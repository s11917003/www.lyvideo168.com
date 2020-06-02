@extends('layout.rwd.lay_web_basic_noright')
@section('title')
@lang('default.title')發布
@stop
@section('des')
@lang('default.description')上車囉
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
			
			<div id="article" class="tabcontent" >
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
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime2' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='watermark' value="{{ $waterMark }}" style="height: 30px; width: 30%">
					浮水印文字
					</div>
					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile" id="videofile">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>						
					<div class="error" id="videofileError" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					
				</div>
			</div>  
			<div id="article1" style="display: none;" class="tabcontent" >
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<div class="form-group p-t-xs">
						<select id="optgroup1" multiple="multiple" name='tags[]'>
							@foreach($tags as $tag)
								<option value="{{$tag->id}}">{{$tag->name}}</option>
							@endforeach
						</select>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js' type='text/javascript'></script>
					</div>
					<textarea name="text" id="postContent1" placeholder="影片標題" class="form-text"></textarea>
					<select id="hd1" style="height: 50px;">
						<option value="0">普通(720p-)</option>
						<option value="1">HD(720p+、碼率大於1200)</option>
					</select>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime1' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime21' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='watermark1' value="{{ $waterMark }}" style="height: 30px; width: 30%">
					浮水印文字
					</div>

					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile1" id="videofile1">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>						
					<div class="error" id="videofileError1" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					<!-- <input type="submit" id="publishBtn1" value="投稿" d="publishBtn1">

					<input type="button" id="addVideo1" value="加影片" d="addVideo"> -->
				</div>
			</div>

			<div id="article2" style="display: none;" class="tabcontent" >
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<div class="form-group p-t-xs">
						<select id="optgroup2" multiple="multiple" name='tags[]'>
							@foreach($tags as $tag)
								<option value="{{$tag->id}}">{{$tag->name}}</option>
							@endforeach
						</select>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js' type='text/javascript'></script>
					</div>
					<textarea name="text" id="postContent2" placeholder="影片標題" class="form-text"></textarea>
					<select id="hd2" style="height: 50px;">
						<option value="0">普通(720p-)</option>
						<option value="1">HD(720p+、碼率大於1200)</option>
					</select>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime2' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime22' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='watermark2' value="{{ $waterMark }}" style="height: 30px; width: 30%">
					浮水印文字
					</div>
					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile1" id="videofile2">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>						
					<div class="error" id="videofileError2" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					<!-- <input type="submit" id="publishBtn1" value="投稿" d="publishBtn1">

					<input type="button" id="addVideo1" value="加影片" d="addVideo"> -->
				</div>
			</div>

			<div id="article3" style="display: none;" class="tabcontent" >
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<div class="form-group p-t-xs">
						<select id="optgroup3" multiple="multiple" name='tags[]'>
							@foreach($tags as $tag)
								<option value="{{$tag->id}}">{{$tag->name}}</option>
							@endforeach
						</select>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js' type='text/javascript'></script>
					</div>
					<textarea name="text" id="postContent3" placeholder="影片標題" class="form-text"></textarea>
					<select id="hd3" style="height: 50px;">
						<option value="0">普通(720p-)</option>
						<option value="1">HD(720p+、碼率大於1200)</option>
					</select>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime3' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime23' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='watermark3' value="{{ $waterMark }}" style="height: 30px; width: 30%">
					浮水印文字
					</div>
					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile1" id="videofile3">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>						
					<div class="error" id="videofileError3" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					<!-- <input type="submit" id="publishBtn1" value="投稿" d="publishBtn1">

					<input type="button" id="addVideo1" value="加影片" d="addVideo"> -->
				</div>
			</div>

			<div id="article4" style="display: none;" class="tabcontent" >
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<div class="form-group p-t-xs">
						<select id="optgroup4" multiple="multiple" name='tags[]'>
							@foreach($tags as $tag)
								<option value="{{$tag->id}}">{{$tag->name}}</option>
							@endforeach
						</select>
						<script src='https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js' type='text/javascript'></script>
					</div>
					<textarea name="text" id="postContent4" placeholder="影片標題" class="form-text"></textarea>
					<select id="hd4" style="height: 50px;">
						<option value="0">普通(720p-)</option>
						<option value="1">HD(720p+、碼率大於1200)</option>
					</select>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime4' value=0 style="height: 30px; width: 30%">
					頭裁切秒數(ex 10秒填10、2分鐘填120,頭砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='cuttime24' value=0 style="height: 30px; width: 30%">
					尾裁切秒數(ex 10秒填10、2分鐘填120,尾砍填入秒數)、預設不填寫
					</div>
					<div style="color: #fff;font-size: 10px;">
					<input type="text" id='watermark4' value="{{ $waterMark }}" style="height: 30px; width: 30%">
					浮水印文字
					</div>
					<!--<input type="text" id='len' placeholder="影片長度(ex 1小時30分0秒填01:30:00)" style="height: 30px;">-->				
					<div class="upload">
						<input type="file" class="form-upload" name="videofile1" id="videofile4">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>						
					<div class="error" id="videofileError4" style="display:none; font-size:14px; color: red">請選擇視頻文件,後綴必須是mp4,avi,rmvb,rm,flv,mpeg,ra,ram,mov,wmv</div>
					<!-- <input type="submit" id="publishBtn1" value="投稿" d="publishBtn1">
					<input type="button" id="addVideo1" value="加影片" d="addVideo"> -->
				</div>
			</div>

			<input type="submit" id="publishBtn" value="投稿" d="publishBtn">
			<input type="button" id="addVideo" value="加影片" d="addVideo" data-tab='1' >
			<input type="button" id="rmoveVideo" style="display: none;" value="刪除" d="rmoveVideo" data-tab='1' >
			<div id="spinner" class=""  style="    background-color: black;
			opacity: 0.7;display: none; width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;">
				<div class="spinner-border" style="top: 50%; position: fixed; left: 45%;" role="status">
				  <span class="sr-only">Loading...</span>
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
				$("#rmoveVideo").on('click', function(){
					$("#addVideo").show();	
					for (i=4;i>=1;i--) {
						if($("#article"+i).is(":visible")){
							$("#article"+i).hide();
							if(i==1) {
								$("#rmoveVideo").hide();	
							}
							return
						}

					}
				
				})
				$("#addVideo").on('click', function(){
					for (i=1;i<=4;i++) {
						if(!$("#article"+i).is(":visible")){
							$("#article"+i).show();
							if(i==1) {
								$("#rmoveVideo").show();	
							}
							if(i==4) {
								$("#addVideo").hide();	
							}
							return
						}

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
				$('#optgroup1').multiSelect({
				    selectableOptgroup: true,
				    afterSelect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    },
				    afterDeselect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    }
				});
				$('#optgroup2').multiSelect({
				    selectableOptgroup: true,
				    afterSelect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    },
				    afterDeselect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    }
				});
				$('#optgroup3').multiSelect({
				    selectableOptgroup: true,
				    afterSelect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    },
				    afterDeselect: function (values) {
				        //select.modifyselectNum('#optgroup');
				    }
				});
				$('#optgroup4').multiSelect({
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