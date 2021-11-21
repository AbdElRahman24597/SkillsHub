<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $data['skills'] = Skill::active()->orderBy('id', 'desc')->paginate(8);

        return view('web.skills.index')->with($data);
    }

    public function show($skill)
    {
        $data['skill'] = Skill::active()->findOrFail($skill);
        $data['exams'] = $data['skill']->exams()->active()->get();

        return view('web.skills.show')->with($data);
    }
}
