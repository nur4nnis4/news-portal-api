<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['post_id', 'user_id', 'content'];


    public function commenter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function post(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
