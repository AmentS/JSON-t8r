<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $guarded = [];
    protected $appends = ['is_owner'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public function addUser(User $user)
    {
        $this->users()->attach($user->id);
    }

    public function userCanAccess(User $user): bool
    {
        return $this->users()->whereKey($user->getKey())->exists();
    }

    public function isOwner(User $user): bool
    {
        return $this->owner->is($user);
    }

    public function getIsOwnerAttribute(): bool
    {
        return $this->owner_id === Auth::user()->id;
    }
}
