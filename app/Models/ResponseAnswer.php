<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseAnswer extends Model
{
    protected $fillable = ['response_id', 'answer_id'];
    
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}

