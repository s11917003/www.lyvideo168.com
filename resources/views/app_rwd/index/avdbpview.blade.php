@extends('layout.rwd.lay_web_basic')
@section('title')
@php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($post->title)}}
@stop
@section('topscript')
<meta itemprop="name" content="老濕機">
<meta itemprop="description" content="{{$post->title}}">
<meta itemprop="keyword" content="老濕機,{{$post->idno}},{{$post->producer}}">
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div id="rs-content-left">
		<div id="rs-content-left-box">
			<div class="rs-contentword">
				<h2><a href="javascript:void(0)">{{$post->title}}</a></h2>
				<img src="{{$post->bigimage}}" width="100%">
			</div>
			<div class="rs-contentword">
				<div class="rs-avdbinfo">番號：{{$post->idno}}</div>
				<div class="rs-avdbinfo">發行時間：{{$post->publish_time}}</div>
				<div class="rs-avdbinfo">影片時長：{{$post->video_len}}</div>
				<div class="rs-avdbinfo">導演：{{$post->director}}</div>
				<div class="rs-avdbinfo">製作商：{{$post->producer}}</div>
				<div class="rs-avdbinfo">系列：{{$post->typestring}}</div>
				<div class="rs-avdbinfo">影片類別：{{$post->tagstring}}</div>
				<div class="rs-avdbinfo">女優：{{$post->avname}}</div>
			</div>
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
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
@stop