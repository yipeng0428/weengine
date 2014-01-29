<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');
define(EARTH_RADIUS, 6371);//地球半径，平均半径为6371km

class BusinessModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		$lat = $this->message['location_x'];
		$lng = $this->message['location_y'];

		$range = isset($this->module['config']['range']) ? $this->module['config']['range'] : 5;
		$point = $this->squarePoint($lng, $lat, $range);
		$sql = "SELECT id, title, thumb, content FROM ".tablename('business')." WHERE weid = '{$_W['weid']}' AND lat<>0 AND lat > '{$point['right-bottom']['lat']}' AND
					 lat < '{$point['left-top']['lat']}' AND lng > '{$point['left-top']['lng']}' AND lng < '{$point['right-bottom']['lng']}'";
		$result = pdo_fetchall($sql);
		$news = array();
		if (!empty($result)) {
			foreach ($result as $row) {
				$news[] = array(
					'title' => $row['title'],
					'description' => cutstr($row['content'], 300),
					'picurl' => $_W['attachurl'] . $row['thumb'],
					'url' => create_url('mobile/module/detail', array('name' => 'business', 'id' => $row['id'], 'weid' => $_W['weid'])),
				);
			}
			return $this->respNews($news);
		} else {
			return $this->respText('抱歉，系统中的商户不在您附近！');
		}
	}


	/**
	 *计算某个经纬度的周围某段距离的正方形的四个点
	 *
	 *@param lng float 经度
	 *@param lat float 纬度
	 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
	 *@return array 正方形的四个点的经纬度坐标
	*/
	public function squarePoint($lng, $lat, $distance = 0.5){

		$dlng =  2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));
		$dlng = rad2deg($dlng);

		$dlat = $distance/EARTH_RADIUS;
		$dlat = rad2deg($dlat);

		return array(
			'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
			'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
			'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
			'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
		);
	}

}
