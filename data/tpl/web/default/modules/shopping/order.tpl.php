<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php if($operation == 'display') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('order', array('op' => 'display'))?>">管理订单</a></li>
</ul>
<?php if($operation == 'display') { ?>
<div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">ID</th>
					<th>订单号</th>
					<th style="width:50px;">姓名</th>
					<th style="width:80px;">电话</th>
					<th style="width:80px;">配送方式</th>
					<th style="width:50px;">总价</th>
					<th style="width:50px;">类型</th>
					<th style="width:50px;">状态</th>
					<th style="width:150px;">下单时间</th>
					<th style="width:120px; text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php echo $item['id'];?></td>
					<td><?php echo $item['ordersn'];?></td>
					<td><?php echo $users[$item['from_user']]['realname'];?></td>
					<td><?php echo $users[$item['from_user']]['mobile'];?></td>
					<td><?php if($item['goodstype']) { ?><?php if($item['sendtype'] == 1) { ?><span class="label label-info">快递</span><?php } else if($item['sendtype'] == 2) { ?><span class="label label-info">自提</span><?php } ?><?php } else { ?>无<?php } ?></td>
					<td><?php echo $item['price'];?> 元</td>
					<td><?php if($item['goodstype']) { ?>实物<?php } else { ?>虚拟<?php } ?></td>
					<td><?php if($item['status'] == 1) { ?><span class="label label-info">已付款</span><?php } ?><?php if($item['status'] == 2) { ?><span class="label label-success">已完成</span><?php } ?><?php if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php } ?></td>
					<td><?php echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<td style="text-align:right;"><a href="<?php echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['id']))?>">查看订单</a></td>
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
<?php } else if($operation == 'detail') { ?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<input type="hidden" name="id" value="<?php echo $item['id'];?>">
		<h4>订单信息</h4>
		<table class="tb">
			<tr>
				<th><label for="">订单号</label></th>
				<td>
					<?php echo $item['ordersn'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">价钱</label></th>
				<td>
					<?php echo $item['price'];?> 元
				</td>
			</tr>
			<tr>
				<th><label for="">配送方式</label></th>
				<td>
					<?php if($item['goodstype']) { ?><?php if($item['sendtype'] == 1) { ?><span class="label label-info">快递</span><?php } else if($item['sendtype'] == 2) { ?><span class="label label-info">自提</span><?php } ?><?php } else { ?>无<?php } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">付款方式</label></th>
				<td>
					<?php if($item['paytype'] == 1) { ?>余额支付<?php } ?>
					<?php if($item['paytype'] == 2) { ?>在线支付<?php } ?>
					<?php if($item['paytype'] == 3) { ?>货到付款<?php } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">订单状态</label></th>
				<td>
					<?php if($item['status'] == 1) { ?><span class="label label-info">已付款</span><?php } ?><?php if($item['status'] == 2) { ?><span class="label label-success">已完成</span><?php } ?><?php if($item['status'] == -1) { ?><span class="label label-error">已关闭</span><?php } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">下单日期</label></th>
				<td>
					<?php echo date('Y-m-d H:i:s', $item['createtime'])?>
				</td>
			</tr>
			<tr>
				<th>备注</th>
				<td>
					<textarea style="height:150px;" class="span7" name="remark" cols="70"><?php echo $item['remark'];?></textarea>
				</td>
			</tr>
		</table>
		<h4>用户信息</h4>
		<table class="tb">
			<tr>
				<th><label for="">姓名</label></th>
				<td>
					<?php echo $item['user']['realname'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">手机</label></th>
				<td>
					<?php echo $item['user']['mobile'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">QQ</label></th>
				<td>
					<?php echo $item['user']['qq'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">地址</label></th>
				<td>
					<?php echo $item['user']['resideprovince'];?> - <?php echo $item['user']['residecity'];?> - <?php echo $item['user']['residedist'];?> - <?php echo $item['user']['address'];?>
				</td>
			</tr>
		</table>
		<h4>商品信息</h4>
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">ID</th>
					<th style="min-width:150px;">商品标题</th>
					<th style="width:100px;">商品编号</th>
					<th style="width:100px;">商品条码</th>
					<th style="width:100px;">销售价/成本价</th>
					<th style="width:100px;">属性</th>
					<th style="width:100px;">数量</th>
					<th style="text-align:right; min-width:60px;">操作</th>
				</tr>
			</thead>
			<?php if(is_array($item['goods'])) { foreach($item['goods'] as $item) { ?>
			<tr>
				<td><?php echo $item['id'];?></td>
				<td><?php if($category[$item['pcate']]['name']) { ?><span class="text-error">[<?php echo $category[$item['pcate']]['name'];?>] </span><?php } ?><?php if($children[$item['pcate']][$item['ccate']]['1']) { ?><span class="text-info">[<?php echo $children[$item['pcate']][$item['ccate']]['1'];?>] </span><?php } ?><?php echo $item['title'];?></td>
				<td><?php echo $item['goodssn'];?></td>
				<td><?php echo $item['productsn'];?></td>
				<!--td><?php echo $category[$item['pcate']]['name'];?> - <?php echo $children[$item['pcate']][$item['ccate']]['1'];?></td-->
				<td style="background:#f2dede;"><?php echo $item['marketprice'];?>元 / <?php echo $item['productprice'];?>元</td>
				<td><?php if($item['status']) { ?><span class="label label-success">上架</span><?php } else { ?><span class="label label-error">下架</span><?php } ?>&nbsp;<span class="label label-info"><?php if($item['type'] == 1) { ?>实体商品<?php } else { ?>虚拟商品<?php } ?></span></td>
				<td><?php echo $goodsid[$item['id']]['total'];?></td>
				<td style="text-align:right;">
					<a href="<?php echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;<a href="<?php echo $this->createWebUrl('goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
				</td>
			</tr>
			<?php } } ?>
		</table>
		<table class="tb">
			<tr>
				<th></th>
				<td>
					<?php if(empty($item['status'])) { ?>
					<button type="submit" class="btn btn-primary span2" onclick="return confirm('确认付款此订单吗？'); return false;" name="confrimpay" onclick="" value="完成">确认付款</button>
					<?php } ?>
					<?php if($item['status'] == 1) { ?>
					<button type="submit" class="btn btn-primary span2" onclick="return confirm('确认完成此订单吗？'); return false;" name="finish" onclick="" value="完成">完成订单</button>
					<?php } ?>
					<?php if($item['status'] == 2) { ?>
					<button type="submit" class="btn btn-primary span2" name="cancel" value="正常" onclick="return confirm('确认取消完成此订单吗？'); return false;">取消完成</button>
					<button type="submit" class="btn btn-primary span2" name="cancelpay" value="正常" onclick="return confirm('确认取消付款此订单吗？'); return false;">取消付款</button>
					<?php } ?>
					<?php if($item['status'] != -1) { ?>
					<button type="submit" class="btn span2" name="close" onclick="return confirm('确认关闭此订单吗？'); return false;" value="关闭">关闭订单</button>
					<?php } else { ?>
					<button type="submit" class="btn span2 btn-primary" name="cancelpay" onclick="return confirm('确认开启此订单吗？'); return false;" value="关闭">开启订单</button>
					<?php } ?>
					<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<?php } ?>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
