<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-02 17:21:46
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-07 16:33:58
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
//use Think\Controller;
//声明类并且继承父类
class DocController extends CommonController{
    //add方法
    public function add(){
        if(IS_POST){
            //处理提交
            $post = I('post.');
            //补全addtime字段
            //$post['addtime'] = time();
            //实例化model
            $model = D('Doc');
            //数据保存
            $result = $model -> saveData($post,$_FILES['file']);
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

      //showList方法
    public function showList(){
        //查询
        $model = D('Doc');
        $data = $model -> select();
        //数据导入
        $this ->assign('data',$data);
        //展示模板
        $this ->display();
    }
    //edit方法
    public function edit(){
        if(IS_POST){
             //处理提交
            $post = I('post.');
            //补全addtime字段
            //$post['addtime'] = time();
            //实例化model
            $model = D('Doc');
            //数据保存
            $result = $model -> updateData($post,$_FILES['file']);
            if($result){
                //成功
                $this ->success('添加成功',U('showList'),1);

            }else{
                //失败
                $this ->error('添加失败','',1);

            }
        }else{
                //接受id
                $id = I('get.id');
                //查询
                $data = M('Doc') -> find($id);
                //传数据给模板
                $this -> assign('data',$data);
                //展示模板
                $this -> display();

        }

    }

    //下载方法
    public function download(){
        //接收id
        $id = I('get.id');
        //查询数据
        $data = M('Doc') -> find($id);
        //下载代码
        $file = WORKING_PATH . $data['filepath'];
        //输出文件
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: ". filesize($file));
        //输出缓冲区
        readfile($file);
    }

    public function showContent(){

        //接受id
        $id = I('get.id');
        //查询数据
        $data = M('Doc') -> find($id);
        //传输数据
        echo htmlspecialchars_decode($data['content']);
    }
}