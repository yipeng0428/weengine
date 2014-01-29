<?php defined('IN_IA') or exit('Access Denied');?><?php if(empty($item)) { ?>
<?php $namesuffix = '-new[(wrapitemid)]';?>
<?php $itemid = '(itemid)';?>
<?php } else { ?>
<?php $namesuffix = '['.$item['id'].']';?>
<?php $itemid = 'scratchcard-item-' . $item['id'];?>
<?php } ?>
<div class="alert alert-info reply-market-list">
	<table class="tb reply-news-edit">
		<tr>
			<th>是否实物：</th>
			<td id="award-inkind">
				<span class="pull-right"><?php if(empty($item)) { ?><a href="javascript:;" onclick="doDeleteItem('<?php echo $itemid;?>')">删除</a><?php } else { ?><a href="<?php echo $this->createWebUrl('delete', array('id' => $item['id']))?>" onclick="doDeleteItem('<?php echo $itemid;?>', this.href)">删除</a><?php } ?></span>
				<label for="radio_1_<?php echo $itemid;?>" class="radio inline"><input type="radio" name="award-inkind<?php echo $namesuffix;?>" id="radio_1_<?php echo $itemid;?>" value="1" <?php if($item['inkind'] == 1) { ?> checked="checked"<?php } ?><?php if(!empty($item)) { ?> disabled=true<?php } ?> /> 是</label><label for="radio_0_<?php echo $itemid;?>" class="radio inline"><input type="radio" name="award-inkind<?php echo $namesuffix;?>" id="radio_0_<?php echo $itemid;?>" value="0" <?php if($item['inkind'] == 0) { ?> checked="checked"<?php } ?><?php if(!empty($item)) { ?> disabled=true<?php } ?> /> 否</label>
			</td>
		</tr>
		<tr>
			<th>奖品名称：</th>
			<td>
				<input type="text" value="<?php echo $item['title'];?>" style="width:275px;" name="award-title<?php echo $namesuffix;?>" placeholder="填写奖品名称">
				<label style="display:inline-block;">中奖率：<input type="text" value="<?php echo $item['probalilty'];?>" name="award-probalilty<?php echo $namesuffix;?>" style="padding-right:30px;width:48px;"><em class="percentage">%</em></label>
				<label <?php if($item['inkind'] == 0) { ?>style="display:none;"<?php } else { ?>style="display:inline-block;"<?php } ?> class="num">数量：<input type="text" value="<?php echo $item['total'];?>" style="width:45px;" name="award-total<?php echo $namesuffix;?>"></label>
			</td>
		</tr>
		<tr>
			<th>奖品描述：</th>
			<td>
				<textarea style="height:80px;" name="award-description<?php echo $namesuffix;?>" class="span7" cols="70" id="" placeholder="填写奖品描述，颜色、类型、规格等"><?php echo $item['description'];?></textarea>
			</td>
		</tr>
		<?php if($item['inkind'] == 0) { ?>
		<tr>
			<th>兑 换 码：</th>
			<td>
				<textarea style="height:80px;" class="span7" cols="70" id="" name="award-activation-code<?php echo $namesuffix;?>" placeholder="填写兑换码或者其他密文类SN码，一行一个"><?php echo $item['activation_code'];?></textarea>
			</td>
		</tr>
		<tr>
			<th>兑换方式：</th>
			<td>
				<input type="text" id="" class="span7" value="<?php echo $item['activation_url'];?>" name="award-activation-url<?php echo $namesuffix;?>" placeholder="填写激活地址或者其他领奖方法">
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
