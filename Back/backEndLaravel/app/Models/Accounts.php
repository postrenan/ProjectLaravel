<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public $timestamps = false;

    public $table = 'account';
    public $primaryKey = 'ID';
    public $fillable = ['email', 'password'];
}
