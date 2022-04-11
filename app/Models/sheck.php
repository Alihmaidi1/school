<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheck extends Model
{
    use HasFactory;

    public $fillable=["student_id","student_fees_id","note","created_at","updated_at"];


    public function student(){


        return $this->belongsTo("App\Models\student","student_id");


    }

}
