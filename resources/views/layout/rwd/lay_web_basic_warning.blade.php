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
{!! Analytics::render() !!}
@yield('topscript')
</head>
<body id="rs-body">
	<div id="rs-main-content" style="width: 100%">
        @yield('maincontent')
	</div>
	<!-- Footer 開始 -->
		<!-- rs-footer -->
	<div id="rs-footer">
		<p>&copy; 老湿机</p>
	</div>
	<script src="/js/draw.js"></script>
	<!-- Footer 結束 -->
</body>
</html>
