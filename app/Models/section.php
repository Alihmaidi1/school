<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    public $fillable=["Name","Notes","grade_id","classroom_id","created_at","updated_at"];

    public function classroom(){

        return $this->belongsTo("\App\Models\classroom","classroom_id");

    }

    public function grade(){

        return $this->belongsTo("App\Models\Grade","grade_id");

    }


    public function promotion_old(){


        return $this->hasMany("\App\Models\promotion","section_id_old");

    }

    public function promotion_new(){


        return $this->hasMany("\App\Models\promotion","section_id_new");

    }


    public function students(){


        return $this->hasMany("App\Models\student","section_id");
    }

    public function exams(){


        return $this->hasMany("App\Models\\exam","section_id");

    }



    public function library(){


        return $this->hasMany("App\Models\library","section_id");

    }




    public function techers(){


        return $this->belongsToMany("App\Models\\techer","App\Models\\techer_section","section_id","techer_id")->withPivot("id");

    }


}
