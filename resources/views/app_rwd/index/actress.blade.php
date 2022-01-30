@extends('layout.rwd.lay_web_basic')
@section('title')
@php
echo $actress->JapaneseName1.'：線上免費試看【JavDic  有碼・無碼・素人 - 日本A片資料庫】';
@endphp
@stop
@section('des')
	@php
		echo '無料エロ動画視聴 - '.$actress->JapaneseName1.' - JavDic  修正あり・無修正・素人 を網羅し、キーワードとタグを絞り込んで、すぐお気に入りのエロ動画を見れる！';
	@endphp
@stop
@section('keywords')
	@php 
		echo  $actress->JapaneseName1,__('ui.meta.keywords'); 
	@endphp
@stop
@section('topscript')
{{-- <meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">
<meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
  
@stop

@section('maincontent')
<div class="artist">
	<div class="artist__content">
	  <figure><img src="/img/Pictures/{{$actress->JapaneseName1}}_coverphoto.jpg"></figure>
	  <div class="artist__content-info">
		<div class="artist__content-name">{{ $actress->JapaneseName1 }}</div>
		<div class="artist__content-moveie">
		  <ul>
			<li>{{ $actress->ChineseName1 }}</li>
			<li>{{ $actress->ChineseName2 }}</li>
			<li>{{ $actress->ChineseName3 }}</li>
			<li>{{ $actress->JapaneseName1 }}</li>
			<li>{{ $actress->JapaneseName2 }}</li>
			<li>{{ $actress->JapaneseName3 }}</li>
			<li>{{ $actress->JapaneseName4 }}</li>
			<li>{{ $actress->JapaneseName5 }}</li>
		  </ul>
		  <p>{{ $count }} {{__('ui.actress_page.videos')}}</p>
		</div>
		<div class="artist__content-link">
		  <a class="i-twitter" href="{{$actress->Twitter  }}">
			<img src="svg/twitter-brands.svg" alt="">
			<span>Twitter</span></a>
		  <a class="i-instagram" href="{{$actress->Instagram  }}"><img src="svg/instagram-brands.svg" alt=""><span>Instagram</span></a>
		</div>
		<div class="artist__content-about" style="height:100%;width:100%;">
			<textarea >{{trim($actress->wiki->Profile)}}</textarea>
		</div>
	  </div>
	</div>
 
	<div class="artist__about">
	 <textarea class="" style="min-height:150px;height:150px;width:100%;border: none;overflow:hidden">{{trim( $actress->wiki->Contents)}}
	 </textarea>
	  <div class="artist__about-more">
		<i class="i-arrow"></i><span>{{__('ui.actress_page.read_more')}}</span><i class="i-arrow"></i>
	  </div>
	</div>

	<div class="category">
		<ul id="category_form" class="category__tags" style="width:100%">
			<li name="all" class="category__tags-item category__tags-item--active"><a href="#">ALL</a></li>
			@foreach ($video_tag as $tag)
			<li name="{{$tag->id}}" class="category__tags-item"><a href="#">{{$tag[$lang]}}({{$tag->count}})</a></li>
			@endforeach
		</ul> 
		<div class="category_more"><a href="#"><span>{{__('ui.more')}}</span> <i class="i-arrow "></i></a></div>
	  </div>
	<div class="list" style=" display: inline;">
		<div class="list__wrap" style="width: 100%;"> 
			<div  id="video_list"  class="list" style="width: 100%;">
				@foreach ($videos_relation as $video_actress)
				<a href="/{{$lang}}/video/{{$video_actress->video_id}}${{ $video_actress->actress}}" class="list__item">
					<figure><img src="{{ $video_actress->cover_img }}"></figure>
					<div class="list__item-info">
					<h5>{{ $video_actress->video_id }}</h5>
					<h1>{{ $video_actress->title }}</h1>
					@if ($video_actress->release_date)<div class="date">{{$video_actress->release_date}}</div> @endif
					</div>
				</a> 
				@endforeach
			</div>
		</div>
	</div>

 
@stop	
@section('footer')
<div class='actress_footer'style=''>
	<p style=''>
	  {{ $actress->wiki->APA }}
	</p>
	<p style=''>
	  This article uses material from the Wikipedia article   <a href="{{ $actress->wiki->Wiki_Link }}">{{ $actress->wiki->wiki_name }}</a>, 
	  <br>which is released under the Creative Commons Attribution-Share-Alike License 3.0
	 
	</p>
</div>
@stop	
@section('footscript')
<style>
.actress_footer {
	padding: 8rem 3rem 0 3rem;
	text-align: center;
	color: #000;
	background: inherit;
	font-size: 0.625rem;

}
.actress_footer p{
	line-height: 1.5;
    padding-bottom: 1rem;
	margin: 0 auto;
	width: 60%;
    word-break: break-all;
}
@media screen and (max-width: 480px){
.actress_footer p{
	width: 90%;
}
}
.artist__about textarea {
	min-height: 150px;
	height: 150px;
}
textarea {
	font-weight: bold;
    line-height: 30px;
    border: none;
    overflow: auto;
    outline: none;
    text-indent : 0em;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
	font-size:15px;
	width: 100%;
    resize: none;  
    background: none;
    color: var(--text-color);
}
</style>
<script>
	 window.onload = function() {
		$('.category').find('li').each(function(){
			$(this).find('a').attr("href","javascript:void(0);");
			cate_cilck(this);
		});
	

	 }
	$('.category_more').on('click', function(e) {
		e.preventDefault();
		const $this = $(this);
		$this.find('.i-arrow').toggleClass('active');
		$this.parent('.category').toggleClass('category--open');
	});
	 
	//   $('.category__more').on('click', function (e) {
	// 	e.preventDefault();
	// 	const $this = $(this);
	// 	$this.find('.i-arrow').toggleClass('active');
	// 	$this.parent('.category').toggleClass('category--open');
	//   });
	$('textarea').each(function() {
        $(this).height($(this).prop('scrollHeight'));
    });
	const $aboutCont = $('.artist__about textArea');
    $aboutCont.css('max-height','150px')
	const $aboutContMore = $('.artist__about-more');
	//   if ($aboutCont.height() > 72) {
	// 	$aboutCont.addClass('active');
	$aboutContMore.show().on('click', function () {
	$aboutCont.toggleClass('active');
	$aboutContMore.find('.i-arrow').toggleClass('active');
	if($aboutCont.hasClass('active')){
	     $aboutCont.css('max-height','3000px')
	}else {
	  $aboutCont.css('max-height','150px')
	}
		});
	function cate_cilck(e){
	
	$(e).click(function(){
		arr =[]
		if($(this).attr('name') == 'all' ){
			if(!$(this).hasClass('category__tags-item--active')){  //要全選取消
				$('.category').find('li').each(function(){
					$(this).removeClass('category__tags-item--active')
				});
					$("li[name=all]").addClass('category__tags-item--active')
			}
		} else {
			if($(this).hasClass('category__tags-item--active')) {
				$(this).removeClass('category__tags-item--active')
			} else {
				$("li[name=all]").removeClass('category__tags-item--active')
				$(this).addClass('category__tags-item--active')
			}
				if($('.category').find('.category__tags-item--active').length == 0){
					$("li[name=all]").addClass('category__tags-item--active')
				}
		}
		
		$('.category__tags').find('.category__tags-item--active').each(function(){
			arr.push($(this).attr('name'))
		 
		});

		// sendAjax(arr,1);
	});
	
	return;
	
	} 
  </script>

@stop