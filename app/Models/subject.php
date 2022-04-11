<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class subject extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];

    public $fillable=["Name","section_id","teacher_id","created_at","updated_at"];



    public function teacher(){

        return $this->belongsTo("App\Models\\techer","teacher_id");
    }

    public function classroom(){

        return $this->belongsTo("App\Models\classroom","classroom_id");
    }

    public function students(){

        return $this->belongsToMany("App\Models\student","App\Models\student_subject","subject_id","student_id");


    }

    public function exams(){

        return $this->hasMany("App\Models\\exam","subject_id");

    }


}
