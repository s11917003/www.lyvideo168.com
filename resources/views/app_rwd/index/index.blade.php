@extends('layout.rwd.lay_web_basic')
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

	
  <div class="container">
	<div class="container__header">每日最新影片</div>
	<div class="news" data-tab="">
	  <ul class="news-tab__header">
		<li class="news-tab__title news-tab__title--active">有碼 FANZE</li>
		<li class="news-tab__title">有碼 Prestige</li>
		<li class="news-tab__title">無碼</li>
		<li class="news-tab__title">素人</li>
	  </ul>
	  <div class="news-tab__content news-tab__content--active">
		<div class="news__title">有碼 FANZE</div>
		<div class="news__list list">  
		@foreach ($video1 as $video)
 
		<a href="/jp/testview/{{$video->video_id}}${{ $video->actress}}"  target="_blank" class="list__item">
			<figure><img src="{{ $video->cover_img }}"></figure>
			<div class="list__item-info">
			<h5>{{$video->title}}</h5>
			<h6>【{{$video->video_id}}】</h6>
			<div class="date">{{$video->release_date}}</div>
			</div>
		</a>
		@endforeach

		</div>
	  </div>
	  <div class="news-tab__content">
		<div class="news__title">有碼 Prestige</div>
		<div class="news__list list">
		  
			@foreach ($video2 as $video)
 
			<a href="/jp/testview/{{$video->video_id}}${{ $video->actress}}"  target="_blank" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
				<h5>{{$video->title}}</h5>
				<h6>【{{$video->video_id}}】</h6>
				<div class="date">{{$video->release_date}}</div>
				</div>
			</a>
			@endforeach
		</div>
	  </div>
	  <div class="news-tab__content">
		<div class="news__title">無碼</div>
		<div class="news__list list">
			@foreach ($video3 as $video)
 
			<a href="/jp/testview/{{$video->video_id}}${{ $video->actress}}"  target="_blank" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
				<h5>{{$video->title}}</h5>
				<h6>【{{$video->video_id}}】</h6>
				<div class="date">{{$video->release_date}}</div>
				</div>
			</a>
			@endforeach
		 

		</div>
	  </div>
	  <div class="news-tab__content">
		<div class="news__title">素人</div>
		<div class="news__list list">
		  
			@foreach ($video4 as $video)
 
			<a href="/jp/testview/{{$video->video_id}}${{ $video->actress}}"  target="_blank" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
				<h5>{{$video->title}}</h5>
				<h6>【{{$video->video_id}}】</h6>
				<div class="date">{{$video->release_date}}</div>
				</div>
			</a>
			@endforeach
		</div>
	  </div>
	</div>
  </div>

 
@stop	

@section('footscript')
</script>
<script>

	window.onload = function() {

		console.log('window.onload')

	 
</script>
@stop