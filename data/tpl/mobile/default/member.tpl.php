<?php defined('IN_IA') or exit('Access Denied');?><style>
body{font:14px/1.5 Tahoma,Helvetica,'SimSun',sans-serif;}
</style>
<div class="banner">
	<div class="user">
		<span class="username"><?php if($_W['fans']['nickname']) { ?><?php echo $_W['fans']['nickname'];?><?php } else { ?>请设置您的昵称<?php } ?></span>
		<span class="usergroup"><?php if(!empty($_W['fans']['card'])) { ?><span style="color:#ff0000">会员<?php if($_W['fans']['card'] > 1) { ?>Lv.<?php echo $_W['fans']['card'];?><?php } ?></span><?php } else { ?>普通会员<?php } ?></span>
		<div class="credit user-list"><span>积分</span><?php echo $_W['fans']['credit1'];?></div>
		<div class="money user-list"><span>金额</span><?php echo $_W['fans']['credit2'];?>元</div>
	</div>
	<div class="avatar"><img src="<?php if(!empty($_W['fans']['avatar'])) { ?><?php echo $_W['fans']['avatar'];?><?php } else { ?>resource/image/noavatar_middle.gif<?php } ?>"></div>
	<div class="banner_footer">
		<div>
			<a class="btn btn-warning" href="<?php echo create_url('mobile/module/profile', array('name' => 'fans', 'weid' => $_W['weid']))?>#qq.com#wechat_redirect">我的资料</a>
			<a class="btn btn-success" href="<?php echo create_url('mobile/module/charge', array('name' => 'member', 'weid' => $_W['weid']))?>#qq.com#wechat_redirect">充值</a>
		</div>
	</div>
</div>
