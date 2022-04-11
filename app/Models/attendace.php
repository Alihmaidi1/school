<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendace extends Model
{
    use HasFactory;

    public $fillable=["student_id","status","section_id","created_at","updated_at"];

    public function student(){


        return $this->belongsTo("App\Models\student","student_id");

    }

}
