<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-06-13
 * Time: 17:33
**/
namespace app\admin\controller;
use app\admin\traits\Result;
use think\facade\Request;

class Nav  extends Common{

    public function  index(){
        if(request()->isAjax()){
//            查询导航列表
            $res=model('Nav')->index();
            return show($res,0);
        }else{

            return view();
        }

    }

//    菜单状态修改
    public function navStatusEdit(){
        $id=request()->param('id');
        $status=request()->param('status')=='true'?1:0;
        $res=model('nav')->where('id',$id)->update(['status'=>$status]);
        if($res){
            $this->success('修改成功', url('/admin/userList'));
        }else{
            $this->error('修改失败', null);
        }


    }
}