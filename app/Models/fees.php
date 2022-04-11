<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class fees extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable=["Name"];
    public $fillable=["amount","Name","classroom_id","year","note"];


    public function classrooms(){


        // return $this->hasMany("App\Models\classroom","")
    }


    public function fees(){


        return $this->hasMany("App\Models\student_fee","student_id");

    }

}
