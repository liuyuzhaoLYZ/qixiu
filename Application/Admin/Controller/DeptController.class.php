<?php
//命名空间声明
namespace Admin\Controller;
//引入父类控制器
//use Think\Controller;
//声明类并且继承父类
class DeptController extends CommonController{
	public function add(){
		if(IS_POST){
			//处理表单提交
			//$post = I('post.');
			$model = D('Dept');
			//数据对象的创建与处理
			$data = $model -> create();//不传递数据就接受post数据
			if(!$data){
				$this -> error($model -> getError());exit;
			}
			$result =$model->add();
			//判断返回值
			if($result){
				//成功
				$this -> success('添加成功',U('showList'),1);
			}else{
				//失败
				$this ->error('添加失败');
			}

		}else{
			//关联dept表
			$model =M('Dept');
			$data = $model->where('pid = 0')->select();
			//展示数据
			$this -> assign('data',$data);
			//展示模板
			$this ->display();
		}
	}


	public function showList(){
		//实例化模型
		$model = M('Dept');
		//查询
		$data = $model-> order('id asc')->select();
		//二次遍历查询顶级部门
		foreach ($data as $key => $value) {

			if($value['pid'] > 0){
				//查询pid对应的部门信息
				$info = $model->find($value['pid']);
				//只需要保留其中的name
				$data[$key]['deptname']= $info['name'];
			}
		}
		//使用load载入文件tree.php
		load('@/tree');
		$data = getTree($data);
		//传数据
		$this ->assign('data',$data);
		$this ->display();
	}


	public function edit(){

		if(IS_POST){
			$model = D('Dept');
			//数据对象的创建与处理
			$data = $model -> create();//不传递数据就接受post数据
			if(!$data){
				$this -> error($model -> getError());exit;
			}
			$result =$model->save();
			//判断返回值
			if($result !== false){
				//成功
				$this -> success('编辑成功',U('showList'),1);
			}else{
				//失败
				$this ->error('编辑失败','',1);

			}
		}else{
			//接受id
				$id = I('get.id');
				//实例化模型
				$model = M('Dept');
				//查询部门信息
				$data = $model ->find($id);
				//查询全部数据给下拉列表使用
				$info = $model -> where(id != $id) -> select();
				//展示数据
				$this -> assign('data',$data);
				$this -> assign('info',$info);
				//dump($info);die;
				//展示模板
				$this -> display();
		}
	}


	//del方法
	public function del(){

		//接受id
		$id = I('get.id');
		//实例化模型
		$model = M('Dept');
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
        $data = M('Dept') -> find($id);
        //传输数据
        echo $data['remark'];
    }
}
