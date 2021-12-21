<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class ExamController extends Controller
{
    public function index(): JsonResource
    {
        return ExamResource::collection(
            Exam::active()
                ->latest()
                ->with('skill')
                ->paginate(8)
        );
    }

    public function popular(): JsonResource
    {
        return ExamResource::collection(
            Exam::active()
                ->withCount('users')
                ->latest('users_count')
                ->take(8)
                ->with('skill')
                ->get()
        );
    }

    public function show($id): JsonResponse
    {
        $exam = Exam::active()
            ->with('skill')
            ->findOrFail($id);

        return response()->json([
            'data' => ExamResource::make($exam),
            'canUserEnterExam' => $this->canUserEnterExam($exam),
        ]);
    }

    public function start($id): JsonResponse
    {
        $exam = Exam::active()->findOrFail($id);
        $userId = auth()->id();

        $pivotRow = $exam->users()->where('user_id', $userId)->first();
        if ($pivotRow && $pivotRow->pivot->status == Exam::CLOSED) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$exam->users->contains($userId)) {
            $exam->users()->attach($userId);
        } else {
            $exam->users()->updateExistingPivot($userId, [
                'status' => Exam::CLOSED,
            ]);
        }

        return response()->json([
            'StartedExamToken' => Crypt::encrypt([
                'userId' => $userId,
                'examId' => $exam->id,
                'expire' => now()->addMinutes($exam->duration),
            ]),
        ]);
    }

    protected function canUserEnterExam(Exam $exam): bool
    {
        $canStartExam = true;

        if (auth('sanctum')->check()) {
            $user = auth('sanctum')->user();
            if (!$user->hasRole('student')) {
                $canStartExam = false;
            } else {
                $pivotRow = $exam->users()->where('user_id', $user->id)->first();
                if ($pivotRow && $pivotRow->pivot->status == Exam::CLOSED) {
                    $canStartExam = false;
                }
            }
        }

        return $canStartExam;
    }
}
