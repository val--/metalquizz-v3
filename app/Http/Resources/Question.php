<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Answer as AnswerResource;

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
        return[
            'id' => $this->id,
            'question' => $this->question,
            'answers' => AnswerResource::collection($this->answers)->shuffle(),
            /*'question_type' => QuestionTypeResource::collection($this->question_type_id)*/
        ];
    }
}
