<?php defined('IN_IA') or exit('Access Denied');?><input type="hidden" name="reply_id" value="<?php echo $reply['id'];?>" />
<div class="alert alert-block alert-new">
	<a class="close" data-dismiss="alert">×</a>
	<h4 class="alert-heading">添加签到信息</h4>
	<table>
		<tbody>
		
			<tr>
				<th>超出签到时间提示</th>
				<td><input type="text" value="<?php echo $reply['overtime'];?>" class="span7" name="overtime" id="overtime">
					<div class="help-block">用户签到超出时间范围的提示，如果未设置则默认为每日早8点至晚10点。</div></td>
			</tr>

			<tr>
				<th>超出签到次数提示</th>
				<td><input type="text" value="<?php echo $reply['overnum'];?>" class="span7" name="overnum" id="overnum">
					<div class="help-block">用户签到超出次数的提示，如果未设置则默认为每日1次。<a class="iconEmotion" href="javascript:;" inputid="enter-tips"><i class="icon-github-alt"></i> 表情</a></div></td>
			</tr>

		</tbody>
	</table>
</div>
