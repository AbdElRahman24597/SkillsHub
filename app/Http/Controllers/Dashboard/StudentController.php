<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = User::role('student')->paginate(10);

        return view('dashboard.students.index')->with($data);
    }

    public function scoreboard(User $user)
    {
        if (!$user->hasRole('student')) {
            return redirect()->route('dashboard.students.index');
        }

        $data['student'] = $user;
        $data['exams'] = $user->exams()->paginate(10);

        return view('dashboard.students.scoreboard')->with($data);
    }

    public function openExam(User $user, $examId)
    {
        if (!$user->exams->contains($examId)) {
            return back();
        }

        $user->exams()->updateExistingPivot($examId, [
            'status' => 'opened',
        ]);

        return back()->with('success', 'Exam opened successfully.');
    }

    public function closeExam(User $user, $examId)
    {
        if (!$user->exams->contains($examId)) {
            return back();
        }

        $user->exams()->updateExistingPivot($examId, [
            'status' => 'closed',
        ]);

        return back()->with('success', 'Exam closed successfully.');
    }
}
