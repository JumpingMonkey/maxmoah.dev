<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivatAppointmentMessage extends Model
{
    use HasFactory;

    protected $fillable = array('name', 'email', 'country_city', 'phone', 'time');
}
