$(document).ready(function () {
	return;
	var tagsCookie = getCookie('tags');
	var allVideoCookie = getCookie('allVideoCount');
	var todayVideoCookie = getCookie('todayVideoCount');
	if (todayVideoCookie && allVideoCookie && tagsCookie) {
		$("#nav-link-box-right .all").html(allVideoCookie);
		$("#nav-link-box-right .today").html(todayVideoCookie);
		var tags = tagsCookie.split('|');
		
		for(i=0;i<tags.length;i++){
			tagData = tags[i].split(',');
			var tag =  '<a class="dropdown-item" href="/tag/'+tagData[0]+'">'+ tagData[1]  +'</a>';
			$(".dropdown-menu").append(tag);
		 
		}

	} else {
		$.ajax({
			type:"get",
			url:"/videoinfo",
			success:function(result){
				var all = result['all'];
				var today = result['today'];
				var tags = result['tags'];
				$("#nav-link-box-right .all").html(all);
				$("#nav-link-box-right .today").html(today);

				if(all == 0 || !all){
					setCookie('allVideoCount','0',1);
				} else {
					setCookie('allVideoCount',all,1);
				}
				if(today == 0 || !today){
					setCookie('todayVideoCount','0',1);
				} else {
					setCookie('todayVideoCount',today,1);
				}
				 
				var textTags = ''
				for(i=0;i<tags.length;i++){
					var tag =  '<a class="dropdown-item" href="/tag/'+tags[i]['id']+'">'+ tags[i]['name']  +'</a>';
					$(".dropdown-menu").append(tag);
					if(i==tags.length-1 && i!= 1){
						textTags += tags[i]['id']+','+ tags[i]['name'];
					} else {
						textTags += tags[i]['id']+','+ tags[i]['name']+'|';
					}
				}

				if(textTags){
					console.log('textTags' ,textTags)
					setCookie('tags',textTags,7);
				}
				
			}
		});
	}

	var videoFile;
	var videoFile1;
	var videoFile2;
	var videoFile3;
	var videoFile4;
	var imgFile;
	$('#videofile').on('change',function(e){checkFile(e,0)});
	$('#videofile1').on('change',function(e){checkFile(e,1)});
	$('#videofile2').on('change',function(e){checkFile(e,2)});
	$('#videofile3').on('change',function(e){checkFile(e,3)});
	$('#videofile4').on('change',function(e){checkFile(e,4)});
	$('#imgfile').on('change', checkFile);
	
	var ff =GetURLParameter('focus');
	if(ff == 'reply') {
		$('#reply').focus()
	}

    function checkFile(event,id=0) {

	  
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
        
        if(is_video && !/.(mp4)/gi.test(file_name)){
            showHideError($file_input[0].id, true, "請上傳影片檔案,後綴必須是mp4",id);
            $file_input.val("");
            return false;
        }

        if(!is_video && !/.(jpg|jpeg|gif|png)/gi.test(file_name)){
            showHideError($file_input[0].id, true, "請上傳圖片檔案,後綴必須是jpeg,jpg,gif,png",id);
            $file_input.val("");
            return false;
        }

        if($file_input[0].files) {
            var size =  $file_input[0].files[0].size;
            if(is_video){
                if (/.(mp4|webm|ogv)/gi.test(file_name) && size > 1024*1024*3500) {
                    showHideError($file_input[0].id, true, "你上傳的是mp4文件, 最大支持3.5g",id);
                    $file_input.val("");
                    return false;
                }
                // 除了浏览器支持的格式以及avi格式外的其他几种文件,限制为50M
                if (!/.(mp4|webm|ogv)/gi.test(file_name)&& size > 1024*1024*3500) {
                    showHideError($file_input[0].id, true, "你上傳的是非mp4文件, 最大支持3.5g",id);
                    $file_input.val("");
                    return false;
                }
            }
        }
		
		showHideError($file_input[0].id, false, '',id);
		
		if(is_video) {
			var tmpvideoFile 
			if (id==0) {
				videoFile = event.target.files;
				tmpvideoFile = videoFile;
			} if (id==1) {
				videoFile1 = event.target.files;
				tmpvideoFile = videoFile1;
			} if (id==2) {
				videoFile2 = event.target.files;
				tmpvideoFile = videoFile2;
			} if (id==3) {
				videoFile3 = event.target.files;
				tmpvideoFile = videoFile3;
			} if (id==4) {
				videoFile4 = event.target.files;
				tmpvideoFile = videoFile4;
			}
		

			console.log(videoFile)
			console.log(videoFile1)
			console.log(videoFile2)
			console.log(videoFile3)
			console.log(videoFile4)
			arr=tmpvideoFile[0].name.split(".");
			var removed = arr.splice(arr.length-1,1);
 
		  if (id==0) {
			$('#postContent').text(arr.join('.'));
		  } else {
			$('#postContent' + id).text(arr.join('.'));
		  }
		} else {
			imgFile = event.target.files;
		}
        
        //console.log(imgFile)
		return true;
    }
	function publishEvent(event) {
		if($('#imgfile').val() != '' || $('#videofile').val() != '' || $('.tablinks.active').data('id') == 1) {
			
			if(uploading == true) {
				alert('哥哥您別急呀！');
				return false;
			}

			// num =  $('#cuttime').val()
			// num2 =  $('#cuttime2').val()
			// if(isNaN(Number(num)) || isNaN(Number(num2))){  
			// 	alert('请输入正整数');
			// 	return false;
			// } else if(Number(num)<0 || Number(num2)<0) {
			// 	alert('请输入正整数');
			// 	return false;
			// }

			for (i = 0; i < 5; i++) {
				var index = ''
				if(i!=0) {
					index = i +''
				}
				console.log( $("#article"+index).is(":visible"))
				if($("#article"+index).is(":visible")){
					num =  $('#cuttime'+index).val()
					num2 =  $('#cuttime2'+index).val()
					if(isNaN(Number(num)) || isNaN(Number(num2))){  
						alert('请输入正整数');
						return false;
					} else if(Number(num)<0 || Number(num2)<0) {
						alert('请输入正整数');
						return false;
					}
					if($('#optgroup'+index).val().length == 0) {
						alert('哥哥您未输入分類唷!');
						return false;
					}
					if($('#watermark'+index).val().length == 0) {
						alert('哥哥浮水印文字未输入唷!');
						return false;
					}

					if($('#videofile'+index).val() == '') {
						alert('哥哥您有檔案未输入唷!');
						return false;
					}
					if($('#postContent'+index).val() == '') {
						alert('哥哥您有內容沒有寫唷');
						return false;
					}
				}

			}
		 
		 
				uploading = true;
				$("#publishBtn").prop('disabled', true);
				$("#publishBtn").css( "background-color", '#c7c5c1');
				$("#publishBtn").html('<img src="/img/source.gif?a=1" style="height:18px;">');
				uploadFile(event, $('.tablinks.active').data('id'))
				return;
			 
		}
		
		
		alert('哥哥您沒有選擇任何檔案唷!');
		return;
	}
    function showHideError (id, show, text, postContentId) {
		var videofileErrorText = ''
		if (postContentId==0) {
			videofileErrorText  = 'videofileError';
		} else {
			videofileErrorText =  'videofileError'  + postContentId;
		}
	    if(show) {
	        $('#'+videofileErrorText).text(text);
			$('#'+videofileErrorText).show();	    
	    } else {
			$('#'+videofileErrorText).hide();	    
	    }

        
    };
    
    function uploadFile(event, type) {
		event.stopPropagation(); // Stop stuff happening
		event.preventDefault(); // Totally stop stuff happening
		// console.log(videoFile)
		// console.log(videoFile1)

		// return;
        //## 宣告一個FormData
        var data = new FormData();
        /*
        if (type == 2) {
        	data.append("img", imgFile[0]);
        }
        */
        if (type == 3) {
			data.append("video", videoFile[0]);

			if(videoFile1)
				data.append("video1", videoFile1[0]);
			if(videoFile2)
			data.append("video2", videoFile2[0]);
			if(videoFile3)
			data.append("video3", videoFile3[0]);
			if(videoFile4)
			data.append("video4", videoFile4[0]);
		}			
		data.append("userid", user_id);
		data.append("type", type);
		//## 將檔案append FormData
		for (i = 0; i < 5; i++) {
			var index = ''
			if(i!=0) {
				index = i +''
			}
			data.append("content"+index, $('#postContent'+index).val());
			data.append("hd"+index, $('#hd'+index).val());
			data.append("cuttime"+index, $('#cuttime'+index).val());
			data.append("cuttime2"+index, $('#cuttime2'+index).val());
			data.append("watermark"+index, $('#watermark'+index).val());
			data.append("tags"+index, $('#optgroup'+index).val())
		}
      
		// console.log(data)
		// return
		
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
				$("#spinner").hide();
				if(data.ret == 0 || data.ret == -3) {
					//toastr["error"](data.msg);
					alert(data.msg);
					
					$('#imgfile').val('');
					$("#publishBtn").prop('disabled', false);
					$("#publishBtn").css( "background-color", '');
					$('#videofile').val('');
					$('#postContent').text('');
					$('#cuttime').val(0);
					$('#cuttime2').val(0);
					$('#hd option').get(0).selected = true;
					$('#optgroup').multiSelect('deselect_all');
					for (i = 1; i < 5; i++) {
						$('#videofile'+i).val('');
						$('#postContent' + i).text('');
						$('#cuttime'+i).val(0);
						$('#cuttime2'+i).val(0);
						$('#hd'+i+' option').get(0).selected = true;
						$('#optgroup'+i).multiSelect('deselect_all');
					}
				

					
				} else {
					$('#videofile').val('');
					$('#postContent').text('');
					$('#cuttime').val(0);
					$('#cuttime2').val(0);
					$('#hd option').get(0).selected = true;
					$('#optgroup').multiSelect('deselect_all');
					for (i = 1; i < 5; i++) {
						$('#postContent' + i).text('');
						$('#videofile'+i).val('');
						$('#cuttime'+i).val(0);
						$('#cuttime2'+i).val(0);
						$('#hd'+i+' option').get(0).selected = true;
						$('#optgroup'+i).multiSelect('deselect_all');
					}

					$('#imgfile').val('');
					alert(data.msg)
					$("#publishBtn").css( "background-color", '');
					$("#publishBtn").prop('disabled', false);
					//window.location.href='/';
	      		}
		  		$(".loading-bar").css("width" , 0 +"%").find("span").html( 0 +"%");
		  		uploading = false

	      	},
		  	error :function( data ) {
				$("#spinner").hide();
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

			if(per == 100) {
				$("#spinner").show();
			}
			
			$(".loading-bar").css("width" , per +"%").find("span").html( per +"%");
		}
    }
	

	var uploading = false;
	$("#publishBtn").on('click', function(e) {
		publishEvent(e);
	});

	$(document).on('click', '.like', function(){
		var clickEv = $(this).data('id')
		// snsclick(clickEv)		
	})
	/*
	$('.like').on('click', function(){
		var clickEv = $(this).data('id')
		snsclick(clickEv)		
	})
	*/
	
	/*
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
						//console.log(value)
						//alert('請先登入');
						location.href =  "/member/login"
					});
	      		}
			}	      	
	    });
	}
	*/
	
	var parentid = 0
	//var nick = postnick
	
	
	$(document).on('click', '.cmt', function(){
	//$('.cmt').on('click',function(){
		$('#reply').val('');
		data =  $(this).data('id') //reply-cmt-12
		postdata = data.split('-');    //0 reply 1 cmt 2 id 3 target
		if(postdata[3] !=0) {nick = $('#reply-nick-'+postdata[2]).text()};
		parentid = postdata[3];
		$('#reply').attr("placeholder", '回覆 ' + nick).focus();
		
	})
	
	$('[id*=replybtn]').on('click', function(){
	
		var pid = $(this).data('postid')

		var replytext = $('#reply-'+pid).val()
		
		if(replytext.length == 0) {
			alert('請留下您的神評論!')
			return false
		}

		if(replytext.length > 140) {
			alert('您的評論超過字數限制囉!')
			return false
		}
		
		if(nick == '') {
			nick = $('#post-nick-'+pid).val()
		}
		$("#spinner").shww();				
		$.ajax({
			method: "POST",
			dataType: "json",
			url: "/sns/reply/request",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},				
			data: {
				postid:pid,
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
					//location.reload();
					//location.href = "/p/" + postid
					
				} else {
					alert(data.msg);
					//toastr["info"](data.msg);
	      		}
	      	},
		  	error :function( data ) {
			
	        	var errors = data.responseJSON;
				if( data.status === 422 ) {
					$.each(errors, function(index, value) {
						//alert(value[0])
						location.href =  "/member/login?forward=/p/" + postid
					});
	      		}
			}	      	
	    });
	})
	
	$('textarea[name=post-content]').on('input',function() {
		 //updateinpue()	
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
			//console.log(count)

		}
		
	})
})

function pageInit(current,total,link){
	current=parseInt(current),total=parseInt(total);
	var count = 6;
	var preLink = current > 1 ? link + (current-1) : "javascript:void(0)";
	var nextLink = current < total ? link + (current+1) : "javascript:void(0)";
	var html = '<ul class="pagination"><li><a href="'+preLink+'" '+(current > 1 ? "":"class=\"no-link\"")+'>«</a><li>';
	if(total <= count){
		for(var i=1;i<=total;i++){
			var pageTag = i == current ? '<li><a><span class="act">'+current+'</span></a></li>' : '<li><a href="'+link+i+'">'+i+'</a></li>'
			html += pageTag;
		}
	}else{
		var i = parseInt(current - count/2) < 2 ? 2 : parseInt(current-count/2);
		var end = (parseInt(current + count/2) > (total - 1)) ? (total-1) : parseInt(current+count/2);
		console.log(current,count/2)
		html += (current==1) ? '<li><a class="active">1</a></li>':'<li><a href="'+link+'1">1</a><li> '+(i > 2 ? "<li><a href='javascript:void(0)'>...</a></li>" :"");
		for(; i <= end; i++){
			var pageTag = (i == current) ? '<li><a class="active" href="javascript:void(0)">'+current+'</a></li>' : '<li><a href="'+(link+i)+'">'+i+'</a></li>'
			html += pageTag;
			}
			html += (end < (total - 2) ? "<li><a href='javascript:void(0)'>...</a></li>" : "")+((current == total) ? '<li><a class="active">'+total+'</a></li>':' <li><a href="'+link+total+'">'+total+'</a></li>');
	}
	html += '<li><a href="'+nextLink+'" '+(current < total ? "":"class=\"no-link\"")+'>»</a><li></ul>';
	return html;
}

function social(type, postid) {
	shareurl = 'https://www.c8c8tv.com/p/' + postid;
	switch (type) {
		case 'fb':
		//sharelink = '';
        FB.ui({
            method: 'feed',
            name: '哈哈TV',
            link: shareurl,
        });
		break;
		
		case 'gg':
		sharelink = 'https://plus.google.com/share?url=' + shareurl;
		break;
		
		case 'tw':
		sharelink = 'https://twitter.com/intent/tweet?url=' + shareurl;
		break;
		
		case 'line':
		break;
	}
	
	if(type != 'fb') {
		window.open(this.sharelink, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=450')
	}
}

function dropreply(id) {
	postid = id
			
	if($('#reply-drop-'+id).data('show') == 0) {
		$('#reply-drop-'+id).show();
		$('#reply-drop-'+id).data('show', 1);
	} else {
		$('#reply-drop-'+id).hide();
		$('#reply-drop-'+id).data('show', 0);
	}
}

// var ssid = $('#rs-content-left-box').data('id');
// 	$(window).on('scroll',function(){
// 	$("div #rs-content-left-box").each(function(){
// 		if($(this).visible()) {
// 			 datashow = $(this).data('show')
// 			if(datashow == false ) {
// 			//if(getElementViewTop(this)) {
// 			//console.log(getElementViewTop(this))
// 				console.log($(this).data('id')+'曝光紀錄1次')
// 				$(this).data('show', true);
// 							 //}
// 			}						 
// 		}
// 	});
				
// })


function getElementViewTop(element){
	var actualTop = element.offsetTop;
	var current = element.offsetParent;
	while (current !== null){
	 　	actualTop += current. offsetTop;
		current = current.offsetParent;
	}
	
	if (document.compatMode == "BackCompat"){
		var elementScrollTop=document.body.scrollTop;
	} else {
		var elementScrollTop=document.documentElement.scrollTop; 
	}
	return actualTop-elementScrollTop;
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}


