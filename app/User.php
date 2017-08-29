<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'cover', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes casting for serialization.
     *
     * @var array
     */
    protected $casts = ['id' => 'int'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
//    protected $appends = ['getIsFollowedAttribute'];


    /**
     * Accessors
     */
    public function getAvatarAttribute($val)
    {
        return is_null($val) ? asset('img/avatar-placeholder.svg') : $val;
    }

    public function getCoverAttribute($val)
    {
        return is_null($val) ? asset('img/cover-placeholder.jpg') : $val;
    }

    /**
     * Relations
     */

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->withCount('replies', 'likes');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follow_id', 'user_id')
                    ->withPivot('follow_id', 'user_id')
                    ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follow_id')
                    ->withPivot('follow_id', 'user_id')
                    ->withTimestamps();
    }

    public function isFollowing($user_id = null)
    {
        return $this->following()
            ->where('follow_id', $user_id ?: auth()->id() )
            ->exists();
    }

    public function getIsFollowedAttribute()
    {
        return $this->followers()
            ->where('follow_id', $this->getKey() )
            ->exists();
    }
}
