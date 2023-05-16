<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected  $table = 'account';
    protected $primaryKey = 'id';

    protected $unique = 'email';

    protected $guarded = ['name','password','email'];
}
