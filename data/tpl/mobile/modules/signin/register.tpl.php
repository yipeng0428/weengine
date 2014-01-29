<?php defined('IN_IA') or exit('Access Denied');?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人资料</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="./source/modules/signin/template/style/css/fans.css" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
</head>

<body id="fans" >
<div class="qiandaobanner"> <a href=""><img src="http://bcs.duapp.com/baeimg/fBc6FjGtff.jpg" ></a> </div>
<div class="cardexplain">
<!--个人头像，昵称等-->
<ul class="round" style="display:none">
<li class="dandanb"><a href="3g.php"><span class="none"><img src="index/images/logo100x100.jpg">
</span></a> </li>
</ul>

<ul class="round">
<li class="title mb"><span class="none">用户资料</span></li>
<li class="nob">
<div class="beizhu">请认真填写以下信息</div>
</li> 

<form action="" method="post" data-ajax="false" onsubmit="return check(this)">

<li  class="nob">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>真实姓名</th>
<td><input name="realname"  type="text" class="px" id="realname" value="" placeholder="请输入您的真实姓名"></td>
</tr>
</table>
</li>

<li  class="nob">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>联系电话</th>
<td><input name="mobile"  class="px" id="mobile" value=""  type="text" placeholder="请输入您的电话"></td>
</tr>
</table>
</li>


<li  class="nob">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>性别</th>
<td><select name="gender" class="dropdown-select" id="gender">
<option  value="" >请选择你的性别</option>
<option  value="1">男</option>
<option  value="2">女</option>
</select></td>
</tr>
</table>
</li>


<div class="footReturn">
<input type="submit" name="submit" id="submit" class="submit" style="width:100%" data-theme="a" data-icon="check" value="提交登记" />
<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />


<div class="window" id="windowcenter">
<div id="title" class="wtitle">操作提示<span class="close" id="alertclose"></span></div>
<div class="content">
<div id="txt"></div>
</div>
</div>
</div>
</form>
</ul>

 
<script type="text/javascript">
	function check(form) {
		if (!form['realname'].value) {
			alert('请输入您的真实姓名！');
			return false;
		}
		if (!form['mobile'].value) {
			alert('请输入您的手机号码！');
			return false;
		}
		if (!/^1[358]{1}[0-9]{9}/.test(form['mobile'].value)) {
			alert('请输入正确的手机号码！');
			return false;
		}
		return true;
	}
</script>
 
</div>
</body>
</html>
