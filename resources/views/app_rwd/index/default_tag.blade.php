@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php echo mb_substr(strip_tags($title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($title)}}
@stop
@section('topscript')
<meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($title)}}">

<script>
	// var postid = '{{$post->id}}';
	// var postnick = '{{$post->userInfo->nick_name}}';
	// var nick = postnick
</script>
@stop
@section('maincontent')
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2"  style="float: left; width: 100%; padding-top:10px; height: 100%;">
				<h5 style="COLOR: #ccc; font-weight: bold;">{{$title}}</h5>
	
				@foreach ($posts as $post)
				 <div style="float: left;padding: 10px; width: 100%; height: 260px; overflow: hidden; text-align: center">
					<a href="/p/{{$post->article['id']}}">
					<!-- <img src="{{ asset('storage'.$post->article['tb_img']) }}" style="width: 100%; height: 85%;"> -->
					<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" height="200px" width="600" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<div class="vjs-poster" tabindex="-1" aria-disabled="false" 
							style="display: inline-block;
							vertical-align: middle;
							background-repeat: no-repeat;
							background-position: 50% 50%;
							background-size: contain;
							cursor: pointer;
							margin: 0;
							padding: 0;
							position: absolute;
							height:100%;
							right: 0;
							bottom: 0;
							left: 0;
							top: 0;
							MARGIN: 0PX 0PX 0 0PX;
							BACKGROUND-COLOR: #000;
							background-image: url('{{ asset('storage'.$post->article['tb_img'])}}');"  
							>
						 
						</div>
						
					</div>
					<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->article['title']}}</div>
					<div style="font-size: 8px; padding-top: 0px;">{{$post->hot['count_view']}}次观看</div>
					</a>
				</div> 	
				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2"  class="justify-content-center"  style="block-size:unset; float: left; width: 100%; padding-top:10px; height: auto;">
				<div  class="justify-content-center1">
					<h5 style="COLOR: #ccc; font-weight: bold;">{{$title}}</h5>
					@foreach ($posts as $post)
					<div id="rs-article-box" style="block-size:unset; float:left;padding: 10px;overflow: hidden">
						<a href="/p/{{$post->article['id']}}">
							<!-- <img id="rs-article-box-img" src="{{ asset('storage'.$post->article['tb_img']) }}"  > -->
							<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" height="200px" width="600" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
								<div class="vjs-poster" tabindex="-1" aria-disabled="false" 
									style="display: inline-block;
									vertical-align: middle;
									background-repeat: no-repeat;
									background-position: 50% 50%;
									background-size: contain;
									cursor: pointer;
									margin: 0;
									padding: 0;
									position: absolute;
									height:100%;
									right: 0;
									bottom: 0;
									left: 0;
									top: 0;
									MARGIN: 0PX 0PX 0 0PX;
									BACKGROUND-COLOR: #000;
									background-image: url('{{ asset('storage'.$post->article['tb_img'])}}');"  
									>
								 
								</div>
								
							</div>
							<label style="cursor: pointer; padding: 5px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->article['title']}}</label>
						
						</a>	<div style="font-size: 8px; padding-top: 0px;COLOR: #fff;">{{$post->hot['count_view']}}次观看</div>
					</div>
					@endforeach
					<div style="clear: both"></div>
				</div> 
			</div>
			@endif					
		</div>	
		<div class="rs-contentbox1" id="page"></div>	
	</div>
	<!-- Content 左側 結束 -->
	<!-- Content 右側 開始 -->
	<!-- RightSideBox -->
	<!-- Content 右側 結束 -->	
@stop
@section('footscript')
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'zh-TW'}
</script>
<script>
	$('#closead').on('click',function(){
		//alert('close')
		$('#videocoverad').hide()
		
	})
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
<script>
	document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/tag/{{$tag}}/");
	nick = ''			
</script>
@stop