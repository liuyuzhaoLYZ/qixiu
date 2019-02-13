<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-07 15:27:36
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-07 15:29:44
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
use Think\Controller;
//声明类并且继承父类
class EmptyController extends Controller{

    public function _empty(){

        $this -> display('Empty/error');
    }
}