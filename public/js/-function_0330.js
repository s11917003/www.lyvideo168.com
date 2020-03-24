$(document).ready(function () {

	var videoFile;
	var imgFile;
	$('#videofile').on('change', checkFile);
	$('#imgfile').on('change', checkFile);
	
	var ff =GetURLParameter('focus');
	if(ff == 'reply') {
		$('#reply').focus()
	}

    function checkFile(event) {
        var $file_input = $(event.currentTarget);
        var file_name = $file_input.val();
        if(!file_name && $('#postType').val() != 1) {
	        //alert('哥哥您沒有選擇任何檔案唷！');
        	return false;
        }
        
        var is_video = true;
        if($file_input[0].id == 'imgfile') {
	        is_video = false;
        }
        
        if(is_video && !/.(mp4|flv|mpeg|mov)/gi.test(file_name)){
            showHideError($file_input[0].id, true, "請上傳影片檔案,後綴必須是mp4,flv,mov,mpeg");
            $file_input.val("");
            return false;
        }

        if(!is_video && !/.(jpg|jpeg|gif|png)/gi.test(file_name)){
            showHideError($file_input[0].id, true, "請上傳圖片檔案,後綴必須是jpeg,jpg,gif,png");
            $file_input.val("");
            return false;
        }

        if($file_input[0].files) {
            var size =  $file_input[0].files[0].size;
            if(is_video){
                if (/.(mp4|webm|ogv)/gi.test(file_name) && size > 1024*1024*30) {
                    showHideError($file_input[0].id, true, "你上傳的是mp4文件, 最大支持30M");
                    $file_input.val("");
                    return false;
                }
                // 除了浏览器支持的格式以及avi格式外的其他几种文件,限制为150M
                if (!/.(mp4|webm|ogv)/gi.test(file_name)&& size > 1024*1024*50) {
                    showHideError($file_input[0].id, true, "你上传的是非mp4文件, 最大支持50M");
                    $file_input.val("");
                    return false;
                }
            }
        }
		
		showHideError($file_input[0].id, false, '');
		
		if(is_video) {
        	videoFile = event.target.files;
		} else {
			imgFile = event.target.files;
		}
        
        console.log(imgFile)
		return true;
    }

    function showHideError (id, show, text) {
	    if(show) {
	        $('#videofileError').text(text);
			$('#videofileError').show();	    
	    } else {
			$('#videofileError').hide();	    
	    }

        
    };
    
    function uploadFile(event, type) {
		event.stopPropagation(); // Stop stuff happening
		event.preventDefault(); // Totally stop stuff happening
		//console.log(videoFile)

        //## 宣告一個FormData
        var data = new FormData();
        if (type == 2) {
        	data.append("img", imgFile[0]);
        }
        if (type == 3) {
        	data.append("video", videoFile[0]);
        }
        //## 將檔案append FormData
        data.append("content", $('#postContent').val());
        data.append("userid", user_id);
        data.append("type", type);
        data.append("tag", $('#tag').val());
		
		console.log(type);
		
		$.ajax({
			method: "POST",
			dataType: "json",
			processData: false, // Don't process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request			
			url: "/upload/request",
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },				
			data: data,
            xhr:function(){
				var xhr = $.ajaxSettings.xhr();
				if(onprogress && xhr.upload) {
					xhr.upload.addEventListener("progress" , onprogress, false);
					return xhr;
				}
			},			
			success: function(data){
				if(data.ret == 0) {
					//toastr["error"](data.msg);
					alert(data.msg);
				} else {
					//註冊成功
					$('#videofile').val('');
					$('#imgfile').val('');
					alert(data.msg)
					window.location.href='/';
	      		}
	      	},
		  	error :function( data ) {
	        	var errors = data.responseJSON;
				if( data.status === 422 ) {
					$.each(errors, function(index, value) {
						alert(value[0])
					});
	      		}
			}
	  	});
	  	
	  	
	  	function onprogress(evt){
			var loaded = evt.loaded;     //已经上传大小情况
			var tot = evt.total;      //附件总大小
			var per = Math.floor(100*loaded/tot);  //已经上传的百分比
			$(".loading-bar").css("width" , per +"%").find("span").html( per +"%");
		}
    }
	

	var uploading = false;
	$("#publishBtn").on('click', function(event) {
		
		if($('#imgfile').val() != '' || $('#videofile').val() != '' || $('.tablinks.active').data('id') == 1) {
			
			if(uploading == true) {
				alert('哥哥您別急呀！');
				return false;
			}
			
			if($('#postContent').val() != '') {
				uploading = true;
				$("#publishBtn").prop('disabled', true);
				$("#publishBtn").css( "background-color", '#c7c5c1');
				$("#publishBtn").html('<img src="/img/source.gif?a=1" style="height:18px;">');
				uploadFile(event, $('.tablinks.active').data('id'))

				return;
			} else {
				alert('哥哥您的內容沒有寫唷!');
				return;
			}
		}
		
		
		alert('哥哥您沒有選擇任何檔案唷!');
		return;
	})

	$(document).on('click', '.like', function(){
		var clickEv = $(this).data('id')
		snsclick(clickEv)		
	})
	/*
	$('.like').on('click', function(){
		var clickEv = $(this).data('id')
		snsclick(clickEv)		
	})
	*/
	
	function snsclick($clickEv) {		
		var clickbtn = $clickEv
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "/sns/ev/request",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},				
			data: {type:clickbtn, userid:user_id},		
			success: function(data){
				if(data.ret == 1) {
					//toastr["info"](data.msg);
					$('#'+clickbtn+' span').text(data.count)
				} else {
					alert(data.msg);
					//toastr["info"](data.msg);
	      		}
	      	},
		  	error :function( data ) {
	        	var errors = data.responseJSON;
				if( data.status === 422 ) {
					$.each(errors, function(index, value) {
						alert(value[0])
					});
	      		}
			}	      	
	    });
	}
	
	var parentid = 0
	//var nick = postnick
	
	
	$('.cmt').on('click',function(){
		$('#reply').val('');
		data =  $(this).data('id') //reply-cmt-12
		postdata = data.split('-');    //0 reply 1 cmt 2 id 4 target
		if(postdata[3] !=0) {nick = $('#reply-nick-'+postdata[2]).text()};
		parentid = postdata[3];
		console.log(parentid);
		$('#reply').attr("placeholder", '回覆 ' + nick).focus();
		
	})
	
	$('#replybtn').on('click', function(){
		var replytext = $('#reply').val()
		if(replytext.length == 0) {
			alert('請留下您的神評論!')
			return false
		}

		if(replytext.length > 140) {
			alert('您的評論超過字數限制囉!')
			return false
		}	
		
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "/sns/reply/request",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},				
			data: {
				postid:postid,
				parentid:parentid,
				target_nick:nick, 
				replytext:replytext,
				userid: user_id				
			},		
			success: function(data){
				if(data.ret == 1) {
					//toastr["info"](data.msg);
					//$('#'+clickbtn+' span').text(data.count)
					alert('回覆成功');
					location.reload();
				} else {
					alert(data.msg);
					//toastr["info"](data.msg);
	      		}
	      	},
		  	error :function( data ) {
	        	var errors = data.responseJSON;
				if( data.status === 422 ) {
					$.each(errors, function(index, value) {
						alert(value[0])
					});
	      		}
			}	      	
	    });
	})
	
	$('textarea[name=post-content]').on('input',function() {
		 updateinpue()	
	});
	
	var less = 0
	function updateinpue() {
		less = 140 - $('#reply').val().length
		$('#lessword').text(less)
	}

	function GetURLParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}
	
	var page = 2;
	var getmorerun = false;
	$(".ccc").on('click', function(){
		if(getmorerun == true) {
			return false;
		}
		getmorerun = true;
		$.get("/getmore/" + page, {},
		  function(data){
		    posts =  data.posts.data
		    
		    if(posts == '') {
			    alert('滾到最底囉')
			    return false
		    } else {
			    page++
		    }
		    
			$.each(posts, function(index, value) {
								
				html = ''
				html = '<div class="contentbox "><a href="'+ value.id +'"><div class="contentpics" style="background: url('+ value.user_info.avatar +') no-repeat top center; background-size:70px"></div></a><div class="contentname"><a href="/p/'+ value.id +'">'+ value.user_info.nick_name +'</a><br></div>'
				
				if(value.cate_id == 2) {
				html+= '<div class="contentword"><a href="/p/'+ value.id +'">'+ value.title +'</a></div><div class="contentword"><img src="'+ value.video_url +'" style="min-width: 320px; max-width: 640px;"></div>'					
				}
				
				if(value.cate_id == 3) {					
				html+= '<div class="contentword"><a href="/p/'+ value.id +'">'+ value.title +'</a></div><div class="contentword"><div class="watermark-v"><img src="/img/tv-mark.png"></div><div style="width:640px;"><video id="my-video-'+ value.id +'" class="video-js vjs-big-play-centered" controls preload="auto" width="640" height="400" poster="'+ value.cover_img +'" data-setup="{}"><source src="'+ value.video_url +'" type="video/mp4"><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that<a href="https:\/\/videojs.com\/html5-video-support\/" target="_blank">supports HTML5 video</a></p></video><script src="https:\/\/vjs.zencdn.net\/6.6.3\/video.js"><\/script></div></div>'					
				}
								
				html+= '<div class="contentword-l"><div class="digg like" id="post-digg-'+ value.id +'" data-id="post-digg-'+ value.id +'"><i class="fas fa-thumbs-up"></i><span> '+ value.detail.count_digg +'</span></div><div class="digg like" id="post-bury-'+ value.id +'" data-id="post-bury-'+ value.id +'"><i class="fas fa-thumbs-down"></i><span> '+ value.detail.count_bury +'</span></div><div class="digg" id="post-repin-'+ value.id +'" data-id="post-repin-'+ value.id +'"><i class="fas fa-star"></i><span> '+ value.detail.count_repin +'</span></div></div><div class="contentword-r"><div class="digg" id="post-share-'+ value.id +'" data-id="post-share-'+ value.id +'"><i class="fas fa-share-square"></i><span> '+ value.detail.count_share +'</span></div><div class="digg" onclick="location.href=\'/p/'+ value.id + '?focus=reply\'"><i class="fas fa-comment"></i><span> '+ value.detail.count_cmt +'</span></div></div></div>' 
				$( "#morecontent" ).append(html);				
			});
			getmorerun = false;
		  });		
		  
	});
	
	var count = 0
	$(document).on('click','div[id^="my-video-"]', function(){
		videoid= $(this).attr('id');
		played = $(this).hasClass('vjs-paused')
		playhoder = $('.vjs-big-play-button').css('display');
		//console.log(playhoder)
		if(played == false || playhoder == 'block') {
			count++;
			ga('send', 'event', 'vidoes', 'play', videoid, 1);
			console.log(count)

		}
		
	})
})



