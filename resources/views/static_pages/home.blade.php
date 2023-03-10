@extends('layouts.default')

@section('title','主页')

@section('content')
<div class="bg-light p-3 p-sm-5 rounded">
  <h1>Hello Laravel</h1>
  <p class="lead">
    你现在所看到的是 <a href="https://github.com/Jakehe1998">Laravel 个人练习项目</a> 的示例项目主页。
  </p>
  <p>
    一切，将从这里开始。
  </p>
  <p>
    <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
  </p>
</div>
@stop
