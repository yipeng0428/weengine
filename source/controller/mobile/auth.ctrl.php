<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');

$weid = $_W['weid'];

if($_GPC['__auth']) {
	$pass = @base64_decode($_GPC['__auth']);
	$pass = @json_decode($pass, true);
	if(is_array($pass) && !empty($pass['fans']) && !empty($pass['time']) && !empty($pass['hash'])) {
		//去掉授权URL时间限制
		//if(abs($pass['time'] - TIMESTAMP) < 180) {
			$row = fans_search($pass['fans'], array('salt'));
			if(!is_array($row) || empty($row['salt'])) {
				$row = array('salt' => '');
			}
			$hash = md5("{$pass['fans']}{$pass['time']}{$row['salt']}{$_W['config']['setting']['authkey']}");
			if($pass['hash'] == $hash) {
				$row = array();
				$row['salt'] = random(8);
				if(fans_update($pass['fans'], $row)) {
					$cookie = array();
					$cookie['openid'] = $pass['fans'];
					$cookie['hash'] = substr(md5("{$pass['fans']}{$row['salt']}{$_W['config']['setting']['authkey']}"), 5, 5);
					$session = base64_encode(json_encode($cookie));
					isetcookie('__msess', $session);
				}
			}
		//}
	}
}

$forward = @base64_decode($_GPC['forward']);
if(empty($forward)) {
	$forward = create_url('mobile/channel', array('name'=>'index', 'weid'=>$weid));
} else {
	$forward = strexists($forward, 'http://') ? $forward : $_W['siteroot'] . $forward;
}
if(strexists($forward, '#')) {
	$pieces = explode('#', $forward, 2);
	$forward = $pieces[0];
}
$forward .= '#mp.weixin.qq.com#wechat_redirect';
header('location:' . $forward);
