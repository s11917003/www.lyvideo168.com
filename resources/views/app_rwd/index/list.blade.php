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
	@if(Route::currentRouteName()  == 'rank-list')
	<div class="container__header">{{__('ui.rank.rank_title')}}</div>
	<ul class="ranking__board">
		<li class="ranking__board-item month"><a href="javascript:void(0)">{{__('ui.rank.month')}}</a></li>
		<li class="ranking__board-item week  ranking__board-item--active"><a  href="javascript:void(0)">{{__('ui.rank.week')}}</a></li>

	</ul>
 
	<!-- 有碼 FANZA -->
	<div class="ranking news">
		<p class="ranking__title">{{strtoupper($cate)}}</p>
		<div class="list__wrap week">
			<div class="list">
				@foreach ($video as $post)
				@foreach ($post->video as $video)	
				@if($video->video_lang == $langIndex)
					<a href="/{{$lang}}/video/{{$video->video_id}}${{$video->actress}}"  class="list__item">
					<p class="list__num">Top {{$post->rank}}.</p>
					
				
					<figure><img src="{{$video->cover_img}}"></figure>
					<div class="list__item-info">
					<h5>{{$video->video_id}}</h5>
					<h1>【{{$video->title}}】</h1>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date))}}</div> @endif
					</div>
					@endif
					@endforeach
				</a>
				
				@endforeach
			</div>
		
		</div>

		<div class="list__wrap month" style="display: none;">
			<div class="list">
				@foreach ($video1 as $post)	
				@foreach ($post->video as $video)
				@if($video->video_lang == $langIndex)
					<a href="/{{$lang}}/video/{{$video->video_id}}${{$video->actress}}" class="list__item">
					<p class="list__num">Top {{$post->rank}}.</p>
				
					
					<figure><img src="{{$video->cover_img}}"></figure>
					<div class="list__item-info">
					<h5>{{$video->video_id}}</h5>
					<h1>【{{$video->title}}】</h1>
					@if($video->release_date)<div class="date">{{date('Y-m-d', strtotime($video->release_date)) }}</div> @endif
					</div>
					@endif
					@endforeach
				</a>
				@endforeach
			</div>
		
		</div>
		@endif
		@if(Route::currentRouteName()  == 'all')
		<div class="container__header">{{__('category')}}</div>
		<div class="ranking">
			<p class="ranking__title">{{$cate}}</p>
			<div class="list__wrap week">
				<div class="list all-list">

				</div>
			</div>
		</div>
		@endif
	</div>
  </div>
@stop
@section('pagination')
<div class="row pt-4"></div>
	<div class="col">
		<div id='pagination' class="pagination   d-flex justify-content-center"></div>
	</div>
</div>
@stop
@section('footscript')
	@if(Route::currentRouteName()  == 'rank-list')
	<script>
		$('.ranking__board .ranking__board-item').on('click', function () {
		$('.ranking__board .ranking__board-item').removeClass('ranking__board-item--active')
		$('.ranking .list__wrap').hide();
		if($(this).hasClass('week')){
			$(this).addClass('ranking__board-item--active')
			$('.ranking .week').show();
		} else if ($(this).hasClass('month')){
			$(this).addClass('ranking__board-item--active')
			$('.ranking .month').show();
		}
		
	});
	</script>
	@endif
	@if(Route::currentRouteName()  == 'all')
	<script>
		function tablePagination(link) {
			postlink = link.split('?')[0]
			para = link.split('?')[1].split('&')
			var page =1;
			for(var i=0;i<para.length;i++){
				var match = para[i].match(/page=(.*?)/);
				page = para[i].replace(/page=(.*?)/,'$1')
			}
			sendAjax('{{$cate}}',page);
		}
		function sendAjax(category,page){
		$.ajax({
				type:"POST",
				url:"/{{$lang}}/all",
				dataType:"json",
				data:{category,page},
				success:function(result){
					 
						if(result.status =true){
							result.video.data.forEach(function(item){
								var dateText =''
								if(item.release_date){
									var date = new Date(item.release_date)
									dateText =  date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
								}
								video = `<a href="/{{$lang}}/video/`+item.video_id+`$`+item.actress+`" class="list__item">
								<figure><img src="`  +item.cover_img+  `"></figure>
								<div class="list__item-info">
								<h5>`  +item.video_id+  `</h5>
								<h6>【`  +item.title+  `】</h6>
								<div class="date">`  +dateText+  `</div>
								</div>
								</a>`
							
								$(".all-list").append(video)
								var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
								$('#pagination').html(newString);
								window.scrollTo({ top: 0, behavior: 'smooth' });
								return;
							});
						}
				}
			});	
	}
	window.onload = function() {

		sendAjax('{{$cate}}',1);
	}
	</script>	
	@endif
	
@stop