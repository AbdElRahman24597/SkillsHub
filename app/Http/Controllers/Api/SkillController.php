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
        return SkillResource::collection(
            Skill::active()
                ->with(['category', 'exams'])
                ->paginate(10)
        );
    }

    public function show($id): JsonResource
    {
        $skill = Skill::active()
            ->with(['category', 'exams'])
            ->findOrFail($id);

        return SkillResource::make($skill);
    }
}
