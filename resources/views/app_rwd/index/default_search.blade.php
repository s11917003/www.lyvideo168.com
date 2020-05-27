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
					<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->title}}</div>
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
						<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->campaign_name}}</div>
						<div style="font-size: 8px; padding-top: 0px;">　　　</div>
						</a>
				@endif
				</div> 	

				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2"  class="justify-content-center"  style="block-size:unset; float: left; width: 100%; padding-top:10px; height: auto;">
				<div  class="justify-content-center1" >
					<h5 style="COLOR: #ccc; font-weight: bold;">搜寻结果 : {{$search}}</h5>
					@foreach ($posts as $post)
					<div id="rs-article-box" style="block-size:unset; float:left;padding: 10px;  overflow: hidden;  ">
						@if (is_Null($post->isAd))
						<a href="/p/{{$post->id}}">
							<!-- <img id="rs-article-box-img" src="{{ asset('storage'.$post->hot['tb_img']) }}"  >
							<label style="padding: 5px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->hot['title']}}</label>
							<div style="font-size: 8px; padding-top: 0px;">{{$post->count_view}}次观看</div> -->
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
							<label style="cursor: pointer; padding: 10px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->title}}</label>
							
						</a>
						<div style="font-size: 8px; padding-top: 0px;COLOR: #fff;">{{$post['detail']->count_view}}次观看</div>
						@else
						<a href="{{$post->web_url}}" data-id='{{$post->id}}' class="adClick"   target="_blank"> 
							<!-- <img id="rs-article-box-img" src="{{ asset('storage'.$post->hot['tb_img']) }}"  >
							<label style="padding: 5px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->hot['title']}}</label>
							<div style="font-size: 8px; padding-top: 0px;">{{$post->count_view}}次观看</div> -->
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
							<label style="cursor: pointer; padding: 10px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->campaign_name}}</label>
							
						</a>
						<div style="font-size: 8px; padding-top: 0px;COLOR: #fff;  opacity: 0;">．</div>
						@endif
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