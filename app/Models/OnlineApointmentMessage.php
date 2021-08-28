<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineApointmentMessage extends Model
{
    use HasFactory;

    protected $fillable = array('name', 'language', 'email', 'phone', 'date', 'time');
}
