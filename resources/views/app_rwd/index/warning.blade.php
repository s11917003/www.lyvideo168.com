@extends('layout.rwd.lay_web_basic_warning')
@section('title')
@lang('default.title')休息站
@stop
@section('des')
No.1 @lang('default.description')休息站，帶你升天帶你飛，每天更新,片片精彩！
@stop
@section('topscript')
<script>
function setCookie(name, value, time) {
  var now = new Date();
  var offset = 8;
  var utc = now.getTime() + (now.getTimezoneOffset() * 60000);
  var nd = utc + (3600000 * offset);
  var exp = new Date(nd);
  var domain = document.domain;
  exp.setTime(exp.getTime() + time * 60 * 60 * 1000);
  document.cookie = name + "=" + escape(value) + ";path=/;expires=" + exp.toGMTString() + ";domain=" + domain + ";"
}


function enter() {
	setCookie('agevarify', true, 180)
	window.location.href = '/';
}
</script>
@stop
@section('maincontent')
<div style="width: 100%; margin: 0 auto; padding-top: 50px;">
	<p align="center"><strong>No.1 @lang('default.description')休息站，帶你升天帶你飛，每天更新！</strong></p>
	<p align="center"><strong>本站依據TICRF網站分級制度進行分級，本站為限制級網站、未滿18歲、禁止進入</strong></p>
</div>
<div style="width: 350px;  border: 8px solid #ffb403; margin: 0 auto">
	<div style="text-align: center">
		<img src="/img/limit_18_01.gif?123" width="227" height="245"></td>
	</div>
	<div style="text-align: center">
		<img src="/img/limit_18_02.gif?123" width="328" height="145">
	</div>
	<div style="text-align: center; padding-bottom: 10px;">
		<a href="javascript:enter()"><img src="/img/limit_18_04.jpg?123" width="138" height="87"></a>
		<a href="https://www.tokyodisneyresort.jp/tc/index.html"><img src="/img/limit_18_03.jpg?123" width="138" height="87"></a>
	</div>
</div>
@stop                   