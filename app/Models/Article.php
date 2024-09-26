<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relation profile-user (n-1)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relation article-comment (1-n)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Relation profile-user (n-1)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
