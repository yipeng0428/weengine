<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<ul class="nav nav-tabs">
		<li<?php if($_GPC['do'] == 'display') { ?> class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('display');?>">商户管理</a></li>
		<li<?php if($_GPC['do'] == 'post') { ?> class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('post');?>">添加商户</a></li>
	</ul>
	<div class="search">
		<form action="index.php" method="get">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="do" value="display" />
		<input type="hidden" name="name" value="business" />
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>关键字</th>
					<td>
						<input class="span6" name="keyword" id="" type="text" value="<?php echo $_GPC['keyword'];?>">
					</td>
				</tr>
				<tr>
					<th>行业</th>
					<td>
						<select name="industry_1" id="industry_1" value="<?php echo $_GPC['industry_1'];?>"></select>
						<select name="industry_2" id="industry_2" value="<?php echo $_GPC['industry_2'];?>"></select>
					</td>
				</tr>
				<tr>
				 <tr class="search-submit">
					<td colspan="2"><button class="btn pull-right span2"><i class="icon-search icon-large"></i> 搜索</button></td>
				 </tr>
			</tbody>
		</table>
		</form>
	</div>
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:200px;">名称</th>
					<th style="width:200px;">行业</th>
					<th style="width:100px;">电话</th>
					<th style="">地址</th>
					<th style="min-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php echo $item['title'];?></td>
					<td><?php echo $item['industry1'];?>&nbsp;<?php echo $item['industry2'];?></td>
					<td><?php echo $item['phone'];?></td>
					<td><?php echo $item['province'];?>-<?php echo $item['city'];?>-<?php echo $item['dist'];?>-<?php echo $item['address'];?></td>
					<td><span><a href="<?php echo $this->createWebUrl('post', array('id' => $item['id']))?>">编辑</a>&nbsp;<a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php echo $this->createWebUrl('delete', array('id' => $item['id']))?>">删除</a></span></td>
				</tr>
				<?php } } ?>
			</tbody>
			<tr>
				<td colspan="5">
					<input name="token" type="hidden" value="<?php echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr>
		</table>
		<?php echo $pager;?>
	</div>
</div>
<script type="text/javascript" src="./source/modules/business/images/industry.js"></script>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
