@extends('layout.rwd.lay_web_basic')
@section('title')
@lang('default.description')-免费视频分享网
@stop
@section('des')
No.1 @lang('default.title')，带你升天带你飞，频繁更新片片精彩！大量线上免费视频，100%免费色情视频、成人短视频、高清成人视频，支援手机收看！
@stop
@section('topscript')
<script>
	var postnick = '';
	document.write(crc);

</script>
@stop
@section('maincontent')
	<!-- Leftside Article -->
		@if (config('app.web_type') == 1)
		<div id="rs-content-left">
		@else 
		<div id="rs-content">
		@endif
	
		@php ($i = 0) 
		<div class="container" style="width:100%;   padding-right: 0px; padding-left: 3px;">
	 
		@foreach ($posts as $post) 
		
			@if ( ($device != 'ios' && $device != 'android')  &&  ($loop->index %  200000 ==0) )
				<div class="row" style="display: inline-table;     margin-right: 0px; margin-left: 0px;">
			@endif

			@if (($device == 'ios' || $device == 'android') &&  ($loop->index %  200000 ==0))
				<div class="row" style="width:100%;   margin-right: 0px; margin-left: 0px;">
			@endif

			@if ($device == 'ios' || $device == 'android')
					@if (config('app.web_type') == 1)
					<div id="blogVideo" class="blogVideo1 col" style="max-width:48%;height: auto;">
					@else
					<div id="blogVideo" class="blogVideo1 col" style="height: auto;">
					@endif
						<div id="rs-content-left-box  embed-responsive embed-responsive-16by9" data-id='{{$post->id}}' data-show=false style="height:170px;">
			@else
					<div id="blogVideo" class="blogVideo1 col"  style="display:inline-grid;">
						<div id="rs-content-left-box" data-id='{{$post->id}}' data-show=false> 
			@endif
 
			
			@if (is_Null($post->isAd))
			<div class="rs-contentword">
				<h2 style="width:95%; padding: 0px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color:#f90;"><a href="/p/{{$post->id}}">{!! $post->title !!}</a></h2>
				<div poster="" class=" embed-responsive embed-responsive-16by9  video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	  id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
					<a href="/p/{{$post->id}}">
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
								top: 0px;
								right: 0;
								bottom: 0;
								left: 0;
								height: 100%;
								MARGIN: 0PX 5PX 0 5PX;
								BACKGROUND-COLOR: #000;
								background-image: url('{{ asset('storage'.$post->cover_img)}}');" 
							>
						
				</div>
				<div id="rs-digg-box2 "  class="detail"  >
					<div class="rs-digg-left" >
						<div class="" id='post-digg' data-id='post-digg'><i class=""></i><span> {{$post->detail->count_view}} views</span></span></div>
					</div>
					<div class="rs-digg-right"  >
							<div class="rs-digg"  id='post-digg-thumbs-up' data-id='1'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$post->detail->count_digg}} </span></span></div>
							<div class="rs-digg "  id='post-digg-thumbs-down' data-id='1'><i class="fas fa-thumbs-down"></i><span> {{$post->detail->count_bury}} </span></div>
					 
					</div>
				</div>
					</a>
				</div>
			</div>
				@if ($device == 'ios' || $device == 'android')
					<div id="rs-digg-box2" style="float: left; width: 100%; position: relative; left: -5px     padding-top: 0px; overflow: visible;">
						@if ($post->tag)
							@foreach ($post->tag as $tag)
							<p><a href="/tag/{{$tag->tagname->id}}" target="_blank" class='rs-digg-box2-tag'>{{$tag->tagname->name}}</a></p>
							@endforeach
						@endif
					</div>

				@else
						@if (config('app.web_type') == 1)
						<div id="rs-digg-box2" style="float: left; width: 100%;     padding-top: 0px; overflow: visible;">
						@else 
						<div id="rs-digg-box2" style="float: left; width: 100%;     padding-top: 0px; overflow: hidden;
							Display: inline-block;
							white-space: nowrap;
							overflow: hidden;
							text-overflow: ellipsis;">
						@endif
					
						@if ($post->tag)
						<p>
							@foreach ($post->tag as $tag)
							<a href="/tag/{{$tag->tagname->id}}" target="_blank" class='rs-digg-box2-tag'>{{$tag->tagname->name}}</a>
							@endforeach
						</p>
						@endif
					</div>
				@endif
			@else
			<div class="rs-contentword">
				<h2  data-id='{{$post->id}}' class="adClick" style="width:95%; padding: 0px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color:#f90;"><a href="{{$post->web_url}}"  target="_blank">{!! $post->campaign_name !!}</a></h2>
				<div poster=""  data-id='{{$post->id}}' class="adClick embed-responsive embed-responsive-16by9  video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
					<a href="{{$post->web_url}}"  target="_blank">
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
						top: 0px;
						right: 0;
						bottom: 0;
						left: 0;
						height: 100%;
						MARGIN: 0PX 5PX 0 5PX;
						BACKGROUND-COLOR: #000;
						background-image: url('{{ asset('storage/'.$post->bg_img)}}');" 
					>
				
					</div>
					</a>	
				</div>
			
			</div>	
			<div id="rs-digg-box2" style="float: left; width: 100%;     padding-top: 0px; overflow: visible;">
					<p><a href="{{$post->web_url}}"  target="_blank" class='rs-digg-box2-tag'>AD</a></p>
			</div>
			@endif
						</div>
					</div>
			@if ((($device == 'ios' || $device == 'android') &&  ($loop->index %  200000 ==199999))   ||   ( ($device != 'ios' && $device != 'android')  &&  ($loop->index %  200000 ==199999))  )
				</div>
			@endif
	 
		@endforeach
		</div>

		
		<!-- @foreach ($posts as $post) -->
		 
		  
		
		
		<!-- JuicyAds v3.0
		@if($i%2 == 0)
			<div id="rs-content-left-box">
			@if ($device == 'android' || $device == 'ios')
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 120px; text-align:center">
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="714569" data-width="300" data-height="112"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':714569});</script>
			</div>
			@else		
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 75px; text-align:center">
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="714570" data-width="468" data-height="72"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':714570});</script>
				</div>
			@endif
			</div>
		@endif
		JuicyAds END -->
		
	
		<!-- @endforeach -->
		<div class="rs-contentbox1" id="page"></div>
	</div>
			
	<!-- RightSideBox -->

	<!-- Content 右側 結束 -->
	<script>
			document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/");
			nick = ''			
	</script>
@stop


@section('footscript1')
@if ($device == 'ios' || $device == 'android') 
<div style="height: 80px;">
</div>

<div 	style="BACKGROUND-COLOR: #000; position: fixed;  bottom: 0; height: 80px;width:100%;">
	<a href="{{$adHalf[0]->web_url}}"  target="_blank">
		<div data-id='{{$adHalf[0]->id}}' class="adClick"   style="Boverflow: hidden; background-repeat: no-repeat;   background-position: 50% 50%; background-size: contain;height: 100%; width:100%;background-image: url('{{  asset('storage/'.$adHalf[0]->bg_img)}}');" >
		</div>
	</a>
</div>
@endif
@stop