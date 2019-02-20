<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-03 20:01:32
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-18 17:10:00
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

         public function showContent(){

        //接受id
        $id = I('get.id');
        //查询数据
        $data = M('Knowledge') -> find($id);
        //传输数据
        echo"作者：" . $data['author'] . "</br>";
        echo"内容：" . $data['content'] . "</br>";
        echo"描述：" . $data['description'] . "</br>";
    }


    public function del(){

        //接受id
        $id = I('get.id');
        //实例化模型
        $model = M('Knowledge');
        //删除
        $result = $model -> delete($id);
        if($result !== false){
                //成功
                $this -> success('删除成功','',1);
            }else{
                //失败
                $this ->error('删除失败','',1);
            }

    }


    public function edit(){
        if(IS_POST){

                $model = D('Knowledge');
                //数据对象的创建与处理
                $data = $model -> create();//不传递数据就接受post数据
                if(!$data){
                    $this -> error($model -> getError());exit;
                }
                $result =$model-> save();
                //判断返回值
                if($result !== false){
                    //成功
                    $this -> success('编辑成功',U('showList'),1);
                }else{
                    //失败
                    $this ->error('编辑失败','',1);

                }
        }else{

                $id = I('get.id');
                $data = M('Knowledge') -> find($id);
                $this -> assign('data',$data);
                $this -> display();

        }

    }


}