<!doctype html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8">	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="description" content="@yield('des')">
<link href="/css/respon.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap-4.0.0.css" rel="stylesheet">
<link href="/css/video-js.css" rel="stylesheet">
<link href="/css/index.css" rel="stylesheet" type="text/css">
<link href="/css/search-list.css" rel="stylesheet" type="text/css">
<link href="/css/female-list.css" rel="stylesheet" type="text/css">
<link href="/css/female-detail.css" rel="stylesheet" type="text/css">
<link href="/css/list.css" rel="stylesheet" type="text/css">
<link href="/css/videojs-contrib-ads.css" rel="stylesheet">
<link rel="stylesheet" href="/css/category-list.css">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
 
 
<script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>
 
<link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">

<script  type="module">
import videojsPreviewThumbnails from 'https://cdn.skypack.dev/videojs-preview-thumbnails';
</script>
  
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
<script>
	$(function(){
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
	});
</script>
@yield('topscript')
</head>

	<body id="rs-body" style='padding-top:1rem;'>

 
	<!-- HEADER 開始 -->
	
	<!-- HEADER 結束 -->
	<div id="rs-main-content"  style='padding-top:0rem;'> 
	 
		<main style="padding-top: 0rem;"> 
		 
			@yield('maincontent')
		</main>
		@yield('pagination')
	</div>
	@yield('footscript')
</body>
</html>