@extends('layout.rwd.lay_web_basic')
@section('title')
@php 
		$locale = App::getLocale(); 
		if ($locale == 'en') {
			echo 'Watch Free Video【JavDic  censored, uncensored and amateur japanese porn】';
		} else if ($locale == 'jp') {
			echo '線上免費試看【JavDic  有碼・無碼・素人 - 日本A片資料庫】';
		} else if($locale == 'zh') {
			echo '無料エロ動画【JavDic  修正あり・無修正・素人 - エロ動画まとめ】'; 
		}
		@endphp
@stop
@section('des')
	@php
	 
		$locale = App::getLocale(); 
		if ($locale == 'en') {
			echo 'Watch and enjoy for free - 【When My Little Stepsister Watched My Wife Cumming Like Crazy, She Decided To... Nao Jinguji
When My Little Stepsister Watched My Wife Cumming Like Crazy, She Decided To... Nao Jinguji】, a japanese porn by 【Nao Jinguji】on JavDic, covering all censored - uncensored - amateur Japanese porn';
		} else if ($locale == 'jp') {
			echo '無料エロ動画視聴 - 【独占】嫁の激しいイキっぷりを目の当たりにした居候中の義妹が欲情して… 神宮寺ナオ,  神宮寺ナオ出演 - JavDic  修正あり・無修正・素人 を網羅し、キーワードとタグを絞り込んで、すぐお気に入りのエロ動画を見れる！';
		} else if($locale == 'zh') {
			echo '免費線上看 【独占】嫁の激しいイキっぷりを目の当たりにした居候中の義妹が欲情して… 神宮寺ナオ,  神宮寺ナオ主演 - JavDic橫跨DMM, Prestige, 加勒比海, HEYZO, 一本道, FC2  全面蒐羅日本A片資源  絕對找的到您喜歡的那一片';
		}

	@endphp
@stop
@section('topscript')
{{-- <meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">
<meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
<script>
	 
</script>
@stop
@section('maincontent')

  <div class="container" style="min-height: 500px;">
	<div class="container__header" style="display: block;">{{ __('ui.new')}}</div>
	<div class="news" data-tab="">
	  <ul class="news-tab__header">
		<li class="news-tab__title news-tab__title--active">{{__('ui.title.censored')}} - FANZA</li>
		<li class="news-tab__title">{{__('ui.title.censored')}} - Prestige</li>
		<li class="news-tab__title">{{__('ui.title.uncensored')}}</li>
		<li class="news-tab__title">{{__('ui.title.amateur')}}</li>
	  </ul>
	  <div class="news-tab__content news-tab__content--active">
		@if(count($video1) > 0)
		<div class="news__title">{{__('ui.title.censored')}} - FANZA</div>
		@endif
		<div class="news__list list">  
		@foreach ($video1 as $video)
 
		<a href="/{{$lang}}/video/{{$video->video_id}}${{ $video->actress}}" class="list__item">
			<figure><img src="{{ $video->cover_img }}"></figure>
			<div class="list__item-info">
			<h6>{{__('ui.title.video_censored')}} FANZA {{$video->video_id}}</h6>
			<p>{{$video->title}}</p>
			@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date))}}</div> @endif
			</div>
		</a>
		@endforeach

		</div>
	  </div>
	  <div class="news-tab__content">
		@if(count($video2) > 0)
		<div class="news__title">{{__('ui.title.censored')}} - Prestige</div>
		@endif
		<div class="news__list list">
		  
			@foreach ($video2 as $video)
 
			<a href="/{{$lang}}/video/{{$video->video_id}}${{ $video->actress}}" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
					<h6>{{__('ui.title.video_censored')}} Prestige {{$video->video_id}}</h6>
					<p>{{$video->title}}</p>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
				</div>
			</a>
			@endforeach
		</div>
	  </div>
	  <div class="news-tab__content">
		@if(count($video3) > 0)
		<div class="news__title">{{__('ui.title.uncensored')}}</div>
		@endif
		<div class="news__list list">
			@foreach ($video3 as $video)
 
			<a href="/{{$lang}}/video/{{$video->video_id}}${{ $video->actress}}" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
					<h6>{{__('ui.title.video_uncensored')}} {{$video->video_id}}</h6>
					<p>{{$video->title}}</p>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
				</div>
			</a>
			@endforeach
		 

		</div>
	  </div>
	  <div class="news-tab__content">
		@if(count($video4) > 0)
		<div class="news__title">{{__('ui.title.amateur')}}</div>
		@endif
		<div class="news__list list">
		  
			@foreach ($video4 as $video)
 
			<a href="/{{$lang}}/video/{{$video->video_id}}${{ $video->actress}}" class="list__item">
				<figure><img src="{{ $video->cover_img }}"></figure>
				<div class="list__item-info">
					<h6>{{__('ui.title.video_amateur')}} {{$video->video_id}}</h6>
					<p>{{$video->title}}</p>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
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
 
    $('[data-tab]').on('click', '.news-tab__title', function () {
      const idx = $(this).index();
      $('[data-tab]')
        .find('.news-tab__title')
        .removeClass('news-tab__title--active');
      $('[data-tab]')
        .find('.news-tab__content')
        .removeClass('news-tab__content--active');

      $(this).addClass('news-tab__title--active');
      $('[data-tab]')
        .find('.news-tab__content')
        .eq(idx)
        .addClass('news-tab__content--active');
    });

    
   

	window.onload = function() {

		console.log('window.onload')

	}
</script>
@stop