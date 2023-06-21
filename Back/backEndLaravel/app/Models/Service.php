<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @property Carbon $deleted_at
 * @property mixed $title
 * @property int $id
 * @property mixed $content
 */

class Service extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $table = 'service';

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected array $dates = ['deleted_at'];

}
