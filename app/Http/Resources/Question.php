<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Answer as AnswerResource;
use Illuminate\Support\Facades\Crypt;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $right_answer_id = false;
        foreach($this->answers as $answer){
            if($answer->is_right_answer){
                $right_answer_id_encrypted = Crypt::encryptString($answer->id);
            }
        }
        return[
            'id' => $this->id,
            'question' => $this->question,
            'answers' => AnswerResource::collection($this->answers)->shuffle(),
            'right_answer' => $right_answer_id_encrypted
            /*'question_type' => QuestionTypeResource::collection($this->question_type_id)*/
        ];
    }
}
