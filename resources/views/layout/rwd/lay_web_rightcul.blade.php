	<!-- <div id="rs-right-box">
	
	</div> -->
	<!-- JuicyAds v3.0
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>	
	-->
	<!--
	<div id="rs-right-box">
		<script type="text/javascript" src="http://js.spacenine.biz/t/329/177/a1329177.js"></script>
	</div>
	-->
	<div id="rs-right-box">
		<div class="rs-appinfo">No.1 @lang('default.description')休息站，带你升天带你飞，频繁更新片片精彩！</div>
		@foreach ($relate as $re)
	
		<div style="width: 240PX; height: 180px; padding:10px 0PX 0 0PX;overflow: hidden;MARGIN: 0 AUTO;">
			@if (is_Null($re->isAd))
			
			<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:100%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
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
												height: 80%;  
												 WIDTH: 100%;
												MARGIN: 0PX 5PX 0 5PX;
												BACKGROUND-COLOR: #000;
												background-image: url('{{ asset('storage'.$re->article['tb_img'])}}');" 
											>
					</div>
					<!-- <img src="{{ asset('storage'.$re->article['tb_img']) }}" style="width: 300px;"> -->
					<div style="    text-align: center; font-size: 8; padding-top: 5px; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color:#f90;">{{$re->article['title']}}</div>

				</a>
			</div>
			@else	
			<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" 	style="height:100%;" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
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
												height: 80%;  
												 WIDTH: 100%;
												MARGIN: 0PX 5PX 0 5PX;
												BACKGROUND-COLOR: #000;
												background-image: url('{{ asset('storage/'.$re->bg_img)}}');" 
											>
					</div>
					<!-- <img src="{{ asset('storage'.$re->article['tb_img']) }}" style="width: 300px;"> -->
					<div style="text-align: center; font-size: 8; padding-top: 5px; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color:#f90;">{{$re->campaign_name }}</div>

				</a>
			</div>
			@endif
					 
		</div>
		@endforeach
	</div>
	<!-- JuicyAds v3.0
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="f alse" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>	
	-->