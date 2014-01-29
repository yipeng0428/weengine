<?php defined('IN_IA') or exit('Access Denied');?><?php include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li><a href="<?php echo create_url('site/module/addquestion', array('state' => '', 'name' => 'fighting'));?>">添加题目</a></li>
	<li class="active"><a href="">管理题目</a></li>
	<li><a href="<?php echo create_url('site/module/playlist', array('state' => '', 'name' => 'fighting'));?>">活动列表</a></li>
</ul>
<div class="main">
	<div class="search">
		<table class="table table-bordered tb">
			<div class="sub-item" id="table-list">
					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover2">
							<thead class="navbar-inner">
								<tr>
									<th style="width:40px;" class="row-first">选择</th>
									<th style="width:400px;">题目<i></i></th>
									<th class="width:150px;">选项<i></i></th>
									<th style="width:50px;">答案<i></i></th>
									<th style="width:100px;">类型<i></i></th>
									<th style="width:110px;">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($list)) { foreach($list as $row) { ?>
								<tr>
									<td class="row-first"><input type="checkbox" name="select[]" value="<?php echo $row['id'];?>" /></td>
									<td>
										<div class="mainContent">
											<div class="nickname" style="text-align:left;"><?php echo $row['id'];?>、<?php echo substr($row['question'],0,69);?></div>
										</div>
									</td>
									<td style="text-align:left;">
										A.<?php echo $row['optionA'];?> 
										B.<?php echo $row['optionB'];?> 
										<?php if($row['optionC']) { ?>C.<?php echo $row['optionC'];?> <?php } else { ?> <?php } ?>
										<?php if($row['optionD']) { ?>D.<?php echo $row['optionD'];?> <?php } else { ?> <?php } ?>
										<?php if($row['optionE']) { ?>E.<?php echo $row['optionE'];?> <?php } else { ?> <?php } ?>
										<?php if($row['optionF']) { ?>F.<?php echo $row['optionF'];?> <?php } else { ?> <?php } ?>
									</td>
									<td style="text-align:left;"><?php echo an($row['answer'],$row['option_num'])?></td>
									<td style="text-align:left;font-size:12px; color:#666;">
										<div style="margin-bottom:10px;"><?php echo $row['classify'];?></div>
									</td>
									<td style="text-align: left;">
										<a href="<?php echo create_url('site/module/questionedit', array('state' => '', 'name' => 'fighting', 'id' => $row['id']))?>">修改</a>
										<a href="<?php echo create_url('site/module/delquestion', array('state' => '', 'name' => 'fighting', 'id' => $row['id']))?>">删除</a>
									</td>
								</tr>
								<?php } } ?>
							</tbody>
						</table>
						<table class="table">
							<tr>
								<td style="width:40px;" class="row-first"><input type="checkbox" onclick="selectall(this, 'select');" /></td>
								<td colspan="4">
									<input type="submit" name="delete" value="删除选中" class="btn btn-primary" />
									<input type="hidden" name="token" value="<?php echo $_W['token'];?>" />
								</td>
							</tr>
						</table>
					</div>
					</form>
					<?php echo $pager;?>
				</div>
		</table>
	</div>
</div>
<?php include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
