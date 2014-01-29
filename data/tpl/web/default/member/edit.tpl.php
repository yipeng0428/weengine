<?php defined('IN_IA') or exit('Access Denied');?><?php include template('common/header', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript">
	function checkProfile() {
		if($('#password').val() != $('#repassword').val()) {
			message('两次输入的密码不一致.', '', 'error');
			return false;
		}
		return true;
	}
</script>
<style>
.form th {
	width: auto;
}
</style>
<ul class="nav nav-tabs">
	<li><a href="<?php echo create_url('member/create');?>">添加用户</a></li>
	<li><a href="<?php echo create_url('member/display');?>">用户列表</a></li>
	<li class="active"><a href="<?php echo create_url('member/edit', array('uid' => $uid));?>">编辑用户</a></li>
</ul>
<div class="main">
	<form action="" class="form-horizontal form" onsubmit="return checkProfile();" method="post">
	<h4>编辑用户基本资料</h4>
	<table class="tb" style="margin-top:10px;">
		<tr>
			<th style="width:90px;"><label for="">用户名</label></th>
			<td>
				<span class="uneditable-input span6"><?php echo $member['username'];?></span>
				<span class="help-block">当前编辑的用户名</span>
			</td>
		</tr>
		<tr>
			<th><label for="">新密码</label></th>
			<td>
				<input id="password" name="password" type="password" class="span6" value="" />
				<span class="help-block">请填写密码，最小长度为 8 个字符</span>
			</td>
		</tr>
		<tr>
			<th><label for="">确认新密码</label></th>
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
					<option value="<?php echo $row['id'];?>" <?php if($member['groupid'] == $row['id']) { ?>selected<?php } ?>><?php echo $row['name'];?></option>
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
			<th><label for="">上次登录时间</label></th>
			<td>
				<input id="lastvisit" name="lastvisit" type="text" class="span6" value="<?php echo date('Y-m-d H:i:s', $member['lastvisit']);?>" />
			</td>
		</tr>
		<tr>
			<th><label for="">上次登录IP</label></th>
			<td>
				<input id="lastip" name="lastip" type="text" class="span6" value="<?php echo $member['lastip'];?>" />
			</td>
		</tr>
	</table>
	<?php if(!empty($extendfields)) { ?>
	<h4>编辑用户扩展资料</h4>
	<table class="tb" style="margin-top:10px;">
		<?php if($extendfields) { ?>
			<?php if(is_array($extendfields)) { foreach($extendfields as $item) { ?>
			<tr>
				<th style="width:90px;"><label for=""><?php echo $item['title'];?></label></th>
				<td><?php echo tpl_fans_form($item['field'], $member['profile'][$item['field']])?></td>
			</tr>
			<?php } } ?>
		<?php } ?>
	</table>
	<?php } ?>
	<table class="tb" style="margin-top:10px;">
		<tr>
			<td colspan="2">
				<input type="submit" class="btn btn-primary span3" name="profile_submit" value="保存用户资料" /><input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
			</td>
		</tr>
	</table>
	</form>
</div>
<?php include template('common/footer', TEMPLATE_INCLUDEPATH);?>
