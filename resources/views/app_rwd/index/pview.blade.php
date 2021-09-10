@extends('layout.rwd.lay_web_basic_pview')
@section('title')
{{--  @php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp --}}
@stop
@section('des')
 
@stop
@section('topscript')
{{-- <meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">
<meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
<script>
	 
</script>
@stop
@section('maincontent')
	<div class="search" style="top:0rem;">
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

	

	<!-- Content 左側 開始 -->
	<div id="">  
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
			<h2 class="title is-4">
			 	{{--<strong>{{ $title }}</strong>--}}
				 <strong> {{$video->title}}</strong>
			  </h2>
			  {{-- @if(!is_Null($marquee))
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
			@endif--}}
			{{-- <div 	style="BACKGROUND-COLOR: #000;  height: 80px;width:100%;">
				<a href="{{$adHalf[0]->web_url}}"  target="_blank">
					<div data-id='{{$adHalf[0]->id}}' class="adClick"   style="overflow: hidden; background-repeat: no-repeat;   background-position: 50% 50%; background-size: contain;height: 100%;width:100%;background-image: url('{{  asset('storage/'.$adHalf[0]->bg_img)}}');" >
					</div>
				</a>
			</div> --}}
		</div>
	
		<div id="rs-content-left-box" class="rs-content-left-box1">
			{{-- <div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>--}}
			<div class="row">
					<div class="container-fluid" style="DISPLAY: contents;">
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
					 sprite_url:"{{ asset('storage/upvideo/aa/thumbnails.jpg') }}",
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
									<td class="list-actress" colspan =2>
									<a href="http://www.javmovie.com/ja/actress/nana-ayano-45.html" title="{{ $video->actress }}">{{ $video->actress }}</a>
									</td>
								</tr>
								<tr>
								 
									<td colspan =2>
										<!-- <a href="" title="HyakkinTV">{{ $video->label }}</a> -->
										@if ($video_tag)
											@foreach ($video_tag as $tag )
											<a class="rs-digg-box2-tag pr-2 pl-2 ml-1" >{{$tag->tagName }} </a>
											@endforeach	
										@endif
									</td>
								</tr>					 
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
								<td>Genre</td>
								<td class="list-genre">
								<a href="http://www.javmovie.com/ja/genre/ass-lover-5.html" title="尻フェチ">尻フェチ</a>
								<a href="http://www.javmovie.com/ja/genre/featured-actress-6.html" title="単体作品">単体作品</a>
								<a href="http://www.javmovie.com/ja/genre/hi-def-7.html" title="ハイビジョン">ハイビジョン</a>
								</td>
								</tr>
								<tr>
									<td colspan =2>
										<div class='playBtn' >
											<a href="#">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.98 31.98">
												<g>
													<circle class="i_played1" cx="15.99" cy="15.99" r="15.99"></circle>
													<circle class="i_played2" cx="15.99" cy="15.99" r="9.2"></circle>
													<path class="i_played3" d="M20.45,15.92l-7-4.06a.09.09,0,0,0-.13.07v8.12a.09.09,0,0,0,.13.07l7-4.06A.08.08,0,0,0,20.45,15.92Z"></path>
												</g>
												</svg>
												<span>試播影片</span>
											</a>
										</div>
									</td>
								</tr>
								<tr >
									<td colspan =2>
										<div class='playBtn' >
											<a href="#">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.98 31.98">
												<g>
													<circle class="i_played1" cx="15.99" cy="15.99" r="15.99"></circle>
													<circle class="i_played2" cx="15.99" cy="15.99" r="9.2"></circle>
													<path class="i_played3" d="M20.45,15.92l-7-4.06a.09.09,0,0,0-.13.07v8.12a.09.09,0,0,0,.13.07l7-4.06A.08.08,0,0,0,20.45,15.92Z"></path>
												</g>
												</svg>
												<span>觀看全片</span>
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
			{{-- <div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<p><a href="/tag/{{$tag->tagname->id}}" target="_blank" class="rs-digg-box2-tag">{{$tag->tagname->name}}</a></p>
					@endforeach
				@endif
			</div>  --}}


			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px;">
				<h5   style="overflow: hidden;overflow: hidden;text-overflow: ellipsis;margin: 0.5rem 0;line-height: 1.8;">
					<b>影片介紹：</b>
				</h5>
				<p>
					@if ($video->description)		
					{{$video->description}}
					@else
					{{$video->title}}
					@endif
				</p>
			</div>
			
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top:10px; height: AUTO;">
				<h5 class="recommend">You may also like</h5>
				<!--
				@php
				$i = 0
				@endphp
				-->
				
				@foreach ($video_with_actress as $video_actress)
				<div style="padding: 10px; width: 70%; height: 200px; margin: 5px;  overflow: hidden; text-align: center;margin: 0px auto;">
					<div poster="" data-id='{{$video_actress->id}}' class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:70%;    padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="http://google1.com"  target="_blank">
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
							<div style="font-size: 8;     line-height: 16px;letter-spacing: 1px;      word-break: break-all;padding-top: 150px;">{{$video_actress->title  }}</div>
		
						</a>
					</div>
				</div>
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
						<a href="/jp/testview/{{$video_actress->video_id}}${{ $video_actress->actress}}"  target="_blank">
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
							<div class='videoTitle'>{{$video_actress->title}}</div>
						 
							<p class='videoInfo'>【{{$video_actress->dvd_id}}】</p>
							<p class='videoInfo'>{{$video_actress->release_date}}</p>
						</a>
					</div>
				</div>
				@endforeach
				<div style="clear: both"></div>

				<h5 class="recommend" >You may also like</h5>
				@foreach ($video_relation as $video_tag)
				<div style="float: left;padding: 10px; width: 230px; height: 230px; margin: 5px; overflow: hidden">
					<div poster=""   class="adClick video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	
					style="height:70%;   padding-top: 0%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
						<a href="/jp/testview/{{$video_tag->video_id}}${{ $video_tag->actress}}"  target="_blank">
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
							</div>
							<div class='videoTitle'>{{$video_tag->title}}</div>
							<p class='videoInfo'>【{{$video_tag->dvd_id}}】</p>
							<p class='videoInfo'>{{$video_tag->release_date}}</p>
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
@section('Carousel2')
<div id="myCarousel" class="carousel slide" style="    position: fixed;top:0;left:0;width:100%;height:100%" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
		  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
		  <li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
	
		<!-- Wrapper for slides -->
		<div class=" position-absolute carousel-inner">
		  <div class="item active">
			<img src="https://www.caribbeancom.com/moviepages/070221-001/images/l/002.jpg" alt="Los Angeles" style="width:100%;">
		  </div>
	
		  <div class="item">
			<img src="https://www.caribbeancom.com/moviepages/070221-001/images/l/002.jpg" alt="Chicago" style="width:100%;">
		  </div>
		
		  <div class="item">
			<img src="https://www.caribbeancom.com/moviepages/070221-001/images/l/002.jpg" alt="New york" style="width:100%;">
		  </div>
		</div>
	
		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		  <span class="glyphicon glyphicon-chevron-left"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
		  <span class="glyphicon glyphicon-chevron-right"></span>
		  <span class="sr-only">Next</span>
		</a>
	  </div>
	  @stop	
@section('footscript')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer> -->
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

		console.log('{{ $video_relation }}')
	};
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
@stop