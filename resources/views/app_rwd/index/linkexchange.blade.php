@extends('layout.rwd.lay_web_basic')
@section('title')
老濕機連結交換
@stop
@section('des')
老濕機連結交換，情色網站互連
@stop
@section('topscript')
<meta itemprop="name" content="老濕機">
<meta itemprop="description" content="老濕機連結交換，情色網站互連">
@stop
@section('maincontent')
	<!-- Content 左側 開始 -->
	<div id="rs-content-left">
		<div id="rs-content-left-box">
			<div class="rs-contentword">

			</div>
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
	$('#closead').on('click',function(){
		//alert('close')
		$('#videocoverad').hide()
		
	})
</script>
<script src='/js/comm.js?r=@php echo uniqid(); @endphp' async=""></script>
@stop