<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    // Se ejecuta antes que cualquier otro
    // Si no retornamos nada, continua ejecutando las polícitas. Si no, las corta con true/false
    public function before(User $authUser, $ability){
        if ($authUser->isAdmin()){
            return true;
        }
    }

    public function edit(User $authUser, User $user){
        return $authUser->id == $user->id;
    }

    public function update(User $authUser, User $user){
        return $authUser->id == $user->id;
    }

    public function destroy(User $authUser, User $user){
        return $authUser->id == $user->id;
    }
}
