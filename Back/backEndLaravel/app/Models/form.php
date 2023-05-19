<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['phone','email','msg','name'];
    protected $guarded = ['update_at','created_at','id'];
}
