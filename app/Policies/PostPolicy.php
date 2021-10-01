<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    private string $class = 'post';

    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        foreach ($user->roles as $role){
            if($role->permissions->contains('name', __FUNCTION__ . '-' . $this->class)){
                return true;
            }
        }
        return false;
    }

    public function view(User $user): bool
    {
        foreach ($user->roles as $role){
            if($role->permissions->contains('name', __FUNCTION__ . '-' . $this->class)){
                return true;
            }
        }
        return false;
    }

    public function create(User $user): bool
    {
        foreach ($user->roles as $role){
            if($role->permissions->contains('name', __FUNCTION__ . '-' . $this->class)){
                return true;
            }
        }
        return false;
    }

    public function update(User $user): bool
    {
        foreach ($user->roles as $role){
            if($role->permissions->contains('name', __FUNCTION__ . '-' . $this->class)){
                return true;
            }
        }
        return false;
    }

    public function delete(User $user): bool
    {
        foreach ($user->roles as $role){
            if($role->permissions->contains('name', __FUNCTION__ . '-' . $this->class)){
                return true;
            }
        }
        return false;
    }

    public function restore(User $user): bool
    {
        //
    }

    public function forceDelete(User $user): bool
    {
        //
    }
}
