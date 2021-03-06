<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/myoA/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/myoA/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/myoA/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="javascript:;" class="add">添加</a>
    <a href="javascript:;" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
                <th class="name">部门</th>
                <th class="process">所属部门</th>
                <th class="node">排序</th>
                <th class="time">备注</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            	<td class="num"><?php echo ($vol["id"]); ?></td>
                <td class="name"><?php echo (str_repeat('&emsp;',$vol["level"]*2)); echo ($vol["name"]); ?></td>
                <td class="process"><?php if($vol["pid"] == 0): ?>顶级部门<?php else: echo ($vol["deptname"]); endif; ?></td>
                <td class="node"><?php echo ($vol["sort"]); ?></td>
                <td class="time"><?php echo ($vol["remark"]); ?></td>
                <td class="operate"><a href="javascript:;" class='show' data-name='<?php echo ($vol["name"]); ?>' data-remark='<?php echo ($vol["remark"]); ?>' data='<?php echo ($vol["id"]); ?>'>查看</a>|<a href="/myoA/index.php/Admin/Dept/edit/id/<?php echo ($vol["id"]); ?>">编辑</a>|<input type="checkbox" class="deptid" value="<?php echo ($vol["id"]); ?>"/></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript" src="/myoA/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/myoA/Public/Admin/js/jquery.pagination.js"></script>
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

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);
	},
	display_msg: true,
	setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');


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
        window.location.href = '/myoA/index.php/Admin/Dept/del/id/' + id;
    });
});


//查看
//jQuery代码
$(function(){
    //给查看按钮绑定点击事件
    $('.show').on('click',function(){
        //获取id
        var id = $(this).attr('data');
        var title = $(this).attr('data-name');
        //获取公文标题
        var remark = $(this).attr('data-remark');
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: 0.3,   //背景透明
            area: ['560px', '90%'],
            content: '/myoA/index.php/Admin/Dept/showContent/id/' + id //iframe的url
        });
    });
});
</script>
</html>