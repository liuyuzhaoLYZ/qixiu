<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-02 18:30:38
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-03 19:43:30
 */
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明模型并且继承父类模型
class DocModel extends Model{
    public function saveData($post,$file){
        //先判断是否有文件需要处理
        if(!$file['error']){
            //定义配置
            $cfg = array(
                    //配置上传路径
                    'rootPath' =>  WORKING_PATH . UPLOAD_ROOT_PATH

                );
      //处理上传,实例化文件上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload -> uploadOne($file);
           // dump($info);die;
          //dump($upload -> getError());die;
            //判断是否上传成功
            if($info){
                //补全其他字段
                $post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                $post['filename'] = $info['name']; //文件原始名
                $post['hasfile'] = 1;
            }else{
                    //A方法实例化控制器
                    A('Doc') -> error($upload -> getError());exit;

            }



        }

        //补全addtime
        $post['addtime'] = time();
        //返回添加操作
        return $this -> add($post);


    }

    //跟新数据保存
    public function updateData($post,$file){
            //先判断是否有文件需要处理
            if(!$file['error']){
                //定义配置
                $cfg = array(
                        //配置上传路径
                        'rootPath' =>  WORKING_PATH . UPLOAD_ROOT_PATH

                    );
          //处理上传,实例化文件上传类
                $upload = new \Think\Upload($cfg);
                //开始上传
                $info = $upload -> uploadOne($file);
               // dump($info);die;
              //dump($upload -> getError());die;
                //判断是否上传成功
                if($info){
                    //补全其他字段
                    $post['filepath'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                    $post['filename'] = $info['name']; //文件原始名
                    $post['hasfile'] = 1;
            }

            //返回添加操作
            return $this -> save($post);


        }
    }
}