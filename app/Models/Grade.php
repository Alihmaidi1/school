<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;
    public $translatable = ['Name'];

    protected $fillable=['Name','Notes',"created_at","updated_at"];
    protected $table = 'Grades';
    public $timestamps = true;

    public function classroom(){

        return $this->hasMany("\App\Models\classroom","grade_id");

    }


    public function section(){

        return $this->hasMany("App\Models\section","grade_id");

    }


    public function promotion_old(){

        return $this->hasMany("\App\Models\promotion","grade_id_old");


    }
    public function promotion_new(){

        return $this->hasMany("\App\Models\promotion","grade_id_new");


    }



    public function students(){


        return $this->hasMany("App\Models\student","grade_id");
    }
}
