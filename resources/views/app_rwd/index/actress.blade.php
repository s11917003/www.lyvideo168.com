@extends('layout.rwd.lay_web_basic_temp')
@section('title')
{{--  @php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp --}}
@stop
@section('des')
 
@stop
@section('topscript')
{{-- <meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($post->title)}}">
<meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
  
@stop
@section('maincontent')
<div class="artist">
	<div class="artist__content">
	  <figure><img src="/img/Pictures/{{$actress->JapaneseName1  }}_coverphoto.jpg"></figure>
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
		  <p>{{ $count }}部影片</p>
		</div>
		<div class="artist__content-link">
		  <a class="i-twitter" href="{{$actress->Twitter  }}">
			<img src="svg/twitter-brands.svg" alt="">
			<span>Twitter</span></a>
		  <a class="i-instagram" href="{{$actress->Twitter  }}"><img src="svg/instagram-brands.svg" alt=""><span>Instagram</span></a>
		</div>
		<div class="artist__content-about" style="height:100%">
			<textarea style="height:auto;width:100%">
				{{ $actress->wiki->Profile }}</textarea>
		</div>
	  </div>
	</div>
 
	<div class="artist__about">
	  <p class="active">
		{{ $actress->wiki->Contents }}</p>
	  <div class="artist__about-more">
		<i class="i-arrow"></i><span>閱讀更多</span><i class="i-arrow"></i>
	  </div>
	</div>
  </div>
@stop	
@section('footer')
<div class='actress_footer'style='
'>
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
textarea {
	font-weight: bold;
    
    line-height: 30px;
    border: none;
    overflow: auto;
    outline: none;

    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
	font-size:15px;
    resize: none; /*remove the resize handle on the bottom right*/
}
	</style>
<script>
	 
	//   $('.category__more').on('click', function (e) {
	// 	e.preventDefault();
	// 	const $this = $(this);
	// 	$this.find('.i-arrow').toggleClass('active');
	// 	$this.parent('.category').toggleClass('category--open');
	//   });
	$('textarea').each(function() {
        $(this).height($(this).prop('scrollHeight'));
    });

	  const $aboutCont = $('.artist__about p');
	  const $aboutContMore = $('.artist__about-more');
	//   if ($aboutCont.height() > 72) {
	// 	$aboutCont.addClass('active');
		$aboutContMore.show().on('click', function () {
		  $aboutCont.toggleClass('active');
		  $aboutContMore.find('.i-arrow').toggleClass('active');
		});
	//   } else {
	// 	$aboutContMore.hide();
	//   }
	 
  </script>

@stop