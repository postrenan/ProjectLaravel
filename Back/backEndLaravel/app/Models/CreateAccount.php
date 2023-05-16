<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Email;

class CreateAccount extends Model
{
    use HasFactory;
    protected $fillable=[
        'Id',
        'Email',
        'Password'
    ];
}
