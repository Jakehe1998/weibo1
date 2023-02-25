<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function create ()
    {
      return view('users.create');
    }

    public function show (User $user)
    {
       return view('users.show',compact('user'));
    }

    public function store (Request $request)
    {
      $this->validate($request, [
        'name' => 'requeired|unique:users|max:50',
        'email' => 'requeired|email|unique:users|max:255',
        'password' => 'requeired|confirmad|min:6',  // confirmad 密码匹配验证
      ]);
      return;
    }
}
