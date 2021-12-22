<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\Types\True_;

class ExamQuestionController extends Controller
{
    public function index($id): JsonResource
    {
        $exam = Exam::active()->with('questions')->findOrFail($id);
        try {
            $token = Crypt::decrypt(request('token'));
        } catch (DecryptException $e) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        abort_if(
            $token['userId'] != auth()->id() || $token['examId'] != $exam->id || $token['expire'] < now(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        return ExamResource::make(
            $exam
        );
    }

    public function store($id): JsonResponse
    {
        $exam = Exam::active()->findOrFail($id);

        try {
            $token = Crypt::decrypt(request('token'));
        } catch (DecryptException $e) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        abort_if(
            $token['userId'] != auth()->id() || $token['examId'] != $exam->id || $token['expire'] < now(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $pivotRow = $exam->users()->where('user_id', $token['userId'])->first();
        abort_if(
            $pivotRow->pivot->status == Exam::STATUS_CLOSED && !is_null($pivotRow->pivot->score),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        request()->validate([
            'answers' => 'array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);

        $score = $this->calculateExamScore($exam);
        $time = $this->calculateExamTime($exam);

        if ($time > $exam->duration) {
            $score = 0;
        }

        $exam->users()->updateExistingPivot(auth()->id(), [
            'score' => $score,
            'time' => $time,
            'status' => Exam::STATUS_CLOSED,
        ]);

        return response()->json([
            'data' => [
                'score' => $score,
            ],
        ]);
    }

    protected function calculateExamScore(Exam $exam): float
    {
        $points = 0;
        $totalQuestionNumber = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset(request()->answers[$question->id])) {
                if (request()->answers[$question->id] == $question->right_answer) {
                    $points++;
                }
            }
        }

        return ($points / $totalQuestionNumber) * 100;
    }

    protected function calculateExamTime(Exam $exam): int
    {
        $pivotRow = $exam->users()->where('user_id', auth()->user()->id)->first();

        return now()->diffInMinutes($pivotRow->pivot->updated_at);
    }
}
