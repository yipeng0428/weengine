<?php
/**
 * 模板助手
 *
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');

function tpl_form_field_color($name, $value = '') {
	$s = '';
	if (!defined('INCLUDE_KINDEDITOR')) {
		$s = '
		<script type="text/javascript" src="./resource/script/colorpicker/spectrum.js"></script>
		<link type="text/css" rel="stylesheet" href="./resource/script/colorpicker/spectrum.css" />';
	}
	$s .= '
	<input class="span2" type="text" name="'.$name.'" id="color-'.md5($name).'" value="'.$value.'" placeholder="">
	<input class="colorpicker" target="color-'.md5($name).'" value="'.$value.'" />
	<script type="text/javascript">colorpicker();</script>';
	define('INCLUDE_COLOR', true);
	return $s;
}

function tpl_form_field_daterange($name, $value = array(), $options = array()) {
	$s = '';
	if (!defined('INCLUDE_DATERANGE')) {
		$s = '
		<link type="text/css" rel="stylesheet" href="./resource/style/daterangepicker.css" />
		<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>';
	}
	define('INCLUDE_DATERANGE', true);
	$value['starttime'] = empty($value['starttime']) ? mktime(0, 0, 0) :  $value['starttime'];
	$value['endtime'] = empty($value['endtime']) ? ($value['starttime'] + 46800) :  $value['endtime'];
	$s .= '
	<input name="'.$name.'-start" type="hidden" value="'.date('Y-m-d', $value['starttime']).'" />
	<input name="'.$name.'-end" type="hidden" value="'.date('Y-m-d', $value['endtime']).'" />
	<button class="btn" id="'.$name.'-date-range" class="date" type="button"><span class="date-title">'.date('Y-m-d', $value['starttime']).' 至 '.date('Y-m-d', $value['endtime']).'</span> <i class="icon-caret-down"></i></button>
	<script type="text/javascript">
	$("#'.$name.'-date-range").daterangepicker({
		format: "YYYY-MM-DD",
		startDate: $(":hidden[name='.$name.'-start]").val(),
		endDate: $(":hidden[name='.$name.'-end]").val(),
		locale: {
			applyLabel: "确定",
			cancelLabel: "取消",
			fromLabel: "从",
			toLabel: "至",
			weekLabel: "周",
			customRangeLabel: "日期范围",
			daysOfWeek: moment()._lang._weekdaysMin.slice(),
			monthNames: moment()._lang._monthsShort.slice(),
			firstDay: 0
		}
	}, function(start, end){
		$("#'.$name.'-date-range .date-title").html(start.format("YYYY-MM-DD") + " 至 " + end.format("YYYY-MM-DD"));
		$(":hidden[name='.$name.'-start]").val(start.format("YYYY-MM-DD"));
		$(":hidden[name='.$name.'-end]").val(end.format("YYYY-MM-DD"));
	});</script>';
	return $s;
}

function tpl_form_field_image($name, $value = '') {
	$s = '';
	if (!defined('INCLUDE_KINDEDITOR')) {
		$s = '
		<script type="text/javascript" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script type="text/javascript" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
		<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />';
	}
	$s .= '
	<div style="display:block; margin-top:5px;" class="input-append">
	<input type="text" value="'.$value.'" name="'.$name.'" id="upload-image-url-'.$name.'" class="span3" autocomplete="off">
	<button class="btn" type="button" id="upload-image-'.$name.'">选择图片</button>
	</div>
	<div id="upload-image-preview-'.$name.'" style="margin-top:10px;">'.(!empty($value) ? '<img src="'.$GLOBALS['_W']['attachurl'] . $value.'" width="100" />' : '').'</div>
	<script type="text/javascript">
	var editor = KindEditor.editor({
		allowFileManager : true,
		uploadJson : "./index.php?act=attachment&do=upload",
		fileManagerJson : "./index.php?act=attachment&do=manager",
		afterUpload : function(url, data) {
			$("#upload-image-url-'.$name.'").val(data.filename);
			$("#upload-image-preview-'.$name.'").html(\'<img src="\'+url+\'" width="100" />\');
		}
	});
	$("#upload-image-'.$name.'").click(function() {
		editor.loadPlugin("image", function() {
			editor.plugin.imageDialog({
				imageUrl : $("#upload-image-url-'.$name.'").val(),
				clickFn : function(url) {
					editor.hideDialog();
					var filename = /images(.*)/.exec(url);
					$("#upload-image-url-'.$name.'").val(filename[0]);
					$("#upload-image-preview-'.$name.'").html(\'<img src="\'+url+\'" width="100" />\');
				}
			});
		});
	});
	</script>';
	define('INCLUDE_KINDEDITOR', true);
	return $s;
}

function tpl_fans_form($field, $value = '') {
	switch ($field) {
		case 'avatar':
			$avatar_url = 'resource/image/avatar/';
			$html = '
				<input type="hidden" value="" name="avatar" id="avatar">
				<div class="file">
					<input type="file" name="avatar" style="width:51%;">
					<div class="input-prepend input-append">
						<button class="btn" type="button" style="width:51%; text-align:center;"><i class="icon-upload-alt"></i> 上传头像</button>
						<button class="btn btn-inverse" type="button" style="width:50%; text-align:center;" data-toggle="modal" data-target="#sysavatar"><i class="icon-github-alt"></i> 系统头像</button>
					</div>
				</div>';
			$html .= '
			<div id="sysavatar" class="modal hide fade" tabindex="-1" style="margin-left:0; left:5%; width:90%;" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<style>
				#sysavatar span{overflow:hidden; display: inline-block; border:2px #E1E1E1 solid; margin-bottom:5px; cursor:pointer;}
				#sysavatar span img{width:50px; height:50px;}
				</style>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">选择系统头像</h3>
				</div>
				<div class="modal-body" style="padding-bottom:10px;">
					<span><img src="'.$avatar_url.'avatar_1.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_2.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_3.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_4.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_5.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_6.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_7.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_8.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_9.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_10.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_11.jpg" /></span>
					<span><img src="'.$avatar_url.'avatar_12.jpg" /></span>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">完成</button>
				</div>
			</div>';
			$html .= '
				<script type="text/javascript">
				$("#sysavatar .modal-body").delegate("span", "click", function(){
					$("#sysavatar .modal-body span").css("border", "2px #E1E1E1 solid");
					$(this).css("border", "2px #ED2F2F solid");
					$("#avatar").val($(this).find("img").attr("src"));
				});
				</script>';
			break;
		case 'nickname':
			$html = '<input type="text" name="nickname" value="'.$value.'">';
			break;
		case 'realname':
			$html = '<input type="text" id="" name="realname" value="'.$value.'">';
			break;
		case 'gender':
			$html = '<select name="gender">
						<option value="0" '.($value == 0 ? 'selected ' : '').'>保密</option>
						<option value="1" '.($value == 1 ? 'selected ' : '').'>男</option>
						<option value="2" '.($value == 2 ? 'selected ' : '').'>女</option>
					</select>';
			break;
		case 'birth':
		case 'birthyear':
		case 'birthmonth':
		case 'birthmonth':
			$year = array(date('Y'), '1914');
			$html = '<select name="birthyear" style="width:30%; margin-right:5%;"><option value="0">年</option>';
			for ($i = $year[0]; $i >= $year[1]; $i--) {
				$html .= '<option value="'.$i.'" '.($i == $value['birthyear'] ? 'selected ' : '').'>'.$i.'</option>';
			}
			$html .= '</select>';
			$html .= '<select name="birthmonth" style="width:30%; margin-right:5%;"><option value="0">月</option>';
			for ($i = 1; $i <= 12; $i++) {
				$html .= '<option value="'.$i.'" '.($i == $value['birthmonth'] ? 'selected ' : '').'>'.$i.'</option>';
			}
			$html .= '</select>';
			$html .= '<select name="birthmonth" style="width:30%;"><option value="0">日</option>';
			for ($i = 1; $i <= 31; $i++) {
				$html .= '<option value="'.$i.'" '.($i == $value['birthmonth'] ? 'selected ' : '').'>'.$i.'</option>';
			}
			$html .= '</select>';
			break;
		case 'reside':
		case 'resideprovince':
		case 'residecity':
		case 'residedist':
			$html = '<select name="resideprovince" id="sel-provance" onChange="selectCity();" style="width:30%; margin-right:5%;">';
			$html .= '<option value="" selected="true">省/直辖市</option>';
			$html .= '</select>';
			$html .= '<select name="residecity" id="sel-city" onChange="selectcounty()" style="width:30%; margin-right:5%;">';
			$html .= '<option value="" selected="true">请选择</option>';
			$html .= '</select>';
			$html .= '<select name="residedist" id="sel-area" style="width:30%;">';
			$html .= '<option value="" selected="true">请选择</option>';
			$html .= '</select>';
			$html .= '<script type="text/javascript" src="./resource/script/cascade.js"></script>';
			$html .= "<script type=\"text/javascript\">cascdeInit('{$value['resideprovince']}','{$value['residecity']}','{$value['residedist']}');</script>";
			break;
		case 'address':
			$html = '<input type="text" id="" name="address" value="'.$value.'" />';
			break;
		case 'mobile':
			$html = '<input type="text" id="" name="mobile" value="'.$value.'" />';
			break;
		case 'qq':
			$html = '<input type="text" id="" name="qq" value="'.$value.'">';
			break;
		case 'email':
			$html = '<input type="text" id="" name="email" value="'.$value.'">';
			break;
		case 'telephone':
			$html = '<input type="text" id="" name="telephone" value="'.$value.'">';
			break;
		case 'taobao':
			$html = '<input type="text" id="" name="taobao" value="'.$value.'">';
			break;
		case 'alipay':
			$html = '<input type="text" id="" name="alipay" value="'.$value.'">';
			break;
		case 'studentid':
			$html = '<input type="text" id="" name="studentid" value="'.$value.'">';
			break;
		case 'grade':
			$html = '<input type="text" id="" name="grade" value="'.$value.'">';
			break;
		case 'graduateschool':
			$html = '<input type="text" id="" name="graduateschool" value="'.$value.'">';
			break;
		case 'education':
			$options = array('博士','硕士','本科','专科','中学','小学','其它');
			$html = '<select name="education">';
			foreach ($options as $item) {
				$html .= '<option value="'.$item.'" '.($value == $item ? 'selected ' : '').'>'.$item.'</option>';
			}
			$html .= '</select>';
			break;
		case 'company':
			$html = '<input type="text" id="" name="company" value="'.$value.'">';
			break;
		case 'occupation':
			$html = '<input type="text" id="" name="occupation" value="'.$value.'">';
			break;
		case 'position':
			$html = '<input type="text" id="" name="position" value="'.$value.'">';
			break;
		case 'revenue':
			$html = '<input type="text" id="" name="revenue" value="'.$value.'">';
			break;
		case 'constellation':
			$options = array('水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座');
			$html = '<select name="constellation">';
			foreach ($options as $item) {
				$html .= '<option value="'.$item.'" '.($value == $item ? 'selected ' : '').'>'.$item.'</option>';
			}
			$html .= '</select>';
			break;
		case 'zodiac':
			$options = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
			$html = '<select name="zodiac">';
			foreach ($options as $item) {
				$html .= '<option value="'.$item.'" '.($value == $item ? 'selected ' : '').'>'.$item.'</option>';
			}
			$html .= '</select>';
			break;
		case 'nationality':
			$html = '<input type="text" id="" name="nationality" value="'.$value.'">';
			break;
		case 'height':
			$html = '<input type="text" id="" name="height" value="'.$value.'">';
			break;
		case 'weight':
			$html = '<input type="text" id="" name="weight" value="'.$value.'">';
			break;
		case 'bloodtype':
			$options = array('A', 'B', 'AB', 'O', '其它');
			$html = '<select name="bloodtype">';
			foreach ($options as $item) {
				$html .= '<option value="'.$item.'" '.($value == $item ? 'selected ' : '').'>'.$item.'</option>';
			}
			$html .= '</select>';
			break;
		case 'idcard':
			$html = '<input type="text" id="" name="idcard" value="'.$value.'">';
			break;
		case 'zipcode':
			$html = '<input type="text" id="" name="zipcode" value="'.$value.'">';
			break;
		case 'site':
			$html = '<input type="text" id="" name="site" value="'.$value.'">';
			break;
		case 'affectivestatus':
			$html = '<input type="text" id="" name="affectivestatus" value="'.$value.'">';
			break;
		case 'lookingfor':
			$html = '<input type="text" id="" name="lookingfor" value="'.$value.'">';
			break;
		case 'bio':
			$html = '<textarea name="bio">'.$value.'</textarea>';
			break;
		case 'interest':
			$html = '<textarea name="interest">'.$value.'</textarea>';
			break;
	}
	return $html;
}