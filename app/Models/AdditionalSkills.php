<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalSkills extends Model
{
    use HasFactory;

    protected $table = "additional_skills";
    protected $fillable = ['user_id', 'name',];
}
