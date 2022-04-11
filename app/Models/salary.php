<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;

    public $fillable=["salary","Note","created_at","updated_at"];

    public function techer(){

        return $this->hasMany("App\Models\\techer","salary_id");
    }
    
}
