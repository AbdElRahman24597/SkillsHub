<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'image' => uploads($this->image),
            'active' => $this->active,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'exams' => ExamResource::collection($this->whenLoaded('exams')),
        ];
    }
}
