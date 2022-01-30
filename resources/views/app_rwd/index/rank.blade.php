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
	<div class="container__header">{{__('ui.rank.rank_title')}}</div>
	<ul class="ranking__board">
		<li class="ranking__board-item  @if($type==1) ranking__board-item--active @endif "><a href="/{{$lang}}/rank/1">{{__('ui.rank.week')}}</a></li>
		<li class="ranking__board-item 	@if($type==2) ranking__board-item--active @endif"><a href="/{{$lang}}/rank/2">{{__('ui.rank.month')}}</a></li>
		
	  </ul>
	@if(count($fanza) > 0)
	<!-- 有碼 FANZA -->
	<div class="ranking">
	  <p class="ranking__title">{{__('ui.title.censored')}} FANZA 
	  	<a href="/{{$lang}}/rank-list/fanza">{{__('ui.more')}} &gt;&gt;</a>
		</p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($fanza as $post)
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
					<figure><img src="{{$post->video[0]->cover_img}}"></figure>
				<div class="list__item-info">
					<h5>{{$post->video[0]->video_id}}</h5>
					<h6>{{$post->video[0]->title}}</h6>
					@if($post->video[0]->release_date)<div class="date">{{$post->video[0]->release_date}}</div> @endif
				</div>
			</a>
			@endforeach
		</div>
	 
	  </div>
	</div>
	@endif
	@if(count($prestige) > 0)
	<!-- 有碼 Prestige -->
	<div class="ranking">
	  <p class="ranking__title">{{__('ui.title.censored')}} Prestige	
		  <a href="/{{$lang}}/rank-list/prestige">{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($prestige as $post)
			<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
					<figure><img src="{{$post->video[0]->cover_img}}"></figure>
				<div class="list__item-info">
					<h5>{{$post->video[0]->video_id}}</h5>
					<h6>{{$post->video[0]->title}}</h6>
					@if($post->video[0]->release_date)<div class="date">{{$post->video[0]->release_date}}</div> @endif
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>
	@endif
	@if(count($uncensored) > 0)
	<!-- 無碼 -->
	<div class="ranking">
	  <p class="ranking__title">{{__('ui.title.uncensored')}} 
		  <a href="/{{$lang}}/rank-list/uncensored">{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($uncensored as $post)
			<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
					<figure><img src="{{$post->video[0]->cover_img}}"></figure>
				<div class="list__item-info">
					<h5>{{$post->video[0]->video_id}}</h5>
					<h6>{{$post->video[0]->title}}</h6>
					@if($post->video[0]->release_date)<div class="date">{{$post->video[0]->release_date}}</div> @endif
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>
	@endif
	@if(count($amateur) > 0)
	<!-- 素人 -->
	<div class="ranking">
	  <p class="ranking__title">{{__('ui.title.amateur')}}
		  <a href="/{{$lang}}/rank-list/amateur"  >{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($amateur as $post)
			<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
				<p class="list__num">Top {{$post->rank}}.</p>
					<figure><img src="{{$post->video[0]->cover_img}}"></figure>
				<div class="list__item-info">
					<h5>{{$post->video[0]->video_id}}</h5>
					<h6>{{$post->video[0]->title}}</h6>
					@if($post->video[0]->release_date)<div class="date">{{$post->video[0]->release_date}}</div> @endif
				</div>
			</a>
			@endforeach

		</div>
	  </div>
	</div>
	@endif
  </div>
@stop	
