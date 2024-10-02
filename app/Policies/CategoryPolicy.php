<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function published(?User $user, Category $category){
        return $category->status == 1;
    }
}
