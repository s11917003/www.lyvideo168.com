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
		<li class="ranking__board-item 	@if($type==2) ranking__board-item--active @endif"><a href="/{{$lang}}/rank/2">{{__('ui.rank.month')}}</a></li>
		<li class="ranking__board-item  @if($type==1) ranking__board-item--active @endif "><a href="/{{$lang}}/rank/1">{{__('ui.rank.week')}}</a></li>
	</ul>
	@if(count($fanza) > 0)
	<!-- 有碼 FANZA -->
	<div class="ranking news">
	  <p class="ranking__title title__keyword__more">{{__('ui.title.censored')}} - FANZA 
	  	<a href="/{{$lang}}/rank-list/fanza">{{__('ui.more')}} &gt;&gt;</a>
		</p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($fanza as $post)
				@foreach ($post->video as $video)
				@if($video->video_lang == $langIndex)
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
					@if ($lang == 'jp') <p class="list__num">{{$post->rank}}位</p>
					@else <p class="list__num">Top {{$post->rank}}.</p>
					@endif
					<figure><img src="{{$post->video[0]->cover_img}}"></figure>
				<div class="list__item-info">
					<h5>{{$video->video_id}}</h5>
					<h1>{{$video->title}}</h1>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
				</div>
				@endif
				@endforeach
			</a>
			@endforeach
		</div>
	 
	  </div>
	</div>
	@endif
	@if(count($prestige) > 0)
	<!-- 有碼 Prestige -->
	<div class="ranking news">
	  <p class="ranking__title title__keyword__more">{{__('ui.title.censored')}} - PRESTIGE
		  <a href="/{{$lang}}/rank-list/prestige">{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($prestige as $post)
				@foreach ($post->video as $video)
				 
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
					@if ($lang == 'jp') <p class="list__num">{{$post->rank}}位</p>
					@else <p class="list__num">Top {{$post->rank}}.</p>
					@endif
						<figure><img src="{{$post->video[0]->cover_img}}"></figure>
					<div class="list__item-info">
						<h5>{{$video->video_id}}</h5>
						<h1>{{$video->title}}</h1>
						@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
					</div>
			 
				@endforeach
			</a>
			@endforeach

		</div>
	  </div>
	</div>
	@endif
	@if(count($uncensored) > 0)
	<!-- 無碼 -->
	<div class="ranking news">
	  <p class="ranking__title title__keyword__more">{{__('ui.title.uncensored')}} 
		  <a href="/{{$lang}}/rank-list/uncensored">{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($uncensored as $post)
				@foreach ($post->video as $video)
				@if($lang == 'zh' && $video->video_lang ==3)
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$video->actress}}" class="list__item">
					@if ($lang == 'jp') <p class="list__num">{{$post->rank}}位</p>
					@else <p class="list__num">Top {{$post->rank}}.</p>
					@endif
						<figure><img src="{{$video->cover_img}}"></figure>
					<div class="list__item-info">
						<h5>{{$video->video_id}}</h5>
						<h1>{{$video->title}}</h1>
						@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
					</div>
				</a> 
				@elseif ( ($lang == 'jp' && $video->video_lang ==3) ||    ($lang == 'en' && $video->video_lang ==2))
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$video->actress}}" class="list__item">
					@if ($lang == 'jp') <p class="list__num">{{$post->rank}}位</p>
					@else <p class="list__num">Top {{$post->rank}}.</p>
					@endif
						<figure><img src="{{$video->cover_img}}"></figure>
					<div class="list__item-info">
						<h5>{{$video->video_id}}</h5>
						<h1>{{$video->title}}</h1>
						@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
					</div>
				</a> 
				@endif	
				@endforeach
			@endforeach

		</div>
	  </div>
	</div>
	@endif
	@if(count($amateur) > 0)
	<!-- 素人 -->
	<div class="ranking news">
	  <p class="ranking__title title__keyword__more">{{__('ui.title.amateur')}}
		  <a href="/{{$lang}}/rank-list/amateur"  >{{__('ui.more')}} &gt;&gt;</a>
	  </p>
	  <div class="list__wrap">
		<div class="list">
			@foreach ($amateur as $post)
				@foreach ($post->video as $video)
				
				<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->video[0]->actress}}" class="list__item">
					<p class="list__num">Top {{$post->rank}}.</p>
						<figure><img src="{{$post->video[0]->cover_img}}"></figure>
					<div class="list__item-info">
						<h5>{{$video->video_id}}</h5>
						<h1>{{$video->title}}</h1>
						@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
					</div>
				</a>
				
				@endforeach
			@endforeach

		</div>
	  </div>
	</div>
	@endif
  </div>
@stop	
