<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relation comment-user (n-1)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relation comment-article (n-1)
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
