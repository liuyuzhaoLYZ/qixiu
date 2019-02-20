<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/myoA/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/myoA/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/myoA/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .id{ width:63px; text-align: center;}
	table tr .name{ width:118px; padding-left:17px;}
	table tr .nickname{ width:63px; padding-left:17px;}
	table tr .dept_id{ width:63px; padding-left:13px;}
	table tr .sex{ width:63px; padding-left:13px;}
	table tr .birthday{ width:80px; padding-left:13px;}
	table tr .tel{ width:113px; padding-left:13px;}
	table tr .email{ width:160px; padding-left:13px;}
	table tr .addtime{ width:160px; padding-left:13px;}
	table tr .operate{ padding-left:13px;}
</style>
</head>

<body>
<div class="title"><h2>公文管理</h2></div>
<div class="table-operate ue-clear">
	<a href="/myoA/index.php/Admin/Doc/add" class="add">添加</a>
    <a href="javascript:;" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="id">序号</th>
                <th class="name">标题</th>
				<th class="file">附件</th>
                <th class="content">作者</th>
				<th class="addtime">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            	<td class="id"><?php echo ($vol["id"]); ?></td>
                <td class="name"><?php echo (msubstr($vol["title"],0,8)); ?></td>
				<td class="file"><?php echo ($vol["filename"]); if($vol["hasfile"] == 1): ?>【<a href="/myoA/index.php/Admin/Doc/download/id/<?php echo ($vol["id"]); ?>">下载</a>】<?php endif; ?></td>
                <td class="content"><?php echo ($vol["author"]); ?></td>
                <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vol["addtime"])); ?></td>
                <td class="operate">
                	<a href ='javascript:;' class='show' data='<?php echo ($vol["id"]); ?>' data-title='<?php echo ($vol["title"]); ?>'>查看</a>|<a href="/myoA/index.php/Admin/Doc/edit/id/<?php echo ($vol["id"]); ?>">编辑</a>|<a href="javascript:;" class="delect" data='<?php echo ($vol["id"]); ?>'>删除</a><input type="checkbox" class="deptid" value="<?php echo ($vol["id"]); ?>"/>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear">
	<div class="pagin-list">
		<?php echo ($page); ?>
	</div>
	<div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
</div>
</body>
<script type="text/javascript" src="/myoA/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/plugin/layer/layer.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
//jQuery代码
$(function(){
    //给查看按钮绑定点击事件
    $('.show').on('click',function(){
        //获取id
        var id = $(this).attr('data');
        //获取公文标题
        var title = $(this).attr('data-title');
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: 0.3,   //背景透明
            area: ['560px', '90%'],
            content: '/myoA/index.php/Admin/Doc/showContent/id/' + id //iframe的url
        });
    });
});

//删除
//jQuery代码
$(function(){
    //给删除按钮绑定点击事件
    $('.del').on('click',function(){
        //事件处理程序
        var idObj = $(':checkbox:checked'); //获取全部已经被选中的checkbox
        var id = '';    //接收处理后的部门id值，组成id1,id2,id3...
        //循环遍历idObj对象，获取其中的每一个值
        for (var i = 0; i < idObj.length; i++) {
            id += idObj[i].value + ',';
        }
        //去掉最后逗号
        id = id.substring(0,id.length - 1);
        //判断id
        if(id == ''){
            return false;
        }
        //带着参数跳转到del方法
        window.location.href = '/myoA/index.php/Admin/Doc/del/id/' + id;
    });
});

$(function(){
    //给删除按钮绑定点击事件
    $('.delect').on('click',function(){
        //事件处理程序
        var id = $(this).attr('data') ;    //接收处理后的部门id值，组成id1,id2,id3...

        //带着参数跳转到del方法
        window.location.href = '/myoA/index.php/Admin/Doc/del/id/' + id;
    });
});

</script>
</html>