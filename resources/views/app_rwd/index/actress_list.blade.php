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
  
@stop
@section('maincontent')

<div class="container">
	<div class="container__header"  style="display: block;">{{__('ui.actresses_list')}}</div>
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
	var page =1
	function sendAjax(page){
		this.page = page
		$.ajax({
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
				type:"POST",
				url:"/{{$lang}}/actress_list",
				dataType:"json",
				data:{page},
				success:function(result){
					// $(".female-list").empty();
					if(result.video_actress){
					
						result.video_actress.data.forEach(function(item){
						let name = ''
						if('{{$lang}}' == 'zh' && item.ChineseName1)  {
							name = item.ChineseName1
						} else {
							name = item.JapaneseName1
						}
						video =	`<a href="/{{$lang}}/actress/`+item.id+`"   class="female-list__item">
							<figure><img src="/img/Pictures/`+item.JapaneseName1+`_coverphoto.jpg"></figure>
							<div class="female-list__item-info-info">
							<h5>`+name+`</h5>
							<div class="show">{{__('ui.Starring')}}：`+item.actress_relations_count+`</div>
							</div>
							</a>`;
						
							$(".female-list").append(video)
							// var newString = result['pagination'].replace(/href="(.*?)"/ig, "href=\"javascript:void(0)\" onclick=\"tablePagination\(`$1`\)\"");
							// $('#pagination').html(newString);
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
	var currentscrollHeight = 0;
	$(window).on("scroll", function () {
		const scrollHeight = $(document).height();
		const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
		const isBottom = scrollHeight - 100 < scrollPos;

		if (isBottom && currentscrollHeight < scrollHeight) {
		 
			sendAjax(this.page +1);	
			// customTag(this.page +1)
			currentscrollHeight = scrollHeight;
		}
	});
	window.onload = function() {	
		sendAjax(1);
	}
</script>
@stop