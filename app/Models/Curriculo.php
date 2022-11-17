<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Curriculo extends Model
{
    use HasFactory;

    protected $collection = 'curriculo';
    protected $connection = 'mongodb';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'experience',
        'schooling',
        'skills',
        'id_user'
    ];
}
