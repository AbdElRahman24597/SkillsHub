<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::select('id', 'skill_id', 'name', 'image', 'questions_number', 'active')->latest()->paginate(10);

        return view('dashboard.exams.index')->with($data);
    }

    public function create()
    {
        $data['skills'] = Skill::select('id', 'name')->latest()->get();

        return view('dashboard.exams.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'description_en' => 'required|string|max:5000',
            'description_ar' => 'required|string|max:5000',
            'skill' => 'required|exists:skills,id',
            'image' => 'required|image|max:2048',
            'questions_number' => 'required|integer|min:1',
            'difficulty' => 'required|integer|between:1,5',
            'duration' => 'required|integer|min:1',
        ]);

        $image = $request->file('image')->store('exams');

        $exam = Exam::create([
            'skill_id' => $request->skill,
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'image' => $image,
            'questions_number' => $request->questions_number,
            'difficulty' => $request->difficulty,
            'duration' => $request->duration,
            'active' => false,
        ]);

        session()->put('created-exam-id', $exam->id);

        return redirect()->route('dashboard.exams.questions.create', $exam->id);
    }

    public function show(Exam $exam)
    {
        $data['exam'] = $exam;

        return view('dashboard.exams.show')->with($data);
    }

    public function edit(Exam $exam)
    {
        $data['skills'] = Skill::select('id', 'name')->latest()->get();
        $data['exam'] = $exam;

        return view('dashboard.exams.edit')->with($data);
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'description_en' => 'required|string|max:5000',
            'description_ar' => 'required|string|max:5000',
            'skill' => 'required|exists:skills,id',
            'image' => 'nullable|image|max:2048',
            'difficulty' => 'required|integer|between:1,5',
            'duration' => 'required|integer|min:1',
        ]);

        $image = $exam->image;
        if ($request->hasFile('image')) {
            Storage::delete($image);
            $image = $request->file('image')->store('exams');
        }

        $exam->update([
            'skill_id' => $request->skill,
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'image' => $image,
            'difficulty' => $request->difficulty,
            'duration' => $request->duration,
        ]);

        return redirect()->route('dashboard.exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        if ($exam->users()->exists()) {
            return back()->with('failure', 'Cannot delete exam, This exam has students.');
        }

        try {
            $image = $exam->img;
            $exam->delete();
            Storage::delete($image);

            session()->flash('success', 'Exam deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('failure', 'Cannot delete exam.');
        }

        return back();
    }

    public function toggle(Exam $exam)
    {
        if ($exam->questions_number != $exam->questions()->count()) {
            return back()->with('failure', 'Cannot activate exam, Questions does not equal exam questions number.');
        }

        $exam->update([
            'active' => !$exam->active,
        ]);

        if ($exam->active) {
            $status = 'activated';
        } else {
            $status = 'deactivated';
        }

        return back()->with('success', "Exam {$status} successfully.");
    }
}
