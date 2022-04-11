<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;

    public $fillable=["Name","techer_id","section_id","subject_id","mark","created_at","updated_at"];


    public function techer(){

        return $this->belongsTo("App\Models\\techer","techer_id");

    }


    public function subject(){

        return $this->belongsTo("App\Models\subject","subject_id");

    }


    public function section(){

        return $this->belongsTo("App\Models\section","section_id");

    }



    public function quezes(){


        return $this->hasMany("App\Models\queze","exam_id");

    }


}
