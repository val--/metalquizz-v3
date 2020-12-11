<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
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
            'answer' => $this->answer,
            //'is_right_answer' => $this->is_right_answer, // must not be returned in api return
        ];
    }
}
