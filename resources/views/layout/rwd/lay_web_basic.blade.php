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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/function.js"></script>
<!-- <script type="text/javascript" src="/js/jquery.lazyload.js"></script> -->
<script type="text/javascript" src="/js/jquery.visible.js"></script>
<script src="/js/popper.min.js"></script>
<!-- <script src="/js/bootstrap-4.0.0.js"></script> -->
<script src="/js/main.js"></script>
<script src="/js/select.js"></script>
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

	<body id="rs-body">

 
	<!-- HEADER 開始 -->
	@include('layout.rwd.lay_video_header')
	<!-- HEADER 結束 -->
	<div id="rs-main-content"  style='padding-bottom:5rem;'> 
		<div class="search" style='top: 0rem;'>
			<div class="search__content">
			<input type="search">
			</div>
			<div class="search__btn">
			<button>搜尋</button>
			<i class="i_search">
				<svg class="svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 23.84 23.84">
				<g>
					<circle class="cls-1" cx="11.03" cy="11.03" r="10.03"></circle>
					<line class="cls-1" x1="18.22" y1="18.22" x2="22.84" y2="22.84"></line>
				</g>
				</svg>
			</i>
			</div>
		</div>
		<main style="padding-top: 0rem;"> 
			@include('layout.rwd.lay_web_right_video')
			@yield('maincontent')
		</main>
		@yield('pagination')
	</div>
	@yield('Carousel')
	 
	<!-- Footer 開始 -->
	@include('layout.rwd.lay_video_footer')
	<!-- Footer 結束 -->
	@yield('footscript')
</body>
</html>