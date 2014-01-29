<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<form action="" method="post" class="form-horizontal form">
		<h4>签到设置</h4>
		<table class="tb">
			<tr>
				<th>每日签到次数</th>
				<td>
					<input type="text" name="times" class="span2" value="<?php echo $settings['times'];?>" /> 次
				</td>
			</tr>									<tr>								<th>签到时间范围</th>								<td>								   从<input name="start_time" type="text" id="example_2" value="<?php echo $settings['start_time'];?>" />				   至<input name="end_time" type="text" id="example_9" value="<?php echo $settings['end_time'];?>" />								</td>			</tr>						<tr>				<th>每次签到奖励</th>				<td>					<input type="text" name="credit" class="span2" value="<?php echo $settings['credit'];?>" /> 积分				</td>			</tr>						<tr>				<th>排行榜显示前</th>				<td>					<input type="text" name="rank" class="span2" value="<?php echo $settings['rank'];?>" /> 名				</td>			</tr>
			<tr>
				<th></th>
				<td>
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3" style="height:30px" />
					<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div><link rel="stylesheet" type="text/css" href="./source/modules/signin/template/style/css/main.css" /><link rel="stylesheet" type="text/css" href="./source/modules/signin/template/style/css/jquery-ui.css" /><style type="text/css">a{color:#007bc4/*#424242*/; text-decoration:none;}a:hover{text-decoration:underline}ol,ul{list-style:none}body{height:100%; font:12px/18px Tahoma, Helvetica, Arial, Verdana, "\5b8b\4f53", sans-serif; color:#51555C;}img{border:none}.demo{width:500px; margin:20px auto}.demo h4{height:32px; line-height:32px; font-size:14px}.demo h4 span{font-weight:500; font-size:12px}.demo p{line-height:28px;}input{width:200px; height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3}pre{padding:6px 0 0 0; color:#666; line-height:20px; background:#f7f7f7}.ui-timepicker-div .ui-widget-header { margin-bottom: 8px;}.ui-timepicker-div dl { text-align: left; }.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }.ui-timepicker-div td { font-size: 90%; }.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }.ui_tpicker_hour_label,.ui_tpicker_minute_label,.ui_tpicker_second_label,.ui_tpicker_millisec_label,.ui_tpicker_time_label{padding-left:20px}</style><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script><script type="text/javascript" src="./source/modules/signin/template/style/js/jquery-ui.js"></script><script type="text/javascript" src="./source/modules/signin/template/style/js/jquery-ui-slide.min.js"></script><script type="text/javascript" src="./source/modules/signin/template/style/js/jquery-ui-timepicker-addon.js"></script><script type="text/javascript">$(function(){	$('#example_1').datetimepicker();	$('#example_2').timepicker({});	$('#example_9').timepicker({});	$('#example_3').datetimepicker({	    showSecond: true,	    showMillisec: true,	    timeFormat: 'hh:mm:ss:l'    });	$('#example_4').timepicker({	    ampm: true,	    hourMin: 8,	    hourMax: 16    });	$('#example_5').datetimepicker({	   hour: 13,	   minute: 15    });	$('#example_6').datetimepicker({	   numberOfMonths: 2,	   minDate: 0,	   maxDate: 30    });	$('#example_7').timepicker({	   hourGrid: 4,	   minuteGrid: 10    });		var ex8 = $('#example_8');      ex8.datetimepicker();      $('#example_8_set_btn').click(function(){	      ex8.datetimepicker('setDate', (new Date()) );      });      $('#example_8_get_btn').click(function(){	       alert(ex8.datetimepicker('getDate'));      });});</script>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>