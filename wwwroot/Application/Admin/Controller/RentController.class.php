<?php

namespace Admin\Controller;


use Think\Controller;

class RentController extends AdminController{

    public function index(){
        $rent = D('Rent')->select();
        $this->assign('rent', $rent);
        C('_SYS_GET_CATEGORY_TREE_', true); //标记系统获取分类树模板
        $this->meta_title = '租赁管理';
        $this->display('index');
    }
    public function add(){
        if(IS_POST){
            $Rent = D('Rent');
            $data = $Rent->create();
            if($data){
                if($Rent->add()){
//                    S('DB_CONFIG_DATA',null);
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Rent->getError());
            }
        } else {
            $this->meta_title = '新增配置';
            $this->assign('info',null);
            $this->display('add');
        }
    }
    public function del($id){
        $res = M('Rent')->delete($id);
        if($res !== false){
            //记录行为
//            action_log('del_category', 'rent', $id, UID);
            $this->success('删除分类成功！');
        }else{
            $this->error('删除分类失败！');
        }

    }
    public function edit($id = 0)
    {
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('Rent')->field(true)->find($id);
        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display('edit');
//        $Rent = D('Rent');
//        $Rent->save();
//        $Rent->add;

    }
}