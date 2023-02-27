@extends('layouts.default')

@section('title','更新个人资源')

@section('content')
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h5>更新个人资源</h5>
      </div>

      <div class="card-body">
        @include('shared._errors')

        <div class="gravatar_edit">
          <a href="http://gravatar.com/emails" target="_blank">
            <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
          </a>
        </div>

        <form action="{{ route('users.update',$user->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}

          <div class="mb-3">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
          </div>

          <div class="mb-3">
            <label for="name">邮箱：</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
          </div>

          <div class="mb-3">
            <label for="name">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="mb-3">
            <label for="name">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">更新</button>

        </form>
      </div>
    </div>
  </div>
@stop
