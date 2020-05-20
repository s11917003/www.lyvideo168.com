@extends('layout.rwd.lay_web_basic_norightnav')
@section('title')
@lang('default.title')登入
@stop
@section('des')
@lang('default.description') 上車囉
@stop

@section('maincontent')
        <form class="form-signin" method="POST" action="/loginPost">
            {{ csrf_field() }}
           
            <h1 class="h3 mb-3 font-weight-normal">@lang('default.login')</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="password"  class="form-control" placeholder="Password" required="">
            @if(session('success'))
            <span class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </span>
             @endif
            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>@lang('default.remenberMe')
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('default.confirm')</button>
            <!-- <p class="mt-5 mb-3 text-muted">© 2017-2018</p> -->
          </form>
@stop
 