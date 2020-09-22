@extends('layout.rwd.lay_web_basic_norightnav')
@section('title')
@lang('default.title')登入
@stop
@section('des')
@lang('default.description') 上車囉
@stop

@section('maincontent')
<h1 align="center">@lang('default.register')</h1>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal form-register" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <h7 for="name" class="control-label">@lang('default.name')</h7>

                            <div class="">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aaccount') ? ' has-error' : '' }}">
                            <h7 for="aaccount" class="control-label">{{config('app.webAccountText')}}会员号</h7>

                            <div class="">
                                <input id="aaccount" type="text" class="form-control" name="aaccount" value="{{ old('aaccount') }}" required>

                                @if ($errors->has('aaccount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aaccount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('wechat') ? ' has-error' : '' }}">
                            <h7 for="weChat" class="control-label">@lang('default.wechat')</h7>

                            <div class="">
                                <input id="wechat" type="text" class="form-control" name="wechat" value="{{ old('wechat') }}" required>

                                @if ($errors->has('wechat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wechat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <h7 for="email" class="control-label">@lang('default.email')</h7>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <h7 for="password" class="control-label">@lang('default.password')</h7>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <h7 for="password-confirm" class="control-label">@lang('default.confirm')</h7>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                         
                        </div>
                        <hr style="opacity:0;" size="8px" align="center" width="100%">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('default.register')</button>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
