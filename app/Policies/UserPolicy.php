<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // update() 接收两个参数，第一个参数为当前用户实例，第二个参数要进行授权的用户实例
    public function update(User $currentUser, User $user)
    {
      return $currentUser->id === $user->id;
    }
}
