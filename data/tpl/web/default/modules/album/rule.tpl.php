<?php defined('IN_IA') or exit('Access Denied');?><div id="form" class="alert alert-block alert-new ">
	<h4 class="alert-heading">选择要展示的相册</h4>
	<table width="100%">
		<tr>
			<td>
				<div class="reply-news-edit-button">
					<button class="btn" style="width:100%;" type="button" onclick="popwin = $('#modal-module-menus').modal();">选择要展示的相册</button>
				</div>
			</td>
		</tr>
		<tr >
			<td id="entry">
			<?php if(is_array($reply)) { foreach($reply as $index => $row) { ?>
				<div class="alert alert-info reply-news-list <?php if($index == 0) { ?>reply-news-list-first<?php } ?>" id="preview_0">
					<div class="reply-news-list-cover">
						<img alt="" src="<?php echo $_W['attachurl'];?><?php echo $album[$row['albumid']]['thumb'];?>">
					</div>
					<div class="reply-news-list-detail">
						<div class="title"><span class="pull-right"><a onclick="return confirm('此操作不可恢复，确定删除吗？');return false;" href="<?php echo $this->createWebUrl('delete', array('id' => $row['id']))?>">删除</a></span><?php echo $album[$row['albumid']]['title'];?></div>
						<div class="content"><?php echo $album[$row['albumid']]['content'];?></div>
					</div>
				</div>
			<?php } } ?>
			</td>
		</tr>
	</table>
</div>
<div id="modal-module-menus" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" style=" width:600px;">
	<div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择要展示的项目</h3></div>
	<div class="modal-body">
		<table class="tb">
			<tr>
				<th><label for="">搜索关键字</label></th>
				<td>
					<div class="input-append" style="display:block;">
						<input type="text" class="span3" name="keyword" value="" id="search-kwd" /><button type="button" class="btn" onclick="search_entries();">搜索</button>
					</div>
				</td>
			</tr>
		</table>
		<div id="module-menus"></div>
	</div>
	<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal" aria-hidden="true">关闭</a></div>
</div>
<script type="text/javascript">
	var popwin;
	function search_entries() {
		var kwd = $.trim($('#search-kwd').val());
		$.post('<?php echo $this->createWebUrl('query');?>', {keyword: kwd}, function(dat){
			$('#module-menus').html(dat);
		});
	}
	function select_entry(o) {
		var html = '<div id="preview_'+$('#entry div.alert').size()+'" class="alert alert-info reply-news-list">' +
					'<div class="reply-news-list-cover"><img src="<?php echo $_W['attachurl'];?>'+o.thumb+'" alt=""></div>' +
					'<div class="reply-news-list-detail"><div class="title">'+o.title+'</div>' +
					'<div class="content">'+o.description+'</div></div></div>' +
					'<input type="hidden" name="albumid[]" value="'+o.id+'"/>';
		var obj = $(html);
		if ($('#entry div.alert').size() >= 8) {
			popwin.modal('hide');
			message('超过图文规则最大显示条数！');
			return false;
		}
		if ($('#entry div').size() == 0) {
			obj.addClass('reply-news-list-first');
		}
		$('#entry').append(obj);
	}
</script>
