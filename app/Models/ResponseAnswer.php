<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseAnswer extends Model
{
    protected $fillable = ['response_id', 'answer_id','survey_id', 'answer_text','user_id'];

    // العلاقة مع Response
    public function response()
    {
        return $this->belongsTo(Responses::class);
    }

    // العلاقة مع Answer
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
