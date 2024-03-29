<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    protected $table = 'post_likes';
    protected $primaryKey = ['user_id', 'post_id'];
    public $incrementing = false;


    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
