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
//            树形数据接口
            if(request()->isget()){
                $res=NavModel::select()->toArray();
                return $this->tree($res);
            }else{
                $data=request()->post();
//                修改
                if($data['id']){

                }else{
                    新增
                    $res=NavModel::create($data,['name','pid','status','type','sort','url']);
                }

                if($res){
                    $msg='保存成功';
                    $code=1;
                }else{
                    $msg='保存失败';
                    $code=0;
                }
                return show([],$code,$msg);
            }

        }else{

            $id=request()->param('id');
            if($id){
                $this->assign('id',$id);
            }
            return $this->fetch();
        }

    }
    public function tree($list){

        foreach ($list as  &$value) {
            # code...
            $value=$value;
            $value['open']=false;
            $value['checked']=false;
        }
        $arr=array('id'=>0,'name'=>'根节点','pid'=>0,'open'=>true,'checked'=>false);
        array_unshift($list,$arr);
        $res=list_to_tree($list,'id','pid','children',0);

        return json($res);
    }
    public function delete(){
        $id=request()->param('id');
        $res=NavModel::destroy($id);
        if($res){

        }else{

        }

    }
}