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

<div class="container">
	<div class="container__header">女優列表</div>
	<div class="famale">
		
		<div class="female-list">	 

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
 
<script>
	var arr =[]
	function sendAjax(page){
		$.ajax({
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
				type:"POST",
				url:"/actress_list",
				dataType:"json",
				data:{page},
				success:function(result){
					$(".female-list").empty();
					if(result.video_actress){
						
						result.video_actress.data.forEach(function(item){
					video =	`<a href="/actress/`+item.id+`"   class="female-list__item">
						<figure><img src="/img/Pictures/`+item.JapaneseName1+`_coverphoto.jpg"></figure>
						<div class="female-list__item-info-info">
						<h5>`+item.JapaneseName1+`</h5>
						<div class="show">出演影片：`+item.JapaneseName1+`</div>
						</div>
						</a>`;
						
							$(".female-list").append(video)
							var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
							$('#pagination').html(newString);
							//window.scrollTo({ top: 0, behavior: 'smooth' });
							return;
						});
					}
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
		sendAjax(page);	
	}

	window.onload = function() {	
		sendAjax(1);
	}
</script>
@stop