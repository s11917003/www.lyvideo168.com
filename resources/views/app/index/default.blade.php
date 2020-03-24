@extends('layout.web.lay_web_basic')
@section('topscript')
<script>
	var postnick = '';
	document.write(crc);

</script>
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div class="content-left">
		@foreach ($posts as $post)
		<div class="contentbox">			
			<a href="/p/{{$post->id}}"><div class="contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:70px"></div></a>
			<div class="contentname"><a href="/p/{{$post->id}}">{{$post->userInfo->nick_name}}</a><br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>		
			@if (@$post->tag->tagname)
			<div class="contentword" style="margin:5px 10px;"><span>#{{$post->tag->tagname->name}}#</span></div>
			@endif
			<div class="contentword"><a href="/p/{{$post->id}}">{{$post->title}}</a></div>
			@if ($post->cate_id == 2)
			<div class="contentword">
				<img src="{{$post->video_url}}" style="min-width: 320px; max-width: 640px;">
			</div>
			@elseif ($post->cate_id == 3)
			<div class="contentword">
				<div class="watermark-v"><img src="/img/tv-mark.png"></div>
				<div style="width:640px;">
		            <video id="my-video-{{$post->id}}" class="video-js vjs-big-play-centered" controls preload="auto" width="640" height="400" poster="{{$post->cover_img}}" data-setup="{}">
						<source src="{{$post->video_url}}" type="video/mp4">
						<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
							<a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
						</p>
					</video>
		        </div>
			</div>		
			@endif
			
			<div class="contentword-l">
				<div class="digg like" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class="fas fa-thumbs-up"></i><span> {{$post->detail->count_digg}}</span></div>
				<div class="digg like" id='post-bury-{{$post->id}}' data-id='post-bury-{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$post->detail->count_bury}}</span></div>
				<div class="digg" id='post-repin-{{$post->id}}' data-id='post-repin-{{$post->id}}'><i class="fas fa-star"></i><span> {{$post->detail->count_repin}}</span></div>
			</div>
			<div class="contentword-r">
				<div class="digg" id='post-share-{{$post->id}}' data-id='post-share-{{$post->id}}'><i class="fas fa-share-square"></i><span> {{$post->detail->count_share}}</span></div>
				<div class="digg" onclick="location.href='/p/{{$post->id}}?focus=reply'"><i class="fas fa-comment"></i><span> {{$post->detail->count_cmt}}</span></div>
			</div>
		</div>
		@endforeach
		<div id='morecontent'></div>
		<div class="contentbox1" >
			<div class="ccc">加載更多</div>
		</div>		
		<div class="contentbox1">
			<ul class="pagination">
				<!--<a href="#" class="select">1</a>-->
				<!--
				@if ($lastPage < 4)
					@for ($i = 1; $i < $lastPage; $i++)
					 <li><a href="/{{ $i }}" @if ($currentPage == $i) class="active" @endif>{{ $i }}</a></li>
					@endfor 			
				@else
					@if ($currentPage >= 4)
					<li><a href="/1">1</a></li>
					<li><a href="javascript:void(0)">...</a>					
					<li><a href="/@php echo ($currentPage - 2); @endphp">@php echo ($currentPage - 2) @endphp</a></li>
					<li><a href="/@php echo ($currentPage - 1); @endphp">@php echo ($currentPage - 1) @endphp</a></li>
					<li><a href="/@php echo ($currentPage ); @endphp" class="active">@php echo ($currentPage ) @endphp</a></li>
						@if ($currentPage != $lastPage)
						<li><a href="/@php echo ($currentPage +1); @endphp">@php echo ($currentPage + 1 ) @endphp</a></li>
						...
						@endif
					@else 
						@for ($i = 1; $i < 5; $i++)
						 <li><a href="/{{ $i }}" @if ($currentPage == $i) class="active" @endif>{{ $i }}</a></li>
						 @endfor 
						 <li><a href="javascript:void(0)">...</a>					
					@endif
				@endif
				-->
				<!--
				<li><a href="#">«</a></li>
				<li><a class="active" href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">»</a></li>
				-->
			</ul>		
		</div>
	</div>
	<!-- Content 左側 結束 -->
	<!-- Content 右側 開始 -->
	<div class="content-right">
		<div class="app-qrcode">
			<p class="app-icon-info"><img src="img/app_icon.png" alt="哈哈TV"></p>
			<p>iPhone和Android平台最受歡迎的休閒娛樂軟體哈哈社區，網路熱辣發源地！</p>
		</div>
		<div class="dl-os1"><a href="#">iOS下載</a></div>
		<div class="dl-os2"><a href="#">Android下載</a></div>
	</div>
	<!--
	<div class="content-right">
		<p align="center">放位置</p>
	</div>
		<div class="content-right">
		<p align="center">放位置</p>
	</div>
	-->
	<!-- Content 右側 結束 -->
@stop