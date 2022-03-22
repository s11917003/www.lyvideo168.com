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
<link href="/css/index.css" rel="stylesheet" type="text/css">
<link href="/css/movie.css" rel="stylesheet" type="text/css">
<link href="/css/search-list.css" rel="stylesheet" type="text/css">
<link href="/css/list.css" rel="stylesheet" type="text/css">
<link href="/css/videojs-contrib-ads.css" rel="stylesheet">
<link href="/css/splide.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/category-list.css">
<link rel="icon" href="/img/logo.png" type="image/x-icon" />
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MC5Q58D');
</script>
<!-- End Google Tag Manager -->
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
<script defer src="/js/splide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/function.js"></script>
<script src="/js/lib/dmm.js"></script>
<!-- <script type="text/javascript" src="/js/jquery.lazyload.js"></script> -->
<script type="text/javascript" src="/js/jquery.visible.js"></script>
<!-- <script src="/js/popper.min.js"></script> -->
<!-- <script src="/js/main.js"></script>
<script src="/js/select.js"></script> -->
<script>
	$(function() {
		$('.big-bg ').click(function() {
			$('.big').hide()
		});
		$.ajax({
				type:"POST",
				url:"/{{$lang}}/popular",
				dataType:"json",
				success:function(result){
					$(".actress_popular_list").empty();
					$(".tag_popular_list").empty();
					$(".series_popular_list").empty();
					
					result.video_actress_popular.forEach(element => {
						let name = ''
						if('{{$lang}}' == 'zh' && element.ChineseName1)  {
							name = element.ChineseName1
						} else if('{{$lang}}' == 'en' && element.EnglishName1)  {
							name = element.EnglishName1
						}else {
							name = element.JapaneseName1
						}
						actress =	`<li><a href="/{{$lang}}/actress/`+element.id+`"   class="female-list__item">`+name+`</a></li>`;
						$(".actress_popular_list").append(actress)
					});
					result.tag_actress_popular.forEach(element => {
						let tag = ''
						if('{{$lang}}' == 'zh')  {
							tag = element.zh
						} else if('{{$lang}}' == 'en')  {
							tag = element.en
						} else  {
							tag = element.jp
						}
						actress =	`<li><a style='font-size: 15px;' href="/{{$lang}}/category?cate=`+element.id+`"   class="female-list__item">`+tag+`</a></li>`;
						$(".tag_popular_list").append(actress)
					});
					result.video_series_popular.forEach(element => {
					 
						actress =	`<li><a href="/{{$lang}}/series?search=`+element+`"   class="female-list__item">`+element+`</a></li>`;
						$(".series_popular_list").append(actress)
					});
					$(".actress_popular_list").append(`<li class="keyword__more"><a href="/{{$lang}}/actress_list">{{__('ui.more')}} &gt;&gt;</a></li>`)
					$(".tag_popular_list").append(`<li class="keyword__more"><a href="/{{$lang}}/category">{{__('ui.more')}} &gt;&gt;</a></li>`)
					 
				}
			});	
		// $.ajaxSetup({
		// headers: {
		// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// }
		// });
	});
</script>
@yield('topscript')
</head>
<div class="big" style=" display:none">
	<div class="big-bg"></div>
	<img class="closeBtn" src="/img/close.png" style="position: absolute; top:55px;right:20px;height:30px;width:30px;z-index: 1000;" > 
	<div class="splide">
		<div class="splide__track">
			  <ul class="splide__list">
			  </ul>
		</div>
	  </div>
</div>
@if (config('app.web_type') == 1)
	<body id="rs-body">
@else 
	<body id="rs-body" class="rs-body1" >
@endif

	<!-- HEADER 開始 -->
	@include('layout.rwd.lay_video_header')
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
	@yield('Carousel')
	 
	<!-- Footer 開始 -->
	@include('layout.rwd.lay_video_footer')
	<!-- Footer 結束 -->
	@yield('footscript')
</body>
 
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MC5Q58D"
height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
 
</html>