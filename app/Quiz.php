<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name', 'user_id', 'category_id', 'difficulty_id', 'image', 'type'
    ];
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }
    
    public function quizType()
    {
        return $this->belongsTo(QuizType::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
