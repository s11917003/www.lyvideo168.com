@extends('layout.rwd.lay_web_basic_noright')
@section('title')
老濕機發布
@stop
@section('des')
老濕機上車囉
@stop
@section('maincontent')
        <link href='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css' rel='stylesheet'>

		<div class="rs-post-box">
			<!-- <h3>投稿</h3> -->
			<div class="tab">
				<!--
				<button class="tablinks active" data-id='1' >文章</button>
				<button class="tablinks" data-id='2'>圖片</button>-->
				<button class="tablinks active" data-id='3' >視頻</button>
			</div>
			
			<div id="article" class="tabcontent">
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<div class="form-group p-t-xs">
					    <select id="optgroup" multiple="multiple" name='tags[]'>
							@foreach($tags as $tag)
								<option value="{{$tag->id}}">{{$tag->name}}</option>
							@endforeach
					    </select>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js' type='text/javascript'></script>
					</div>
					<textarea name="text" id="postContent" placeholder="影片標題" class="form-text"></textarea>
					<select id="hd" style="height: 50px;">
						<option value="0">普通(720p-)</option>
						<option value="1">HD(720p+、碼率大於1200)</option>
					</select>
					<div style="font-size: 10px;">
					<input type="text" id='cuttime' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="font-size: 10px;">
					<input type="text" id='cuttime2' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile" id="videofile">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>					
					<div class="error" id="videofileError" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					<input type="submit" id="publishBtn" value="投稿" d="publishBtn">
				</div>
			</div>
			
			<script>
				$(".tablinks").on('click', function(){
					var clicked = $(this).data('id');
					$(".tablinks").removeClass('active');
					$('[data-id='+clicked+']').addClass('active');
					$('#videofileError').hide();
					
					if(clicked == 3) {
						$('.upload').show();
						$('#imgfile').hide();
						$('#videofile').show();
						//$('#tip').text('不要上傳大於5分鐘的視頻，小編不會通過噠，濃縮的才是精華！~');
					}					
				})
				
				// 初始化
				$('#optgroup').multiSelect({
				    selectableOptgroup: true,
				    afterSelect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    },
				    afterDeselect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    }
				});
				
				// 可选全选按钮
				$('button.selectAll').click(function(){
				    $(selectId).multiSelect('select_all');
				    return false;
				});
				
				// 已选全选按钮
				$('button.deselectAll').click(function(){
				    $(selectId).multiSelect('deselect_all');
				    return false;
				});
				
				// 搜索框实时查询
				$('input.search-input').on('input propertychange', function() {
				    var inputValue = $(this).val().trim();
				    var $selections = $(selectId).siblings('.ms-container').find('.ms-selectable li.ms-elem-selectable');
				    $selections.each(function () {
				        var thisValue = $(this).children('span').text();
				        if (thisValue.match(inputValue)) {
				            $(this).show();
				        } else {
				            $(this).hide();
				        }
				    });
				});
			</script>
@stop