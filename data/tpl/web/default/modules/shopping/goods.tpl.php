<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php if($operation == 'post') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('goods', array('op' => 'post'))?>">添加商品</a></li>
	<li <?php if($operation == 'display') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('goods', array('op' => 'display'))?>">管理商品</a></li>
</ul>
<?php if($operation == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $item['id'];?>" />
		<h4>添加商品</h4>
		<table class="tb">
			<tr>
				<th><label for="">排序</label></th>
				<td>
					<input type="text" name="displayorder" class="span6" value="<?php echo $item['displayorder'];?>" />
				</td>
			</tr>
			<tr>
				<th>分类</th>
				<td>
					<select class="span3" style="margin-right:15px;" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
						<option value="0">请选择一级分类</option>
						<?php if(is_array($category)) { foreach($category as $row) { ?>
						<?php if($row['parentid'] == 0) { ?>
						<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $item['pcate']) { ?> selected="selected"<?php } ?>><?php echo $row['name'];?></option>
						<?php } ?>
						<?php } } ?>
					</select>
					<select class="span3" id="cate_2" name="ccate" autocomplete="off">
						<option value="0">请选择二级分类</option>
						<?php if(!empty($item['ccate']) && !empty($children[$item['pcate']])) { ?>
						<?php if(is_array($children[$item['pcate']])) { foreach($children[$item['pcate']] as $row) { ?>
						<option value="<?php echo $row['0'];?>" <?php if($row['0'] == $item['ccate']) { ?> selected="selected"<?php } ?>><?php echo $row['1'];?></option>
						<?php } } ?>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="">商品名称</label></th>
				<td>
					<input type="text" name="goodsname" class="span6" value="<?php echo $item['title'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">商品单位</label></th>
				<td>
					<input type="text" name="unit" class="span3" value="<?php echo $item['unit'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">商品类型</label></th>
				<td>
					<label for="isshow3" class="radio inline"><input type="radio" name="type" value="1" id="isshow3" <?php if(empty($item) || $item['type'] == 1) { ?>checked="true"<?php } ?> onclick="$('#product').show()" /> 实体商品</label>&nbsp;&nbsp;&nbsp;<label for="isshow4" class="radio inline"><input type="radio" name="type" value="2" id="isshow4"  <?php if($item['type'] == 2) { ?>checked="true"<?php } ?>  onclick="$('#product').hide()" /> 虚拟商品</label>
					<span class="help-block">虚拟商品，例如：优惠券，打折卡等，需要用户去店里消费使用的。实体商品，需要进行用户自提或是邮递的商品。</span>
				</td>
			</tr>
			<tr>
				<th><label for="">是否上架</label></th>
				<td>
					<label for="isshow1" class="radio inline"><input type="radio" name="status" value="1" id="isshow1" <?php if(empty($item) || $item['status'] == 1) { ?>checked="true"<?php } ?> /> 是</label>
					&nbsp;&nbsp;&nbsp;
					<label for="isshow2" class="radio inline"><input type="radio" name="status" value="0" id="isshow2"  <?php if(!empty($item) && $item['status'] == 0) { ?>checked="true"<?php } ?> /> 否</label>
					<span class="help-block"></span>
				</td>
			</tr>
			<tr>
				<th><label for="">缩略图</label></th>
				<td>
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"><?php if($item['thumb']) { ?><img src="<?php echo $_W['attachurl'];?><?php echo $item['thumb'];?>" width="200" /><?php } ?></div>
						<div>
							<span class="btn btn-file"><span class="fileupload-new">选择图片</span><span class="fileupload-exists">更改</span><input name="thumb" type="file" /></span>
							<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
							<?php if($item['thumb']) { ?><button type="submit" name="fileupload-delete" value="<?php echo $item['thumb'];?>" class="btn fileupload-new">删除</button><?php } ?>
						</div>
					</div>
					<span class="help-block"></span>
				</td>
			</tr>
			<tr>
				<th><label for="">商品编号</label></th>
				<td>
					<input type="text" name="goodssn" class="span6" value="<?php echo $item['goodssn'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">商品条码</label></th>
				<td>
					<input type="text" name="productsn" class="span6" value="<?php echo $item['productsn'];?>" />
				</td>
			</tr>
			<tr>
				<th><label for="">销售价</label></th>
				<td>
					<input type="text" name="marketprice" class="span3" value="<?php echo $item['marketprice'];?>" /> 元
				</td>
			</tr>
			<tr>
				<th><label for="">成本价</label></th>
				<td>
					<input type="text" name="productprice" class="span3" value="<?php echo $item['productprice'];?>" /> 元
				</td>
			</tr>
			<tr>
				<th><label for="">库存</label></th>
				<td>
					<input type="text" name="total" class="span3" value="<?php echo $item['total'];?>" />
					<span class="help-block">当前商品的库存数量，设置-1则表示不限制。</span>
				</td>
			</tr>
			<tr>
				<th>简介</th>
				<td>
					<textarea style="height:150px;" class="span7" name="description" cols="70"><?php echo $item['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th>内容</th>
				<td>
					<textarea style="height:400px; width:100%;" class="span7 richtext-clone" name="content" cols="70"><?php echo $item['content'];?></textarea>
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
<script type="text/javascript">
<!--
	var category = <?php echo json_encode($children)?>;
	kindeditor($('.richtext-clone'));
//-->
</script>
<?php } else if($operation == 'display') { ?>
<div class="main">
	<div class="search">
		<form action="index.php" method="get">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="do" value="goods" />
		<input type="hidden" name="op" value="display" />
		<input type="hidden" name="name" value="shopping" />
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>关键字</th>
					<td>
						<input class="span6" name="keyword" id="" type="text" value="<?php echo $_GPC['keyword'];?>">
					</td>
				</tr>
				<tr>
					<th>状态</th>
					<td>
						<select name="status">
							<option value="1" <?php if(!empty($_GPC['status'])) { ?> selected<?php } ?>>上架</option>
							<option value="0" <?php if(empty($_GPC['status'])) { ?> selected<?php } ?>>下架</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>分类</th>
					<td>
						<select class="span3" style="margin-right:15px;" name="cate_1" onchange="fetchChildCategory(this.options[this.selectedIndex].value)">
							<option value="0">请选择一级分类</option>
							<?php if(is_array($category)) { foreach($category as $row) { ?>
							<?php if($row['parentid'] == 0) { ?>
							<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $_GPC['cate_1']) { ?> selected="selected"<?php } ?>><?php echo $row['name'];?></option>
							<?php } ?>
							<?php } } ?>
						</select>
						<select class="span3" id="cate_2" name="cate_2">
							<option value="0">请选择二级分类</option>
							<?php if(!empty($_GPC['cate_1']) && !empty($children[$_GPC['cate_1']])) { ?>
							<?php if(is_array($children[$_GPC['cate_1']])) { foreach($children[$_GPC['cate_1']] as $row) { ?>
							<option value="<?php echo $row['0'];?>" <?php if($row['0'] == $_GPC['cate_2']) { ?> selected="selected"<?php } ?>><?php echo $row['1'];?></option>
							<?php } } ?>
							<?php } ?>
						</select>
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
					<th style="width:30px;">ID</th>
					<th style="min-width:150px;">商品标题</th>
					<th style="width:100px;">商品编号</th>
					<th style="width:100px;">商品条码</th>
					<th style="width:100px;">销售价/成本价</th>
					<th style="width:100px;">属性</th>
					<th style="text-align:right; min-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php echo $item['id'];?></td>
					<td><?php if(!empty($category[$item['pcate']])) { ?><span class="text-error">[<?php echo $category[$item['pcate']]['name'];?>] </span><?php } ?><?php if(!empty($children[$item['pcate']])) { ?><span class="text-info">[<?php echo $children[$item['pcate']][$item['ccate']]['1'];?>] </span><?php } ?><?php echo $item['title'];?></td>
					<td><?php echo $item['goodssn'];?></td>
					<td><?php echo $item['productsn'];?></td>
					<td style="background:#f2dede;"><?php echo $item['marketprice'];?>元 / <?php echo $item['productprice'];?>元</td>
					<td><?php if($item['status']) { ?><span class="label label-success">上架</span><?php } else { ?><span class="label label-error">下架</span><?php } ?>&nbsp;<span class="label label-info"><?php if($item['type'] == 1) { ?>实体商品<?php } else { ?>虚拟商品<?php } ?></span></td>
					<td style="text-align:right;">
						<a href="<?php echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;<a href="<?php echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
			<tr>
				<td></td>
				<td colspan="3">
					<input name="token" type="hidden" value="<?php echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr>
		</table>
		<?php echo $pager;?>
	</div>
</div>
<script type="text/javascript">
<!--
	var category = <?php echo json_encode($children)?>;
//-->
</script>
<?php } ?>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
