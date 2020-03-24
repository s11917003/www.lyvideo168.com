	<div id="rs-right-box">
		<div class="rs-appinfo">No.1老湿机休息站，带你升天带你飞，频繁更新片片精彩！</div>
	</div>
	<!-- JuicyAds v3.0
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>	
	-->
	<!--
	<div id="rs-right-box">
		<script type="text/javascript" src="http://js.spacenine.biz/t/329/177/a1329177.js"></script>
	</div>
	-->
	<div id="rs-right-box">
		@foreach ($relate as $re)
		<div style="width: 300; height: 230px; padding-top: 10px; overflow: hidden">
			<a href="/p/{{$re->post_id}}">
				<img src="{{ asset('storage'.$re->article['tb_img']) }}" style="width: 300px;">
				<div style="font-size: 8; padding-top: 5px;">{{$re->article['title']}}</div>
			</a>
		</div>
		@endforeach
	</div>
	<!-- JuicyAds v3.0
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>
	<div id="rs-right-box">
		<script type="text/javascript" data-cfasync="false" async src="https://adserver.juicyads.com/js/jads.js"></script>
		<ins id="697681" data-width="300" data-height="262"></ins>
		<script type="text/javascript" data-cfasync="false" async>(adsbyjuicy = window.adsbyjuicy || []).push({'adzone':697681});</script>
	</div>	
	-->