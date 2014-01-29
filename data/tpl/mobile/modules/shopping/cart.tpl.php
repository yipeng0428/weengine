<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<link type="text/css" rel="stylesheet" href="./source/modules/shopping/images/common.css">
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner" style="padding:0 5px;">
		<a class="btn btn-small btn-inverse pull-right" href="<?php echo create_url('mobile/channel', array('name' => 'home', 'weid' => $_W['weid']))?>"><i class="icon-user"></i> 个人中心</a>
		<button class="btn btn-small btn-inverse pull-left" onclick="history.go(-1);"><i class="icon-chevron-left"></i> 返回</button>
	</div>
</div>
<div class="dish-main">
	<div class="order-hd">
		<span class="pull-right"><em>总计：</em><span class="total"><?php echo $price;?></span>元</span>
		<span class="pull-left">请确认商品后提交订单</span>
	</div>
	<div class="order-detail">
		<div class="order-detail-hd">
			<span class="pull-right">
				<a class="btn btn-success" href="<?php echo $this->createMobileUrl('list');?>"><i class="icon-plus"></i> 再逛逛</a>
				<a class="btn" href="<?php echo $this->createMobileUrl('clear');?>" onclick="return confirm('此操作不可恢复，确认？'); return false;"><i class="icon-trash"></i> 清空</a>
			</span>
			<span class="pull-left">我的购物车</span>
		</div>
		<div class="order-detail-list">
			<ul class="unstyled">
				<?php if(is_array($goods)) { foreach($goods as $item) { ?>
				<li>
					<div class="pull-right">
						<span class="img-circle menu-list-button reduce" onclick="order.reduce(<?php echo $item['id'];?>)">-</span>
						<span class="menu-list-num"><?php echo $cart[$item['id']]['total'];?></span>
						<span class="img-circle menu-list-button add" onclick="order.add(<?php echo $item['id'];?>)">+</span>
					</div>
					<div class="pull-left">
						<div class="title"><?php echo $item['title'];?></div>
						<div class="price"><span><?php echo $item['marketprice'];?></span>元<?php if($item['unit']) { ?> / <?php echo $item['unit'];?><?php } ?></div>
					</div>
				</li>
				<?php } } ?>
			</ul>
		</div>
	</div>
	<div class="order-detail myinfo">
		<div class="order-detail-hd">
			<span class="pull-left">我的信息</span>
		</div>
		<form action="" method="post" onsubmit="return checkform(this); return false;">
			<table class="form-table">
				<tr>
					<th><label for="">真实姓名</label></th>
					<td><input type="text" id="" name="realname" value="<?php echo $profile['realname'];?>"></td>
				</tr>
				<tr>
					<th><label for="">地区</label></th>
					<td>
						<select name="resideprovince" id="sel-provance" onChange="selectCity();" class="pull-left" style="width:30%; margin-right:5%;">
							<option value="" selected="true">省/直辖市</option>
						</select>
						<select name="residecity" id="sel-city" onChange="selectcounty()" class="pull-left" style="width:30%; margin-right:5%;">
							<option value="" selected="true">请选择</option>
						</select>
						<select name="residedist" id="sel-area" class="pull-left" style="width:30%;">
							<option value="" selected="true">请选择</option>
						</select>
					</td>
				</tr>
				<tr>
					<th><label for="">详细地址</label></th>
					<td><input type="text" id="" name="address" value="<?php echo $profile['address'];?>" /></td>
				</tr>
				<tr>
					<th><label for="">手机</label></th>
					<td><input type="text" id="" name="mobile" value="<?php echo $profile['mobile'];?>" /></td>
				</tr>
				<tr>
					<th><label for="">QQ</label></th>
					<td><input type="text" id="" name="qq" value="<?php echo $profile['qq'];?>" /></td>
				</tr>
			</table>
			<div class="order-detail-hd">
				<span class="pull-left">其他</span>
			</div>
			<?php if($goodstype == 1) { ?>
			<table class="form-table">
				<tr>
					<th><label for="">付款方式</label></th>
					<td>
						<select name="paytype">
							<option value="1">余额支付</option>
							<option value="2">在线支付</option>
							<option value="3">货到付款</option>
						</select>
					</td>
				</tr>
				<tr>
					<th><label for="">配送方式</label></th>
					<td>
						<select name="sendtype">
							<option value="1">快递</option>
							<option value="2">自提</option>
						</select>
					</td>
				</tr>
			</table>
			<?php } else { ?>
			<table class="form-table">
				<tr>
					<th><label for="">付款方式</label></th>
					<td>
						<select name="paytype">
							<option value="1">余额支付</option>
							<option value="2">在线支付</option>
						</select>
					</td>
				</tr>
			</table>
			<?php } ?>
		<input type="hidden" name="goodstype" value="<?php echo $goodstype;?>" />
		<input type="submit" value="√ 提交订单" name="submit" class="btn btn-success" style="margin-bottom:10px; float:right;">
		<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
	</div>
	</form>
</div>
<script type="text/javascript" src="./resource/script/cascade.js"></script>
<script type="text/javascript">
cascdeInit('<?php echo $profile['resideprovince'];?>','<?php echo $profile['residecity'];?>','<?php echo $profile['residedist'];?>'); //开启地区三级联动
function priceTotal() {
	var a = 0;
	$('.order-detail-list li').each(function() {
		a = a + parseInt($(this).find('.price span').html()) * parseInt($(this).find('.menu-list-num').html());
	});
	$('.order-hd .total').html(a);
	$('.order-detail-list li:last').css("border-bottom", 0);
}
priceTotal();
$('.order-detail-list').delegate(".add", "click", function(){
	var a = $(this).parent().parent();
	a.find('.menu-list-num').html(function() {
		return parseInt($(this).html()) + 1;
	});
	priceTotal();
});
$('.order-detail-list').delegate(".reduce", "click", function(){
	var a = $(this).parent().parent();
	if(a.find('.menu-list-num').html() == 1 || a.find('.menu-list-num').html() < 0) {
		if(confirm("确定要删除吗？")) {
			a.remove();
		} else {
			return false;
		}
	}
	a.find('.menu-list-num').html(function() {
		return parseInt($(this).html()) - 1;
	});
	priceTotal();
});

var order = {
	'add' : function(goodsid) {
		var $this = this;
		$this.cart(goodsid, 'add');
	},
	'reduce' : function(goodsid) {
		var $this = this;
		$this.cart(goodsid, 'reduce');
	},
	'cart' : function(goodsid, operation) {
		if (!goodsid) {
			alert('请选择商品！');
			return;
		}
		operation = operation ? operation : 'add';
		$.getJSON('<?php echo $this->createMobileUrl('updatecart');?>', {'op' : operation, 'goodsid' : goodsid}, function(s){
			if (s.message.status) {
				$('#goodsnum_'+goodsid).html(s.message.total);
			} else {
				alert(s.message.message);
			}
		});
	}
};

function checkform(form) {
	if (!form['realname'].value) {
		alert('请输入您的真实姓名！');
		return false;
	}
	if (!form['address'].value) {
		alert('请输入您的详细地址！');
		return false;
	}
	if (!form['mobile'].value) {
		alert('请输入您的手机号码！');
		return false;
	}
	if (!form['qq'].value) {
		alert('请输入您的QQ号码！');
		return false;
	}
	if (!form['paytype'].value) {
		alert('请选择付款方式！');
		return false;
	}
	<?php if($goodstype == 1) { ?>
	if (!form['sendpay'].value) {
		alert('请选择配送方式！');
		return false;
	}
	<?php } ?>
}
</script>
<?php include $this->template('footer', TEMPLATE_INCLUDEPATH);?>