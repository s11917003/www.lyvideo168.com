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
	<div class="container__header">類別搜尋</div>
	<div class="category category--open">
	  <div class="category__title">來源</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">全部</a></li>
		<li class="category__tags-item"><a href="#">有碼 - FANZA</a></li>
		<li class="category__tags-item category__tags-item--active">
		  <a href="#">有碼 - PRESTIGE</a>
		</li>
		<li class="category__tags-item category__tags-item--active">
		  <a href="#">無碼</a>
		</li>
		<li class="category__tags-item"><a href="#">FC2</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">形式</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">高畫質</a></li>
		<li class="category__tags-item"><a href="#">VR 專用</a></li>
		<li class="category__tags-item"><a href="#">女優作品</a></li>
		<li class="category__tags-item"><a href="#">出道作品</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">角色</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">美少女</a></li>
		<li class="category__tags-item category__tags-item--active"><a href="#">女高中生</a></li>
		<li class="category__tags-item"><a href="#">女大學生</a></li>
		<li class="category__tags-item category__tags-item--active"><a href="#">辣妹</a></li>
		<li class="category__tags-item"><a href="#">人妻</a></li>
		<li class="category__tags-item"><a href="#">少婦</a></li>
		<li class="category__tags-item"><a href="#">熟女</a></li>
		<li class="category__tags-item"><a href="#">素人</a></li>
		<li class="category__tags-item"><a href="#">OL</a></li>
		<li class="category__tags-item"><a href="#">女老師</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">身材</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">美乳</a></li>
		<li class="category__tags-item"><a href="#">巨乳</a></li>
		<li class="category__tags-item"><a href="#">巨臀</a></li>
		<li class="category__tags-item"><a href="#">肉系女孩</a></li>
		<li class="category__tags-item"><a href="#">苗條</a></li>
		<li class="category__tags-item"><a href="#">高挑</a></li>
		<li class="category__tags-item"><a href="#">小隻馬</a></li>
		<li class="category__tags-item"><a href="#">貧乳</a></li>
		<li class="category__tags-item"><a href="#">迷你系</a></li>
		<li class="category__tags-item"><a href="#">白虎</a></li>
		<li class="category__tags-item"><a href="#">美臀系</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">玩法</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">乳交</a></li>
		<li class="category__tags-item"><a href="#">母乳</a></li>
		<li class="category__tags-item"><a href="#">口交</a></li>
		<li class="category__tags-item"><a href="#">深喉嚨</a></li>
		<li class="category__tags-item"><a href="#">足交</a></li>
		<li class="category__tags-item"><a href="#">顏射</a></li>
		<li class="category__tags-item"><a href="#">吞精</a></li>
		<li class="category__tags-item"><a href="#">內射</a></li>
		<li class="category__tags-item"><a href="#">打飛機‧打手槍</a></li>
		<li class="category__tags-item"><a href="#">高潮噴水</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow"></i></a></div>
	</div>

	<div class="category">
	  <div class="category__title">服裝</div>
	  <ul class="category__tags">
		<li class="category__tags-item"><a href="#">Cosplay</a></li>
		<li class="category__tags-item"><a href="#">絲襪</a></li>
		<li class="category__tags-item"><a href="#">制服</a></li>
		<li class="category__tags-item">
		  <a href="#">女運動褲 ‧ 布魯馬</a>
		</li>
		<li class="category__tags-item"><a href="#">史庫水</a></li>
		<li class="category__tags-item"><a href="#">和服 ‧ 浴衣</a></li>
		<li class="category__tags-item"><a href="#">泳衣</a></li>
		<li class="category__tags-item"><a href="#">眼鏡</a></li>
	  </ul>
	  <div class="category__more"><a href="#"><span>更多</span> <i class="i-arrow"></i></a></div>
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