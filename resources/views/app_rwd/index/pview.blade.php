@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php
		$actress = '';
		if(!is_null($video->actressData)){
		foreach ($video->actressData as $data ) {
			$actress .=  $data['name'].',';
		}  
		}
		$locale = App::getLocale(); 
		if ($locale == 'en') {
			echo $video->video_id.' | '.$actress.'：Watch Free Video【JavDic  censored, uncensored and amateur japanese porn】';
		} else if ($locale == 'jp') {
			echo $video->title.' | '.$actress.'：線上免費試看【JavDic  有碼・無碼・素人 - 日本A片資料庫】';
		} else if($locale == 'zh') {
			echo $video->title.' | '.$actress.'：無料エロ動画【JavDic  修正あり・無修正・素人 - エロ動画まとめ】'; 
		}
		@endphp
@stop
@section('des')
	@php
		$actress = '';
		if(!is_null($video->actressData)){
		foreach ($video->actressData as $data ) {
			$actress .=  $data['name'].',';
		}  
		}
		$locale = App::getLocale(); 
		if ($locale == 'en') {
			echo 'Watch and enjoy for free‐ 【'.$video->title.'】, a japanese porn by 【'.$actress.'】on Javdic, covering all censored - uncensored - amateur Japanese porn';
		} else if ($locale == 'jp') {
			echo '無料エロ動画視聴 - '.$video->title.',  '.$actress.' 出演 - JavDic  修正あり・無修正・素人 を網羅し、キーワードとタグを絞り込んで、すぐお気に入りのエロ動画を見れる！';
		} else if($locale == 'zh') {
			echo '免費線上看 '.$video->title.',  '.$actress.' 主演 - Javdic橫跨DMM, Prestige, 加勒比海, HEYZO, 一本道, FC2  全面蒐羅日本A片資源  絕對找的到您喜歡的那一片!'; 
		}

	@endphp
@stop
@section('keywords')
	@php 
	$actress = '';
	if(!is_null($video->actressData)){
	foreach ($video->actressData as $data ) {
		$actress .=  $data['name'].',';
	}  
	} 
	$tags ='';
	if ($video_tag){
		 foreach ($video_tag as $tag ) {
			$tags .=  $tag->tagName.',';
		}  
	}
	echo  $actress,$video->video_id,$tags,__('ui.meta.keywords'); 
	
	@endphp
@stop
	 
	 
@section('maincontent')
	 

	<!-- Content 左側 開始 -->
	<div id="">  
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
			<h2 class="title is-4">
				 <strong> {{$video->title}}</strong>
			  </h2>
		</div>
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
			<div class="row">
					<div class="container-fluid" style="DISPLAY: contents;">
						@if ($device == 'ios' || $device == 'android')
						<div class="col-xs-12 col-sm-8 col-md-8 mdm-big" >
						@else
						<div class="col-xs-12 col-sm-8 col-md-8 mdm-big" >
						@endif
						<video id="av-video" data-setup="{}" width="600" height="264" class="video-js vjs-default-skin vjs-fluid vjs-show-big-play-button-on-pause vjs-fill vjs-16-9 vjs-big-play-centered " poster="{{$video->cover_img}}" controls>
							@if ($video_status)
							<source  id="av-video-source" 
							src="{{$video->video_url}}"
							type="video/mp4">
							@endif
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
				{{-- sources:"/getvideo/{{$post->id}}",--}}
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
					//  sprite_url:"{{ asset('storage/upvideo/aa/thumbnails.jpg') }}",
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
				 
				@if (!$video_status)
					$('.vjs-big-play-button').hide();
				@endif
				
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
			function playToggle() {
				videojs( 'av-video').play();
			}
					 
						</script>

						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 mdm-small">
							<div class="mdm-small">
								
								<div class="mdm-info">
								<!-- <h4 class="m-title">{{ $video->title }}</h4> -->
								<div class="table-responsive">
								<table class="table">
								<tbody>
								<tr>
									<td>
										<!-- star
										星星點燈: star__item--active 
										點亮半顆星: star__item--half star__item--active
										底部掛載分數判斷 script
           								 -->
										<ul id="star-rank" class="star" data-star="3.4">
											<li class="star__item star__item--active">
											  <div class="star__item-back">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											  <div class="star__item-front">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											</li>
											<li class="star__item star__item--active">
											  <div class="star__item-back">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											  <div class="star__item-front">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											</li>
											<li class="star__item star__item--active">
											  <div class="star__item-back">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											  <div class="star__item-front">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											</li>
											<li class="star__item star__item--active star__item--half">
											  <div class="star__item-back">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											  <div class="star__item-front">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											</li>
											<li class="star__item">
											  <div class="star__item-back">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											  <div class="star__item-front">
												<svg viewBox="64 64 896 896" focusable="false" fill="currentColor" width="1em" height="1em" data-icon="star" aria-hidden="true">
												  <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 00.6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0046.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path>
												</svg>
											  </div>
											</li>
										  </ul>
									</td>		
								</tr>
								<tr>
									<td class="" colspan>
										@if(!is_null($video->actressData))
										@foreach ($video->actressData as $data )
												<a href='/actress/{{ $data["id"]}}'  >{{ $data['name'] }}</a>
										@endforeach	
										@endif
									
									</td>
								</tr>
								<tr>
								 
									<td colspan =2 style="padding-bottom:10px">
										<!-- <a href="" title="HyakkinTV">{{ $video->label }}</a> -->
										@if ($video_tag)
											@foreach ($video_tag as $tag )
											<a href="/{{$lang}}/category?cate={{  $tag->tag_id   }}" class="  m-2 pl-2 ml-1" >{{$tag->tagName }} </a>
											@endforeach	
										@endif
									</td>
								</tr>					 
								<tr>
								<td><h1>{{__('ui.video_view.DVD_ID')}}</h1></td>
								<td>{{ $video->dvd_id }}</td>
								</tr>
								<tr>
								<td><h1>{{__('ui.video_view.Release_Date')}}</h1></td>
								<td>{{ $video->release_date }}</td>
								</tr>
								<tr>
								<td><h1>{{__('ui.video_view.Runtime')}}</h1></td>
								<td id='Runtime' ></td>
								</tr>
								<tr>
								<td><h1>{{__('ui.video_view.Director')}}</h1></td>
								<td>{{ $video->director }}</td>
								</tr>
								<tr>
								<td><h1>{{__('ui.video_view.Studio')}}</h1></td>
								<td>{{ $video->studio }}</td>
								</tr>
								
<!-- 								
								<tr>
								<td>Genre</td>
								<td class="list-genre">
									<a href="http://www.javmovie.com/ja/genre/ass-lover-5.html" title="尻フェチ">尻フェチ</a>
									<a href="http://www.javmovie.com/ja/genre/featured-actress-6.html" title="単体作品">単体作品</a>
									<a href="http://www.javmovie.com/ja/genre/hi-def-7.html" title="ハイビジョン">ハイビジョン</a>
								</td>
								</tr> -->
								@if ($video_status)
								<tr>
									<td colspan =2>
										<div class='playBtn' >
											<a  href="javascript:void(0)" onClick="playToggle()">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.98 31.98">
												<g>
													<circle class="i_played1" cx="15.99" cy="15.99" r="15.99"></circle>
													<circle class="i_played2" cx="15.99" cy="15.99" r="9.2"></circle>
													<path class="i_played3" d="M20.45,15.92l-7-4.06a.09.09,0,0,0-.13.07v8.12a.09.09,0,0,0,.13.07l7-4.06A.08.08,0,0,0,20.45,15.92Z"></path>
												</g>
												</svg>
												<span>{{__('ui.video_view.WATCH_FREE_SAMPLE')}}</span>
											</a>
										</div>
									</td>
								</tr>
								@endif
								<tr >
									<td colspan =2>
										<div class='playBtn' >
											<a id = 'goToURL'  href="{{ url($url) }}">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.98 31.98">
												<g>
													<circle class="i_played1" cx="15.99" cy="15.99" r="15.99"></circle>
													<circle class="i_played2" cx="15.99" cy="15.99" r="9.2"></circle>
													<path class="i_played3" d="M20.45,15.92l-7-4.06a.09.09,0,0,0-.13.07v8.12a.09.09,0,0,0,.13.07l7-4.06A.08.08,0,0,0,20.45,15.92Z"></path>
												</g>
												</svg>
												<span>{{__('ui.video_view.WATCH_FULL_VIDEO')}}</span>
											</a>
										</div>
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
				<!-- <div class="rs-digg-left"     style="float: left; width: auto; padding: 0px 3px;">
					<div class="" id='post-digg-1' data-id='post-digg-1'><i class=""></i><span> test views</span></span></div>
				</div> -->
				<!-- <div class="rs-digg-right orange5"   style="margin:0;">
					{{-- @if ($status == 1)
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like " id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@elseif ($status == 2)
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like rs-digg-click" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@else  
						<div class="rs-digg like" id='post-digg-thumbs-up' data-id='{{$post->id}}'><i class="fas fa-thumbs-up fa-w-16"></i><span> {{$postsDetail->count_digg}} </span></span></div>
						<div class="rs-digg like" id='post-digg-thumbs-down' data-id='{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$postsDetail->count_bury}} </span></div>
					@endif --}}
					<a href="#commentList" class="load_modal_login btn btn-download"><i class="fa fa-download"></i>Download</a>
					<a class="load_modal_login btn btn-bookmark" action="http://www.javmovie.com/favorite/390057"><i class="fa fa-plus"></i> <span>Favorite</span></a>
					<a class="load_modal_login btn btn-report">Correction</a>
				</div> -->
			</div>
		
			<div class="col-md-12 layout-left-big">
				<div class="row">
				 
				 
				@if ($video->thumbnail_img_router)	

		 


				<div class="col-md-12">
					<div class="detail-wrapper player-detail">
						<div class="clearfix"></div>
						<div class="movie-gallery">
							<div class="movie-gallery-wrapper">
								@foreach ($video->thumbnail_img_router as $thumbnail_img)
								<a class="example-image-link" href="{{ url($thumbnail_img) }}" data-lightbox="100TV-404-gallery" data-title="Click the right half of the image to move forward.">
									<img class="example-image" src="{{  asset($thumbnail_img)}}" alt="">
								</a>
								@endforeach			
								
							</div>
						</div>
					</div>
				</div>
				@endif
				</div>
			</div>


			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				<h5   style="overflow: hidden;overflow: hidden;text-overflow: ellipsis;margin: 0.5rem 0;line-height: 1.8;">
					<b>{{__('ui.video_view.VIDEO_INTRODUCTION')}}：</b>
				</h5>
				<p style="margin: 0.5rem 1rem; line-height: 1.8;">
					@if ($video->description)		
					{{$video->description}}
					@else
					{{$video->title}}
					@endif
				</p>
			</div>
			
		 
			
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: auto;">
				<h5 class="recommend" >{{__('ui.video_view.STARRING')</h5>
				@if (count($video_with_actress) >0 )
			
				@foreach ($video_with_actress as $video_actress)
				<div style="float: left;padding: 10px; width: 230px; height: 230px; margin: 5px; overflow: hidden">
					<div poster=""   class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	
					style="height:70%;   padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="/{{$lang}}/testview/{{$video_actress->video_id}}${{ $video_actress->actress}}"  target="_blank">
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
							
								<div class='videoTitle'>{{$video_actress->title}}</div>
							
								<p class='videoInfo'>【{{$video_actress->dvd_id}}】</p>
								<p class='videoInfo'>{{$video_actress->release_date}}</p> 
						</div>
						</a>
					</div>
				</div>
				@endforeach
				<div style="clear: both"></div>
				@endif
				<h5 class="recommend" >{{__('ui.video_view.LIKE')}}</h5>
				@if(count($video_relation) > 0) 
				@foreach ($video_relation as $video_tag)
				<div style="float: left;padding: 10px; width: 230px; height: 230px; margin: 5px; overflow: hidden">
					<div poster=""   class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	
					style="height:70%;   padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="/{{$lang}}/testview/{{$video_tag->video_id}}${{ $video_tag->actress}}"  target="_blank">
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
														background-image: url('{{ $video_tag->cover_img }}');" 
													>
						
								<div class='videoTitle'>{{$video_tag->title}}</div>
								<p class='videoInfo'>【{{$video_tag->dvd_id}}】</p>
								<p class='videoInfo'>{{$video_tag->release_date}}</p>
							</div>
						</a>
					</div>
				</div>
				@endforeach
				@endif
				<div style="clear: both"></div>
			</div>
		 				
		</div>		
	</div>

	<!-- Content 左側 結束 -->
	<!-- Content 右側 開始 -->
	<!-- RightSideBox -->
	<!-- Content 右側 結束 -->	
@stop	

@section('footscript')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer> -->
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

	window.onload = function() {	
		 
		
		// videoId = '{{$video->video_id}}';
	
		// 		// client新規作成
	
		// var client = new dmm.Client({
		// 	api_id: "hW63FdKybRxHq5tmA2Zk",
		// 	affiliate_id: "Javdic-990"
		// });
		// var options = {site: "DMM.R18",keyword:videoId}

		// client.product(options, function (err, data) {
		// 	console.log(data);
		// 	if(data.items.length > 0){
		// 		volume  = data.items[0].volume
		// 		URL  = data.items[0].URL

		// 		console.log(volume);

		// 		console.log(URL);

		// 		$('#Runtime').html(volume+ ' min')
		// 		$("#goToURL").attr("href",URL);
		// 	}

		// 	// if(data.items.length > 0){
		// 	// 	for (const [key, value] of Object.entries(data.items[0].sampleMovieURL)) {
 
		// 	// 		if(key.indexOf('size_')  >=0){
		// 	// 			console.log(value);
		// 	// 			var videoSourceElm = $('#av-video-source')
		// 	// 			videoSourceElm.src = value;
		// 	// 			var player = videojs( 'av-video')
		// 	// 			console.log(player.src);
		// 	// 			player.src({
		// 	// 				src:value,
		// 	// 				type: 'video/mp4'/*video type*/
		// 	// 			});
		// 	// 			player.load();
		// 	// 			break;
		// 	// 		}
   
		// 	// }
			
		// 	// }
		
		// });
		 
	}
</script>

@stop