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
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
	var postid = '{{$post->id}}';
	var postnick = '{{$post->userInfo->nick_name}}';
	var nick = postnick
</script>
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div id="">  
		<div id="rs-content-left-box">
			<!-- <div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div> -->
			<div class="rs-contentword">
				<h2><a href="javascript:void(0)"  style="FONT-SIZE: 28PX;">{!! $post->title !!}</a></h2>
					<div style="position: relative">

						<video id='av-video' width="600" height="264" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" poster="{{asset('storage'.$post->cover_img)}}" controls>
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
			
			<!-- JuicyAds v3.0
			@if ($device == 'ios' || $device == 'android')

			@else
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 95px; text-align: center">
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="697695" data-width="728" data-height="102"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697695});</script>
			</div>
			@endif
			JuicyAds END -->
			<div id="rs-digg-box2">
				<div class="rs-digg-left"     style="float: left; width: auto; padding: 0px 3px;">
					<div class="" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class=""></i><span> {{$postsDetail->count_view}} views</span></span></div>
				</div>
				<div class="rs-digg-right orange5"   style="margin:0;">
					@if ($status == 1)
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like " id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@elseif ($status == 2)
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@else  
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@endif
				</div>
			</div>
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<p><a href="/tag/{{$tag->tagname->id}}" target="_blank" class="rs-digg-box2-tag">{{$tag->tagname->name}}</a></p>
					@endforeach
				@endif
			</div>
			
			<!-- JuicyAds v3.0
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 280px; background-color: #cecece; text-align: center">
					<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
					<ins id="697681" data-width="300" data-height="262"></ins>
					<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
			</div>
			@endif
			JuicyAds END-->
			
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: AUTO;">
				<h5 class="recommend">推荐影片</h5>
				<!--
				@php
				$i = 0
				@endphp
				-->
				
				@foreach ($relate as $re)
				<div style="float: left;padding: 10px; width: 100%; height: 250px; margin: 5px;  overflow: hidden; text-align: center">
					
					<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:80%;    padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="/p/{{$re->post_id}}">
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
														background-image: url('{{ asset('storage'.$re->article['tb_img'])}}');" 
													>
							</div>
							<div style="font-size: 8; padding-top: 5px;">{{$re->article['title']}}</div>
		
						</a>
					</div>
				</div>
				
				<!-- JuicyAds v3.0
				@if ($i % 3 == 1)
				<div style="float: left;padding: 10px; width: 100%; height: 100px; margin: 5px; background: #f1f1f1; overflow: hidden; text-align: center">
					<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
					<ins id="697690" data-width="300" data-height="112"></ins>
					<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697690});</script>					
				</div>	
				@endif
				JuicyAds END -->
				
				<!--
				@php
					$i++
				@endphp
				-->
				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: 430px;">
				<h5 class="recommend">推荐影片</h5>
				@foreach ($relate as $re)
				<div style="float: left;padding: 10px; width: 230px; height: 185px; margin: 5px; overflow: hidden">
					<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:80%;    padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="/p/{{$re->post_id}}">
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
														background-image: url('{{ asset('storage'.$re->article['tb_img'])}}');" 
													>
							</div>
							<!-- <img src="{{ asset('storage'.$re->article['tb_img']) }}" style="width: 300px;"> -->
							<div style="font-size: 8; padding-top: 5px;">{{$re->article['title']}}</div>
		
						</a>
					</div>
					
				 
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
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('#post-digg-thumbs-up').on('click',function(){
		// if($("#post-digg-thumbs-up").hasClass('rs-digg-click')) {
		// console.log('hasClass')
		// 	return
		// }
		var id =  $(this).attr("data-id") 
		$.ajax({
			type:"POST",
			url:"/thumbsup",
			dataType:"json",
			data:{id:id},
			success:function(result){
				
				var status = result['status']
				var loginstatus = result['login']
				var count_digg = result['count_digg']
				var count_bury = result['count_bury']
				if(!loginstatus || loginstatus == false ) {
					window.location.href = '/login'
					return
				}
				$("#post-digg-thumbs-down span").html(' '+count_bury+' ');
				$("#post-digg-thumbs-up span").html(' '+count_digg+' ');
				$("#post-digg-thumbs-down").removeClass('rs-digg-click');
				$("#post-digg-thumbs-up").removeClass('rs-digg-click');
				if(status == 1 ) {
					$("#post-digg-thumbs-up").addClass('rs-digg-click');
				}
				
				
			}
		});	
	})

	$('#post-digg-thumbs-down').on('click',function(){
		// if($("#post-digg-thumbs-down").hasClass('rs-digg-click')) {
		// console.log('hasClass')
		// 	return
		// }
		var id =  $(this).attr("data-id") 
		$.ajax({
			type:"POST",
			url:"/thumbsdown",
			dataType:"json",
			data:{id:id},
			success:function(result){
				var status = result['status']
				var loginstatus = result['login']
				var count_digg = result['count_digg']
				var count_bury = result['count_bury']
				if(!loginstatus || loginstatus == false ) {
					window.location.href = '/login'
					return
				}
				$("#post-digg-thumbs-down span").html(' '+count_bury+' ');
				$("#post-digg-thumbs-up span").html(' '+count_digg+' ');
				$("#post-digg-thumbs-up ").removeClass('rs-digg-click');
				$("#post-digg-thumbs-down").removeClass('rs-digg-click');
				if(status == 2 ) {
					$("#post-digg-thumbs-down").addClass('rs-digg-click');
				}
				
			}
		});	
	})
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
@stop