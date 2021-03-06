<?php
/**
 * 微商城模块微站定义
 *
 * @author WeEngine Team
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class ShoppingModuleSite extends WeModuleSite {

	public function doWebCategory() {
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			if (!empty($_GPC['displayorder'])) {
				foreach ($_GPC['displayorder'] as $id => $displayorder) {
					pdo_update('shopping_category', array('displayorder' => $displayorder), array('id' => $id));
				}
				message('分类排序更新成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
			}
			$children = array();
			$category = pdo_fetchall("SELECT * FROM ".tablename('shopping_category')." WHERE weid = '{$_W['weid']}' ORDER BY parentid ASC, displayorder DESC");
			foreach ($category as $index => $row) {
				if (!empty($row['parentid'])){
					$children[$row['parentid']][] = $row;
					unset($category[$index]);
				}
			}
			include $this->template('category');
		} elseif ($operation == 'post') {
			$parentid = intval($_GPC['parentid']);
			$id = intval($_GPC['id']);
			if(!empty($id)) {
				$category = pdo_fetch("SELECT * FROM ".tablename('shopping_category')." WHERE id = '$id'");
			} else {
				$category = array(
					'displayorder' => 0,
				);
			}
			if (!empty($parentid)) {
				$parent = pdo_fetch("SELECT id, name FROM ".tablename('shopping_category')." WHERE id = '$parentid'");
				if (empty($parent)) {
					message('抱歉，上级分类不存在或是已经被删除！', $this->createWebUrl('post'), 'error');
				}
			}
			if (checksubmit('submit')) {
				if (empty($_GPC['name'])) {
					message('抱歉，请输入分类名称！');
				}
				$data = array(
					'weid' => $_W['weid'],
					'name' => $_GPC['catename'],
					'displayorder' => intval($_GPC['displayorder']),
					'parentid' => intval($parentid),
				);
				if (!empty($id)) {
					unset($data['parentid']);
					pdo_update('shopping_category', $data, array('id' => $id));
				} else {
					pdo_insert('shopping_category', $data);
					$id = pdo_insertid();
				}
				message('更新分类成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
			}
			include $this->template('category');
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$category = pdo_fetch("SELECT id, parentid FROM ".tablename('shopping_category')." WHERE id = '$id'");
			if (empty($category)) {
				message('抱歉，分类不存在或是已经被删除！', $this->createWebUrl('category', array('op' => 'display')), 'error');
			}
			pdo_delete('shopping_category', array('id' => $id, 'parentid' => $id), 'OR');
			message('分类删除成功！', $this->createWebUrl('category', array('op' => 'display')), 'success');
		}
	}

	public function doWebGoods() {
		global $_GPC, $_W;
		$category = pdo_fetchall("SELECT * FROM ".tablename('shopping_category')." WHERE weid = '{$_W['weid']}' ORDER BY parentid ASC, displayorder DESC", array(), 'id');
		if (!empty($category)) {
			$children = '';
			foreach ($category as $cid => $cate) {
				if (!empty($cate['parentid'])) {
					$children[$cate['parentid']][$cate['id']] = array($cate['id'], $cate['name']);
				}
			}
		}

		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'post') {
			$id = intval($_GPC['id']);
			if (!empty($id)) {
				$item = pdo_fetch("SELECT * FROM ".tablename('shopping_goods')." WHERE id = :id" , array(':id' => $id));
				if (empty($item)) {
					message('抱歉，商品不存在或是已经删除！', '', 'error');
				}
			}
			if (checksubmit('submit')) {
				if (empty($_GPC['goodsname'])) {
					message('请输入商品名称！');
				}
				if (empty($_GPC['pcate'])) {
					message('请选择商品分类！');
				}
				$data = array(
					'weid' => intval($_W['weid']),
					'displayorder' => intval($_GPC['displayorder']),
					'title' => $_GPC['goodsname'],
					'pcate' => intval($_GPC['pcate']),
					'ccate' => intval($_GPC['ccate']),
					'type' => intval($_GPC['type']),
					'status' => intval($_GPC['status']),
					'description' => $_GPC['description'],
					'content' => htmlspecialchars_decode($_GPC['content']),
					'productsn' => $_GPC['productsn'],
					'goodssn' => $_GPC['goodssn'],
					'marketprice' => $_GPC['marketprice'],
					'productprice' => $_GPC['productprice'],
					'total' => intval($_GPC['total']),
					'unit' => $_GPC['unit'],
					'createtime' => TIMESTAMP,
				);
				if (!empty($_FILES['thumb']['tmp_name'])) {
					file_delete($_GPC['thumb_old']);
					$upload = file_upload($_FILES['thumb']);
					if (is_error($upload)) {
						message($upload['message'], '', 'error');
					}
					$data['thumb'] = $upload['path'];
				}
				if (empty($id)) {
					pdo_insert('shopping_goods', $data);
				} else {
					unset($data['createtime']);
					pdo_update('shopping_goods', $data, array('id' => $id));
				}
				message('商品更新成功！', $this->createWebUrl('goods', array('op' => 'display')), 'success');
			}
		} elseif ($operation == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$condition = '';
			if (!empty($_GPC['keyword'])) {
				$condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
			}

			if (!empty($_GPC['cate_2'])) {
				$cid = intval($_GPC['cate_2']);
				$condition .= " AND ccate = '{$cid}'";
			} elseif (!empty($_GPC['cate_1'])) {
				$cid = intval($_GPC['cate_1']);
				$condition .= " AND pcate = '{$cid}'";
			}

			if (isset($_GPC['status'])) {
				$condition .= " AND status = '".intval($_GPC['status'])."'";
			}

			$list = pdo_fetchall("SELECT * FROM ".tablename('shopping_goods')." WHERE weid = '{$_W['weid']}' $condition ORDER BY status DESC, displayorder DESC, id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('shopping_goods') . " WHERE weid = '{$_W['weid']}'");
			$pager = pagination($total, $pindex, $psize);
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id, thumb FROM ".tablename('shopping_goods')." WHERE id = :id", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，商品不存在或是已经被删除！');
			}
			if (!empty($row['thumb'])) {
				file_delete($row['thumb']);
			}
			pdo_delete('shopping_goods', array('id' => $id));
			message('删除成功！', referer(), 'success');
		}
		include $this->template('goods');
	}

	public function doWebOrder() {
		global $_W, $_GPC;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$condition = '';
			if (!empty($_GPC['keyword'])) {
				$condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
			}

			if (!empty($_GPC['cate_2'])) {
				$cid = intval($_GPC['cate_2']);
				$condition .= " AND ccate = '{$cid}'";
			} elseif (!empty($_GPC['cate_1'])) {
				$cid = intval($_GPC['cate_1']);
				$condition .= " AND pcate = '{$cid}'";
			}

			if (isset($_GPC['status'])) {
				$condition .= " AND status = '".intval($_GPC['status'])."'";
			}

			$list = pdo_fetchall("SELECT * FROM ".tablename('shopping_order')." WHERE weid = '{$_W['weid']}' $condition ORDER BY status ASC, createtime DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('shopping_order') . " WHERE weid = '{$_W['weid']}'");
			$pager = pagination($total, $pindex, $psize);
			if (!empty($list)) {
				foreach ($list as $row) {
					$userids[$row['from_user']] = $row['from_user'];
				}
			}
			$users = fans_search($userids, array('realname', 'resideprovince', 'residecity', 'residedist', 'address', 'mobile', 'qq'));
		} elseif ($operation == 'detail') {
			$id = intval($_GPC['id']);
			if (checksubmit('finish')) {
				pdo_update('shopping_order', array('status' => 2, 'remark' => $_GPC['remark']), array('id' => $id));
				message('订单操作成功！', referer(), 'success');
			}
			if (checksubmit('cancel')) {
				pdo_update('shopping_order', array('status' => 1, 'remark' => $_GPC['remark']), array('id' => $id));
				message('取消完成订单操作成功！', referer(), 'success');
			}
			if (checksubmit('cancelpay')) {
				pdo_update('shopping_order', array('status' => 0, 'remark' => $_GPC['remark']), array('id' => $id));
				message('取消订单付款操作成功！', referer(), 'success');
			}
			if (checksubmit('confrimpay')) {
				pdo_update('shopping_order', array('status' => 1, 'remark' => $_GPC['remark']), array('id' => $id));
				message('确认订单付款操作成功！', referer(), 'success');
			}
			if (checksubmit('close')) {
				pdo_update('shopping_order', array('status' => -1, 'remark' => $_GPC['remark']), array('id' => $id));
				message('订单关闭操作成功！', referer(), 'success');
			}
			if (checksubmit('open')) {
				pdo_update('shopping_order', array('status' => 0, 'remark' => $_GPC['remark']), array('id' => $id));
				message('开启订单操作成功！', referer(), 'success');
			}
			$item = pdo_fetch("SELECT * FROM ".tablename('shopping_order')." WHERE id = :id", array(':id' => $id));
			$item['user'] = fans_search($item['from_user'], array('realname', 'resideprovince', 'residecity', 'residedist', 'address', 'mobile', 'qq'));
			$goodsid = pdo_fetchall("SELECT goodsid, total FROM ".tablename('shopping_order_goods')." WHERE orderid = '{$item['id']}'", array(), 'goodsid');
			$goods = pdo_fetchall("SELECT * FROM ".tablename('shopping_goods')."  WHERE id IN ('".implode("','", array_keys($goodsid))."')");
			$item['goods'] = $goods;
		}
		include $this->template('order');
	}

	public function doWebDeleteImage() {
		global $_GPC, $_W;
		$setting = $_W['account']['modules'][$this->_saveing_params['mid']]['config'];
		$setting['picurl'] = '';
		$this->saveSettings($setting);
		message('删除图片成功！', '', 'success');
	}


	public function doMobilelist() {
		global $_GPC, $_W;
		$this->checkAuth();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$condition = '';

		if (!empty($_GPC['ccate'])) {
			$cid = intval($_GPC['ccate']);
			$condition .= " AND ccate = '{$cid}'";
		} elseif (!empty($_GPC['pcate'])) {
			$cid = intval($_GPC['pcate']);
			$condition .= " AND pcate = '{$cid}'";
		}

		$children = array();
		$category = pdo_fetchall("SELECT * FROM ".tablename('shopping_category')." WHERE weid = '{$_W['weid']}' ORDER BY parentid ASC, displayorder DESC");
		foreach ($category as $index => $row) {
			if (!empty($row['parentid'])){
				$children[$row['parentid']][] = $row;
				unset($category[$index]);
			}
		}
		$list = pdo_fetchall("SELECT * FROM ".tablename('shopping_goods')." WHERE weid = '{$_W['weid']}' AND status = '1' $condition ORDER BY displayorder DESC, id DESC LIMIT ".($pindex - 1) * $psize.','.$psize);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('shopping_goods') . " WHERE weid = '{$_W['weid']}' AND status = '1' $condition");
		$pager = pagination($total, $pindex, $psize, $url = '', $context = array('before' => 0, 'after' => 0, 'ajaxcallback' => ''));
		include $this->template('list');
	}

	public function doMobileUpdateCart() {
		global $_GPC, $_W;
		$result = array('status' => 0, 'message' => '');
		$operation = $_GPC['op'];
		$goodsid = intval($_GPC['goodsid']);

		$goods = pdo_fetch("SELECT id, type, total FROM ".tablename('shopping_goods')." WHERE id = :id", array(':id' => $goodsid));
		if (empty($goods)) {
			$result['message'] = '抱歉，该商品不存在或是已经被删除！';
			message($result, '', 'ajax');
		}

		if ($goods['total'] == 0) {
			$result['message'] = '抱歉，该商品库存不足！';
			message($result, '', 'ajax');
		}
		if ($goods['type'] == '1') {
			if (pdo_fetchcolumn("SELECT id, total FROM ".tablename('shopping_cart')." WHERE from_user = :from_user AND weid = '{$_W['weid']}' AND goodstype = '2'", array(':from_user' => $_W['fans']['from_user']))) {
				$result['message'] = '抱歉，虚拟物品与实体物品请分开购买！';
				message($result, '', 'ajax');
			}
		} elseif ($goods['type'] == '2') {
			if (pdo_fetchcolumn("SELECT id, total FROM ".tablename('shopping_cart')." WHERE from_user = :from_user AND weid = '{$_W['weid']}' AND goodstype = '1'", array(':from_user' => $_W['fans']['from_user']))) {
				$result['message'] = '抱歉，虚拟物品与实体物品请分开购买！';
				message($result, '', 'ajax');
			}
		}
		$row = pdo_fetch("SELECT id, total FROM ".tablename('shopping_cart')." WHERE from_user = :from_user AND weid = '{$_W['weid']}' AND goodsid = :goodsid", array(':from_user' => $_W['fans']['from_user'], ':goodsid' => $goodsid));

		if (empty($row['id'])) {
			if ($operation == 'reduce') {
				$result['message'] = '您并没有购买此商品！';
				$result['total'] = 0;
				message($result, '', 'ajax');
			}
			$data = array(
				'weid' => $_W['weid'],
				'goodsid' => $goodsid,
				'goodstype' => $goods['type'],
				'from_user' => $_W['fans']['from_user'],
				'total' => '1',
			);
			pdo_insert('shopping_cart', $data);
		} else {
			$row['total'] = $operation == 'reduce' ? ($row['total'] - 1) : ($row['total'] + 1);
			if ($goods['total'] > -1 && $row['total'] > $goods['total']) {
				$result['message'] = '抱歉，该商品库存不足！';
				message($result, '', 'ajax');
			}
			if (empty($row['total'])) {
				pdo_delete('shopping_cart', array('from_user' => $_W['fans']['from_user'], 'weid' => $_W['weid'], 'goodsid' => $goodsid));
			} else {
				$data = array(
					'total' => $row['total'],
				);
				pdo_update('shopping_cart', $data, array('from_user' => $_W['fans']['from_user'], 'weid' => $_W['weid'], 'goodsid' => $goodsid));
			}
		}
		$result['status'] = 1;
		$result['message'] = '商品数据更新成功！';
		$result['total'] = intval($data['total']);
		message($result, '', 'ajax');
	}

	public function doMobileMyCart() {
		global $_W, $_GPC;
		$this->checkAuth();
		if (checksubmit('submit')) {
			$goodstype = intval($_GPC['goodstype']) ? intval($_GPC['goodstype']) : 1;
			$cart = pdo_fetchall("SELECT * FROM ".tablename('shopping_cart')." WHERE goodstype = '{$goodstype}' AND weid = '{$_W['weid']}' AND from_user = '{$_W['fans']['from_user']}'", array(), 'goodsid');
			if (!empty($cart)) {
				$goods = pdo_fetchall("SELECT id, title, thumb, marketprice, unit, total FROM ".tablename('shopping_goods')." WHERE id IN ('".implode("','", array_keys($cart))."')");
				if (!empty($goods)) {
					foreach ($goods as $row) {
						if (empty($cart[$row['id']]['total'])) {
							continue;
						}
						if ($row['total'] != -1 && $row['total'] < $cart[$row['id']]['total']) {
							message('抱歉，“'.$row['title'].'”此商品库存不足！', $this->createMobileUrl('mycart'), 'error');
						}
						$price += (floatval($row['marketprice']) * intval($cart[$row['id']]['total']));
					}
				}
				$data = array(
					'weid' => $_W['weid'],
					'from_user' => $_W['fans']['from_user'],
					'ordersn' => date('md') . random(4, 1),
					'price' => $price,
					'status' => 0,
					'sendtype' => intval($_GPC['sendtype']),
					'paytype' => intval($_GPC['paytype']),
					'goodstype' => intval($_GPC['goodstype']),
					'createtime' => TIMESTAMP,
				);
				pdo_insert('shopping_order', $data);
				$orderid = pdo_insertid();
				//插入订单商品
				foreach ($goods as $row) {
					if (empty($row)) {
						continue;
					}
					pdo_insert('shopping_order_goods', array(
						'weid' => $_W['weid'],
						'goodsid' => $row['id'],
						'orderid' => $orderid,
						'total' => $cart[$row['id']]['total'],
						'createtime' => TIMESTAMP,
					));
				}
				//清空购物车
				pdo_delete('shopping_cart', array('weid' => $_W['weid'], 'from_user' => $_W['fans']['from_user']));
				//变更商品库存
				if (!empty($goods)) {
					foreach ($goods as $row) {
						if (empty($cart[$row['id']]['total'])) {
							continue;
						}
						pdo_query("UPDATE ".tablename('shopping_goods')." SET total = :total WHERE id = :id AND total > 0", array(':total' => $row['total'] - $cart[$row['id']]['total'], ':id' => $row['id']));
					}
				}
				//更新粉丝资料
				fans_update($_W['fans']['from_user'], array(
					'realname' => $_GPC['realname'],
					'resideprovince' => $_GPC['resideprovince'],
					'residecity' => $_GPC['residecity'],
					'residedist' => $_GPC['residedist'],
					'address' => $_GPC['address'],
					'mobile' => $_GPC['mobile'],
					'qq' => $_GPC['qq'],
				));
				message('提交订单成功，现在跳转至付款页面...', $this->createMobileUrl('pay', array('orderid' => $orderid)), 'success');
			} else {
				message('抱歉，您的购物车里没有任何商品，请先购买！', $this->createMobileUrl('list'), 'error');
			}
		}
		$goodstype = 1;
		$cart = pdo_fetchall("SELECT * FROM ".tablename('shopping_cart')." WHERE goodstype = '{$goodstype}' AND weid = '{$_W['weid']}' AND from_user = '{$_W['fans']['from_user']}'", array(), 'goodsid');
		if (empty($cart)) {
			$goodstype = 2;
			$cart = pdo_fetchall("SELECT * FROM ".tablename('shopping_cart')." WHERE goodstype = '{$goodstype}' AND weid = '{$_W['weid']}' AND from_user = '{$_W['fans']['from_user']}'", array(), 'goodsid');
		}
		if (!empty($cart)) {
			$goods = pdo_fetchall("SELECT id, title, thumb, marketprice, unit FROM ".tablename('shopping_goods')." WHERE id IN ('".implode("','", array_keys($cart))."')");
		}
		if (empty($goods)) {
			message('抱歉，您的购物车里没有任何商品，请先购买！', $this->createMobileUrl('list'), 'error');
		}
		$profile = fans_search($_W['fans']['from_user'], array('realname', 'resideprovince', 'residecity', 'residedist', 'address', 'mobile', 'qq'));
		include $this->template('cart');
	}

	public function doMobilePay() {
		global $_W, $_GPC;
		$this->checkAuth();
		$orderid = intval($_GPC['orderid']);
		$order = pdo_fetch("SELECT * FROM ".tablename('shopping_order')." WHERE id = :id", array(':id' => $orderid));
		if ($order['status'] != '0') {
			message('抱歉，您的订单已经付款或是被关闭，请重新进入付款！', $this->createMobileUrl('myorder'), 'error');
		}
		if (checksubmit('paytype1')) {
			if ($order['paytype'] != 1) {
				message('抱歉，您的支付方式不正确，请重新提交订单！', $this->createMobileUrl('myorder'), 'error');
			}
			if ($_W['fans']['credit2'] < $order['price']) {
				message('抱歉，您帐户的余额不够支付该订单，请充值！', create_url('mobile/module/charge', array('name' => 'member', 'weid' => $_W['weid'])), 'error');
			}

			if (pdo_update('card_members', array('credit2' => $profile['credit2'] - $order['price']), array('from_user' => $_W['fans']['from_user']))) {
				pdo_update('shopping_order', array('status' => 1), array('id' => $orderid));
				message('余额付款成功！', $this->createMobileUrl('myorder'), 'success');
			} else {
				message('余额付款失败，请重试！', $this->createMobileUrl('myorder'), 'error');
			}
		}
		if (checksubmit()) {
			$params['tid'] = $orderid;
			$params['user'] = $_W['fans']['from_user'];
			$params['fee'] = $order['price'];;
			$params['title'] = $_W['account']['name'] . "商城订单{$order['ordersn']}";
			$this->pay($params);
		}

		include $this->template('pay');
	}

	public function doMobileClear() {
		global $_W, $_GPC;
		$this->checkAuth();
		//清空购物车
		pdo_delete('shopping_cart', array('weid' => $_W['weid'], 'from_user' => $_W['fans']['from_user']));
		message('清空购物车成功！', $this->createMobileUrl('list'), 'success');
	}

	public function doMobileMyOrder() {
		global $_W, $_GPC;
		$this->checkAuth();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$list = pdo_fetchall("SELECT * FROM ".tablename('shopping_order')." WHERE weid = '{$_W['weid']}' AND from_user = '{$_W['fans']['from_user']}' ORDER BY id DESC LIMIT ".($pindex - 1) * $psize.','.$psize, array(), 'id');
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('shopping_order') . " WHERE weid = '{$_W['weid']}' AND from_user = '{$_W['fans']['from_user']}'");
		$pager = pagination($total, $pindex, $psize);

		if (!empty($list)) {
			foreach ($list as &$row) {
				$goodsid = pdo_fetchall("SELECT goodsid FROM ".tablename('shopping_order_goods')." WHERE orderid = '{$row['id']}'", array(), 'goodsid');
				$goods = pdo_fetchall("SELECT id, title, thumb, unit, marketprice FROM ".tablename('shopping_goods')."  WHERE id IN ('".implode("','", array_keys($goodsid))."')");
				$row['goods'] = $goods;
			}
		}
		include $this->template('order');
	}

	public function doMobileDetail() {
		global $_W, $_GPC;
		$this->checkAuth();
		$goodsid = intval($_GPC['id']);
		$goods = pdo_fetch("SELECT * FROM ".tablename('shopping_goods')." WHERE id = :id", array(':id' => $goodsid));
		if (empty($goods)) {
			message('抱歉，商品不存在或是已经被删除！');
		}
		if (checksubmit('submit')) {
			$_GPC['count'] = intval($_GPC['count']);
			if ($goods['total'] > -1 && $goods['total'] < $_GPC['count']) {
				message('抱歉，该商品库存不足！');
			}
			$row = pdo_fetch("SELECT id, total FROM ".tablename('shopping_cart')." WHERE from_user = :from_user AND weid = '{$_W['weid']}' AND goodsid = :goodsid", array(':from_user' => $_W['fans']['from_user'], ':goodsid' => $goodsid));
			if (empty($row['id'])) {
				$data = array(
					'weid' => $_W['weid'],
					'goodsid' => $goodsid,
					'goodstype' => $goods['type'],
					'from_user' => $_W['fans']['from_user'],
					'total' => $_GPC['count'],
				);
				pdo_insert('shopping_cart', $data);
			} else {
				$data = array(
					'total' => $row['total'] + $_GPC['count'],
				);
				if ($goods['total'] > -1 && $goods['total'] < $data['total']) {
					message('抱歉，该商品库存不足！');
				}
				pdo_update('shopping_cart', $data, array('from_user' => $_W['fans']['from_user'], 'weid' => $_W['weid'], 'goodsid' => $goodsid));
			}
			message('添加商品成功，请去“我的购物车”提交订单！', $this->createMobileUrl('list'), 'success');
		}
		include $this->template('detail');
	}

	private function checkAuth() {
		global $_W;
		if (empty($_W['fans']['from_user'])) {
			message('非法访问，请重新点击链接进入个人中心！');
		}
	}

	public function payResult($params) {
		$fee = intval($params['fee']);
		pdo_update('shopping_order', array('status' => 1), array('id' => $params['tid']));
		if ($params['from'] == 'return') {
			message('支付成功！', '../../' . $this->createMobileUrl('myorder'), 'success');
		}
	}
}
