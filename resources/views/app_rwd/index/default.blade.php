@extends('layout.rwd.lay_web_basic')
@section('title')
老湿机休息站-免费视频分享网
@stop
@section('des')
No.1老湿机休息站，带你升天带你飞，频繁更新片片精彩！大量线上免费视频，100%免费色情视频、成人短视频、高清成人视频，支援手机收看！
@stop
@section('topscript')
<script>
	var postnick = '';
	document.write(crc);

</script>
@stop
@section('maincontent')
	<!-- Leftside Article -->
	<div id="rs-content-left">
		<!-- @php ($i = 1) -->
		@foreach ($posts as $post)
		<div id="rs-content-left-box" data-id='{{$post->id}}' data-show=false>
			<div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>
			<div class="rs-contentword">
				<h2><a href="/p/{{$post->id}}">{!! $post->title !!}</a></h2>
				<p style="position: relative"><a href="/p/{{$post->id}}">
					<img src="/img/if_play_alt_118620.png"  style="position: absolute; top:40%; left:45%; z-index: 999; width: 50px;">
					<img src="{{ asset('storage'.$post->cover_img) }}" alt="{{$post->title}}" style="min-width: 320px; max-width: 640px;">
					</a>
				</p>
			</div>
			<div id="rs-digg-box2" style="float: left; width: 100%; padding-top: 10px">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<p><a href="/tag/{{$tag->tagname->id}}" target="_blank" class='rs-digg-box2-tag'>{{$tag->tagname->name}}</a></p>
					@endforeach
				@endif
			</div>		
		</div>
		
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
		
		<!-- @php ($i++)	-->	
		@endforeach
		<div class="rs-contentbox1" id="page"></div>
	</div>
			
	<!-- RightSideBox -->

	<!-- Content 右側 結束 -->
	<script>
			document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/");
			nick = ''			
	</script>
@stop