<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_fee extends Model
{
    use HasFactory;
    public $fillable=["student_id","fee_id","Note","created_at","updated_at"];


    public function student(){


        return $this->belongsTo("App\Models\student","student_id");

    }

    public function fee(){

        return $this->belongsTo("App\Models\\fees","fee_id");
    }



}
