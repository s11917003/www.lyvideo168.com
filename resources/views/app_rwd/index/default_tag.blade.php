@extends('layout.rwd.lay_web_basic')
@section('title')
{{$tag}}|No.1老濕機休息站，帶你升天帶你飛，每天更新,片片精彩！
@stop
@section('des')
No.1老濕機休息站，帶你升天帶你飛，每天更新,片片精彩！
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
		@php ($i = 1)
		@foreach ($posts as $post)

		<div id="rs-content-left-box" data-id='{{$post->article['id']}}' data-show=false>
			<div class="rs-contentpics" style="background: url({{$post->article['userInfo']['avatar']}}) no-repeat top center; background-size:50px"><a href="/p/{{$post->article['id']}}"></a></div>
			<div class="rs-contentname">{{$post->article['userInfo']['nick_name']}}<br>{{ Carbon\Carbon::parse($post->article['created_time'])->format('m-d H:i:s') }}</div>
			<div class="rs-contentword">
				<h2><a href="/p/{{$post->article['id']}}">{!! $post->article['title'] !!}</a></h2>
				<p style="position: relative"><a href="/p/{{$post->article['id']}}">
					<img src="/img/if_play_alt_118620.png"  style="position: absolute; top:40%; left:45%; z-index: 999; width: 50px;">
					<img src="{{ asset('storage'.$post->article->cover_img) }}"       alt="{{$post->article['title']}}" style="min-width: 320px; max-width: 640px;">
					</a>
				</p>
			</div>			
			<div id="rs-digg-box2" style="float: left; width: 100%">
				@if ($tag)
					@foreach ($post->article['tag'] as $tt)
					<p><a href="/tag/{{$tt->tagname->id}}" target="_blank" class="rs-digg-box2-tag">{{$tt->tagname->name}}</a></p>
					@endforeach
				@endif
			</div>					
		</div>
		@if($i%2 == 0)
			<div id="rs-content-left-box">
			@if ($device == 'android' || $device == 'ios')
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 120px; text-align:center">
				<!-- JuicyAds v3.0 -->
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="714569" data-width="300" data-height="112"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':714569});</script>
				<!--JuicyAds END-->
			</div>
			@else		
			<div id="rs-digg-box2" style="float: left; width: 100%; height: 75px; text-align:center">
				<!-- JuicyAds v3.0 -->
				<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
				<ins id="714570" data-width="468" data-height="72"></ins>
				<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':714570});</script>
				<!--JuicyAds END-->
				</div>
			@endif
			</div>
		@endif
		@php ($i++)
		@endforeach
		<div class="rs-contentbox1" id="page"></div>
	</div>
			
	<!-- RightSideBox -->
	<!-- Content 右側 結束 -->
	  <script>
		document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/tag/{{$post->post_tag_id}}/");
		nick = ''			

	</script> 
@stop