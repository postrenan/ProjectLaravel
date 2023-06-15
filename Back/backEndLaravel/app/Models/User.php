<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $ID
 * @property string $name
 * @property Carbon $deleted_at
 * @property mixed $email
 * @property mixed|string $api_token
 * @property mixed|string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $table = 'users';

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'email',
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    protected array $dates = ['deleted_at'];

}
