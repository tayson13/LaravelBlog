<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_posts(){

        return $this->belongsToMany('App\Models\Post');
    }

    public function role(){
        
        return $this->hasOne('App\Models\Role');
    }

    public function profile(){
        
        return $this->hasOne('App\Models\Profile', 'user_id');
    }

    public function comment(){
        
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    public function UserLike()
    {
        return $this->MorphMany('App\Models\Like', 'likeable');
    }
}
