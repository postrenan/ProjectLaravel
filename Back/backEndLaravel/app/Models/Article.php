<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $deleted_at
 * @property mixed $title
 * @property int $author
 * @property mixed $category
 * @property mixed $content
 * @property mixed|string $slug
 * @property mixed $image
 */

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'article';

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'author',
        'category',
        'slug',
        'image'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */

    protected array $dates = ['deleted_at'];
}
