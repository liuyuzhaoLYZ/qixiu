<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-05 15:45:22
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-18 17:54:57
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
//use Think\Controller;
//声明类并且继承父类
class EmailController extends CommonController{
    public function send(){
        if(IS_POST){
            //处理数据
            $post = I('post.');
            //实例化自定义model
            $model = D('Email');
            //调用方法实现数据保存
            $result = $model -> addData($post,$_FILES['file']);
            if($result){
                //成功
                $this -> success('邮件发送成功',U('sendBox'),1);
            }else{
                //失败
                $this -> error('邮件发送失败');
            }
        }else{
                //查询收件人信息
                $data =M('User') -> field('id,truename') -> where("id !=" . session('id')) -> select();
                //展示数据
                $this ->assign('data',$data);
                //展示模板
                $this -> display();

        }

    }

    public function sendBox(){
        //查询当前用户已经发送的邮件的数据
        //select t1.*,t2.truename as truename from sp_email as t1 left join sp_user as t2 on t1.to_id = t2.id where t1.from_id=当前用户的id;
        $data = M('Email') -> field('t1.*,t2.truename as truename') -> alias('t1') -> join('left join sp_user as t2 on t1.to_id = t2.id') ->where('t1.from_id = ' . session('id')) -> select();
        //展示数据
        $this -> assign('data',$data);
        //展示模板
        $this -> display();
    }

    public function download(){
          //接收id
            $id = I('get.id');
            //查询数据
            $data = M('Email') -> find($id);
            //下载代码
            $file = WORKING_PATH . $data['filepath'];
            //输出文件
            header("Content-type: application/octet-stream");
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header("Content-Length: ". filesize($file));
            //输出缓冲区
            readfile($file);
        }

    public function recBox(){
                 $data = M('Email') -> field('t1.*,t2.truename as truename') -> alias('t1') -> join('left join sp_user as t2 on t1.from_id = t2.id') ->where('t1.to_id = ' . session('id')) -> select();
                //展示数据
                $this -> assign('data',$data);
                //展示模板
                $this -> display();


        }

    public function getContent(){
        //接受id
        $id = I('get.id');
        //查询数据
        $data = M('Email') ->where("id = $id and to_id = " . session('id')) -> find();

        if($data['isread'] == '0'){
            //修改状态
            M('Email') -> save(array('id' => $id,'isread' => 1));
        }
        //传输数据
        echo htmlspecialchars_decode($data['content']);
    }
    public function getCount(){
        if(IS_AJAX){
            $model = M('Email');
            $count = $model -> where("isread = 0 and to_id = " . session('id')) -> count();
            echo $count;
       }
    }

    public function del(){

        //接受id
        $id = I('get.id');
        //实例化模型
        $model = M('Email');
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

}