<!doctype html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8">	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - 老湿机</title>
<meta name="description" content="@yield('des')">
<link href="/css/respon.css?r=@php echo uniqid(); @endphp" rel="stylesheet" type="text/css">
<link href="/css/bootstrap-4.0.0.css?r=@php echo uniqid(); @endphp" rel="stylesheet">
<link href="https://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
	.video-js {
		$primary-background-color: #fa0;
		font-size: 15px;
	}
</style>
<!-- If you'd like to support IE8 -->
<script src="//vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="//vjs.zencdn.net/6.6.3/video.js"></script>

<script defer src="/js/fontawesome-all.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/js/function.js?r=@php echo uniqid(); @endphp"></script>
<script type="text/javascript" src="/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/js/jquery.visible.js"></script>
<script src="/js/bootstrap-4.0.0.js"></script>

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
@yield('topscript')
</head>
<body id="rs-body">
<!-- JuicyAds PopUnders v3 Start -->
<script type="text/javascript" src="https://js.juicyads.com/jp.php?c=3474y213t244u4q2q28443b494&u=http%3A%2F%2Fwww.juicyads.rocks"></script>
<!-- JuicyAds PopUnders v3 End -->
	<!-- HEADER 開始 -->
	@include('layout.rwd.lay_web_header',['postArticle'=>false])
	<!-- HEADER 結束 -->
	<!-- NAV選項區域 開始 -->
	@include('layout.rwd.lay_web_nav')
	<!-- NAV選項區域 結束 -->
	<div id="rs-main-content">
        @yield('maincontent')
	</div>
	<!-- Footer 開始 -->
	<!-- Footer 結束 -->
	@yield('footscript')
</body>
</html>
