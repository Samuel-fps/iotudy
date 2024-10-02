<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function published(?User $user, Article $article){
        return $article->status == 1;
    }
}
