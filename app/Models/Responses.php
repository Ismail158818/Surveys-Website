<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    protected $fillable = ['survey_id', 'user_id']; 

    public function answers()
    {
        return $this->hasMany(ResponseAnswer::class);
    }
}
