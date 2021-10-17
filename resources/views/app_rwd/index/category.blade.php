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
	  <ul id='category_source' class="category__tags">
		<li name="all" class="category__tags-item"><a href="#">全部</a></li>
		<li name="censored_f" class="category__tags-item"><a href="#">有碼 - FANZA</a></li>
		<li name="censored_p" class="category__tags-item category__tags-item--active">
		  <a href="#">有碼 - PRESTIGE</a>
		</li>
		<li name="uncensored"  class="category__tags-item category__tags-item--active">
		  <a href="#">無碼</a>
		</li>
		<li name="FC2" class="category__tags-item"><a href="#">FC2</a></li>
	  </ul>
	  <div class="category__more category_source_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">形式</div>
	  <ul id="category_form" class="category__tags">
		<li name="217" class="category__tags-item"><a href="#">高畫質</a></li>
		<li name="236" class="category__tags-item"><a href="#">VR 專用</a></li>
		<li name="112" class="category__tags-item"><a href="#">女優作品</a></li>
		<li name="211" class="category__tags-item"><a href="#">出道作品</a></li>
	  </ul> 
	  <div class="category__more category_form_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">角色</div>
	  <ul  id="category_role"  class="category__tags">
		<li name="2" class="category__tags-item"><a href="#">美少女</a></li>
		<li name="38" class="category__tags-item category__tags-item--active"><a href="#">女高中生</a></li>
		<li name="8" class="category__tags-item"><a href="#">女大學生</a></li>
		<li name="15" class="category__tags-item category__tags-item--active"><a href="#">辣妹</a></li>
		<li name="22" class="category__tags-item"><a href="#">人妻</a></li>
		<li name="49" class="category__tags-item"><a href="#">少婦</a></li>
		<li name="24" class="category__tags-item"><a href="#">熟女</a></li>
		<li name="93" class="category__tags-item"><a href="#">素人</a></li>
		<!-- <li name="vr" class="category__tags-item"><a href="#">OL</a></li> -->
		<li name="14" class="category__tags-item"><a href="#">女老師</a></li>
	  </ul>
	  <div class="category__more category_role_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">身材</div>
	  <ul   id="category_figure" class="category__tags">
		<li name="38" class="category__tags-item"><a href="#">美乳</a></li>
		<li name="53" class="category__tags-item"><a href="#">巨乳</a></li>
		<li name="52" class="category__tags-item"><a href="#">巨臀</a></li>
		<li name="57" class="category__tags-item"><a href="#">肉系女孩</a></li>
		<li name="64" class="category__tags-item"><a href="#">苗條</a></li>
		<li name="67" class="category__tags-item"><a href="#">高挑</a></li>
		<li name="63" class="category__tags-item"><a href="#">小隻馬</a></li>
		<li name="65" class="category__tags-item"><a href="#">貧乳</a></li>
		<li name="69" class="category__tags-item"><a href="#">迷你系</a></li>
		<li name="137" class="category__tags-item"><a href="#">白虎</a></li>
		<li name="95" class="category__tags-item"><a href="#">美臀癖</a></li>
	  </ul>
	  <div class="category__more category_figure_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow active"></i></a></div>
	</div>

	<div class="category category--open">
	  <div class="category__title">玩法</div>
	  <ul id="category_play" class="category__tags">
		<li name="95" class="category__tags-item"><a href="#">乳交</a></li>
		<li name="155" class="category__tags-item"><a href="#">母乳</a></li>
		<li name="154" class="category__tags-item"><a href="#">口交</a></li>
		<li name="162" class="category__tags-item"><a href="#">深喉嚨</a></li>
		<li name="172" class="category__tags-item"><a href="#">足交</a></li>
		<li name="169" class="category__tags-item"><a href="#">顏射</a></li>
		<li name="160" class="category__tags-item"><a href="#">吞精</a></li>
		<li name="159" class="category__tags-item"><a href="#">內射</a></li>
		<li name="175" class="category__tags-item"><a href="#">打飛機‧打手槍</a></li>
		<li name="197" class="category__tags-item"><a href="#">高潮噴水</a></li>
	  </ul>
	  <div class="category__more category_play_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow"></i></a></div>
	</div>

	<div class="category category--open">
		<div class="category__title">服裝</div>
	  <ul id="category_clothing" class="category__tags">
		<li name="103" class="category__tags-item"><a href="#">Cosplay</a></li>
		<li name="84" class="category__tags-item"><a href="#">絲襪</a></li>
		<li name="90" class="category__tags-item"><a href="#">制服</a></li>
		<li name="75" class="category__tags-item"><a href="#">女運動褲 ‧ 布魯馬</a></li>
		<li name="86" class="category__tags-item"><a href="#">史庫水</a></li>
		<li name="76" class="category__tags-item"><a href="#">和服 ‧ 浴衣</a></li>
		<li name="88" class="category__tags-item"><a href="#">泳衣</a></li>
		<li name="59" class="category__tags-item"><a href="javascript:void(0);">眼鏡</a></li>
	  </ul>
	  <div class="category__more category_clothing_more" style="display: none;"><a href="#"><span>更多</span> <i class="i-arrow"></i></a></div>
	</div>

	<div class="list">
		<div class="list__wrap" style="width: 100%;"> 
		  <div  id="video_list"  class="list">
		  </div>
		</div>
	  </div>
  </div>
 
@stop	

@section('footscript')
</script>
<script>
	var arr =[]
	function cate_cilck(e){
		
		$(e).click(function(){
			arr =[]
			if($(this).attr('name') =='all'){
				$('#category_source li').removeClass('category__tags-item--active')
				$('#category_source li').addClass('category__tags-item--active')
			} else {
				if($(this).hasClass('category__tags-item--active')) {
					$(this).removeClass('category__tags-item--active')
				} else {
					$(this).addClass('category__tags-item--active')
				}
			
			}
			$('.category__tags').find('li').each(function(){
				if($(this).hasClass('category__tags-item--active')) {
					
					arr.push($(this).attr('name'))
				}
			
			});
			console.log('aa '+arr)

			$.ajax({
				type:"POST",
				url:"/category",
				dataType:"json",
				data:{tag:arr},
				success:function(result){
					$("#video_list").empty();
					console.log(result)
					console.log(result.video)
					result.video.forEach(function(item){
			  
						video = `<a href="/jp/testview/`+item.video_id+`$`+item.actress+`" class="list__item">
						<figure><img src="`  +item.cover_img+  `"></figure>
						<div class="list__item-info">
						<h5>`  +item.video_id+  `</h5>
						<h6>【`  +item.title+  `】</h6>
						<div class="date">`  +item.release_date+  `</div>
						</div>
						</a>`
						$("#video_list").append(video)
					 
					});
				

				
			
				}
			});	
		});
		
		return;
		
	} 

	function checkMoreBtm(e){
		var arr = ["source","form","role","figure","play","clothing"];
		for (let i=0; i<arr.length; i++) {

			console.log("#"+arr[i])
			if ($("#category_"+arr[i]).prop('scrollWidth') <= $("#category_"+arr[i]).width() ) {
				console.log(1)
				$(".category_"+arr[i]+"_more").hide()
			} else {
				console.log(2)
				$(".category_"+arr[i]+"_more").show()
			}
		}
	}
	$(window).resize(function() {

		console.log('resize')
		 checkMoreBtm() 
	});
	window.onload = function() {
		$('li a').attr("href","javascript:void(0);");

		checkMoreBtm() 
		$('#category_source').find('li').each(function(){
			cate_cilck(this)
		});
		$('#category_form').find('li').each(function(){
			cate_cilck(this)
		});
		$('#category_role').find('li').each(function(){
			cate_cilck(this)
		});
		$('#category_figure').find('li').each(function(){
			cate_cilck(this)
		});
		$('#category_play').find('li').each(function(){
			cate_cilck(this)
		});
		$('#category_clothing').find('li').each(function(){
			cate_cilck(this)
		});
		console.log('window.onload')

	}
</script>
@stop