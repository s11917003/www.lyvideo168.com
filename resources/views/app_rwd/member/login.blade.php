@extends('layout.rwd.lay_web_basic_noright')
@section('title')
哈友登入
@stop
@section('maincontent')
			<div class="rs-post-box">
				<div class="rs-fastlogin">
					<h1 align="center">快速登入</h1>
					<div class="rs-login-btn-fb"><a href="/openid/facebook/login?forward={{$forward}}" title="以Facebook帳號登入"></a></div>
					<div class="rs-login-btn-tt"><a href="/openid/twitter/login?forward={{$forward}}" title="以twitter帳號登入"></a></div>
					<div class="rs-login-btn-gg"><a href="/openid/google/login?forward={{$forward}}" title="以google帳號登入"></a></div>
					<!--<div class="rs-login-btn-ig"><a href="/openid/ig/login?forward={{$forward}}" title="以instagram帳號登入"></a></div>-->
					<div class="rs-login-btn-line"><a href="/openid/line/login?forward={{$forward}}" title="以Line帳號登入"></a></div>
				</div>
			</div>
@stop