<h5 id='userinfo'style="COLOR: #ccc; font-weight: bold;">用戶资讯</h5>
				
<div class="container">
	<table class="row userinfo">
		<tr class="nav-item " width= '100%'>
			<td class="title">帐号</td>
			<td class="">{{$user->login_account}}</td>
		</tr>	
		<tr class="nav-item">
			<td class="title">暱称</td>
			<td class="">
				<div  data-id="1" id="edit1"  class="edit"><div id="infoTxt1">{{$user->nick_name}}</div>&nbsp;&nbsp;<i  data-id="1"  class=" far fa-edit"></i></div>
				<div  data-id="1" id="input1" style="display:none"><input id="inputbox1" maxlength="20"  value="{{$user->nick_name}}">&nbsp;
					<div data-id="1" class="input correct"><i class=" far fa-check-circle"></i></div>
					<div data-id="1" class="input wrong"><i class=" far fa-times-circle"></i></div>
				</div>
			</td>
		</tr>	
		<tr class="nav-item">
			<td class="title">{{config('app.webAccountText')}}会员号</td> 
			<td class="">
				<div   data-id="2" id="edit2" class="edit"><div id="infoTxt2">{{$user->aaccount}}</div>&nbsp;&nbsp;<i  data-id="2" class=" far fa-edit"></i></div>
				<div  data-id="2" id="input2"  style="display:none"><input id="inputbox2" maxlength="20" value="{{$user->aaccount}}">&nbsp;
					<div data-id="2" class="input correct"><i class=" far fa-check-circle"></i></div>
					<div data-id="2" class="input wrong"><i class=" far fa-times-circle"></i></div>
				</div>
			</td>
		</tr>
		<tr class="nav-item">
			<td class="title">微信号</td> 
			<td class="">
					<div  data-id="3" id="edit3" class="edit"><div id="infoTxt3">{{$user->wechat}}</div>&nbsp;&nbsp;<i   data-id="3" class="far fa-edit"></i></div>
					<div  data-id="3" id="input3" style="display:none"><input maxlength="20"  id="inputbox3" value="{{$user->wechat}}">&nbsp;
						<div data-id="3" class="input correct"><i class=" far fa-check-circle"></i></div>
						<div data-id="3" class="input wrong"><i class=" far fa-times-circle"></i></div>
					</div>
				</td>
		</tr>
		<tr class="nav-item">
			<td class="title">註册时间</td> 
			<td class="">{{$user->created_at}}</td>
		</tr>
	</table>
</div>
	
