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
 */

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'article';

    protected $fillable = [
        'title',
        'content',
        'author',
        'category',
        'slug',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
    ];
}
