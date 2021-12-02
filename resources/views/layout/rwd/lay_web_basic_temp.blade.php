<!doctype html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8">	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="description" content="@yield('des')">
<meta name="keywords" content="@yield('keywords')">
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
<link rel="icon" href="/img/logo.png" type="image/x-icon" />
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MC5Q58D');
</script>
<!-- End Google Tag Manager -->
<script src="js/main.js"></script>
<script src="js/select.js"></script>
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
	@yield('footer')
	@yield('footscript')
</body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MC5Q58D"
	height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
</html>