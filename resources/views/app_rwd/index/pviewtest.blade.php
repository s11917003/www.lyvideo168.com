@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($post->title)}}
@stop
@section('topscript')
<meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">

<script>
	var postid = '{{$post->id}}';
	var postnick = '{{$post->userInfo->nick_name}}';
	var nick = postnick
</script>
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div id="rs-content-left">
		<div id="rs-content-left-box">
			<div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>
			<div class="rs-contentword">
				<h2><a href="javascript:void(0)">{!! $post->title !!}</a></h2>
					<div style="position: relative">
						@if ($device != 'ios' && $device != 'android')
						<div id='videocoverad' style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background-color: '#80808000'; z-index: 99; display: block">
							<div style="position: absolute;top: 80px; left: 200px; width: 300px; height: 250px;">
								<div style="padding: 0 0 0 4px; width: 20px; height: 20px; left: 5px; top: 5px; position: absolute; z-index: 1000; background-color: #c1c1c1; color:#828282; border-radius: 50%;" id='closead'>X</div>
								<!--  ad tags Size: 300x250 ZoneId:1329177-->
								<!-- JuicyAds v3.0 -->
								<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
								<ins id="697681" data-width="300" data-height="262"></ins>
								<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
								<!--JuicyAds END-->
							</div>
						</div>
						@else
						<div id='videocoverad' style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background-color: '#80808000'; z-index: 999; display: block">
							<div style="position: absolute;top: 0; left: 10%; width: 300px; height: 250px;">
								<div style="padding: 0 0 0 4px; width: 20px; height: 20px; left: 5px; top: 5px;;position: absolute; z-index: 1000; background-color: #c1c1c1; color:#828282; border-radius: 50%;" id='closead'>X</div>
								<!--<script type="text/javascript" src="https://js.spacenine.biz/t/329/177/a1329177.js"></script>-->
								<script type="text/javascript" src="https://js.spacenine.biz/t/329/177/a1329177.js"></script>
							</div>
						</div>						
						@endif						
						<video id='av-video' width="600" height="264" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" poster="{{$post->cover_img}}" controls>
						  <source
						     src="/getvideo/{{$post->id}}"
						     type="application/x-mpegURL">
						</video>
						<script>
						var player = videojs('av-video',{
								html5: {
									hls: {
								          overrideNative: true
								    },
									nativeVideoTracks: false,
									nativeAudioTracks: false,
									nativeTextTracks: false
								}
							});
						</script>
			        </div>					
			</div>
			@if ($device == 'ios' || $device == 'android')

			@else
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 95px; text-align: center">
				<!-- JuicyAds v3.0 -->
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="697695" data-width="728" data-height="102"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697695});</script>
				<!--JuicyAds END-->
			</div>
			@endif
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<p><a href="/tag/{{$tag->tagname->id}}" class="rs-digg-box2-tag">{{$tag->tagname->name}}</a></p>
					@endforeach
				@endif
			</div>
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 280px; background-color: #cecece; text-align: center">
				<!-- JuicyAds v3.0 -->
					<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
					<ins id="697681" data-width="300" data-height="262"></ins>
					<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
				<!--JuicyAds END-->
			</div>
			@endif
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: 2950px;">
				<h5 class="recommend">推荐影片</h5>
				@php
				$i = 0
				@endphp
				@foreach ($relate as $re)
				<div style="float: left;padding: 10px; width: 100%; height: 250px; margin: 5px; background: #f1f1f1; overflow: hidden; text-align: center">
					<a href="/p/{{$re->post_id}}">
					<img src="{{ asset('storage'.$re->article['tb_img']) }}"  style="width: 100%;">
					<div style="font-size: 8; padding-top: 5px;">{{$re->article['title']}}</div>
					</a>
				</div>
				@if ($i % 3 == 1)
				<div style="float: left;padding: 10px; width: 100%; height: 100px; margin: 5px; background: #f1f1f1; overflow: hidden; text-align: center">
					<!-- JuicyAds v3.0 -->
					<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
					<ins id="697690" data-width="300" data-height="112"></ins>
					<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697690});</script>
					<!--JuicyAds END-->					
				</div>	
				@endif
				@php
					$i++
				@endphp
				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: 430px;">
				<h5 class="recommend">推荐影片</h5>
				@foreach ($relate as $re)
				<div style="float: left;padding: 10px; width: 230px; height: 185px; margin: 5px; background: #f1f1f1; overflow: hidden">
					<a href="/p/{{$re->post_id}}">
					<img src="{{ asset('storage'.$re->article['tb_img']) }}" style="width: 210px;">
					<div style="font-size: 8; padding-top: 5px;">{{$re->article['title']}}</div>
					</a>
				</div>
				@endforeach
				<div style="clear: both"></div>
			</div>
			@endif					
		</div>		
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
@stop