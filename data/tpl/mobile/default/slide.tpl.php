<?php defined('IN_IA') or exit('Access Denied');?><?php include_once IA_ROOT . '/source/modules/site/model.php'?>
<?php $slide = site_article_search('', 'f');?>
<style>
.box_swipe {
  overflow: hidden;
  position: relative;
}
.box_swipe ul {
  overflow: hidden;
  position: relative;
}
.box_swipe ul > li {
  float:left;
  width:100%;
  position: relative;
}
.box_swipe>ol{
	height:20px;
	position: relative;
	z-index:10;
	margin-top:-25px;
	text-align:right;
	padding-right:15px;
	background-color:rgba(0,0,0,0.3);
}
.box_swipe>ol>li{
	display:inline-block;
	margin:5px 0;
	width:8px;
	height:8px;
	background-color:#757575;
	border-radius: 8px;
}
.box_swipe>ol>li.on{
	background-color:#ffffff;
}
</style>
<div id="banner_box" class="box_swipe">
	<ul>
	<?php if(is_array($slide['list'])) { foreach($slide['list'] as $v) { ?>
		<li>
			<a href="<?php echo create_url('mobile/channel', array('name' => 'detail', 'id' => $v['id'], 'weid' => $_W['weid']))?>">
				<img src="<?php echo $_W['attachurl'];?><?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>" style="width:100%;" />
			</a>
		</li>
	<?php } } ?>
	</ul>
	<ol>
	<?php $slideNum = 1;?>
	<?php if(is_array($slide['list'])) { foreach($slide['list'] as $vv) { ?>
		<li<?php if($slideNum == 1) { ?> class="on"<?php } ?>></li>
		<?php $slideNum++;?>
	<?php } } ?>
	</ol>
</div>
<script>
$(function() {
	new Swipe($('#banner_box')[0], {
		speed:500,
		auto:3000,
		callback: function(){
			var lis = $(this.element).next("ol").children();
			lis.removeClass("on").eq(this.index).addClass("on");
		}
	});
});
</script>