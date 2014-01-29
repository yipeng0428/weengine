<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php if($operation == 'post') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('category', array('op' => 'post'))?>">添加分类</a></li>
	<li <?php if($operation == 'display') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('category', array('op' => 'display'))?>">管理分类</a></li>
</ul>
<?php if($operation == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
	<input type="hidden" name="parentid" value="<?php echo $parent['id'];?>" />
		<h4>分类详细设置</h4>
		<table class="tb">
			<?php if(!empty($parentid)) { ?>
			<tr>
				<th><label for="">上级分类</label></th>
				<td>
					<?php echo $parent['name'];?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th><label for="">排序</label></th>
				<td>
					<input type="text" name="displayorder" class="span6" value="<?php echo $category['displayorder'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">分类名称</label></th>
				<td>
					<input type="text" name="catename" class="span6" value="<?php echo $category['name'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">分类描述</label></th>
				<td>
					<textarea name="description" class="span6" cols="70"><?php echo $category['description'];?></textarea>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
					<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript" src="./resource/script/colorpicker/spectrum.js"></script>
<link type="text/css" rel="stylesheet" href="./resource/script/colorpicker/spectrum.css" />
<script type="text/javascript">
<!--
	$(function(){
		colorpicker();
	});
//-->
</script>
<?php } else if($operation == 'display') { ?>
<div class="main">
	<div class="category">
		<form action="" method="post" onsubmit="return formcheck(this)">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:10px;"></th>
					<th style="width:60px;">显示顺序</th>
					<th>分类名称</th>
					<th style="width:80px;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($category)) { foreach($category as $row) { ?>
				<tr>
					<td><?php if(count($children[$row['id']]) > 0) { ?><a href="javascript:;"><i class="icon-chevron-down"></i></a><?php } ?></td>
					<td><input type="text" class="span1" name="displayorder[<?php echo $row['id'];?>]" value="<?php echo $row['displayorder'];?>"></td>
					<td><div class="type-parent"><?php echo $row['name'];?>&nbsp;&nbsp;<?php if(empty($row['parentid'])) { ?><a href="<?php echo $this->createWebUrl('category', array('parentid' => $row['id'], 'op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加子分类</a><?php } ?></div></td>
					<td><a href="<?php echo $this->createWebUrl('category', array('op' => 'post', 'id' => $row['id']))?>">编辑</a>&nbsp;&nbsp;<a href="<?php echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;">删除</a></td>
				</tr>
				<?php if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $row) { ?>
				<tr>
					<td></td>
					<td><input type="text" class="span1" name="displayorder[<?php echo $row['id'];?>]" value="<?php echo $row['displayorder'];?>"></td>
					<td><div class="type-child"><?php echo $row['name'];?>&nbsp;&nbsp;</div></td>
					<td><a href="<?php echo $this->createWebUrl('category', array('op' => 'post', 'id' => $row['id']))?>">编辑</a>&nbsp;&nbsp;<a href="<?php echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;">删除</a></td>
				</tr>
				<?php } } ?>
			<?php } } ?>
				<tr>
					<td></td>
					<td colspan="4">
						<a href="<?php echo $this->createWebUrl('category', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加新分类</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4">
						<input name="submit" type="submit" class="btn btn-primary" value="提交">
						<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
</div>
<?php } ?>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
