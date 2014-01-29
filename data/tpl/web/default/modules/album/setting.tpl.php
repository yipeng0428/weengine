<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<form action="" method="post" class="form-horizontal form">
		<h4>相册展现方式</h4>
		<table class="tb">
			<tr>
				<th>相册展示方式</th>
				<td>
					<label class="radio inline"><input type="radio" value="1" name="style[albumlisttype]" <?php if(empty($styles['albumlisttype']['content']) || $styles['albumlisttype']['content'] == '1') { ?> checked<?php } ?>> 单行</label>
					<label class="radio inline"><input type="radio" value="2" name="style[albumlisttype]" <?php if($styles['albumlisttype']['content'] == '2') { ?> checked<?php } ?>> 双行</label>
					<label class="radio inline"><input type="radio" value="3" name="style[albumlisttype]" <?php if($styles['albumlisttype']['content'] == '3') { ?> checked<?php } ?>> 瀑布流</label>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
					<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>