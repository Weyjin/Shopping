<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/18
 * Time: 11:29
 * 后台登陆
 */
namespace Admin\Controller;

use Common\Common\UserHelper;
use Think\Controller;
use Admin\Common\Comm;

class LoginController extends Controller{

    public function index(){

        //初始化rule表
        $userHelper=new UserHelper();
        $userHelper->initRule();
        //初始化超级用户账号
        Comm::initAdminAccount();

        $this->display();
    }


    public function LoginHandle(){
        $email = $_POST['email'];
        $password = I('post.password');

        if (Comm::checkUer($email, $password)) {

            $email = session('email');
            $users = M('user');
            $data['email'] = $email;
            $user = $users->where($data)->find();
            session('user', $user);
            session('uid', $user['id']);


            $this->redirect('Admin/Index/index');
        } else {
            $this->error('邮箱或密码错误');
        }
    }
}