<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function countStudents()
    {
        $num = 0;
        foreach ($this->exams as $exam) {
            $num += $exam->users->count();
        }

        return $num;
    }
}
