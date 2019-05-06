<?php
namespace Home\Controller;

use Common\Common\UserHelper;
use Think\Controller;
use Home\Common;
use Home\Common\AuthController;

class UserController extends AuthController
{

    //用户首页
    public function index()
    {

        //  echo $_SESSION['user_groupid'];

        $email = session('email');
        $users = M('user');
        $data['email'] = $email;
        $user = $users->where($data)->find();
        session('user', $user);
        $this->assign('user', $user);


        $this->display();

    }

    //编辑昵称
    public function editName()
    {
        $user = session('user');
        $this->assign('user', $user);
        $this->display();
    }

    public function EditNameHandle()
    {


        $user = session('user');
        $id = $user['id'];
        $name = $_POST['name'];
        $userHelper = new UserHelper();

        $helper = $userHelper->EditName($id, $name);

        if ($helper) {
            $this->redirect('Home/User/index');
        } else {
            $this->error('昵称不能为空！', U('Home/User/editName'), 1);
        }

    }

    //修改密码
    public function editPassword()
    {
        $this->display();
    }

    public function editPasswordHandle(){

        $user = session('user');
        $id = $user['id'];

        $oldPassword= $_POST['oldPassword'];
        $newPassword= $_POST['newPassword'];

        $userHelper = new UserHelper();

        $helper = $userHelper->editPassword($id,$oldPassword,$newPassword);


        switch ($helper){
            case 1:
                $this->error('旧密码输入错误！', U('Home/User/editPassword'), 1);
                break;
            case 2:
                $this->error('新密码不能为空！', U('Home/User/editPassword'), 1);
                break;
            case 3:
                $this->redirect('Home/User/index');
                break;
        }



    }




}