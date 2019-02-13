<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-01-25 17:30:55
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-07 15:48:57
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
////声明类并且继承父类
class IndexController extends CommonController{

        //index方法
        public function index(){
            //显示模板
            $this ->display();
        }
          //home方法
        public function home(){
            //显示模板
            $this ->display();
        }


}