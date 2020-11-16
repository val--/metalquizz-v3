<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'category_id', 'difficulty_id', 'image', 'type', 'inactive'
    ];
    
    public function answers()
    {
        return $this->hasMany(Answers::class);
    }
    
    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }
    
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function attachement()
    {
        return $this->hasOne(Attachement::class);
    }
}
