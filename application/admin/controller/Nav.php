<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-06-13
 * Time: 17:33
**/
namespace app\admin\controller;
use app\admin\model\Nav as NavModel;
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

//    增加导航菜单

    public function navedit(){
        if(request()->isajax()){
            $data=request()->post();

            $res=NavModel::create($data,['name','pid','status','type','sort','url']);
            if($res){
                $msg='保存成功';
                $code=1;
            }else{
                $msg='保存失败';
                $code=0;
            }
            return show([],$code,$msg);
        }else{

            $navlist=NavModel::where('status',1)->select();

            $this->assign('navlist',$navlist);
            return $this->fetch();
        }

    }
    public function ceshi(){
        $res=NavModel::select();
        foreach($res as $v){
            $arr['id']=$v['id'];
            $arr['name']=$v['name'];
            $arr['open']=true;
            $arr['checked']=false;
            if($v['pid']!=0){}

        }
        return show($res,1,'加载成功');
    }
    public function delete(){
        $id=request()->param('id');
        $res=NavModel::destroy($id);
        if($res){

        }else{

        }

    }
}