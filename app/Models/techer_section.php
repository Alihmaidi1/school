<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class techer_section extends Model
{
    use HasFactory;

    public $fillable=["techer_id","section_id","created_at","updated_at"];




}
