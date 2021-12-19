<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillController extends Controller
{
    public function index(): JsonResource
    {
        return SkillResource::collection(Skill::with(['category', 'exams'])->paginate(10));
    }

    public function show(Skill $skill): JsonResource
    {
        return SkillResource::make($skill->load(['category', 'exams']));
    }
}
