@extends('layout.web.lay_web_basic')
@section('maincontent')
		<div class="post-box">
			<div class="fastlogin">
				<h1 align="center">快速登入</h1>
				<div class="login-btn-fb"><a href="/openid/facebook/login?forward={{$forward}}" title="以Facebook帳號登入"></a></div>
				<div class="login-btn-tt"><a href="/openid/twitter/login?forward={{$forward}}" title="以twitter帳號登入"></a></div>
				<div class="login-btn-gg"><a href="/openid/google/login?forward={{$forward}}" title="以google帳號登入"></a></div>
				<div class="login-btn-ig"><a href="/openid/ig/login?forward={{$forward}}" title="以instagram帳號登入"></a></div>
			</div>
		</div>
@stop