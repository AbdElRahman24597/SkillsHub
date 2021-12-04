<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::active()->latest()->paginate(8);

        return view('web.exams.index')->with($data);
    }

    public function show($exam)
    {
        $data['exam'] = Exam::active()->findOrFail($exam);
        $data['canStartExam'] = $this->canEnterExam(auth()->user(), $data['exam']);

        return view('web.exams.show')->with($data);
    }

    public function start(Exam $exam)
    {
        if (url()->previous() !== route('exams.show', $exam->id)) {
            return redirect()->route('home.index');
        }

        $userId = auth()->user()->id;
        $pivotRow = $exam->users()->where('user_id', $userId)->first();
        if ($pivotRow && $pivotRow->pivot->status == 'closed') {
            return redirect()->route('home.index');
        }

        if (!$exam->users->contains($userId)) {
            $exam->users()->attach($userId);
        } else {
            $exam->users()->updateExistingPivot($userId, [
                'status' => 'closed',
            ]);
        }

        session()->put('started-exam-id', $exam->id);

        return redirect()->route('exams.questions', $exam->id);
    }

    public function questions(Exam $exam)
    {
        if (session('started-exam-id') !== $exam->id) {
            return redirect()->route('home.index');
        }

        $data['exam'] = $exam;

        return view('web.exams.questions')->with($data);
    }

    public function store(Request $request, Exam $exam)
    {
        if (url()->previous() !== route('exams.questions', $exam->id)) {
            return redirect()->route('home.index');
        }

        $request->validate([
            'answers' => 'nullable|array',
            'answers.*' => 'required|in:1,2,3,4',
        ]);

        $score = $this->calculateExamScore($request, $exam);
        $time = $this->calculateExamTime($exam);

        if ($time > $exam->duration) {
            $score = 0;
        }

        $exam->users()->updateExistingPivot($request->user()->id, [
            'score' => $score,
            'time' => $time,
        ]);

        session()->remove('started-exam-id');

        return redirect()->route('exams.show', $exam->id)->with('success', __('web.exams.success_message', [
            'name' => $exam->name,
            'score' => $score,
        ]));
    }

    private function canEnterExam(User $user, Exam $exam)
    {
        $canStartExam = true;

        if ($user) {
            if (!$user->hasRole('student')) {
                $canStartExam = false;
            } else {
                $pivotRow = $exam->users()->where('user_id', $user->id)->first();
                if ($pivotRow && $pivotRow->pivot->status == 'closed') {
                    $canStartExam = false;
                }
            }
        }

        return $canStartExam;
    }

    private function calculateExamScore(Request $request, Exam $exam)
    {
        $points = 0;
        $totalQuestionNumber = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                if ($request->answers[$question->id] == $question->right_answer) {
                    $points++;
                }
            }
        }

        return ($points / $totalQuestionNumber) * 100;;
    }

    private function calculateExamTime(Exam $exam)
    {
        $pivotRow = $exam->users()->where('user_id', auth()->user()->id)->first();
        $startedTime = $pivotRow->pivot->updated_at;
        $finishedTime = Carbon::now();

        return $finishedTime->diffInMinutes($startedTime);
    }
}
