<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php
if (empty($_W['styles']['albumlisttype'])) {
	$_W['styles']['albumlisttype'] = 1;
}
?>
<link rel="stylesheet" type="text/css" href="./source/modules/album/template/mobile/photo.mobile.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/album/template/mobile/photoswipe.mobile.css" media="all" />
<script type="text/javascript" src="./source/modules/album/template/mobile/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="./source/modules/album/template/mobile/jquery.wookmark.min.js"></script>
<style>
img{width:100%!important;}
<?php if($_W['styles']['albumlisttype'] == 2) { ?>
/* 双排 class="album2" */
#gallery{
	overflow:hidden;
}
#gallery li{
	display:inline-block;
	width:50%;
	-webkit-box-sizing:border-box;
	float:left;
	border-radius:0;
	background:none;
	padding:5px;
	border:0;
	box-shadow:none;
}
#gallery li a{
	display:block;
	background-color: #ffffff;
	border: 1px solid #ffffff;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	cursor: pointer;
	padding: 4px;
	box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.1);
	-webkit-box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.1);
	height:150px;
	overflow:hidden;
	position:relative;
}
#gallery li a p{
	position:absolute;
	width:100%;
	bottom:0;
	background:#fff;
	line-height:30px;
	padding-right: 10px;
	-webkit-box-sizing:border-box;
}
#gallery li a img{
	width:100%;
	min-height:100%;
}
.album li p>span, .album1 li p>span, .album2 li p>span {
	float: right;
	color: #aaa;
	position: absolute;
	right: 5px;
	background: #fff;
	padding-left: 5px;
}
#gallery li p {
	display: inline-block;
	max-width: 100%;
}
<?php } ?>
/* 单排  class="album" */
<?php if($_W['styles']['albumlisttype'] == 1) { ?>
#gallery li{
	display:block;
	width:inherit;
	margin:5px;
}
.album li p>span, .album1 li p>span, .album2 li p>span {
	float: right;
	color: #aaa;
	position: absolute;
	right: 5px;
	background: #fff;
	padding-left: 5px;
}
#gallery li p {
	display: inline-block;
	max-width: 100%;
}
<?php } ?>
<?php if($_W['styles']['albumlisttype'] == '3') { ?>
/* 瀑布流 class="album" */
.album li p>span, .album1 li p>span, .album2 li p>span {
	float: right;
	color: #aaa;
	position: absolute;
	right: 5px;
	background: #fff;
	padding-left: 5px;
}
#gallery li p {
	display: inline-block;
	max-width: 100%;
}
<?php } ?>
</style>
<div id="photo">
	<div class="body">
		<div class="qiandaobanner">
			<a href="#">
				<img src="./themes/mobile/default/images/albums_head.jpg" alt="" style="max-height:200px;"/>
			</a>
		</div>
		<div id="main" class="<?php if($_W['styles'] == 2) { ?>album2<?php } else { ?>album<?php } ?>"> <!--这个地方class有变化-->
			<ul id="gallery" class="gallery">
				<?php if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
				<li style="">
					<a href="<?php echo $this->createMobileUrl('detail', array('id' => $row['id'], 'weid' => $_W['weid']))?>">
						<img src="<?php echo $_W['attachurl'];?><?php echo $row['thumb'];?>" alt="<?php echo $row['title'];?>">
						<p><?php echo $row['title'];?><span></span></p>
					</a>
				</li>
				<?php } } ?>
			</ul>
		</div>
	</div>
</div>
<?php echo $result['pager'];?>
<?php if($_W['styles']['albumlisttype'] == 3) { ?>
<script type="text/javascript">
//下面是瀑布流js
$(function() {
  $('#gallery').imagesLoaded(function() {
	// Prepare layout options.
	var options = {
	  autoResize: false, // This will auto-update the layout when the browser window is resized.
	  container: $('#main'), // Optional, used for some extra CSS styling
	  offset: 4, // Optional, the distance between grid items
	  itemWidth: 140 // Optional, the width of a grid item
	};

	// Get a reference to your grid items.
	var handler = $('#gallery li');
	// Call the layout function.
	handler.wookmark(options);
  });
});
</script>
<?php } ?>
<?php include $this->template('footer', TEMPLATE_INCLUDEPATH);?>