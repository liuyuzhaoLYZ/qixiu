<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-03 20:14:24
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-03 20:58:56
 */
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明模型并且继承父类模型
class KnowledgeModel extends Model{
    public function addData($post,$file){
        //先判断是否有文件需要处理
        if($file['error'] == '0'){
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
                $post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                //制作缩略图
                //1.实例化
                $image = new \Think\Image();
                //2.打开图片传递图片的路径
                $image -> open(WORKING_PATH . $post['picture'] );
                //3.自作缩略图等比例缩放
                $image -> thumb(100,100);
                //4.保存图片，传递完整路径（目录+文件名）
                $image -> save(WORKING_PATH . UPLOAD_ROOT_PATH .  $info['savepath'] . 'thumb_' . $info['savename']);
                //补全thumb字段
                $post['thumb'] = UPLOAD_ROOT_PATH .  $info['savepath'] . 'thumb_' . $info['savename'];
        }
    }
                //补全addtime
                $post['addtime'] = time();
                //返回添加操作
                return $this -> add($post);
    }
}