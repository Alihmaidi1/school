<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class student extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];

    public $fillable=["email","password","gender","Name","title","age","classroom_id","section_id","parents_id","created_at","updated_at"];


    public function classroom(){


        return $this->belongsTo("\App\Models\classroom","classroom_id");

    }


    public function parent(){


        return $this->belongsTo("App\Models\parents","parents_id");

    }



    public function promotion(){


        return $this->hasMany("\App\Models\promotion","student_id");

    }



    public function subjects(){


        return $this->belongsToMany("App\Models\subject","App\Models\student_subject","student_id","subject_id");


    }



    public function section(){


        return $this->belongsTo("App\Models\section","section_id");
    }

    public function grade(){


        return $this->belongsTo("App\Models\Grade","grade_id");
    }


    public function photos(){

        return $this->morphMany("App\Models\photos","photoable");

    }



    public function fees(){

        return $this->hasMany("App\Models\student_fee","student_id");
    }


    public function shecks(){

        return $this->hasMany("App\Models\sheck","student_id");

    }


    public function attendace(){

        return $this->hasMany("App\Models\attendace","student_id");

    }



}
