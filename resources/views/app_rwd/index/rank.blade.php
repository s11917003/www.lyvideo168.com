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
	<div class="container__header">排行榜一覽</div>
	<ul class="ranking__board">
		<li class="ranking__board-item  @if($type==1) ranking__board-item--active @endif "><a href="/rank/1">每週排行榜</a></li>
		<li class="ranking__board-item 	@if($type==2) ranking__board-item--active @endif"><a href="/rank/2">每月排行榜</a></li>
		
	  </ul>
	<!-- 有碼 FANZA -->
	<div class="ranking">
	  <p class="ranking__title">有碼 FANZA</p>
	 
	  <div class="list__wrap">
		<div class="list">
			@foreach ($fanza as $post)
				<a href="/jp/testview/{{$post->video->video_id}}${{$post->video->actress}}"  target="_blank" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
				<figure><img src="{{$post->video->cover_img}}"></figure>
				<div class="list__item-info">
				<h5>{{$post->video->video_id}}</h5>
				<h6>【{{$post->video->title}}】</h6>
				<div class="date">2018-05-17</div>
				</div>
			</a>
			@endforeach
		</div>
	 
	  </div>
	</div>

	<!-- 有碼 Prestige -->
	<div class="ranking">
	  <p class="ranking__title">有碼 Prestige</p>
	  
	  <div class="list__wrap">
		<div class="list">
			@foreach ($prestige as $post)
			<a href="movie.html" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
				<figure><img src="{{$post->video->cover_img}}"></figure>
				<div class="list__item-info">
				<h5>{{$post->video->video_id}}</h5>
				<h6>【{{$post->video->title}}】</h6>
				<div class="date">2018-05-17</div>
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>

	<!-- 無碼 -->
	<div class="ranking">
	  <p class="ranking__title">無碼</p>
	   
	  <div class="list__wrap">
		<div class="list">
			@foreach ($uncensored as $post)
			<a href="movie.html" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
				<figure><img src="{{$post->video->cover_img}}"></figure>
				<div class="list__item-info">
				<h5>{{$post->video->video_id}}</h5>
				<h6>【{{$post->video->title}}】</h6>
				<div class="date">2018-05-17</div>
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>

	<!-- 素人 -->
	<div class="ranking">
	  <p class="ranking__title">素人</p>
 
	  <div class="list__wrap">
		<div class="list">
		  
			@foreach ($amateur as $post)
			<a href="movie.html" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
				<figure><img src="{{$post->video->cover_img}}"></figure>
				<div class="list__item-info">
				<h5>{{$post->video->video_id}}</h5>
				<h6>【{{$post->video->title}}】</h6>
				<div class="date">2018-05-17</div>
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>
  </div>
@stop	