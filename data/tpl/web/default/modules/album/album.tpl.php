<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php if($foo == 'create') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('list', array('foo' => 'create'));?>">创建相册</a></li>
	<li <?php if($foo == 'display') { ?>class="active"<?php } ?>><a href="<?php echo $this->createWebUrl('list', array('foo' => 'display'));?>">相册管理</a></li>
	<?php if($foo == 'photo') { ?><li class="active"><a href="<?php echo $this->createWebUrl('list', array('foo' => 'photo', 'albumid' => $id));?>">添加照片</a></li><?php } ?>
</ul>
<style>
.album_list{overflow:hidden; padding-top:15px;}
.album_list li{border:1px #DDD solid; width:237px; float:left; margin-left:15px; margin-bottom:10px;}
.album_list li .album_pic{display:block; width:237px; height:130px; overflow:hidden;}
.album_list li .album_pic img{width:237px;}
.album_list li .album_main{padding:10px; overflow:hidden;}
.album_list li .album_main .album_title{font-size:16px; height:20px; width:217px; overflow:hidden;}
.album_list li .album_main .pull-left{color:#999;}
.album_manage .table th{width:120px;}
.album_manage #albums_head img{margin-right:10px; max-height:70px;}
</style>
<?php if($foo == 'create') { ?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<input type="hidden" name="id" value="<?php echo $item['id'];?>">
		<h4>相册管理</h4>
		<table class="tb">
			<?php if(!empty($item)) { ?>
			<tr>
				<th><label for="">访问地址</label></th>
				<td>
					<a href="<?php echo $this->createMobileUrl('detail', array('weid' => $_W['weid'], 'id' => $item['id']))?>" target="_blank"><?php echo $this->createMobileUrl('detail', array('weid' => $_W['weid'], 'id' => $item['id']))?></a>
					<span class="help-block">您可以根据此地址，添加回复规则，设置访问。</span>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th><label for="">排序</label></th>
				<td>
					<input type="text" id="rule-name" class="span2" placeholder="" name="displayorder" value="<?php echo $item['displayorder'];?>">
					<span class="help-block">相册优先级，越大则越靠前</span>
				</td>
			</tr>
			<tr>
				<th><label for="">名称</label></th>
				<td>
					<input type="text" class="span6" placeholder="" name="title" value="<?php echo $item['title'];?>">
				</td>
			</tr>
			<tr>
				<th><label for="">封面</label></th>
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
				<th>简介</th>
				<td>
					<textarea style="height:200px;" class="span7" name="content" cols="70" id="reply-add-text"><?php echo $item['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="">相册类型</label></th>
				<td>
					<label for="radio_1" class="radio inline"><input type="radio" name="type" id="radio_1" value="0" <?php if(empty($item) || $item['type'] == 0) { ?> checked<?php } ?> /> 普通</label>
					<label for="radio_0" class="radio inline"><input type="radio" name="type" id="radio_0" value="1" <?php if(!empty($item) && $item['type'] == 1) { ?> checked<?php } ?> /> 360全景</label>
				</td>
			</tr>
			<tr>
				<th><label for="">前台是否显示</label></th>
				<td>
					<label for="radio_1" class="radio inline"><input type="radio" name="isview" id="radio_1" value="1" <?php if(empty($item) || $item['isview'] == 1) { ?> checked<?php } ?> /> 显示</label>
					<label for="radio_0" class="radio inline"><input type="radio" name="isview" id="radio_0" value="0" <?php if(!empty($item) && $item['isview'] == 0) { ?> checked<?php } ?> /> 隐藏</label>
					<span class="help-block">设置隐藏后，此相册只可以通过关键字触发</span>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<?php } else if($foo == 'display') { ?>
<ul class="unstyled album_list">
	<?php if(is_array($list)) { foreach($list as $item) { ?>
	<li>
		<a href="<?php echo $this->createWebUrl('list', array('foo' => 'photo', 'albumid' => $item['id']))?>" class="album_pic"><img src="<?php echo $_W['attachurl'];?><?php echo $item['thumb'];?>" /></a>
		<div class="album_main">
			<p class="album_title"><?php echo $item['title'];?></p>
			<p>
				<span class="pull-right"><a href="<?php echo $this->createWebUrl('list', array('foo' => 'photo', 'albumid' => $item['id']))?>">上传照片</a> <a href="<?php echo $this->createWebUrl('list', array('foo' => 'create', 'id' => $item['id']))?>">编辑</a> <a href="<?php echo $this->createWebUrl('list', array('foo' => 'delete', 'id' => $item['id'], 'type' => 'album'))?>" onclick="return confirm('此操作不可恢复，确定删除码？'); return false;">删除</a></span>
				<span class="pull-left">有<?php echo $item['total'];?>张照片</span>
			</p>
		</div>
	</li>
	<?php } } ?>
</ul>
<?php } else if($foo == 'photo') { ?>
<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="./resource/script/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
<?php if($album['type'] == 1) { ?>
	$(function(){
		var i = 0;
		var a;
		$('#selectimage').click(function() {
			a = $(".photo_list .alert").length;
			a = 7 - a;
			if(a < 0) a = 0;
			if(a != 0) {
				var editor = KindEditor.editor({
					allowFileManager : false,
					imageUploadLimit : a,
					imageSizeLimit : '30MB',
					uploadJson : './index.php?act=attachment&do=upload'
				});
			}
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(list) {
						if (list && list.length > 0) {
							for (i in list) {
								if (list[i]) {
									var html = '<div class="alert alert-block alert-new">' +
											'<input type="hidden" name="attachment-new[]" value="'+list[i]['filename']+'" />'+
											'<span class="pull-right"><a href="javascript:;" onclick="var $this = this;if (confirm(\'删除操作不可恢复，确定码？\')){ajaxopen(\'site.php?act=album&do=delete&type=photo&attachment='+list[i]['filename']+'\', function(s) {$($this).parent().parent().remove();})}; return false;">删除</a></span>' +
											'<div class="photo_preview pull-left"><label class="radio inline"><img src="'+list[i]['url']+'"><div><a href="javascript:;" onclick="ajaxopen(\'site.php?act=album&do=cover&albumid=<?php echo $album['id'];?>&thumb='+list[i]['filename']+'\', function(msg){ message(msg)})">设为封面</a></div></label></div>' +
											'<table class="pull-left">' +
											'<tr><th>排序</th><td><select class="span1" name="displayorder-new[]"><option value="0">前</option><option value="1">右</option><option value="2">后</option><option value="3">左</option><option value="4">上</option><option value="5">下</option></select></td></tr>' +
											'<tr><th>标题</th><td><input type="text" name="title-new[]" value="" class="span5"></td></tr>' +
											'<tr><th>简介</th><td><textarea name="description-new[]" class="span5"></textarea></td></tr>' +
											'</table></div>';
									$('#listimage').append(html);
									i++;
								}
							}
							editor.hideDialog();
							$(".photo_list .alert").each(function(b) {
								$(this).find('select option[value="'+(b-1)+'"]').attr("selected", true);
							});
						} else {
							alert('请先选择要上传的图片！');
						}
					}
				});
			});
		});
	});
<?php } else { ?>
	$(function(){
		var i = 0;
		$('#selectimage').click(function() {
			var editor = KindEditor.editor({
				allowFileManager : false,
				imageSizeLimit : '30MB',
				uploadJson : './index.php?act=attachment&do=upload'
			});
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(list) {
						if (list && list.length > 0) {
							for (i in list) {
								if (list[i]) {
									html = '<div class="alert alert-block alert-new">' +
											'<input type="hidden" name="attachment-new[]" value="'+list[i]['filename']+'" />'+
											'<span class="pull-right"><a href="javascript:;" onclick="var $this = this;if (confirm(\'删除操作不可恢复，确定码？\')){ajaxopen(\'site.php?act=album&do=delete&type=photo&attachment='+list[i]['filename']+'\', function(s) {$($this).parent().parent().remove();})}; return false;">删除</a></span>' +
											'<div class="photo_preview pull-left"><label class="radio inline"><img src="'+list[i]['url']+'"><div><a href="javascript:;" onclick="ajaxopen(\'site.php?act=album&do=cover&albumid=<?php echo $album['id'];?>&thumb='+list[i]['filename']+'\', function(msg){ message(msg)})">设为封面</a></div></label></div>' +
											'<table class="pull-left">' +
											'<tr><th>排序</th><td><input type="text" name="displayorder-new[]" value="" class="span1"></td></tr>' +
											'<tr><th>标题</th><td><input type="text" name="title-new[]" value="" class="span5"></td></tr>' +
											'<tr><th>简介</th><td><textarea name="description-new[]" class="span5"></textarea></td></tr>' +
											'</table></div>';
									$('#listimage').append(html);
									i++;
								}
							}
							editor.hideDialog();
						} else {
							alert('请先选择要上传的图片！');
						}
					}
				});
			});
		});
	});
<?php } ?>
</script>
<style>
.photo_list{padding:15px 0;}
.photo_list .alert{width:auto; margin-top:10px; overflow:hidden;}
.photo_list .photo_preview{width:130px;}
.photo_list .photo_preview img{width:130px; margin-bottom:5px;}
.photo_list .photo_preview label{padding:0;}
.photo_list .photo_preview input[type="radio"]{margin-left:0; margin-right:10px;}
.photo_list table{margin-left:40px;}
.photo_list table th,.photo_list table td{padding-bottom:5px;}
.photo_list table th{width:60px; font-size:14px;}
.photo_list table input,.photo_list table select{margin-bottom:0;}
</style>
<div class="main">
	<div class="photo_list">
	<form method="post" class="form">
	<input name="token" type="hidden" value="<?php echo $_W['token'];?>" />
	<input name="albumid" type="hidden" value="<?php echo $album['id'];?>" />
	<span id="selectimage" class="btn btn-primary"><i class="icon-plus"></i> 上传照片</span>
	<input type="submit" name="submit" id="selectimage" class="btn" value="保存" /> <span style="color:red;">上传照片后，请保存照片数据！</span>
	<div style="padding:10px 0;">相册访问地址：<a target="_blank" href="<?php echo create_url('mobile/channel', array('weid' => $_W['weid'], 'id' => $album['id'], 'name' => 'photo'))?>"><?php echo create_url('mobile/channel', array('weid' => $_W['weid'], 'id' => $album['id'], 'name' => 'photo'))?></a></div>
	<?php if($album['type'] == 1) { ?>
	<div class="alert alert-info" style="margin-top:0;">
		<i class="icon-warning-sign"></i> 请把照片按照前->右->后->左->上->下的顺序排列！
	</div>
	<?php } ?>
	<?php if($album['type'] == 0) { ?><div id="listimage"></div><?php } ?>
	<?php if(is_array($photos)) { foreach($photos as $item) { ?>
	<div class="alert alert-block alert-new">
		<input type="hidden" value="<?php echo $item['attachment'];?>" name="attachment[<?php echo $item['id'];?>]">
		<span class="pull-right"><a class="delete" onclick="return confirm('删除操作不可恢复，确定码？'); return false;" href="<?php echo $this->createWebUrl('list', array('foo' => 'delete', 'type' => 'photo', 'id' => $item['id']))?>">删除</a></span>
		<div class="photo_preview pull-left">
			<label class="radio inline">
				<img src="<?php echo $_W['attachurl'];?><?php echo $item['attachment'];?>">
				<div><a href="javascript:;" onclick="ajaxopen('<?php echo $this->createWebUrl('list', array('foo' => 'cover', 'albumid' => $album['id'], 'thumb' => $item['attachment']))?>', function(msg){ message(msg)})">设为封面</a></div>
			</label>
		</div>
		<table class="pull-left">
			<tr>
				<th>排序</th>
				<td>
				<?php if($album['type'] == 1) { ?>
				<select class="span1" name="displayorder[<?php echo $item['id'];?>]">
					<option value='0' <?php if($item['displayorder']==0) { ?>selected<?php } ?>>前</option>
					<option value='1' <?php if($item['displayorder']==1) { ?>selected<?php } ?>>右</option>
					<option value='2' <?php if($item['displayorder']==2) { ?>selected<?php } ?>>后</option>
					<option value='3' <?php if($item['displayorder']==3) { ?>selected<?php } ?>>左</option>
					<option value='4' <?php if($item['displayorder']==4) { ?>selected<?php } ?>>上</option>
					<option value='5' <?php if($item['displayorder']==5) { ?>selected<?php } ?>>下</option>
				</select>
				<?php } else { ?>
				<input type="text" class="span1" value="<?php echo $item['displayorder'];?>" name="displayorder[<?php echo $item['id'];?>]">
				<?php } ?>
				</td>
			</tr>
			<tr>
				<th>标题</th>
				<td><input type="text" class="span5" value="<?php echo $item['title'];?>" name="title[<?php echo $item['id'];?>]"></td>
			</tr>
			<tr>
				<th>简介</th>
				<td><textarea class="span5" name="description[<?php echo $item['id'];?>]"><?php echo $item['description'];?></textarea></td>
			</tr>
		</table>
	</div>
	<?php } } ?>
	<?php if($album['type'] == 1) { ?><div id="listimage"></div><?php } ?>
	</form>
	</div>
</div>
<?php } ?>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
