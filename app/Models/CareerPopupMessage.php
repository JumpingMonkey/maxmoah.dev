<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPopupMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_title',
        'name',
        'email',
        'phone',
        'social_media',
        'files'
    ];
}
