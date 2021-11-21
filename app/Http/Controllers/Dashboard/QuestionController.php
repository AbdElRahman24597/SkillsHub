<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\ExamAdded;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $data['exam'] = $exam;

        return view('dashboard.questions.index')->with($data);
    }

    public function create(Exam $exam)
    {
        if (session('created-exam-id') != $exam->id) {
            return redirect()->route('dashboard.exams.index');
        }

        $data['examId'] = $exam->id;
        $data['questionsNumber'] = $exam->questions_number;

        return view('dashboard.questions.create')->with($data);
    }

    public function store(Request $request, Exam $exam)
    {
        if (url()->previous() != route('dashboard.exams.questions.create', $exam->id)) {
            return redirect()->route('dashboard.exams.index');
        }

        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'right_answers' => 'required|array',
            'right_answers.*' => 'required|integer|between:1,4',
            'option_1s' => 'required|array',
            'option_1s.*' => 'required|string|max:255',
            'option_2s' => 'required|array',
            'option_2s.*' => 'required|string|max:255',
            'option_3s' => 'required|array',
            'option_3s.*' => 'required|string|max:255',
            'option_4s' => 'required|array',
            'option_4s.*' => 'required|string|max:255',
        ]);

        for ($i = 0; $i < $exam->questions_number; $i++) {
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'option_1' => $request->option_1s[$i],
                'option_2' => $request->option_2s[$i],
                'option_3' => $request->option_3s[$i],
                'option_4' => $request->option_4s[$i],
                'right_answer' => $request->right_answers[$i],
            ]);
        }

        $exam->update([
            'active' => true,
        ]);

        event(new ExamAdded($exam));

        $request->session()->remove('created-exam-id');

        return redirect()->route('dashboard.exams.index')->with('success', 'Exam added successfully.');
    }

    public function edit(Question $question)
    {
        $data['question'] = $question;

        return view('dashboard.questions.edit')->with($data);
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'right_answer' => 'required|integer|between:1,4',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',
        ]);

        $question->update($data);

        return redirect()->route('dashboard.exams.questions.index', $question->exam->id)->with('success', 'Question updated successfully.');
    }
}
