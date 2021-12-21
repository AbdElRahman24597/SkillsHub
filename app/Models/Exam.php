<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Exam extends Model
{
    use HasFactory, HasTranslations;

    const OPENED = 'opened';
    const CLOSED = 'closed';

    public $translatable = ['name', 'description'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('score', 'time', 'status')
            ->withTimestamps();
    }
}
