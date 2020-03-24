@extends('layout.rwd.lay_web_basic')
@section('topscript')
<meta property="og:type" content="video.other">
<meta property="og:title" content="{{$post->title}}">
<meta property="og:url" content="https://devtest.c8c8tv.com/p/{{$post->id}}">
<meta property="og:image" content="{{$post->cover_img}}">
<meta property="og:video" content="{{$post->video_url}}" />
<script>
	var postid = '{{$post->id}}';
	var postnick = '{{$post->userInfo->nick_name}}';
	var nick = postnick

</script>
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div class="content-left">
		<div class="contentbox">
			<div class="contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:70px"></div>
			<div class="contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>
			<div class="contentword">{{$post->title}}</div>
			@if ($post->cate_id == 2)
			<div class="contentword">
				<img src="{{$post->video_url}}" style="min-width: 320px; max-width: 640px;">
			</div>
			@elseif ($post->cate_id == 3)
			<div class="contentword">
				<div class="watermark-v"><img src="/img/tv-mark.png"></div>
				<div style="width:640px;">
		            <video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" width="640" height="400" poster="{{$post->cover_img}}" data-setup="{}">
						<source src="{{$post->video_url}}" type="video/mp4">
						<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
							<a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
						</p>
					</video>
					<script src="https://vjs.zencdn.net/6.6.3/video.js"></script>
		        </div>
			</div>		
			@endif
			<div class="contentword-l">
				<div class="digg like" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class="fas fa-thumbs-up"></i><span> {{$post->detail->count_digg}}</span></div>
				<div class="digg like"><i class="fas fa-thumbs-down"></i><span> {{$post->detail->count_bury}}</span></div>
				<div class="digg"><i class="fas fa-star"></i><span> {{$post->detail->count_repin}}</span></div>
			</div>
			<div class="contentword-r">
				<div class="digg"><i class="fas fa-share-square"></i><span> {{$post->detail->count_share}}</span></div>
				<div class="digg cmt" id='reply-cmt-{{$post['id']}}-0' data-id='reply-cmt-{{$post['id']}}-0'><i class="fas fa-comment"></i><span> {{$post->detail->count_cmt}}</span></div>
			</div>
		</div>
		<div class="contentbox">
			<div class="contentpics"></div>
			<div style="h:500px;float:left;margin:10px 0 0 10px;">
				<textarea placeholder="展現你的神評論吧" data-defaultholder="展現你的神評論吧" class="post-content" name="post-content" id="reply" cols="76" rows="6"></textarea>
			</div>
			<div class="contentword-l-s">
				<p>到以下平台展現你的神評論吧</p>
				<div class="line-it-button" data-lang="zh_Hant" data-type="share-d" data-url="https://devtest.c8c8tv.com/p/{{$post->id}}" style="display: none;"></div>
				 <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>

				<div class="digg-fb"><a href="#" title="到Facebook分享您的神評論吧"></a></div>
				<div class="digg-tt"><a href="#" title="到twitter分享您的神評論吧"></a></div>
				<div class="digg-gg"><a href="#" title="到Google分享您的神評論吧"></a></div>
				<div class="digg-ig"><a href="#" title="到instagram分享您的神評論吧"></a></div>
			</div>
			<div class="contentword-l-s1">
				<div class="wwss">您還可以輸入<span style="color:#FD5154" id='lessword'>140</span>個字</div>
				<div class="icon-comm"><a href="javascript:void(0)" id='replybtn'>評論</a></div>
			</div>
		</div>
		@foreach ($comm as $com)
		<div class="contentbox">
			<a href="#"><div class="contentpicsu"  style="background: url({{$com['userInfo']['avatar']}}) no-repeat top center; background-size:70px"></div></a>
			<div class="contentname"><a href="#" id='reply-nick-{{$com['id']}}'>{{$com['name']}}</a><br>{{$com['created_at']}}</div>
			<div class="contentword-ll">
				<div class="digg like" id='reply-digg-{{$com['id']}}' data-id='reply-digg-{{$com['id']}}'><i class="fas fa-thumbs-up"></i><span> {{$com['count_digg']}}</span></div>
				<div class="digg like" id='reply-bury-{{$com['id']}}' data-id='reply-bury-{{$com['id']}}'><i class="fas fa-thumbs-down"></i><span> {{$com['count_bury']}}</span></div>
				<div class="digg cmt" id='reply-cmt-{{$com['id']}}-{{$com['id']}}' data-id='reply-cmt-{{$com['id']}}-{{$com['id']}}'><i class="fas fa-comment"></i> {{$com['count_reply']}}</div>
			</div>
			<div class="contentword">{{ $com['content'] }}</div>			
		</div>
			@foreach($reply as $rep)				
				@if( $rep['parentid'] == $com['id'])
				<div class="contentbox" style="border-left: 4px solid #c3c3c3">
					<a href="#"><div class="contentpicsu"  style="background: url({{ $rep['data']['userInfo']['avatar']}}) no-repeat top center; background-size:70px"></div></a>
					<div class="contentname"><a href="#" id='reply-nick-{{$rep['data']['id']}}'>{{$rep['data']['name']}}</a><br>{{$rep['data']['created_at']}}</div>
					<div class="contentword-ll">
						<div class="digg like" id='reply-digg-{{$rep['data']['id']}}' data-id='reply-digg-{{$rep['data']['id']}}'><i class="fas fa-thumbs-up"></i><span> {{$rep['data']['count_digg']}}</span></div>
						<div class="digg like" id='reply-bury-{{$rep['data']['id']}}' data-id='reply-bury-{{$rep['data']['id']}}'><i class="fas fa-thumbs-down"></i><span> {{$rep['data']['count_bury']}}</span></div>
						<div class="digg cmt" id='reply-cmt-{{$rep['data']['id']}}-{{$com['id']}}' data-id='reply-cmt-{{$rep['data']['id']}}-{{$com['id']}}'><i class="fas fa-comment"></i></div>
					</div>
					<div class="contentword">回覆 {{ $rep['data']['target_name'] }}：{{$rep['data']['content']}}</div>
				</div>					
				@endif
			@endforeach
		@endforeach
		<div class="contentbox1">
			<ul class="pagination">
				<li><a href="#">«</a></li>
				<li><a class="active" href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">»</a></li>
			</ul>
		</div>
	</div>
	<!-- Content 左側 結束 -->
	
	<!-- Content 右側 開始 -->
	<div class="content-right">
		<div class="app-qrcode">
			<p class="app-icon-info"><img src="/img/app_icon.png" alt="哈哈TV"></p>
			<p>iPhone和Android平台最受歡迎的休閒娛樂軟體哈哈社區，網路熱辣發源地！</p>
		</div>
		<div class="dl-os1"><a href="#">iOS下載</a></div>
		<div class="dl-os2"><a href="#">Android下載</a></div>
	</div>
	<div class="content-right">
		<p align="center">放位置</p>
	</div>
		<div class="content-right">
		<p align="center">放位置</p>
	</div>
	<!-- Content 右側 結束 -->	
@stop