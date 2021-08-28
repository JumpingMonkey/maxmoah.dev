<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeRequestMessage extends Model
{
    use HasFactory;

    protected $fillable = array('name', 'subject', 'email', 'phone', 'message');
}
