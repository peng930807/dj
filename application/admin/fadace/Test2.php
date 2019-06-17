<?php
namespace app\admin\fadace;

use think\Facade;

class Test2 extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\admin\common\Test2';
    }
}