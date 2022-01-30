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
		<p class="search-result__title">{{__('ui.search_result')}}</p>
		<!-- <ul class="search-result__board">
		  <li class="search-result__board-item"><a href="#">照相關度排列</a></li>
		  <li class="search-result__board-item search-result__board-item--active"> <a href="#">照發行日期排列</a> </li>
		</ul> -->
		<div class="list" style="width: 100%;">
			<div class="list__wrap" style="width: 100%;"> 
			  <div  id="video_list"  class="list">
				 
			  </div>
			</div>
		</div>
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
</script>
<script>
	var arr =[]
	function sendAjax(search,page){
		$.ajax({
				type:"POST",
				url:"/{{$lang}}/search",
				dataType:"json",
				data:{page,search},
				success:function(result){
					$("#video_list").empty();
					result.video.data.forEach(function(item){
						video = `<a href="/{{$lang}}/video/`+item.video_id+`$`+item.actress+`" class="list__item">
						<figure><img src="`  +item.cover_img+  `"></figure>
						<div class="list__item-info">
						<h5>`  +item.video_id+  `</h5>
						<h6>【`  +item.title+  `】</h6>
						<div class="date">`   +  ( item.release_date || '' )+  `</div>
						</div>
						</a>`
						$("#video_list").append(video)
						var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
                		$('#pagination').html(newString);
						window.scrollTo({ top: 0, behavior: 'smooth' });
						return;
					});
				}
			});	
	}
	function tablePagination(link) {

		postlink = link.split('?')[0]
		para = link.split('?')[1].split('&')
		var page =1;
		for(var i=0;i<para.length;i++){
			var match = para[i].match(/page=(.*?)/);
			page = para[i].replace(/page=(.*?)/,'$1')
		}
		// arr =[]
		// $('.category__tags').find('li').each(function(){
		// 		if($(this).hasClass('category__tags-item--active')) {
					
		// 			arr.push($(this).attr('name'))
		// 		}
		// 	});
		sendAjax(`{{ $search }}`,page);
		
		
	}

	window.onload = function() {	

		console.log(`{{ $search }}`)
		sendAjax(`{{ $search }}`,1);
	}
</script>
@stop