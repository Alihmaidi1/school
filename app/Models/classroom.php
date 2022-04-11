<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    public $fillable=["Name","Notes","created_at","grade_id","updated_at"];

    public function grade(){

        return $this->belongsTo("\App\Models\Grade","grade_id");
    }

    public function section(){

        return $this->hasMany("\App\Models\section","classroom_id");

    }

    public function students(){


        return $this->hasManyThrough("App\Models\student","App\Models\section","classroom_id","section_id");

    }

    public function promotion_old(){


        return $this->hasMany("\App\Models\promotion","classroom_id_old");


    }

    public function promotion_new(){


        return $this->hasMany("\App\Models\promotion","classroom_id_new");


    }



    public function subjects(){


        return $this->hasMany("App\Models\subject","classroom_id");

    }



    public function library(){


        return $this->hasMany("App\Models\library","classroom_id");


    }


}
