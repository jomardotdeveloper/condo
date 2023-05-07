<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'file_src',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
