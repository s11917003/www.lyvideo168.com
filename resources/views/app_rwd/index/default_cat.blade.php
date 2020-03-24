@extends('layout.rwd.lay_web_basic')
@section('title')
哈哈TV，搞笑影片、圖片，網路熱辣段子發源地
@stop
@section('des')
全台No.1搞笑的社區，快來樓頂招樓下，阿母招阿爸，阿公招阿嬤，厝邊招隔壁，成為「哈友」一起笑哈哈！
@stop
@section('topscript')
<script>
	var postnick = '';
	document.write(crc);

</script>
@stop
@section('maincontent')
	<!-- Leftside Article -->
	<div id="rs-content-left">
		@foreach ($posts as $post)
		<div id="rs-content-left-box" data-id='{{$post->id}}' data-show=false>
			@if($post->is_hot == 1 || $post->detail->count_played > 1000)
			<div class="rs-item-hot">推薦</div>
			@endif
			<!--
			<div id="rs-digg-box1">
				<div class="rs-digg-left">
					<div class="rs-digg-fb"><a href="javascript:social('fb', {{$post->id}})"></a></div>
					<div class="rs-digg-tt"><a href="javascript:social('tw', {{$post->id}})"></a></div>
					<div class="rs-digg-gg"><a href="javascript:social('gg', {{$post->id}})"></a></div>
					<div><div class="line-it-button" data-lang="zh_Hant" data-type="share-b" data-url="https://www.c8c8tv.com/p/{{$post->id}}" style="display: none;" title="到Line分享您的神評論吧"></div></div>
				</div>
			</div>
			-->
			<div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:70px"><a href="/p/{{$post->id}}"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>
			<div class="rs-contentword">
				@if ($post->tag)
				<p><a href="/tag/{{$post->tag->tagname->id}}" target="_blank" style="padding: 5px 8px;background-color: #fff100;border-radius: 8px;">#{{$post->tag->tagname->name}}</a></p>
				@endif
				<h2><a href="/p/{{$post->id}}">{!!$post->title!!}</a></h2>
				@if ($post->cate_id == 2)
				<p><img src="{{$post->video_url}}" alt="{{$post->title}}" style="min-width: 320px; max-width: 640px;"></p>
				@elseif($post->cate_id == 3)
					<div style="position: relative">
						<div class="watermark-v" style="position: absolute; z-index: 100; top: 10px; right: 10px; pointer-events: none;"><img src="/img/tv-mark.png"></div>
			            <video id="my-video-{{$post->id}}" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls preload="auto" width="640" height="264"  poster="{{$post->cover_img}}" data-setup='{"fluid": true}'>
							<source src="{{$post->video_url}}" type="video/mp4">
							<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
								<a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
							</p>
						</video>
			        </div>					
				@endif
			</div>
			<div class="rs-digg-left">
					<div class="rs-digg-fb"><a href="javascript:social('fb', {{$post->id}})"></a></div>
					<div class="rs-digg-tt"><a href="javascript:social('tw', {{$post->id}})"></a></div>
					<div class="rs-digg-gg"><a href="javascript:social('gg', {{$post->id}})"></a></div>
					<div class="rs-digg-line"><div class="line-it-button" data-lang="zh_Hant" data-type="share-c" data-url="https://www.c8c8tv.com/p/{{$post->id}}" style="display: none;" title="到Line分享您的神評論吧"></div></div>
			</div>				
			<div id="rs-digg-box2">
				<div class="rs-digg-right">
					<div class="rs-digg like" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class="fas fa-thumbs-up"></i><span> {{$post->detail->count_digg}}</span></span></div>
					<div class="rs-digg like" id='post-bury-{{$post->id}}' data-id='post-bury-{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$post->detail->count_bury}}</span></div>
					<!--<div class="rs-digg" id='post-repin-{{$post->id}}' data-id='post-repin-{{$post->id}}'><i class="fas fa-star"></i><span> {{$post->detail->count_repin}}</span></div>
					<div class="rs-digg" id='post-share-{{$post->id}}' data-id='post-share-{{$post->id}}'><i class="fas fa-share-square"></i><span> {{$post->detail->count_share}}</span></div>-->
					<div class="rs-digg" onclick="location.href='/p/{{$post->id}}?focus=reply'"><i class="fas fa-comment"></i><span> {{$post->detail->count_cmt}}</span></div>
					<!--<div class="rs-digg dropdown-toggle" onclick="dropreply({{$post->id}})"><i class="fas fa-comment"></i><span> {{$post->detail->count_cmt}}</span></div>-->

				</div>
			</div>
			
			<div class="rs-contentbox1" style="padding-top: 10px;" id="reply-drop-{{$post->id}}" data-show='0'>
				<div class="rs-contentpics" style="background: url(http://www.c8c8tv.com/img/app_icon.png) no-repeat top center; background-size:70px"></div>
				<div class="rs-comm-box">
					<form>
						<input value="{{$post->userInfo->nick_name}}" id='post-nick-{{$post->id}}' hidden>
						<textarea placeholder="展現你的神評論吧" data-defaultholder="展現你的神評論吧" class="post-content" name="post-content" id="reply-{{$post->id}}"></textarea></form>
				</div>
				<div class="rs-contentword-l-s1">
					<div class="rs-wwss">您可以輸入<span style="color:#FD5154" id='lessword'>140</span>個字</div>
					<div class="rs-icon-comm"><a href="javascript:void(0)" id='replybtn-{{$post->id}}' data-postid='{{$post->id}}'>評論</a></div>
				</div>
			</div>
						
			<!-- 回覆後區塊 -->
			@if( $post->commentsGod != null)
			<div style="width:90%;margin:auto;float: left">
				<div class="rs-contentpics" style="background: url({{$post->commentsGod->userInfo->avatar}}) no-repeat top center; background-size:70px"></div>
				<div class="rs-contentname"><span style="margin: 10px;font-size: 9px;padding: 1px 3px;color: #f00;border: 1px solid #f00;border-radius: 3px;">神評論</span>{{$post->commentsGod->name}}</div>
				<div class="rs-contentword">
					{{$post->commentsGod->content}}
				</div>
				<div id="rs-digg-box2">
					<div class="rs-digg-right">
					<div class="rs-digg-right">
						<div class="rs-digg like" id='reply-digg-{{$post->commentsGod->id}}' data-id='reply-digg-{{$post->commentsGod->id}}'><i class="fas fa-thumbs-up"></i><span> {{$post->commentsGod->count_digg}}</span></span></div>
						<div class="rs-digg like" id='reply-bury-{{$post->commentsGod->id}}' data-id='reply-bury-{{$post->commentsGod->id}}'><i class="fas fa-thumbs-down"></i><span> {{$post->commentsGod->count_bury}}</span></div>
						<div class="rs-digg" onclick="location.href='/p/{{$post->id}}?focus=reply'"><i class="fas fa-comment"></i><span> {{$post->commentsGod->count_reply}}</span></div>
					</div>
					</div>
				</div>				
			</div>
			@endif
		</div>
		@endforeach
		<div class="rs-contentbox1" id="page"></div>
	</div>
			
	<!-- RightSideBox -->
	<!-- Content 右側 結束 -->
	<script>
		document.getElementById("page").innerHTML = pageInit({{$currentPage}}, {{$lastPage}} ,"/category/{{$cate}}/");
		nick = '{{ Session('USER.NICK_NAME')}}'			
	</script>
	</script>
@stop