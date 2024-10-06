<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // CReate profile
    protected static function boot(){
        parent::boot();

        static::created(function($user){
            $user->profile()->create();
        });
    }

    // Relation user-profile (1-1)
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    // Relation user-article (1-n)
    public function articles(){
        return $this->hasMany(Article::class);
    }

    // Relation user-comment (1-n)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function adminlte_image(){
        return asset('storage/' . Auth::user()->profile->photo);
    }

}
