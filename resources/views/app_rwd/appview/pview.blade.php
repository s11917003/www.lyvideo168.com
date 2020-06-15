@extends('layout.rwd.lay_app_basic')
@section('title')
@php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($post->title)}}
@stop
@section('topscript')
<meta itemprop="name" content="
">
<meta itemprop="description" content="{{strip_tags($post->title)}}">

<script>
	var postid = '{{$post->id}}';
	var postnick = '{{$post->userInfo->nick_name}}';
	var nick = postnick
</script>
@stop
@section('maincontent')
	<div>
		<div style="position: relative">				
			<video id='av-video' width="600" height="254" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" poster="{{ asset('storage'.$post->cover_img) }}" preload= "none" controls>
				<source src="/getvideo/{{$post->id}}" type="application/x-mpegURL">
			</video>
			<script>
				var player = videojs('av-video',{
						html5: {
							hls: {
						          overrideNative: true
						    },
							nativeVideoTracks: false,
							nativeAudioTracks: false,
							nativeTextTracks: false
						}
					});
			</script>
		</div>			
		<div style="margin: 10px"><h4 style="font-size: 0.8em">{{$post->title}}</h4></div>
		<div style="margin: 10px">
				@if ($post->tag)
					@foreach ($post->tag as $tag)
					<div style="float: left; margin-right: 5px; padding: 2px 15px; border-radius:15px;background-color: #2D7089; font-size: 0.6em	"><span style="color: white">{{$tag->tagname->name}}</span></div>
					@endforeach
				@endif
				<div style="clear: both"></div>
		</div>
		<div style="margin: 10px; text-align: center">
			<h5 class="recommend">推荐影片</h5>
			@foreach ($relate as $re)
			<div style="float: left; width: 50%; height: 140px;padding: 5px; margin-bottom: 5px">
				<div id="relate{{$re->article['id']}}" data-pid="{{$re->article['id']}}">
					<img src="{{ asset('storage'.$re->article['tb_img']) }}"     style="width: 100%;">
					<div style="font-size: 0.7em; line-height: 1.6em; padding-top: 5px;" >{{$re->article['title']}}</div>
				</div>
				</div>
			@endforeach
			<div style="clear: both"></div>
		</div>
	</div>
	<script>
		
		$('[id^=relate]').on('click',function(){
			pid = $(this).data('pid')
			
			window.postMessage(JSON.stringify({
				type:'relate',
				data:{
					pid:pid,
				}
			}))
			
			setTimeout(function(){
				window.location = 'https://www.gporn.cc/pv/' + pid
			}, 100)
		})
		
		document.addEventListener('message',function(e){
		   document.getElementById('sum').innerText = JSON.parse(e.data).result;
		})
	</script>
@stop
