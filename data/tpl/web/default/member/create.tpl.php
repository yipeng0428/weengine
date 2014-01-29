<?php defined('IN_IA') or exit('Access Denied');?><?php include template('common/header', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript">
	function check() {
		if($.trim($(':text[name="username"]').val()) == '') {
			message('没有输入用户名.', '', 'error');
			return false;
		}
		if($('#password').val() == '') {
			message('没有输入密码.', '', 'error');
			return false;
		}
		if($('#password').val() != $('#repassword').val()) {
			message('两次输入的密码不一致.', '', 'error');
			return false;
		}
		return true;
	}
</script>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php echo create_url('member/create');?>">添加用户</a></li>
	<li><a href="<?php echo create_url('member/display');?>">用户列表</a></li>
</ul>
<div class="main">
	<form action="" class="form-horizontal form" onsubmit="return check();" method="post">
		<h4>添加新用户</h4>
		<table class="tb">
			<tr>
				<th><label for="">用户名</label></th>
				<td>
					<input id="" name="username" type="text" class="span6" value="<?php echo $member['username'];?>" />
					<span class="help-block">请输入用户名，用户名为 3 到 15 个字符组成，包括汉字，大小写字母（不区分大小写）</span>
				</td>
			</tr>
			<tr>
				<th><label for="">密码</label></th>
				<td>
					<input id="password" name="password" type="password" class="span6" value="" />
					<span class="help-block">请填写密码，最小长度为 8 个字符</span>
				</td>
			</tr>
			<tr>
				<th><label for="">确认密码</label></th>
				<td>
					<input id="repassword" type="password" class="span6" value="" />
					<span class="help-block">重复输入密码，确认正确输入</span>
				</td>
			</tr>
			<tr>
				<th><label for="">所属用户组</label></th>
				<td>
					<select name="groupid">
						<option value="0">请选择所属用户组</option>
						<?php if(is_array($groups)) { foreach($groups as $row) { ?>
						<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
						<?php } } ?>
					</select>
					<span class="help-block">分配用户所属用户组后，该用户会自动拥有此用户组内的模块操作权限</span>
				</td>
			</tr>
			<tr>
				<th><label for="">备注</label></th>
				<td>
					<textarea id="" name="remark" style="height:80px;" class="span6"><?php echo $member['remark'];?></textarea>
					<span class="help-block">方便注明此用户的身份</span>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="submit" class="btn btn-primary span2" name="submit" value="确认注册" /><input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include template('common/footer', TEMPLATE_INCLUDEPATH);?>
