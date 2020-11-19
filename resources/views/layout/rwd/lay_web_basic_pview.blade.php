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
<link href="/css/videojs-contrib-ads.css" rel="stylesheet">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
<style>
	.video-js {
		$primary-background-color: #fa0;
		font-size: 15px;
	}
</style>
<!-- If you'd like to support IE8 -->
<!-- <script src="/js/videojs-ie8.min.js"></script> -->
<!-- <script src="/js/video.js"></script> -->
<script src="https://vjs.zencdn.net/7.3.0/video.min.js"></script>
<!-- <script src="//cdn.sc.gl/videojs-hotkeys/latest/videojs.hotkeys.min.js"></script> -->
<link href="https://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
<script  type="module">
import videojsPreviewThumbnails from 'https://cdn.skypack.dev/videojs-preview-thumbnails';
</script>
<script src="/js/videojs-thumbnails/videojs.thumbnails.js"></script>
<!-- <script src="/js/videojs-thumbnails/videojs.thumbnails.js"></script> -->
<script src="/js/videojs-contrib-hls.js"></script>
<script src="/js/videojs-contrib-ads.js"></script>
<script defer src="/js/fontawesome-all.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="/js/function.js"></script>
<script type="text/javascript" src="/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/js/jquery.visible.js"></script>
<script src="/js/popper.min.js"></script>
<script<script src="/js/bootstrap-4.0.0.js"></script>
<script>
	$(function(){
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
		$('.adClick').on('click',function(){
			var id =  $(this).attr("data-id") 
			console.log('id'+id)

			$.ajax({
				type:"get",
				url:"/clickAd/"+id,
				success:function(result){
					// var address = result['address'];
					// console.log(address);
					// window.location.href = address;
				}
			});	

		})	
		$(".rs-contentword img").lazyload({
			load : cccccount
		});
		// $('[data-toggle="offcanvas"]').on('click', function () {
		// 	$('.offcanvas-collapse').toggleClass('open')
		// 	$('#nav-link-mask').toggle()
		//   })
		//  $('[data-toggle="dropdown"]').on('click', function () {
		// 	if ($('.dropdown-menu').hasClass( "show" ) ) {
		// 		$('.dropdown-menu').removeClass('show');
		// 		return;
		// 	}
    	// 	$('.dropdown-menu').toggleClass('show')
		// })		 
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
@if (config('app.web_type') == 1)
	<body id="rs-body">
@else 
	<body id="rs-body" class="rs-body1" >
@endif
<!-- JuicyAds PopUnders v3 Start -->
<!--
<script type="text/javascript" src="https://js.juicyads.com/jp.php?c=3474y213t244u4q2q28443b494&u=http%3A%2F%2Fwww.juicyads.rocks"></script>
-->
<!-- JuicyAds PopUnders v3 End -->		
	<!-- HEADER 開始 -->
	@include('layout.rwd.lay_web_header',['postArticle'=>false])
	<!-- HEADER 結束 -->
 
	@if (config('app.web_type') == 1)
	<div id="rs-main-content"> 
		@yield('maincontent')
        @include('layout.rwd.lay_web_rightcul_norelate')
	</div>
	@else 
	<div id="rs-main-content1"> 
		@include('layout.rwd.lay_web_left_sidebar')
		@include('layout.rwd.lay_web_right_sidebar')
		@yield('maincontent')
        @include('layout.rwd.lay_web_rightcul_norelate')
		
	</div>
	@endif

	 
	<!-- Footer 開始 -->
	@include('layout.rwd.lay_web_footer')
	<!-- Footer 結束 -->
	@yield('footscript')
</body>
</html>
