<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
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
}
