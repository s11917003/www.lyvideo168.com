<!doctype html>
<html>
<head>
<html lang="zh-Hant-TW">
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - 哈哈TV</title>
<link href="/css/mainstyle.css?r=@php echo uniqid(); @endphp" rel="stylesheet" type="text/css">
<link href="https://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
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
<script>
	$(function(){
		$(".contentbox img").lazyload();
	});
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
<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.12&appId=1680137345573660&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- HEADER 開始 -->
	@include('layout.web.lay_web_header',['postArticle'=>false])
	<!-- HEADER 結束 -->
	<!-- NAV選項區域 開始 -->
	@include('layout.web.lay_web_nav')
	<!-- NAV選項區域 結束 -->
	<div class="main-content">
        @yield('maincontent')
	</div>
	<div style="height:60px;"></div>
	<!-- Footer 開始 -->
	@include('layout.web.lay_web_footer')
	<!-- Footer 結束 -->
	@yield('footscript')
</body>
</html>
