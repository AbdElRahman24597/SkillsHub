<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'description' => $this->getTranslations('description'),
            'image' => uploads($this->image),
            'questions_number' => $this->questions_number,
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
            'skill' => SkillResource::make($this->whenLoaded('skill')),
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            'created_at' => $this->created_at,
        ];
    }
}
