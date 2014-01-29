<?php defined('IN_IA') or exit('Access Denied');?>	<div id="footer">
		<span class="pull-left">
			<p><?php if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> &copy; 2013 <a href="http://www.we7.cc">www.we7.cc</a><?php } else { ?><?php echo $_W['setting']['copyright']['footerleft'];?><?php } ?></p>
		</span>
		<span class="pull-right">
			<p><?php if(empty($_W['setting']['copyright']['footerright'])) { ?><a href="http://www.we7.cc">关于微擎</a>&nbsp;&nbsp;<a href="http://bbs.we7.cc">微擎帮助</a><?php } else { ?><?php echo $_W['setting']['copyright']['footerright'];?><?php } ?></p>
		</span>
	</div>
	<div class="emotions" style="display:none;"></div>
	<?php echo $_W['setting']['copyright']['statcode'];?>
</body>
</html>