<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function authors()
    {
        return $this->belongsToMany(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isSubscribedBy(User $user)
    {
        return $this->subscriptions()->where('user_id', $user->id)->exists();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}