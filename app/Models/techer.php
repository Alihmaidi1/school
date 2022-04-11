<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class techer extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable=["Name"];
    public $fillable=["Name","email","password","number","gender","start_date","salary_id","title","spicefic","created_at","updated_at"];

    public function salary(){


        return $this->belongsTo("App\Models\salary","salary_id");
    }


    public function photos(){

        return $this->morphMany("App\Models\photos","photoable");

    }

    public function subjects(){


        return $this->hasMany("App\Models\subject","teacher_id");

    }

    public function exams(){

        return $this->hasMany("App\Models\\exam","techer_id");

    }



    public function librarys(){


        return $this->hasMany("App\Models\library","techer_id");

    }



    public function sections(){


        return $this->belongsToMany("App\Models\section","App\Models\\techer_section","techer_id","section_id")->withPivot("id");

    }



}
