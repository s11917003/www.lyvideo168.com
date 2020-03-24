@extends('layout.rwd.lay_web_basic')
@section('title')
@php echo mb_substr(strip_tags($post->title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('topscript')
<meta name="twitter:site" content="@c8c8tv">

<meta name="twitter:title" content="@php echo mb_substr(strip_tags($post->title) , 0 , 35, 'UTF-8') . '...'; @endphp - 哈哈TV">
<meta name="twitter:description" content="{{strip_tags($post->title)}}">
<meta name="twitter:domain" content="devtest.c8c8tv.com">

<meta property="og:type" content="video.other">
<meta property="og:title" content="@php echo mb_substr(strip_tags($post->title) , 0 , 35, 'UTF-8') . '...'; @endphp - 哈哈TV">
<meta property="og:description" content="{{strip_tags($post->title)}}">
<meta property="og:url" content="https://devtest.c8c8tv.com/p/{{$post->id}}">
<meta property="fb:app_id" content="1680137345573660">
@if($post->cate_id == 1)
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{$post->share_fb_img}}">
 <meta property="og:image" content="{{$post->share_fb_img}}">
 <meta property="og:image:width" content="1200">
 <meta property="og:image:height" content="620">
@elseif($post->cate_id == 2)
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{$post->cover_img}}">
<meta property="og:image" content="{{$post->cover_img}}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="620">
@else
<meta name="twitter:card" content="summary_large_image">
<meta property="og:image" content="{{$post->cover_img}}">
<meta property="og:image:width" content="800">
<meta property="og:image:height" content="420">
@endif
@if($post->cate_id == 3)
<meta property="og:video" content="{{$post->video_url}}" />
<meta property="og:video:type" content="video/mp4">
@endif
<script>
	var postid = '{{$post->id}}';
	var postnick = '{{$post->userInfo->nick_name}}';
	var nick = postnick

</script>
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div class="rs-content-left">
		<div class="rs-content-left-box">
			<div id="rs-digg-box1">
				<div class="rs-digg-left">
					<div class="rs-digg-fb"><a href="#"></a></div>
					<div class="rs-digg-tt"><a href="#"></a></div>
					<div class="rs-digg-gg"><a href="#"></a></div>
					<div class="rs-digg-ig"><a href="#"></a></div>
				</div>	
			</div>
			<div class="rs-contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:70px"><a href="javascript::void(0);"></a></div>
			<div class="rs-contentname">{{$post->userInfo->nick_name}}<br>11-30 10:23:42</div>
			<div class="rs-contentword">
				@if ($post->tag)
				<p><a href="javascript:void(0);" style="padding: 5px 8px;background-color: #fff100;border-radius: 8px;">#{{$post->tag->tagname->name}}</a></p>
				@endif				
				<h2><a href="javascript:void(0)">{!! $post->title !!}</a></h2>
				@if ($post->cate_id == 2)
				<img src="{{$post->video_url}}" alt="{{$post->title}}">
				@elseif ($post->cate_id == 3)
					<div style="position: relative">
						<div class="watermark-v" style="position: absolute; z-index: 100; top: 10px; right: 10px; pointer-events: none;"><img src="/img/tv-mark.png"></div>
			            <video id="my-video-{{$post->id}}" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls preload="auto" width="640" height="264"  poster="{{$post->cover_img}}" data-setup="{'fluid': true}">
							<source src="{{$post->video_url}}" type="video/mp4">
							<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
								<a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
							</p>
						</video>
			        </div>					
				@endif
			</div>
			<div id="rs-digg-box2">
				<div class="rs-digg-right">
					<div class="rs-digg like" id='post-digg-{{$post->id}}' data-id='post-digg-{{$post->id}}'><i class="fas fa-thumbs-up"></i><span> {{$post->detail->count_digg}}</span></div>
					<div class="rs-digg like" id='post-bury-{{$post->id}}' data-id='post-bury-{{$post->id}}'><i class="fas fa-thumbs-down"></i><span> {{$post->detail->count_bury}}</span></div>
					<div class="rs-digg" id='post-repin-{{$post->id}}' data-id='post-repin-{{$post->id}}'><i class="fas fa-star"></i><span> {{$post->detail->count_repin}}</span></div>
					<div class="rs-digg" id='post-share-{{$post->id}}' data-id='post-share-{{$post->id}}'><i class="fas fa-share-square"></i><span> {{$post->detail->count_share}}</span></div>
					<div class="rs-digg cmt" id='reply-cmt-{{$post['id']}}-0' data-id='reply-cmt-{{$post['id']}}-0'><i class="fas fa-comment"></i><span> {{$post->detail->count_cmt}}</span></div>
				</div>
			</div>

			<div class="contentpics" style="background: url({{$post->userInfo->avatar}}) no-repeat top center; background-size:70px"></div>
			<div class="contentname">{{$post->userInfo->nick_name}}<br>{{ Carbon\Carbon::parse($post->created_time)->format('m-d H:i:s') }}</div>
			<div class="contentword">{!! $post->title !!}</div>
			@if ($post->cate_id == 2)
			<div class="contentword">
				<img src="{{$post->video_url}}" style="min-width: 320px; max-width: 640px;">
			</div>
			@elseif ($post->cate_id == 3)
			<div class="contentword">
				<div class="watermark-v"><img src="/img/tv-mark.png"></div>
				<div style="width:640px;">
		            <video id="my-video" class="video-js vjs-big-play-centered vjs-16-9" controls preload="auto" width="640" height="400" poster="{{$post->cover_img}}" data-setup="{}">
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
				<div style="float: left; padding-right: 5px;">
				<div class="line-it-button" data-lang="zh_Hant" data-type="share-c" data-url="https://www.c8c8tv.com/p/{{$post->id}}" style="display: none;"></div></div>
				<div class="digg-fb fb-share"><a href="javascript:void(0);"></a></div>
				<div class="digg-tt"><a href="https://twitter.com/intent/tweet?url=https://devtest.c8c8tv.com/p/{{$post->id}}" title="到twitter分享您的神評論吧" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=450');return false;"></a></div>
    			<div class="digg-gg"><a href="https://plus.google.com/share?url=https://devtest.c8c8tv.com/p/{{$post->id}}" title="到Google分享您的神評論吧" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=450');return false;"></a></div>
				<!--<div class="digg-ig"><a href="#" title="到instagram分享您的神評論吧"></a></div>-->
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
    $('.fb-share').click(function() {
	    console.log('fbshare')
        FB.ui({
            method: 'feed',
            name: 'Manoj Yadav',
            link: 'https://devtest.c8c8tv.com/p/{{$post->id}}',
            picture: '{{$post->cover_img}}',
            description: '{{$post->title}}'
        });
    });
    
    
</script>
@stop