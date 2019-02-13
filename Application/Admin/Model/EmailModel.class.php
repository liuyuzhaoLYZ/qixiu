<?php
/**
 * @Author: liuyuzhao
 * @Date:   2019-02-05 16:14:17
 * @Last Modified by:   liuyuzhao
 * @Last Modified time: 2019-02-07 14:35:03
 */
//声明命名空间
namespace Admin\Model;
//引入父类模型
use Think\Model;
//声明模型并且继承父类模型
class EmailModel extends Model{
    public function addData($post,$file){
        if($file['error'] == '0'){
            $cfg = array('rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload ->uploadOne($file);
            //判断上传结果
           //dump($info);die;
            if($info){
                //上传成功处理字段
                //file hasfile filename
                $post['file'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                $post['hasfile'] = 1;
                $post['filename'] = $info['name'];//文件原始名称
            }
        }
        //补充from_id addData
        $post['from_id'] = session('id');
        $post['addtime'] = time();
        //数据保存
        return $this -> add($post);

    }
}
