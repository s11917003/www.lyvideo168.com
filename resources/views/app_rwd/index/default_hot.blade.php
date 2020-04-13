@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php echo mb_substr(strip_tags($title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($title)}}
@stop
@section('topscript')
<meta itemprop="name" content="老濕機">
<meta itemprop="description" content="{{strip_tags($title)}}">

<script>
	// var postid = '{{$post->id}}';
	// var postnick = '{{$post->userInfo->nick_name}}';
	// var nick = postnick
</script>
@stop
@section('maincontent')
			@if ($device == 'ios' || $device == 'android')
			<div id="rs-digg-box2"  style="float: left; width: 100%; padding-top:10px; height: 100%;">
				<h5>热门影片</h5>
	
				@foreach ($posts as $post)
				 <div style="float: left;padding: 10px; width: 100%; height: 260px; margin: 5px;  overflow: hidden; text-align: center">
					<a href="/p/{{$post->id}}">
					<img src="{{ asset('storage'.$post->hot['tb_img']) }}" style="width: 100%; height: 85%;">
					<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->hot['title']}}</div>
					<div style="font-size: 8px; padding-top: 0px;">{{$post->count_view}}次观看</div>
					</a>
				</div> 	
				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2"  class="justify-content-center"  style="block-size:unset; float: left; width: 100%; padding-top:10px; height: auto;">
				<div  class="justify-content-center" style="width: auto">
					<h5>热门影片</h5>
					@foreach ($posts as $post)
					<div id="rs-article-box" style="block-size:unset; float:left;padding: 10px;  margin: 5px; overflow: hidden">
						<a href="/p/{{$post->id}}">
							<img id="rs-article-box-img" src="{{ asset('storage'.$post->hot['tb_img']) }}"  >
							<label style="padding: 5px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->hot['title']}}</label>
							<div style="font-size: 8px; padding-top: 0px;">{{$post->count_view}}次观看</div>
						</a>
					</div>
					@endforeach
					<div style="clear: both"></div>
				</div> 
			</div>
			@endif					
		</div>	
		<div class="rs-contentbox1" id="page"></div>	
	</div>
	<!-- Content 左側 結束 -->
	<!-- Content 右側 開始 -->
	<!-- RightSideBox -->
	<!-- Content 右側 結束 -->	
@stop
@section('footscript')
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'zh-TW'}
</script>
<script>
	$('#closead').on('click',function(){
		//alert('close')
		$('#videocoverad').hide()
		
	})
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
<script>
	document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/tag/{{$tag}}/");
	nick = ''			
</script>
@stop