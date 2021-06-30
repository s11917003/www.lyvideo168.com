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
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
	
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
			@endif -->
			<!-- <div 	style="BACKGROUND-COLOR: #000;  height: 80px;width:100%;">
				<a href="{{$adHalf[0]->web_url}}"  target="_blank">
					<div data-id='{{$adHalf[0]->id}}' class="adClick"   style="overflow: hidden; background-repeat: no-repeat;   background-position: 50% 50%; background-size: contain;height: 100%;width:100%;background-image: url('{{  asset('storage/'.$adHalf[0]->bg_img)}}');" >
					</div>
				</a>
			</div> -->
		</div>
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
			<!-- <div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div> -->
			<div class="row">
					<div class="container-fluid" style="DISPLAY: inline-flex;">
						@if ($device == 'ios' || $device == 'android')
						<div class="col-xs-12 col-sm-8 col-md-8 mdm-big" >
						@else
						<div class="col-xs-12 col-sm-8 col-md-8 mdm-big" >
						@endif
						<video id="av-video" data-setup="{}" width="600" height="264" class="video-js vjs-default-skin vjs-fluid vjs-show-big-play-button-on-pause vjs-fill vjs-16-9 vjs-big-play-centered" poster="{{$video->cover_img}}" controls>
						<source 
						src="{{$video->video_url}}"
						type="video/mp4">
						</video>
						<!-- /video id="samplevideo_html5_api" class="vjs-tech" preload="auto" tabindex="-1" autoplay="" src="https://awscc3001.r18.com/litevideo/freepv/d/dva/dvaj518/dvaj518_dmb_w.mp4"><source src="https://awscc3001.r18.com/litevideo/freepv/d/dva/dvaj518/dvaj518_sm_w.mp4" type="video/mp4" res="240" label="300 Kbps"><source src="https://awscc3001.r18.com/litevideo/freepv/d/dva/dvaj518/dvaj518_dm_w.mp4" type="video/mp4" res="480" label="1000 Kbps"><source src="https://awscc3001.r18.com/litevideo/freepv/d/dva/dvaj518/dvaj518_dmb_w.mp4" type="video/mp4" res="720" label="1500 Kbps"><p class="vjs-no-js">Your browser does not support the video tag.</p></video> -->
						<script>
							// var player = videojs('my-player',{
							// 	html5: {
							// 		hls: {
							// 	          overrideNative: true  
							// 	    },
							// 		nativeVideoTracks: false,
							// 		nativeAudioTracks: false,
							// 		nativeTextTracks: false
							// 	}
							// });
							 window.onload = function () {
				var player = videojs( 'av-video',{
                	hls: {
								          overrideNative: true  
								    },
									nativeVideoTracks: false,
									nativeAudioTracks: false,
									
                controls : true,
                techOrder : [ 'html5' ],
                controlslist : 'nodownload',
                language : "zh-Hant",
				preload : 'auto',
				// type:"application/x-mpegURL",
				// sources:"/getvideo/{{$post->id}}",
                // sources : 'https://d2zihajmogu5jn.cloudfront.net/elephantsdream/hls/ed_hd.m3u8',
             
                controlBar : {
                    name : 'ControlBar',
                    children : [
                        {name: "PlayToggle"},
                        {name: "ProgressControl"},
                        {name: "DurationDisplay"},
                        {name: "MuteToggle"},
                        {name: "VolumeControl"},
					

					 
					   {name: "currentTimeDisplay"},
                        
				 
						{name: "FullscreenToggle"},
                    ]
                }
            },function () {
				this.initialPreviewThumbnail({
					 sprite_url:"{{ asset('storage/upvideo/'.$post->folder.'/thumbnails.jpg') }}",
					//;    /js/videojs-thumbnails/output-180x120-thumb.jpg',
                    second:6,
                    sprite_x_count:30000,
                    thumbnail_width:160,
					thumbnail_height:90,
				
					preview_window_top :-90,
					// hook_move  :function (event) {
					// 	console.log( 'ready to play' );
					// 	this.player.controlBar.currentTimeDisplay.el_.innerHTML =  'ready to play';

                    // }
                    // preview_window_border_color:'green'
                });
                

                this.hotkeys({
                    keyup : function(event){
						console.log( 'ready to play' );
                        if( event.code=="Space" ) {
                            if( this.paused() ) this.play();
                            else this.pause();
                        }
                    },
                    keydown : function (event) {
						console.log( 'ready to play' );
                        if( event.code=="ArrowRight" )this.currentTime(Math.floor(this.currentTime())+10);
                        if( event.code=="ArrowLeft" )this.currentTime(Math.floor(this.currentTime())-10);
                        if( event.code=="ArrowUp" )this.volume(this.volume()+0.1);
                        if( event.code=="ArrowDown" )this.volume(this.volume()-0.1);
                    }
                });
                console.log( 'ready to play' );
			});
			
			const SeekBar = videojs.getComponent('SeekBar');
			SeekBar.prototype.getPercent = function getPercent() {
				const time = this.player_.currentTime()
				const percent = time / this.player_.duration()
				return percent >= 1 ? 1 : percent
			}
			SeekBar.prototype.handleMouseMove = function QQQQ(event) {
				let newTime = this.calculateDistance(event) * this.player_.duration()
			if (newTime === this.player_.duration()) {
				newTime = newTime - 0.1
    		}
    this.player_.currentTime(newTime);
    this.update();
    let currentTime = player.currentTime();
    let minutes = Math.floor(currentTime / 60);   
    let seconds = Math.floor(currentTime - minutes * 60)
    let x = minutes < 10 ? "0" + minutes : minutes;
    let y = seconds < 10 ? "0" + seconds : seconds;
    let format = x + ":" + y;
    player.controlBar.currentTimeDisplay.el_.innerHTML = format;
			}
							 }
        
					 
						</script>

						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 mdm-small">
							<div class="mdm-small">
								<div class="mdm-info">
								<h4 class="m-title">{{ $video->title }}</h4>
								<div class="table-responsive">
								<table class="table">
								<tbody>
								<tr>
								<td>DVD ID</td>
								<td>{{ $video->dvd_id }}</td>
								</tr>
								<tr>
								<td>Release Date</td>
								<td>{{ $video->release_date }}</td>
								</tr>
								<tr>
								<td>Runtime</td>
								<td>17 min</td>
								</tr>
								<tr>
								<td>Director</td>
								<td><a href="" title="----">{{ $video->director }}</a></td>
								</tr>
								<tr>
								<td>Studio</td>
								<td><a href="http://www.javmovie.com/ja/studio/hyakkin-tv-4255.html" title="HyakkinTV">HyakkinTV</a></td>
								</tr>
								<tr>
								<td>Label</td>
								<td><a href="" title="HyakkinTV">{{ $video->label }}</a></td>
								</tr>
								<tr>
								<td>Actress</td>
								<td class="list-actress">
								<a href="http://www.javmovie.com/ja/actress/nana-ayano-45.html" title="彩乃なな">{{ $video->actress }}</a>
								</td>
								</tr>
								<tr>
								<td>Genre</td>
								<td class="list-genre">
								<a href="http://www.javmovie.com/ja/genre/ass-lover-5.html" title="尻フェチ">尻フェチ</a>
								<a href="http://www.javmovie.com/ja/genre/featured-actress-6.html" title="単体作品">単体作品</a>
								<a href="http://www.javmovie.com/ja/genre/hi-def-7.html" title="ハイビジョン">ハイビジョン</a>
								</td>
								</tr>
								</tbody>
								</table>
								</div>
								</div>
								</div>
						</div>
			        </div>					
			</div>
			
	
			<div id="rs-digg-box2">
				<div class="rs-digg-left"     style="float: left; width: auto; padding: 0px 3px;">
					<div class="" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class=""></i><span> {{$postsDetail->count_view}} views</span></span></div>
				</div>
				<div class="rs-digg-right orange5"   style="margin:0;">
					<!-- @if ($status == 1)
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like " id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@elseif ($status == 2)
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@else  
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@endif -->
					<a href="#commentList" class="load_modal_login btn btn-download"><i class="fa fa-download"></i>Download</a>
					<a class="load_modal_login btn btn-bookmark" action="http://www.javmovie.com/favorite/390057"><i class="fa fa-plus"></i> <span>Favorite</span></a>
					<a class="load_modal_login btn btn-report">Correction</a>
				</div>
			</div>
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				<h5   style="overflow: hidden;overflow: hidden;text-overflow: ellipsis;color:#f90;">
					@if ($video->description)		
					{{$video->description}}
					@else
					{{$video->title}}
					@endif
				</h5>
			</div>
			<div class="col-md-12 layout-left-big">
				<div class="row">
				@if ($video->thumbnail_img)	
				<div class="col-md-12">
					<div class="detail-wrapper player-detail">
						<div class="clearfix"></div>
						<div class="movie-gallery">
							<div class="movie-gallery-wrapper">
								@foreach ($video->thumbnail_img as $thumbnail_img)
								<a class="example-image-link" href="{{ $thumbnail_img }}" data-lightbox="100TV-404-gallery" data-title="Click the right half of the image to move forward.">
									<img class="example-image" src="{{ $thumbnail_img }}" alt="">
								</a>
								@endforeach			
								
							</div>
						</div>
					</div>
				</div>
				@endif
				</div>
			</div>
			<!-- <div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<p><a href="/tag/{{$tag->tagname->id}}" target="_blank" class="rs-digg-box2-tag">{{$tag->tagname->name}}</a></p>
					@endforeach
				@endif
			</div> -->
		
			
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: AUTO;">
				<h5 class="recommend">You may also like</h5>
				<!--
				@php
				$i = 0
				@endphp
				-->
				
				@foreach ($relate as $re)
				<div style="padding: 10px; width: 70%; height: 200px; margin: 5px;  overflow: hidden; text-align: center;margin: 0px auto;">
					@if (is_Null($re->isAd))
					<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:70%;    padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
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
							<div style="font-size: 8;padding-top: 5px;">{{$re->article['title']}}</div>
		
						</a>
					</div>
					@else
					<div poster="" data-id='{{$re->id}}' class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:70%;    padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="{{$re->web_url}}"  target="_blank">
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
														background-image: url('{{ asset('storage/'.$re->bg_img)}}');" 
													>
													
							</div>
							<div style="font-size: 8;     line-height: 16px;letter-spacing: 1px;      word-break: break-all;padding-top: 5px;">{{$re->campaign_name}}</div>
		
						</a>
					</div>
					@endif
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
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: auto;">
				<h5 class="recommend" >You may also like</h5>
				@foreach ($video_with_actress as $video_actress)
				<div style="float: left;padding: 10px; width: 230px; height: 230px; margin: 5px; overflow: hidden">
					<div poster=""   class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	
					style="height:70%;   padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="http://google.com"  target="_blank">
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
														background-image: url('{{ $video_actress->cover_img }}');" 
													>
							</div>
							<div style="font-size: 8;    line-height: 16px;letter-spacing: 1px;     word-break: break-all;padding-top: 5px;">{{$video_actress->title  }}</div>
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
	window.onload = function() {

		console.log('window.onload')

		console.log('{{ $video->actress }}')
	};
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
@stop