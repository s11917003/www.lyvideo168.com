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
		<div class="category">
			<ul id="category_form" class="category__tags" style="width:100%">
				<li name="all" class="category__tags-item category__tags-item--active"><a href="#">{{__('ui.tag.all')}}</a></li>
				@foreach ($video_tag as $tag)
				<li name="{{$tag->id}}" class="category__tags-item"><a href="#">{{$tag[$lang]}}({{$tag->count}})</a></li>
				@endforeach
			</ul> 
			<div class="category_more"><a href="#"  class="{{$lang}}"><span>{{__('ui.tag.more')}}</span> <i class="i-arrow "></i></a></div>
		  </div>
		<div class="list" style="width: 100%;">
			<div class="list__wrap" style="width: 100%;"> 
			  <div  id="video_list"  class="list">
				@foreach ($videos as $post)
					<a href="/{{$lang}}/video/{{$post->video_id}}${{$post->actress}}" class="list__item">
						<figure><img src="{{$post->cover_img}}"></figure>
						<div class="list__item-info">
							<h5>{{$post->video_id}}</h5>
							<h1>{{$post->title}}</h1>
							@if($post->release_date)<div class="date">{{date('Y-m-d', strtotime($post->release_date)) }}</div> @endif
						</div>
					</a>
				@endforeach
			  </div>
			</div>
		</div>
	</div>
</div>
@stop	
@section('footscript')
<script>
	function sendAjax(tag){
		$.ajax({
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
				type:"POST",
				url:"/{{$lang}}/content",
				dataType:"json",
				data:{tag,type:'{{$type}}',search:'{{$search}}'},
				success:function(result){
					if(result.videos){
					 
						$("#video_list").empty()
						result.videos.forEach(function(item){
						var dateText =''
					 
						item.release_date = item.release_date.replace('日', '') 
						item.release_date = item.release_date.replace(/[\u4e00-\u9fff\u3400-\u4dff\uf900-\ufaff]/g, '-') 
				
						if(item.release_date){
							var date = new Date(item.release_date)
							dateText =  date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
						}
	
						video = `<a href="/{{$lang}}/video/`+item.video_id+`$`+item.actress+`" class="list__item">
						<figure><img src="`  +item.cover_img+  `"></figure>
						<div class="list__item-info">
						<h5>`  +item.video_id+  `</h5>
						<h1>`  +item.title+  `</h1>
						<div class="date">`  +  dateText +  `</div>
						</div>
						</a>`

						$("#video_list").append(video)
						return;
					});
					}
				}
			});	
	}
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
		if($this.parent('.category').hasClass('category--open')){
		    $this.find('span').html(`{{__('ui.tag.collapse')}}`)
		} else {
		    $this.find('span').html(`{{__('ui.tag.more')}}`)
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

		sendAjax(arr,1);
	});
	
	return;
	
	} 
 
</script>
@stop	
