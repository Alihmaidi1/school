<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class queze extends Model
{
    use HasFactory;

    public $fillable=["title","exam_id","first_answer","second_answer","third_answer","correct_answer","mark"];


    public function exam(){


        return $this->belongsTo("App\Models\\exam","exam_id");

    }

}
