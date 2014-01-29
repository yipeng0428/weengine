<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/bootstrap_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/bootstrap_responsive_min.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/todc_bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/themes.css" media="all" />
<link rel="stylesheet" type="text/css" href="./source/modules/public/style/css/inside.css" media="all" />
<script type="text/javascript" src="./source/modules/public/style/src/jQuery.js"></script>
<script type="text/javascript" src="./source/modules/public/style/src/bootstrap_min.js"></script>
<script type="text/javascript" src="./source/modules/public/style/src/inside.js"></script>
<title>一战到底 - <?php if(empty($_W['setting']['copyright']['sitename'])) { ?>VFAN - 微信公众平台管理系统<?php } else { ?><?php echo $_W['setting']['copyright']['sitename'];?><?php } ?></title>
    <!--[if lte IE 9]><script src="./source/modules/public/style/src/watermark.js"></script><![endif]-->
	<!--[if IE 7]><link href="./source/modules/public/style/css/font_awesome_ie7.css" rel="stylesheet" /><![endif]-->
</head>
<body>
    <div id="main">
        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span12">

                    <div class="box">
                        <div class="box-title">
                            <div class="span8">
                                <h3><i class="icon-table"></i>一战到底活动信息</h3>
                            </div>
                            <div class="span4">
                                <form action="" method="post" class="form-horizontal">
                                    <input type="text" id="keyword-input" name="keywords" class="input-small-z" placeholder="请输入关键词" data-rule-required="true" />
                                    <button class="btn">查询</button>
                                </form>
                            </div>
                        </div>

                        <div class="box-content">
                            <div class="alert hide">
                                <span>你本月有 3 次机会可免收活动创建费，已经使用了 2 次机会!</span>
                            </div>
                            <div class="row-fluid">
                                <div class="span12 control-group">
                                    <div class="span7">
                                        <a class="btn" href="<?php echo create_url('site/module/addplay', array('state' => '', 'name' => 'fighting'))?>"><i class="icon-plus"></i>一战到底活动</a>
                                        <a class="btn" href="javascript:location.reload()"><i class="icon-refresh"></i>刷新</a>
                                    </div>
                                    <div class="span5 datatabletool">
                                        <a class="btn"  attr="BatchDel" title="删除"><i class="icon-trash"></i>删除</a>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row-fluid dataTables_wrapper">
                                <form action="" method="post" class="form-horizontal">
                                    <table id="listTable" class="table table-bordered table-hover  dataTable">
                                        <thead>
                                            <tr>
                                                <th class='with-checkbox'>
                                                    <input type="checkbox" class="check_all" /></th>
                                                <th>活动名称</th>
                                                <th>关键字</th>
                                                <th>有效参与人数</th>
                                                <th>总浏览数</th>
                                                <th>开始时间/结束时间</th>
                                                <th>状态</th>
                                                <th class="norightborder">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php if(is_array($list)) { foreach($list as $row) { ?>		                                      
                                            <tr>
                                                <td class="with-checkbox">
                                                    <input type="checkbox" name="check" value="<?php echo $row['id'];?>"></td>
                                                <td><?php echo $row['title'];?> </td>
                                                <td><?php if(is_array($row['keywords'])) { foreach($row['keywords'] as $kw) { ?>
														<?php echo $kw['content'];?>
													<?php } } ?></td>
                                                <td><?php echo $row['fansnum'];?></td>
                                                <td><?php echo $row['viewnum'];?></td>
                                                <td><?php echo $row['starttime'];?><br>
                                                    <?php echo $row['endtime'];?></td>
                                                <td><?php echo $row['status'];?></td>
                                                <td class="norightborder">
                                                    <a class="btn" rel="tooltip" href="<?php echo create_url('site/module/Updateplay', array('state' => '', 'name' => 'fighting','rid'=>$row['id']))?>" title="编辑"><i class="icon-edit"></i></a>
													<?php if($row['show']==1) { ?>
														<a class="btn" title="开始活动" href="javascript:drop_confirm('您确定要开始吗，设置中途可以随时修改!', '<?php echo create_url('site/module/setshow', array('state' => '', 'name' => 'fighting','rid'=>$row['id'],'isshow'=>1))?>');"><i class="icon-play"></i></a>                                       
													<?php } else if($row['show']==2) { ?>
														<a class="btn" title="结束活动" href="javascript:drop_confirm('您确定要暂停吗，设置中途可以随时修改!', '<?php echo create_url('site/module/setshow', array('state' => '', 'name' => 'fighting','rid'=>$row['id'],'isshow'=>0))?>');"><i class="icon-stop"></i></a>                                       														
													<?php } ?>

                                                    
													<a class="btn" rel="tooltip" href="javascript:drop_confirm('您确定要删除吗?', '<?php echo create_url('site/module/delete', array('state' => '', 'name' => 'fighting','rid'=>$row['id']))?>');" title="删除"><i class="icon-remove"></i></a>
												</td>
                                            </tr>
                                            <?php } } ?> 
                                            </tbody>
                                    </table>
                                </form>
                               <div class="dataTables_paginate paging_full_numbers"><span><?php echo $pager;?></span></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
$(function(){
	$("[attr='BatchDel']").click(function(){
		var check = $("input:checked");
		if(check.length<1){
			alert('请选择删除项');
			return false;
		}
		var id = new Array();
		check.each(function(i){
			id[i] = $(this).val();
		});

		$.post('<?php echo create_url('site/module/deleteAll', array('state' => '', 'name' => 'fighting'))?>', {idArr:id},function(data){
			if (data.errno ==0)
			{
				location.reload();
			} else {
				alert(data.error);
			}


		},'json');

	});
});
</script>
<script>
function drop_confirm(msg, url){
    if(confirm(msg)){
        window.location = url;
    }
}
</script>
</body>
</html>
