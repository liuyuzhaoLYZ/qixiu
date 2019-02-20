<?php
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明模型并且继承父类模型
class DeptModel extends Model{
    // 添加时调用create方法允许接收的字段
    protected $insertFields = 'name,sort,remark';
    //自动验证定义
    protected $_validate     =  array(
            //部门规则：必填，不为空
            array('name','require','部门名称不为空！'),
            array('name','','部门已经存在',0,'unique'),
            //使用函数的方式来验证排序是否为是数字
            array('sort','is_numeric','排序必须是数字',0,'function'),
        );
}