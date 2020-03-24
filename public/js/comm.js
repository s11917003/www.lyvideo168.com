$('.loadmorereply').on('click', function(){
		console.log($(this).data('id'));
		parentid = $(this).data('id');
		$.ajax({
			method: "GET",
			dataType: "json",
			url: "/comm/reply/loadmore",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},				
			data: {
				postid:postid,
				parentid:parentid,
			},		
			success: function(data){
				if(data.replys) {
					//console.log(data.replys)
					html = ''
					$.each(data.replys, function(index, reply) {
						html += '<div class="rs-contentbox1" style="margin:0 20px;"><a href="javascript:void(0)"><div class="rs-contentpics1"  style="background: url(' + reply.user_info.avatar + ') no-repeat top center; background-size:70px"></div></a><div class="rs-contentname"><a href="#" id="reply-nick-'+ reply.id +'">'+ reply.name +'</a><br>'+ reply.created_at +'</div><div class="contentword-ll" style="padding-right:20px"><div class="rs-digg-cmm like" id="reply-digg-'+ reply.id +'" data-id="reply-digg-'+ reply.id +'"><i class="fas fa-thumbs-up"></i><span> '+ reply.count_digg +'</span></div><div class="rs-digg-cmm like" id="reply-bury-'+ reply.id +'" data-id="reply-bury-'+ reply.id +'"><i class="fas fa-thumbs-down"></i><span> '+ reply.count_bury +'</span></div><div class="rs-digg-cmm cmt" id="reply-cmt-'+ reply.id +'-'+ reply.parent_id +'" data-id="reply-cmt-'+ reply.id +'-'+ reply.parent_id +'"><i class="fas fa-comment"></i></div></div><div class="rs-contentword" style="margin: 0 30px;">回覆 '+ reply.target_name +'：'+ reply.content +'</div></div>'
					})
					$( "#repmore-"+parentid).append(html);				
					//console.log(html)
					//toastr["info"](data.msg);
					//$('#'+clickbtn+' span').text(data.count)
					//alert('回覆成功');
					//location.reload();
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
	    $(this).hide();		
})