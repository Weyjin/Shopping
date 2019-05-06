<?php
namespace Admin\Common;

use Think\Auth;
use Think\Controller;

/**
 * 所有要进行权限管理的类都要继承这个类
 */
class AuthController extends Controller
{


    protected function _initialize()
    {

       //以用户名来判断是否是超级管理员，绕过验证，不用用户组来判断的原因是用户组有时候是中文 ,而且常删除或更改。
        if($_SESSION['user']['name']=='admin'){
            return true;
        }

        $auth = new Auth();

            if (!$auth->check(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME, session('uid'))) {

                $this->error('没有权限',U('Admin/Login/index'));
            }


    }


}