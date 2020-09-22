@extends('layout.rwd.lay_web_basic_pview')
@section('title')
@php echo mb_substr(strip_tags($title) , 0 , 25, 'UTF-8'); @endphp
@stop
@section('des')
{{strip_tags($title)}}
@stop
<meta itemprop="name" content="@lang('default.description')">
<meta itemprop="description" content="{{strip_tags($title)}}">
@section('maincontent')
			
			@if ($device == 'ios' || $device == 'android') 
			
			<div id="rs-digg-box2"  style="float: left; width: 100%; padding-top:10px; height: auto;">
				@include('layout.rwd.lay_web_userinfo')
				<h5 style="COLOR: #ccc; font-weight: bold;">喜好影片</h5>
	
				@foreach ($posts as $post)
				 <div style="float: left;padding: 10px; width: 100%; height: 260px;    overflow: hidden; text-align: center">
				 
					<a href="/p/{{$post->id}}" data-id='{{$post->id}}' class="adClick"   target="_blank">

						<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" height="200px" width="600" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
							<div class="vjs-poster" tabindex="-1" aria-disabled="false" 
								style="display: inline-block;
								vertical-align: middle;
								background-repeat: no-repeat;
								background-position: 50% 50%;
								background-size: contain;
								cursor: pointer;
								margin: 0;
								padding: 0;
								position: absolute;
								height:100%;
								right: 0;
								bottom: 0;
								left: 0;
								top: 0;
								MARGIN: 0PX 0PX 0 0PX;
								BACKGROUND-COLOR: #000;
								background-image: url('{{ asset('storage/'.$post->tb_img)}}');"  
								>
							 
							</div>
							
						</div>
						<div style="font-size: 8; padding-top: 0px; inline-block; width: 100%; overflow: hidden;overflow: hidden; text-overflow: ellipsis;">{{$post->title}}</div>
						<div style="font-size: 8px; padding-top: 0px;">　　　</div>
						</a>
			 
				</div> 	
				@endforeach			
				<div style="clear: both"></div>
			</div>
			@else
			<div id="rs-digg-box2"  class="justify-content-center rs-digg-box5"  style="block-size:unset; float: left; padding-top:10px; height: auto;">
				<div  class="justify-content-center1" ></div>
					@include('layout.rwd.lay_web_userinfo')
					<h5 style="COLOR: #ccc; font-weight: bold;">喜好影片</h5>
					@foreach ($posts as $post)
					<div id="rs-article-box" style="block-size:unset; float:left;padding: 10px;  overflow: hidden;  ">
					 
						<a href="/p/{{$post->id}}" data-id='{{$post->id}}' class="adClick"   target="_blank"> 
							<div poster="" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered vjs-paused av-video-dimensions vjs-controls-enabled vjs-workinghover vjs-v6 vjs-user-inactive" height="200px" width="600" id="av-video" lang="zh-hant-tw" role="region" aria-label="Video Player">
								<div class="vjs-poster" tabindex="-1" aria-disabled="false" 
									style="display: inline-block;
									vertical-align: middle;
									background-repeat: no-repeat;
									background-position: 50% 50%;
									background-size: contain;
									cursor: pointer;
									margin: 0;
									padding: 0;
									position: absolute;
									height:100%;
									right: 0;
									bottom: 0;
									left: 0;
									top: 0;
									MARGIN: 0PX 0PX 0 0PX;
									BACKGROUND-COLOR: #000;
									background-image: url('{{ asset('storage/'.$post->tb_img)}}');"  
									>
								</div>
								
							</div>
							<label style="cursor: pointer; padding: 10px 0px 0px 0px;Display: inline-block;  overflow: hidden;  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$post->title}}</label>
						</a>
						<div style="font-size: 8px; padding-top: 0px;COLOR: #fff;  opacity: 0;">．</div>
				 
					</div>
					@endforeach
					<div style="clear: both"></div>
				</div> 
			</div>
			@endif					
		</div>		
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
	 
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
<script>
 	$(function(){
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			});
			$('.searchBox #submit').on('click',function(){
				var text =  $( ".searchBox #input" ).val();

				if(text =='') {
					alert("请输入搜寻内容");
					return;
				}
				location.replace("/search/"+encodeURI(text)+"/1");
			})	

		 
			$('.edit').on('click', function () {
				var id=$(this).data('id');
				
				$('#input'+id).show();
				$('.edit').show();
				$('#input'+1).hide();
				$('#input'+3).hide();
				$('#input'+2).hide();
				$('#input'+id).show();
				 
				$(this).hide();
			 
			});
			 
			$('.input').on('click', function () {
				var id=$(this).data('id');
				 
				if($(this).hasClass("correct")) {
					var nick_name ='';
					var aaccount ='';
					var wechat ='';
					var regExp = /^[\d|a-zA-Z]+$/;
					if(id==1){
						nick_name = $('#inputbox'+id).val()
						nick_name =  	nick_name.replace(/\s*/g,"");
						alert(nick_name)
					} else if(id==2) {
						aaccount =$('#inputbox'+id).val()
						if (regExp.test(aaccount)){
						}	
    					else{
							alert('請輸入正確格式')
							return ;
						}
					} else if(id==3) {
						wechat =$('#inputbox'+id).val()
						if (regExp.test(wechat)){
						}	
    					else{
							alert('請輸入正確格式')
							return ;
						}
					}
					$.ajax({
						method: "POST",
						dataType: "json",
						url: "/updateUser",			
						data: {
							nick_name:nick_name,
							aaccount: aaccount,
							wechat: wechat				
						},			
						success: function(data){

							$('#input'+1).hide();
							$('#input'+3).hide();
							$('#input'+2).hide();
							$('#edit1').show();
							$('#edit2').show();
							$('#edit3').show();

							if(data.nick_name){
								$('#inputbox1').val(data.nick_name)
								$('#infoTxt1').html(data.nick_name)
							} else if(data.aaccount){
								$('#inputbox2').val(data.aaccount)
								$('#infoTxt2').html(data.aaccount)
							} else if(data.wechat){
								$('#inputbox3').val(data.wechat)
								$('#infoTxt2').html(data.wechat)
							}
						},
						error :function( data ) {
							console.log('error'+data)
							// var errors = data.responseJSON;
							// if( data.status === 422 ) {
							// 	$.each(errors, function(index, value) {
							// 		alert(value[0])
							// 	});
							// }
						}
					})
   
 


				
				} else if($(this).hasClass("wrong")) {
				 
					$('#inputbox1').val($('#edit1').text())
					$('#inputbox2').val($('#edit2').text())
					$('#inputbox3').val($('#edit3').text()) 
					$('#input'+1).hide();
					$('#input'+3).hide();
					$('#input'+2).hide();
					$('#edit1').show();
					$('#edit2').show();
					$('#edit3').show();
				}
			});
		
		});
</script>
@stop