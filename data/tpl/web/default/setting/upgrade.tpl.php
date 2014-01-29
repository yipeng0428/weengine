<?php defined('IN_IA') or exit('Access Denied');?><?php include template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li<?php if($do == 'upgrade') { ?> class="active"<?php } ?>><a href="<?php echo create_url('setting/upgrade');?>">自动更新</a></li>
	<li<?php if($do == 'history') { ?> class="active"<?php } ?>><a href="<?php echo create_url('setting/upgrade/history');?>">未成功的自动更新(需要手动更新)</a></li>
</ul>
<?php if($do == 'upgrade') { ?>
<div class="main">
	<div style="padding:15px;">
		<div class="alert alert-error" style="">
			<i class="icon-warning-sign"></i> 更新时请注意备份网站数据和相关数据库文件！官方不强制要求用户跟随官方意愿进行更新尝试！
		</div>
		<form action="" method="post" class="form-horizontal form" <?php if(!$upgrade || !$upgrade['upgrade']) { ?>onsubmit="return agreement();"<?php } ?>>
			<?php if(!$upgrade || !$upgrade['upgrade']) { ?>
			<table class="tb">
				<tr>
					<th>更新协议</th>
					<td>
						<label class="checkbox"><input type="checkbox" id="agreement_0"> 我已经做好了相关文件的备份工作</label>
						<label class="checkbox"><input type="checkbox" id="agreement_1"> 认同官方的更新行为并自愿承担更新所存在的风险</label>
						<label class="checkbox"><input type="checkbox" id="agreement_2"> 理解官方的辛勤劳动并报以感恩的心态点击更新按钮</label>
					</td>
				</tr>
				<tr>
					<th>检查新版</th>
					<td>
						<input name="check-update" type="submit" value="立即检查新版本" class="btn" />
						<div class="help-block">当前系统未检测到有新版本, 你可以点击此按钮, 来立即检查一次.</div>
					</td>
				</tr>
			</table>
			<?php } else { ?>
			<table class="tb">
				<tr>
					<th>版本</th>
					<td>
						<label>
							<i class="icon-check-empty"> &nbsp; 系统当前版本: v<?php echo IMS_VERSION?></i>
						</label>
						<?php if($upgrade['version'] != IMS_VERSION) { ?>
						<label>
							<i class="icon-check-empty"> &nbsp; 存在的新版本: v<?php echo $upgrade['version'];?></i>
						</label>
						<?php } ?>
						<div class="help-block">在一个发布版中可能存在多次补丁, 因此版本可能未更新</div>
					</td>
				</tr>
				<tr>
					<th>发布日期</th>
					<td>
						<label>
							<i class="icon-check-empty"> &nbsp; 系统当前Release版本: v<?php echo IMS_RELEASE_DATE?></i>
						</label>
						<?php if($upgrade['release'] != IMS_RELEASE_DATE) { ?>
						<label>
							<i class="icon-check-empty"> &nbsp; 存在的新Release版本: v<?php echo $upgrade['release'];?></i>
						</label>
						<?php } ?>
						<div class="help-block">系统会检测当前程序文件的变动, 如果被病毒或木马非法篡改, 会自动警报并提示恢复至默认版本, 因此可能修订日期未更新而文件有变动</div>
					</td>
				</tr>
				<?php if($upgrade['announcement']) { ?>
				<tr>
					<th>更新通告</th>
					<td>
						<?php echo $upgrade['announcement'];?>
					</td>
				</tr>
				<?php } ?>
				<?php if($upgrade['schemas']) { ?>
				<tr>
					<th>数据库变动</th>
					<td>
						<div class="help-block"><strong>注意: 重要: 本次更新涉及到数据库变动, 请做好备份.</strong></div>
					</td>
				</tr>
				<?php } ?>
				<?php if($upgrade['attachments']) { ?>
				<tr>
					<th>文件变动</th>
					<td>
						<div class="help-block"><strong>注意: 重要: 本次更新涉及到程序变动, 请做好备份.</strong></div>
						<div class="alert alert-info" style="line-height:20px;margin-top:20px;">
						<?php if(is_array($upgrade['attachments'])) { foreach($upgrade['attachments'] as $line) { ?>
						<div><span style="display:inline-block; width:30px;"><?php if(is_file(IA_ROOT . $line)) { ?>M<?php } else { ?>A<?php } ?></span><?php echo $line;?></div>
						<?php } } ?>
						</div>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<th>自动更新</th>
					<td>
						<input name="do-update" type="submit" value="立即更新" class="btn" onclick="return confirm('更新将直接覆盖本地文件, 请注意备份文件和数据. \n\n**另注意** 更新过程中不要关闭此浏览器窗口.');" />
						<input type="hidden" name="hash" value="<?php echo $hash;?>" />
						<div class="help-block">立即更新当前系统</div>
					</td>
				</tr>
			</table>
			<?php } ?>
		</form>
	</div>
</div>
<?php } ?>
<?php if($do == 'history') { ?>
<div class="main">
	<div style="padding:15px;">
		<?php if(empty($ds)) { ?>
		<div class="alert alert-info">
			没有需要手动升级的文件
		</div>
		<?php } else { ?>
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="min-width:300px;">版本说明</th>
					<th style="width:160px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($ds)) { foreach($ds as $row) { ?>
				<tr>
					<td>Release 版本升级: <?php echo $row['title'];?></td>
					<td>
						<?php if($row['error']) { ?>
						<a href="<?php echo create_url('setting/upgrade/history', array('foo' => 'delete', 'version' => $row['title']));?>">版本已失效, 请删除</a>
						<?php } else { ?>
						<?php if($row['current']) { ?>
						<a href="<?php echo create_url('setting/upgrade/history', array('foo' => 'manual', 'version' => $row['title']));?>">升级</a>
						<?php } else { ?>
						升级只能按照版本顺序升级
						<?php } ?>
						<?php } ?>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
		<?php } ?>
	</div>
</div>
<?php } ?>
<script>
function agreement() {
	var a = $("#agreement_0").is(':checked');
	var b = $("#agreement_1").is(':checked');
	var c = $("#agreement_2").is(':checked');
	if(a && b && c) {
		return true;
	} else {
		message("抱歉，更新前请仔细阅读更新协议！", location.href, 'error');
		return false;
	}
}
</script>
<?php include template('common/footer', TEMPLATE_INCLUDEPATH);?>
