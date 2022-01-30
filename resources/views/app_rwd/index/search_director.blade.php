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
	<div class="search-result">
		<p class="search-result__title">{{__('ui.search_result')}}:{{$search}}</p>
		<!-- <ul class="search-result__board">
		  <li class="search-result__board-item"><a href="#">照相關度排列</a></li>
		  <li class="search-result__board-item search-result__board-item--active"> <a href="#">照發行日期排列</a> </li>
		</ul> -->
		<div class="list" style="width: 100%;">
			<div class="list__wrap" style="width: 100%;"> 
			  <div  id="video_list"  class="list">
				@foreach ($videos as $post)
					<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->actress}}" class="list__item">
						<figure><img src="{{$post->cover_img}}"></figure>
						<div class="list__item-info">
							<h5>{{$post->video_id}}</h5>
							<h6>{{$post->title}}</h6>
							@if($post->release_date)<div class="date">{{$post->release_date}}</div> @endif
						</div>
					</a>
				@endforeach
			  </div>
			</div>
		</div>
	</div>
</div>
@stop	

