<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parents extends Model
{
    use HasFactory;

    public $fillable=["email","password","father_name","Number","Title","father_nationality","father_job","mother_name","mother_nationality","mother_job","created_at","updated_at"];

    public function photos(){

        return $this->morphMany("App\Models\photos","photoable");
    }

    public function students(){

        return $this->hasMany("App\Models\student","parents_id");
    
    }
}
