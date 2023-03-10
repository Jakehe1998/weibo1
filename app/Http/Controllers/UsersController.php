<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{

    public function __construct ()
    {
      // 第一个参数为中间键名称，第二个参数为要过滤的动作，
      $this->middleware('auth',[
        'except' => ['show','create','story','index'] // 非需登录操作
      ]);

      $this->middleware('guest',[
        'only' => ['create'] // 只让未登录用户访问
      ]);
    }

    public function index ()
    {
      $users = User::paginate(6);
      return view('users.index',compact('users'));
    }

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
        'name' => 'required|unique:users|max:50',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|confirmed|min:6',  // confirmed 密码匹配验证
      ]);

      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      Auth::login($user);
      session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
      return redirect()->route('users.show',[$user]);

    }

    public function edit (User $user)
    {
      $this->authorize('update', $user);
      return view('users.edit',compact('user'));
    }

    public function update(User $user, Request $request)
    {
      $this->authorize('update', $user);
      $this->validate($request,[
        'name'=> 'required|max:50',
        'password'=> 'nullable|confirmed|min:6',
      ]);

      $data = [];

      $data['name'] = $request->name;

      if($request->password) $data['password'] = bcrypt($request->password);

      $user->update($data);

      session()->flash('success', '个人资料更新成功');
      return redirect()->route('users.show',$user);

    }

    public function destroy(User $user) {
      $this->authorize('destroy',$user);
      $user->delete();
      session()->flash('success','成功删除用户');
      return back();
    }
}
