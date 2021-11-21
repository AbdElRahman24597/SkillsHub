<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.skills.index')->with($data);
    }

    public function create()
    {
        $data['categories'] = Category::select('id', 'name')->orderBy('id', 'DESC')->get();

        return view('dashboard.skills.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image')->store('skills');

        Skill::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'image' => $image,
            'category_id' => $request->category,
        ]);

        return redirect()->route('dashboard.skills.index')->with('success', 'Skill added successfully.');
    }

    public function show(Skill $skill)
    {
        $data['skill'] = $skill;

        return view('dashboard.skills.show')->with($data);
    }

    public function edit(Skill $skill)
    {
        $data['skill'] = $skill;
        $data['categories'] = Category::select('id', 'name')->orderBy('id', 'DESC')->get();

        return view('dashboard.skills.edit')->with($data);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = $skill->image;
        if ($request->hasFile('image')) {
            Storage::delete($image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'image' => $image,
            'category_id' => $request->category,
        ]);

        return redirect()->route('dashboard.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $image = $skill->image;
        $skill->delete();
        Storage::delete($image);

        return back()->with('success', 'Skill deleted successfully.');
    }

    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active,
        ]);

        if ($skill->active) {
            $status = 'activated';
        } else {
            $status = 'deactivated';
        }

        return back()->with('success', "Skill {$status} successfully.");
    }
}
