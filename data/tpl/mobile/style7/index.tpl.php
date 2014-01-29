<?php defined('IN_IA') or exit('Access Denied');?><?php include template('header', TEMPLATE_INCLUDEPATH);?>
<style>
body{
font:<?php echo $_W['styles']['fontsize'];?> <?php echo $_W['styles']['fontfamily'];?>;
color:<?php echo $_W['styles']['fontcolor'];?>;
padding:0;
margin:0;
background-image:url('<?php if(!empty($_W['styles']['indexbgimg'])) { ?><?php echo $_W['styles']['indexbgimg'];?><?php } ?>');
background-size:cover;
background-color:<?php if(empty($_W['styles']['indexbgcolor'])) { ?>#E9E9E9<?php } else { ?><?php echo $_W['styles']['indexbgcolor'];?><?php } ?>;
<?php echo $_W['styles']['indexbgextra'];?>
}
a{color:<?php echo $_W['styles']['linkcolor'];?>; text-decoration:none;}
<?php echo $_W['styles']['css'];?>
.box{width:100%;overflow:hidden;margin-top:10px;}
.box .box-item{float:left;text-align:center;display:block;text-decoration:none;outline:none;width:47%;height:110px;position:relative; color:#333; background:#FFF; margin:0 0 2% 2%; padding:2% 0 0 0;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.box .box-item i{display:inline-block;width:100%;height:80px;line-height:80px;font-size:40px;color:#EEE; background:#C9C9C9; overflow:hidden;}
.box .box-item span{color:<?php echo $_W['styles']['fontnavcolor'];?>;display:block;font-size:14px; position:absolute; bottom:3.5%; width:100%; overflow:hidden;}
</style>
<div class="box">
	<?php if(is_array($navs)) { foreach($navs as $nav) { ?>
	<a href="<?php echo $nav['url'];?>" class="box-item">
		<?php if(!empty($nav['icon'])) { ?>
		<i style="background:url(<?php echo $_W['attachurl'];?><?php echo $nav['icon'];?>) no-repeat;background-size:cover;" class=""></i>
		<?php } else { ?>
		<i class="<?php echo $nav['css']['icon']['icon'];?>" style="<?php echo $nav['css']['icon']['style'];?>"></i>
		<?php } ?>
		<span style="<?php echo $nav['css']['name'];?>"><?php echo $nav['name'];?></span>
	</a>
	<?php } } ?>
</div>
<?php include template('footer', TEMPLATE_INCLUDEPATH);?>