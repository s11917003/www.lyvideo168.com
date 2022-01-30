@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php echo mb_substr(strip_tags($title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($title)}}
@stop
<meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($title)}}">
@section('maincontent')
			<!-- @if(!is_Null($marquee))
			<marquee>
			@foreach ($marquee as $quee )
				@if ($loop->count != 1) 
					@if ($loop->first)
						<div style="display: contents;color: rgb(255, 217, 0)" class="rs-appinfo"> 		
					@endif

					@if ($loop->index ==1)
					<a href="http://{{$quee }}" target="_blank">{{$quee}}</a>
					@else
					{{$quee}}	
					@endif

					@if ($loop->last)
						</div> 
					@endif
				@else
				<div class="rs-appinfo">{{$quee}}</div> 
				@endif
			@endforeach
			</marquee>
			@endif-->
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2"  style="float: left; width: 100%; padding-top:10px; height: auto;">
				<h5 style="COLOR: #ccc; font-weight: bold;">搜寻结果 : {{$search}}</h5>
	
				@foreach ($posts as $post)
				 <div style="float: left;padding: 10px; width: 100%; height: 260px;    overflow: hidden; text-align: center">
					@if (is_Null($post->isAd))
					<a href="/p/{{$post->id}}">
					<!-- <img src="{{ asset('storage'.$post->hot['tb_img']) }}" style="width: 100%; height: 85%;"> -->
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
							background-image: url('{{ asset('storage'.$post->tb_img)}}');"  
							>
						 
						</div>
						
					</div>
					<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;   overflow: hidden; text-overflow: ellipsis;">{{$post->title}}</div>
					<div style="font-size: 8px; padding-top: 0px;">{{$post['detail']->count_view}}次观看</div>
					</a>
					@else
					<a href="{{$post->web_url}}" data-id='{{$post->id}}' class="adClick"   target="_blank">
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
								background-image: url('{{ asset('storage/'.$post->bg_img)}}');"  
								>
							 
							</div>
							
						</div>
						<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;  overflow: hidden; text-overflow: ellipsis;">{{$post->campaign_name}}</div>
						<div style="font-size: 8px; padding-top: 0px;">　　　</div>
						</a>
				@endif
				</div> 	

				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2"  class="rs-digg-box5 justify-content-center"  style="block-size:unset; float: left; padding-top:10px; height: auto;">
				<div  class="justify-content-center1" >
					<h5 style="COLOR: #ccc; font-weight: bold;">搜寻结果 : {{$search}}</h5>
					@foreach ($videos as $video)
					<div style="float: left;padding: 10px; width: 230px; height: 230px; margin: 5px; overflow: hidden">
						<div poster=""   class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	
						style="height:70%;   padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
							<a href="/jp/video/{{$video->video_id}}${{ $video->actress}}"  target="_blank">
								<div class="vjs-poster" tabindex="-1" aria-disabled="false" style="display: inline-block;
															vertical-align: middle;
															background-repeat: no-repeat;
															background-position: 50% 50%;
															background-size: contain;
															cursor: pointer;
															margin: 0;
															padding: 0;
															position: relative;
															top: 0PX;
															right: 0;
															bottom: 0;
															left: 0;
															height: 100%;  
															 WIDTH: 100%;
															MARGIN: 0PX 5PX 0 5PX;
															BACKGROUND-COLOR: #000;
															background-image: url('{{ $video->cover_img }}');" 
														>
								</div>
								<div style="font-size: 8;    line-height: 16px;letter-spacing: 1px;     word-break: break-all;padding-top: 150px;">{{$video->title  }}</div>
							</a>
						</div>
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
	document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/search/"+{{$search}}+'/');
	nick = ''			
</script>
@stop