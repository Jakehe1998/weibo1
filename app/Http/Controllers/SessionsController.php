<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //

    public function __construct ()
    {
      $this->middleware('guest',[
        'only' => ['create'] // 只让未登录用户访问登录页
      ]);
    }

    public function create ()
    {
      return view('sessions.create');
    }

    public function store (Request $request)
    {
      $credentials = $this->validate($request, [
        'email' => 'required|email|max:255',
        'password' => 'required',
      ]);

      if(Auth::attempt($credentials,$request->has('remember'))) {
        session()->flash('success',"欢迎回来");
        $fallback = route('users.show', Auth::user());
        return redirect()->intended($fallback); //返回上次请求的页面，若上次请求记录为空，则跳转到默认地址
      }else{
        session()->flash('danger','很抱歉，您输入的邮箱或密码不正确');
        return redirect()->back()->withInput();
      }
    }

    public function destroy ()
    {
      Auth::logout();
      session()->flash('success',"您已成功退出");
      return redirect()->route('login');
    }
}
