<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $goodsid;?>" />
<div class="mobile-img">
	<?php if(!empty($goods['thumb'])) { ?><img src="<?php echo $_W['attachurl'];?><?php echo $goods['thumb'];?>" /><?php } ?>
</div>
<div class="mobile-div img-rounded">
	<div class="mobile-hd">商品详细描述</div>
	<div class="mobile-content">
		<?php echo $goods['content'];?>
	</div>
</div>
<div class="mobile-div img-rounded">
	<div class="mobile-hd">商品其他信息</div>
	<div class="mobile-content">
		<table class="form-table">
			<tr>
				<th>名称</th>
				<td><span class="uneditable-input"><?php echo $goods['title'];?></span></td>
			</tr>
			<tr>
				<th>售价</th>
				<td><span class="uneditable-input"><?php echo $goods['marketprice'];?>/<?php echo $goods['unit'];?></span></td>
			</tr>
			<?php if($goods['type'] == 1) { ?>
			<tr>
				<th>商品编号</th>
				<td><span class="uneditable-input"><?php echo $goods['goodssn'];?></span></td>
			</tr>
			<tr>
				<th>条形码</th>
				<td><span class="uneditable-input"><?php echo $goods['productsn'];?></span></td>
			</tr>
			<?php } ?>
			<?php if($goods['total'] != -1) { ?>
			<tr>
				<th>库存</th>
				<td><span class="uneditable-input"><?php echo $goods['total'];?></span></td>
			</tr>
			<?php } ?>
			<tr>
				<th>购买数量</th>
				<td><input type="text" name="count" value="1" /></td>
			</tr>
		</table>
	</div>
</div>
<div class="mobile-submit">
	<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
	<input type="submit" name="submit" class="btn btn-success btn-large submit" style="width:100%;" value="购买">
</div>
</form>
<?php include $this->template('footer', TEMPLATE_INCLUDEPATH);?>