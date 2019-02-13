<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-03 20:01:32
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-07 15:48:58
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
//use Think\Controller;
//声明类并且继承父类
class KnowledgeController extends CommonController{
  //add方法
    public function add(){
        if(IS_POST){
            //处理提交
            $post = I('post.');
            //补全addtime字段
            //$post['addtime'] = time();
            //实例化model
            $model = D('Knowledge');
            //数据保存
            $result = $model -> addData($post,$_FILES['thumb']);
            if($result){
                //成功
                $this ->success('添加成功',U('showList'),1);

            }else{
                //失败
                $this ->error('添加失败','',1);

            }

        }else{

                //展示模板
                $this ->display();

        }
    }


    public function showList(){
            //查询
            $model = D('Knowledge');
            $data = $model -> select();
            //数据导入
            $this ->assign('data',$data);
            //展示模板
            $this ->display();
    }

}