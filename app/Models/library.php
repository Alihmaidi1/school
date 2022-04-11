<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library extends Model
{
    use HasFactory;

    public $fillable=["Name_File","classroom_id","section_id","techer_id","extension","created_at","updated_at"];


    public function techer(){


    return $this->belongsTo("App\Models\\techer","techer_id");

    }


    public function classroom(){


        return $this->belongsTo("App\Models\classroom","classroom_id");

    }


    public function section(){

        return $this->belongsTo("App\Models\section","section_id");


    }


}
