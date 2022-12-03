<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Vaga extends Model
{
    use HasFactory;

    protected $collection = 'vagas';
    protected $connection = "mongodb";

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'necessary_skills',
        'level',
        'experience'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
