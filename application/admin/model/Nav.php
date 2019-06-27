<?php
namespace app\admin\model;

use think\Model;

class Nav extends Model
{


    public function index(){
        return $this->query("select a.*,IFNULL((select b.name  from think_nav b where a.pid=b.id)  ,'顶级菜单') p_name from think_nav a");

    }
}