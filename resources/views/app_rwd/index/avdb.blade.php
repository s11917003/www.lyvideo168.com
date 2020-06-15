@extends('layout.rwd.lay_web_basic')
@section('title')
@lang('default.title')休息站
@stop
@section('des')
No.1 @lang('default.description')休息站，帶你升天帶你飛，每天更新,片片精彩！
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
		@foreach ($posts as $post)
		<div id="rs-content-left-box" data-id='{{$post->id}}' data-show=false class='avdb-left-box'>
			<div class="rs-contentname">{{$post->idno}}<br>{{ Carbon\Carbon::parse($post->publish_time)->format('Y-m-d') }}</div>
			<div class="rs-contentword" style="height: 100px; overflow: hidden">
				<h2 style="font-size: 12px; line-height: 18px;"><a href="/avdbview/{{$post->id}}">{!! $post->title !!}</a></h2>
			</div>
			<div class="rs-contentword" style="min-height: 210px;">
				<p><img src="{{$post->coverimg}}" alt="{{$post->title}}" style="width:100%"></p>
			</div>							
		</div>
		@endforeach
		<div class="rs-contentbox1" id="page"></div>
	</div>
			
	<!-- RightSideBox -->

	<!-- Content 右側 結束 -->
	<script>
			document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} , {{$pagestring}});
			nick = ''			
	</script>
@stop