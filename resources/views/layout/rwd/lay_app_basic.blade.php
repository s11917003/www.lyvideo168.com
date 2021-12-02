<!doctype html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8">	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="description" content="@yield('des')">
<link href="/css/respon.css?" rel="stylesheet" type="text/css">
<link href="/css/bootstrap-4.0.0.css" rel="stylesheet">
<link href="/css/video-js.css" rel="stylesheet">
<link href="/css/videojs-contrib-ads.css" rel="stylesheet">
<link rel="icon" href="/img/logo.png" type="image/x-icon" />
<script src="/js/jquery-3.3.1.js"></script>
<script src="/js/video.js"></script>
<script src="/js/videojs-contrib-hls.js"></script>
<!--<script src="/js/videojs-contrib-ads.js"></script>-->
<style>
	.video-js {
		$primary-background-color: #fa0;
		font-size: 15px;
	}
</style>
<!-- If you'd like to support IE8 -->
@yield('topscript')
</head>
@if (config('app.web_type') == 1)
	<body id="rs-body">
@else 
	<body id="rs-body" class="rs-body1" >
@endif

<!-- JuicyAds PopUnders v3 Start -->
<!-- <script type="text/javascript" src="https://js.juicyads.com/jp.php?c=3474y213t244u4q2q28443b494&u=http%3A%2F%2Fwww.juicyads.rocks"></script> -->
<!-- JuicyAds PopUnders v3 End -->
	<!-- HEADER 結束 -->
	<!-- NAV選項區域 結束 -->
	<div id="rs-main-content" style="width: 100%; margin: 0 0 20px 0">
        @yield('maincontent')
	</div>
</body>

<script defer src="/js/fontawesome-all.js"></script>
<script src="/js/function.js"></script>
<script type="text/javascript" src="/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/js/jquery.visible.js"></script>
<script>
	$(function(){
		$(".rs-contentword img").lazyload({
			load : cccccount
		});
	});
	
	function cccccount() {
		console.log('+++')
	}
</script>
{!! Analytics::render() !!}

<script>
@if(Session::has('USER'))
	var user_id = '{{ Session::get('USER')['USER_ID']}}'
	var user_acc = '{{ Session::get('USER')['LOGIN_ACCOUNT']}}'
	ga('set', 'userId', user_id)
@else
	var user_id = ''
	var user_acc = ''
@endif
	var crc = ''
</script>
</html>
