<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-01-30 17:36:14
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-18 15:47:39
 */
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
//use Think\Controller;
//声明类并且继承父类
class UserController extends CommonController{

    public function add(){
        if(IS_POST){
            //处理表单提交
            //$post = I('post.');
            $model = M('User');
            //数据对象的创建与处理
            $data = $model -> create();//不传递数据就接受post数据
            //if(!$data){
              //  $this -> error($model -> getError());exit;
          //  }
            $data['addtime'] = time();
            $result =$model->add($data);
            //判断返回值
            if($result){
                //成功
                $this -> success('添加成功',U('showList'),1);
            }else{
                //失败
                $this ->error('添加失败');
            }

        }else{
             $model = M('Dept');
            //查询部门信息
            $data = $model->select();
            //数据传入
           // dump($data);die;
            $this ->assign('data',$data);
            //模板展示
            $this -> display();
        }



    }

    public function showList(){
        //关联数据表
        $model = M('User');
        //查询中记录数
        $count = $model->count();
        //实例化page类
        $Page = new \Think\Page($count,1);//每页显示一条数据

        $Page -> rollPage = 4;
        $Page -> lastSuffix = false;
        $Page -> setConfig('prev','上一页');
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('last','末页');
        $Page -> setConfig('first','首页');
        //使用show方法生成url
        $show = $Page ->show();
        //查询
        $data = $model->limit($Page-> firstRow,$Page-> lastRow)->select();
        //展示数据
        $this ->assign('data',$data);
        $this ->assign('show',$show);
        //模板展示
        $this -> display();

    }

    public function edit(){
        if(IS_POST){
             $model = D('User');
            //数据对象的创建与处理
            $data = $model -> create();//不传递数据就接受post数据
            if(!$data){
                $this -> error($model -> getError());exit;
            }
            $result =$model->save();
            //判断返回值
            if($result !== false){
                //成功
                $this -> success('添加成功',U('showList'),1);
            }else{
                //失败
                $this ->error('添加失败','',1);

            }

        }else{
                 //接受id
                $id = I('get.id');
                //实例化模型
                $model = M('User');
                //查询部门信息
                $data = $model ->find($id);
                //查询全部数据给下拉列表使用
                 $info = $model -> field('t1.*,t2.name as deptname') -> table('sp_user as t1,sp_dept as t2') -> where('t1.dept_id = t2.id') -> select();
                //展示数据
                $this -> assign('data',$data);
                $this -> assign('info',$info);
                $this ->display();

        }

    }

    public function del(){
             //接受id
            $id = I('get.id');
            //实例化模型
            $model = M('User');
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


     public function showContent(){

        //接受id
        $id = I('get.id');
        //查询数据
        $data = M('User') -> find($id);
        //传输数据
        echo"昵称：" . $data['nickname'] . "</br>";
        echo"性别：" . $data['sex'] . "</br>";
        echo"电话：" . $data['tel'] . "</br>";
        echo"生日：" . $data['birthday'] . "</br>";
        echo"邮箱：" . $data['email'] . "</br>";
        echo"备注：" . $data['remark'] . "</br>";
    }
}
