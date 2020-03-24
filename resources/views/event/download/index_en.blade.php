<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Secret</title>
    <meta property="og:title" content="Secret"/>
    <meta property="og:description" content="Your first choice, awesome APP with abundant videos for you to watch. No registration required with daily updates."/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="http://www.gporn.cc"/>
    <meta property="og:image" content="http://www.gporn.cc/event/download/img/main-base.jpg"/>
    <meta name="HandheldFriendly" content="true">   
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="/event/download/css/reset.css" rel="stylesheet" type="text/css">
    <link href="/event/download/css/animate.css" rel="stylesheet" type="text/css">
    <link href="/event/download/css/css.txt" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/event/download/js/jquery.min.js" language="javascript"></script>
    <link href="/event/download/css/landing.css?v=123" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/event/download/img/app-icon.png">
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
					setCookie('appdl', true, 3600);
				}
				
                function go_android(){
					var r = confirm("You must be at least eighteen (18) years of age!");
					if (r == true) {
		    				//window.location.replace("http://www.gporn.cc/event/apk/download?pkgname=sex.gporn.apk");
		    				alert("Coming sooooooon!")
					} else {
		    				alert("You are sincere, but unfortunately no gold axe can give you!");
					}
                }
                
				function go_paypal(){
					window.location.replace("/event/app/payment/paypal");
                }
				
				/*
                function go_ios(){
                        var r = confirm("請問您是否成年，年滿18歲？");
                        if (r == true) {
                        	if(is_ios()) {
                                	alert("請先刪除舊版程式才能安裝。安裝後請到：設定 > 一般 > 裝置管理，點擊信任後便可開始使用。");
									window.location.replace("http://www.gporn.cc");
                        	} else {
                                	alert("請直接用 iOS 手機或平板開啟連結安裝。");
                        	}
                        } else {
                                alert("您真誠實，可惜沒有金斧頭可以給你，祝您早日長大！");
                        }
                }

                function is_ios() {
                        var userAgent = navigator.userAgent || navigator.vendor || window.opera;
                        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                                return true;
                        }

                        return false;
                }
                */     
        </script>
</head>
<body onload="enter()">
    <div id="header">
      <div class="max-container cf">
        <a href="/" id="header-logo"><img src="/event/download/img/app-icon.png" alt="AV TV" id="header-logo-img"><img src="/event/download/img/app-icon.png" id="header-logo-img-small" style="display:none;"></a>
        <ul id="header-nav">
			<li class="header-nav-item ct1"><a href="javascript:go_android();" target="_blank">Android</a></li>
			<!--<li class="header-nav-item ct1"><a href="javascript:go_ios();" target="_blank">iOS</a></li>
			<li class="header-nav-item ct1"><a href="mailto:">與我們聯絡</a></li>
          	<li class="header-nav-item ct1"><a href="mailto:">合作提案</a></li>
          	-->
        </ul>
      </div>
    </div>
	
    <!-- COVER -->
    <div id="cover" class="animated fadeIn"></div>
    <!-- END COVER -->
     
    <!-- HERO -->
    <div id="center-table">
      <div id="center-cell">
        <div id="hero-container" class="cf animated fadeInUp">
          <div id="hero-content">
            <img src="/event/download/img/app-icon.png" width="72" height="72" id="hero-icon">
            <h1 id="hero-title" class="ct1">Secret</h1>
            <p id="hero-message" class="ct1">Your first choice, awesome APP with abundant videos for you to watch. No registration required with daily updates.</p>
            <div id="hero-stores">
              <a href="javascript:go_android();" target="_blank"><img src="/event/download/img/badge-play-store3.png" alt="Get it on Google Play" class="hero-store-badge"></a>
            </div>
            <p>
            <div id="hero-stores">
				<h1 id="hero-message" class="ct1">Get Access Now!</h1>
				<a href="javascript:go_paypal();" target="_blank"><img src="/event/download/img/170_paypal.png" alt="Get it on Google Play" class="hero-store-badge" style="width: 85px"></a>					<input type="hidden" name="cmd" value="_s-xclick">
            </div>
            </p>
          </div>
          <div id="hero-device">
            <div id="hero-device-screen">
              <img src="/event/download/img/iphone-screen2.jpg" class="screen">
            </div>
            <img src="/event/download/img/htc.png" id="hero-device-base">
          </div>
          <br style="clear:both;">
        </div>
      </div>
    </div>
    <!--[if lt ie 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>  
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</body></html>
