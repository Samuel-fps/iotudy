<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{

    public function view(?User $user, Article $article){
        return $article->user_id == $user->id;
    }

    public function update(?User $user, Article $article){
        return $article->user_id == $user->id;
    }

    public function delete(?User $user, Article $article){
        return $article->user_id == $user->id;
    }


    public function published(?User $user, Article $article){
        return $article->status == 1;
    }
}
