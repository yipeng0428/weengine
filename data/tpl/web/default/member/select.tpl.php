<?php defined('IN_IA') or exit('Access Denied');?><?php if($do == 'account') { ?>
<div class="main">
	<div class="search">
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>公众号名称</th>
					<td><input id="wKeyword" type="text" class="span6" value="<?php echo $_GPC['keyword'];?>" /></td>
				</tr>
				 <tr class="search-submit">
					 <td colspan="2"><button class="btn pull-right span2" onclick="aW.query();"><i class="icon-search icon-large"></i> 搜索</button></td>
				 </tr>
			</tbody>
		</table>
	</div>
	<div class="account">
		<table class="table table-bordered tb">
			<thead>
				<tr>
					<th>公众号码</th>
					<th>当前所属用户</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($wechats)) { foreach($wechats as $row) { ?>
				<tr>
					<td><?php echo $row['name'];?></td>
					<td><?php if($row['owner']) { ?><span class="label label-success">当前用户</span><?php } else { ?><?php echo $row['member']['username'];?><?php } ?></td>
					<td><?php if($row['owner']) { ?><a href="javascript:;" onclick="aW.revo('<?php echo $row['weid'];?>');">收回管理权限</a><?php } else { ?><a href="javascript:;" onclick="aW.auth('<?php echo $row['weid'];?>');">授权此用户管理</a><?php } ?></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
		<?php echo $pager;?>
	</div>
</div>
<?php } ?>
<?php if($do == 'module') { ?>
<div class="main">
	<div class="account">
		<table class="table table-bordered tb">
			<thead>
				<tr>
					<th>模块名称</th>
					<th>模块标识</th>
					<th>功能简述</th>
					<th>可访问否</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($modules)) { foreach($modules as $row) { ?>
				<tr>
					<td><?php echo $row['title'];?></td>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['ability'];?></td>
					<td><?php if($row['owner']) { ?><span class="label label-success">可访问</span><?php } ?><?php if($row['issystem']) { ?><span class="label label-success">系统模块</span><?php } ?></td>
					<td><?php if(!empty($groupsmodules['modules']) && in_array($row['mid'], $groupsmodules['modules'])) { ?><span class="label label-info">继承用户组</span><?php } else { ?><?php if(!$row['issystem']) { ?><?php if($row['owner']) { ?><a href="javascript:;" onclick="aM.revo('<?php echo $row['mid'];?>');">收回访问权限</a><?php } else { ?><a href="javascript:;" onclick="aM.auth('<?php echo $row['mid'];?>');">授权此用户访问</a><?php } ?><?php } ?><?php } ?></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
		<?php echo $pager;?>
	</div>
</div>
<?php } ?>
<?php if($do == 'template') { ?>
<div class="main">
	<div class="account">
		<table class="table table-bordered tb">
			<thead>
				<tr>
					<th>模板名称</th>
					<th>模板标识</th>
					<th>功能简介</th>
					<th>可访问否</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($templates)) { foreach($templates as $temp) { ?>
				<tr>
					<td><?php echo $temp['title'];?></td>
					<td><?php echo $temp['name'];?></td>
					<td><?php echo $temp['description'];?></td>
					<td><?php if($temp['owner']) { ?><span class="label label-success">可访问</span><?php } ?><?php if($temp['name'] == 'default') { ?><span class="label label-success">系统模块</span><?php } ?></td>
					<td><?php if(!empty($groupsmodules['templates']) && in_array($temp['id'], $groupsmodules['templates'])) { ?><span class="label label-info">继承用户组</span><?php } else { ?><?php if($temp['name'] != 'default') { ?><?php if($temp['owner']) { ?><a href="javascript:;" onclick="aT.revo('<?php echo $temp['id'];?>');">收回访问权限</a><?php } else { ?><a href="javascript:;" onclick="aT.auth('<?php echo $temp['id'];?>');">授权此用户访问</a><?php } ?><?php } ?><?php } ?></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
		<?php echo $pager;?>
	</div>
</div>
<?php } ?>

