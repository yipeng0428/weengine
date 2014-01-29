<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php include $this->template('member', TEMPLATE_INCLUDEPATH);?>
<div class="profile">
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo create_url('mobile/module/profile', array('name' => 'fans', 'weid' => $_W['weid']))?>#qq.com#wechat_redirect">完整资料</a></li>
			<li class="active"><a href="javascript:;">完善资料</a></li>
		</ul>
		<form action="" method="post" enctype="multipart/form-data" onsubmit="return validate();">
		<input type="hidden" name="from_user" value="<?php echo $_W['fans']['from_user'];?>" />
		<div class="tab-content" style="padding:0 10px; margin-top:10px;">
			<div class="tab-pane active">
				<div class="form-item">当前系统需要你完善以下资料才能继续操作</div>
				<table class="form-table">
					<?php if(isset($profile['avatar'])) { ?>
					<tr>
						<th><label for="">头像</label></th>
						<td>
							<input type="hidden" value="" name="avatar" id="avatar">
							<div class="file">
								<input type="file" name="avatar" style="width:51%;">
								<div class="input-prepend input-append">
									<button class="btn" type="button" style="width:51%; text-align:center;"><i class="icon-upload-alt"></i> 上传头像</button>
									<button class="btn btn-inverse" type="button" style="width:50%; text-align:center;" data-toggle="modal" data-target="#sysavatar"><i class="icon-github-alt"></i> 系统头像</button>
								</div>
							</div>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th><label for="">用户名</label></th>
						<td><input type="text" name="" value="<?php echo $_W['fans']['from_user'];?>" readonly="readonly"></td>
					</tr>
					<?php if(isset($profile['nickname'])) { ?>
					<tr>
						<th><label for="">昵称</label></th>
						<td><input type="text" name="nickname" value="<?php echo $profile['nickname'];?>"></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['realname'])) { ?>
					<tr>
						<th><label for="">真实姓名</label></th>
						<td><input type="text" id="" name="realname" value="<?php echo $profile['realname'];?>"></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['gender'])) { ?>
					<tr>
						<th><label for="">性别</label></th>
						<td><select name="gender"><option value="0" <?php if($profile['gender'] == '0') { ?> selected<?php } ?>>保密</option><option value="1" <?php if($profile['gender'] == '1') { ?> selected<?php } ?>>男</option><option value="2" <?php if($profile['gender'] == '2') { ?> selected<?php } ?>>女</option></select></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['birthyear'])) { ?>
					<tr>
						<th><label for="">生日</label></th>
						<td>
							<select name="birthyear" class="pull-left" style="width:30%; margin-right:5%;">
								<option value="0">年</option>
								<?php
									for ($i = $form['birthday']['year']['0']; $i >= $form['birthday']['year']['1']; $i--) {
								?>
								<option value="<?php echo $i;?>" <?php if($profile['birthyear'] == $i) { ?> selected<?php } ?>><?php echo $i;?></option>
								<?php
									}
								?>
							</select>
							<select name="birthmonth" class="pull-left" style="width:30%; margin-right:5%;">
								<option value="0">月</option>
								<?php
									for ($i = 1; $i <= 12; $i++) {
								?>
								<option value="<?php echo $i;?>" <?php if($profile['birthmonth'] == $i) { ?> selected<?php } ?>><?php echo $i;?></option>
								<?php
									}
								?>
							</select>
							<select name="birthday" class="pull-left" style="width:30%;">
								<option value="">日</option>
								<?php
									for ($i = 1; $i <= 31; $i++) {
								?>
								<option value="<?php echo $i;?>" <?php if($profile['birthday'] == $i) { ?> selected<?php } ?>><?php echo $i;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['resideprovince'])) { ?>
					<tr>
						<th><label for="">地区</label></th>
						<td>
							<select name="resideprovince" id="sel-provance" onChange="selectCity();" class="pull-left" style="width:30%; margin-right:5%;">
								<option value="" selected="true">省/直辖市</option>
							</select>
							<select name="residecity" id="sel-city" onChange="selectcounty()" class="pull-left" style="width:30%; margin-right:5%;">
								<option value="" selected="true">请选择</option>
							</select>
							<select name="residedist" id="sel-area" class="pull-left" style="width:30%;">
								<option value="" selected="true">请选择</option>
							</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['address'])) { ?>
					<tr>
						<th><label for="">详细地址</label></th>
						<td><input type="text" id="" name="address" value="<?php echo $profile['address'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['mobile'])) { ?>
					<tr>
						<th><label for="">手机</label></th>
						<td><input type="text" id="" name="mobile" value="<?php echo $profile['mobile'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['qq'])) { ?>
					<tr>
						<th><label for="">QQ</label></th>
						<td><input type="text" id="" name="qq" value="<?php echo $profile['qq'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['email'])) { ?>
					<tr>
						<th><label for="">Email</label></th>
						<td><input type="text" id="" name="email" value="<?php echo $profile['email'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['telephone'])) { ?>
					<tr>
						<th><label for="">固定电话</label></th>
						<td><input type="text" id="" name="telephone" value="<?php echo $profile['telephone'];?>"/ ></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['msn'])) { ?>
					<tr>
						<th><label for="">MSN</label></th>
						<td><input type="text" id="" name="msn" value="<?php echo $profile['msn'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['taobao'])) { ?>
					<tr>
						<th><label for="">阿里旺旺</label></th>
						<td><input type="text" id="" name="taobao" value="<?php echo $profile['taobao'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['alipay'])) { ?>
					<tr>
						<th><label for="">支付宝帐号</label></th>
						<td><input type="text" id="" name="alipay" value="<?php echo $profile['alipay'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['studentid'])) { ?>
					<tr>
						<th><label for="">学号</label></th>
						<td><input type="text" id="" name="studentid" value="<?php echo $profile['studentid'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['grade'])) { ?>
					<tr>
						<th><label for="">班级</label></th>
						<td><input type="text" id="" name="grade" value="<?php echo $profile['grade'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['graduateschool'])) { ?>
					<tr>
						<th><label for="">毕业学校</label></th>
						<td><input type="text" id="" name="graduateschool" value="<?php echo $profile['graduateschool'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['education'])) { ?>
					<tr>
						<th><label for="">学历</label></th>
						<td>
							<select name="education">
							<?php if(is_array($form['education'])) { foreach($form['education'] as $item) { ?>
							<option value="<?php echo $item;?>" <?php if($profile['education'] == $item) { ?> selected<?php } ?>><?php echo $item;?></option>
							<?php } } ?>
							</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['company'])) { ?>
					<tr>
						<th><label for="">公司</label></th>
						<td><input type="text" id="" name="company" value="<?php echo $profile['company'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['occupation'])) { ?>
					<tr>
						<th><label for="">职业</label></th>
						<td><input type="text" id="" name="occupation" value="<?php echo $profile['occupation'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['position'])) { ?>
					<tr>
						<th><label for="">职位</label></th>
						<td><input type="text" id="" name="position" value="<?php echo $profile['position'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['revenue'])) { ?>
					<tr>
						<th><label for="">年收入</label></th>
						<td><input type="text" id="" name="revenue" value="<?php echo $profile['revenue'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['constellation'])) { ?>
					<tr>
						<th><label for="">星座</label></th>
						<td>
							<select name="constellation">
							<?php if(is_array($form['constellation'])) { foreach($form['constellation'] as $item) { ?>
							<option value="<?php echo $item;?>" <?php if($profile['constellation'] == $item) { ?> selected<?php } ?>><?php echo $item;?></option>
							<?php } } ?>
							</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['zodiac'])) { ?>
					<tr>
						<th><label for="">生肖</label></th>
						<td>
							<select name="zodiac">
							<?php if(is_array($form['zodiac'])) { foreach($form['zodiac'] as $item) { ?>
							<option value="<?php echo $item;?>" <?php if($profile['zodiac'] == $item) { ?> selected<?php } ?>><?php echo $item;?></option>
							<?php } } ?>
							</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['nationality'])) { ?>
					<tr>
						<th><label for="">国籍</label></th>
						<td><input type="text" id="" name="nationality" value="<?php echo $profile['nationality'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['height'])) { ?>
					<tr>
						<th><label for="">身高</label></th>
						<td><input type="text" id="" name="height" value="<?php echo $profile['height'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['weight'])) { ?>
					<tr>
						<th><label for="">体重</label></th>
						<td><input type="text" id="" name="weight" value="<?php echo $profile['weight'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['bloodtype'])) { ?>
					<tr>
						<th><label for="">血型</label></th>
						<td>
						<select name="bloodtype">
							<?php if(is_array($form['bloodtype'])) { foreach($form['bloodtype'] as $item) { ?>
							<option value="<?php echo $item;?>" <?php if($profile['bloodtype'] == $item) { ?> selected<?php } ?>><?php echo $item;?></option>
							<?php } } ?>
						</select>
						</td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['idcard'])) { ?>
					<tr>
						<th><label for="">身份证号</label></th>
						<td><input type="text" id="" name="idcard" value="<?php echo $profile['idcard'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['zipcode'])) { ?>
					<tr>
						<th><label for="">邮编</label></th>
						<td><input type="text" id="" name="zipcode" value="<?php echo $profile['zipcode'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['site'])) { ?>
					<tr>
						<th><label for="">个人主页</label></th>
						<td><input type="text" id="" name="site" value="<?php echo $profile['site'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['affectivestatus'])) { ?>
					<tr>
						<th><label for="">情感状态</label></th>
						<td><input type="text" id="" name="affectivestatus" value="<?php echo $profile['affectivestatus'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['lookingfor'])) { ?>
					<tr>
						<th><label for="">交友目的</label></th>
						<td><input type="text" id="" name="lookingfor" value="<?php echo $profile['lookingfor'];?>" /></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['bio'])) { ?>
					<tr>
						<th><label for="">自我介绍</label></th>
						<td><textarea name="bio"><?php echo $profile['bio'];?></textarea></td>
					</tr>
					<?php } ?>
					<?php if(isset($profile['interest'])) { ?>
					<tr>
						<th><label for="">兴趣爱好</label></th>
						<td><textarea name="interest"><?php echo $profile['interest'];?></textarea></td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<table class="form-table">
				<tr>
					<td colspan="2" align="center"><input type="hidden" name="token" value="<?php echo $_W['token'];?>" /><input type="submit" class="btn btn-large submit" value="提交" name="submit"></td>
				</tr>
			</table>
		</div>
	</form>
	</div>
</div>
<?php if(isset($profile['avatar'])) { ?>
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
		<?php $avatar_url = 'resource/image/avatar/';?>
		<span><img src="<?php echo $avatar_url;?>avatar_1.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_2.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_3.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_4.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_5.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_6.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_7.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_8.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_9.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_10.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_11.jpg" /></span>
		<span><img src="<?php echo $avatar_url;?>avatar_12.jpg" /></span>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">完成</button>
	</div>
</div>
<?php } ?>
<?php if(isset($profile['resideprovince'])) { ?>
<script type="text/javascript">
cascdeInit('<?php echo $profile['resideprovince'];?>','<?php echo $profile['residecity'];?>','<?php echo $profile['residedist'];?>'); //开启地区三级联动
$("#sysavatar .modal-body").delegate("span", "click", function(){
	$("#sysavatar .modal-body span").css("border", "2px #E1E1E1 solid");
	$(this).css("border", "2px #ED2F2F solid");
	$('#avatar').val($(this).find("img").attr("src"));
});
</script>
<?php } ?>
<?php include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
