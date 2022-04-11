<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;

    public $fillable=["grade_id_old","classroom_id_old","section_id_old","grade_id_new","classroom_id_new","section_id_new","old_year","new_year","student_id","created_at","updated_at"];
    public function student(){


        return $this->belongsTo("\App\Models\student","student_id");

    }


        public function grade_old(){

        return $this->belongsTo("\App\Models\Grade","grade_id_old");
        
    }
    
    public function grade_new(){

        return $this->belongsTo("\App\Models\Grade","grade_id_new");
        
    }

    public function classroom_old(){


        return $this->belongsTo("\App\Models\classroom","classroom_id_old");

    }


    
    public function classroom_new(){


        return $this->belongsTo("\App\Models\classroom","classroom_id_new");

    }

    public function section_old(){


        return $this->belongsTo("\App\Models\section","section_id_old");

    }

    public function section_new(){


        return $this->belongsTo("\App\Models\section","section_id_new");

    }


}
