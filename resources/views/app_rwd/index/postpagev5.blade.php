@extends('layout.rwd.lay_web_basic_noright')
@section('title')
哈哈TV發布
@stop
@section('des')
全台No.1搞笑的社區，快來樓頂招樓下，阿母招阿爸，阿公招阿嬤，厝邊招隔壁，成為「哈友」一起笑哈哈！
@stop
@section('maincontent')
		<div class="rs-post-box">
			<!-- <h3>投稿</h3> -->
			<div class="tab">
				<button class="tablinks active" data-id='1' >文章</button>
				<button class="tablinks" data-id='2'>圖片</button>
				<button class="tablinks" data-id='3' >視頻</button>
			</div>
			
			<div id="article" class="tabcontent">
				<!-- <h3 align="center">文章上傳</h3> -->
				<div class="item-sel">
					<select id="tag" style="height: 45px;">
						@foreach($tags as $tag)
						<option value="{{$tag->id}}">{{$tag->name}}</option>
						@endforeach
					</select>
					<textarea name="text" id="postContent" placeholder="分享一切有笑點的事，投稿後經審查評分後有機會被推薦到首頁唷！" class="form-text"></textarea>
					<div class="upload">
						<input type="file" class="form-upload" name="imgfile" id="imgfile" style="display: none" multiple>
						<input type="file" class="form-upload" name="videofile" id="videofile" style="display: none">
						<div class="loading-bar" style="width:0%;"><span></span></div>
					</div>
					<div style="margin:5px 0;font-size:14px;" id='tip'>分享一切有笑點的事情，投稿經審核評分後，有機會被推薦到首頁，注意不要發別人已經發過的老段子哦。</div>
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
					
					if(clicked == 1) {
						$('.upload').hide();
						$('#tip').text('分享一切有笑點的事情，投稿經審核評分後，有機會被推薦到首頁，注意不要發別人已經發過的老段子哦。');
					}
					
					if(clicked == 2) {
						$('.upload').show();
						$('#imgfile').show();
						$('#videofile').hide();
						$('#tip').text('分享有趣圖片，投稿經審核評分後，有機會被推薦到首頁，注意不要發別人已經發過的老段子哦。');
					}
					
					if(clicked == 3) {
						$('.upload').show();
						$('#imgfile').hide();
						$('#videofile').show();
						$('#tip').text('不要上傳大於5分鐘的視頻，小編不會通過噠，濃縮的才是精華！~');
					}					
				})
			</script>
@stop