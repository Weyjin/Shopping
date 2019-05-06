<?php
namespace Admin\Controller;

use Common\Common\UserHelper;
use Admin\Common\AuthController;
use Home\Common;

class UserController extends AuthController
{




    //页面控制
    public function PageControl($id, $title)
    {

        //1.列出所有页面

        $auth_rule = M('auth_rule');
        $auth_rule = $auth_rule->select();

        if (count($auth_rule) > 0) {
            $mQry = '';

            foreach ($auth_rule as $item) {

                $mQry .= '<input type="checkbox" name="checkbox" value="'.$item['id'].'" id="' . $item['id'] . '"/>';
                $mQry .= '<label for="' . $item['id'] . '">';
                $mQry .= $item['title'] . '</label>';
                $mQry .= '&nbsp;&nbsp;&nbsp;';
                if ($item['id'] % 5 == 0) {
                    $mQry .= '<br/>';
                }

            }

            $this->assign('mQry', $mQry);
        }

        $this->assign('title', $title);
        $this->assign('group_id', $id);

        $this->display();
    }

    public function setPageControlHandle(){


       $id=I('post.id');
       $rules=I('post.rules');

        $userHelper=new UserHelper();
        $userHelper->setRulesToGroup($id,$rules);

        $this->ajaxReturn('保存成功');

    }

    //页面说明
    public function PageDescription()
    {

        $rules = M('auth_rule');
        //多笔数据使用select()，单笔数据使用find()
        $rules = $rules->select();
        if (count($rules) > 0) {
            $mQry = '';
            foreach ($rules as $item) {

                $mQry .= '<tr>';

                $mQry .= '<td style="display:none;">';
                $mQry .= '<p name="rule_id">';
                $mQry .= $item['id'];
                $mQry .= '</p>';
                $mQry .= '</td>';


                $mQry .= '<td>';
                $mQry .= $item['name'];
                $mQry .= '</td>';

                $mQry .= '<td>';
                $mQry .= '<input type="text" class="form-control" id="describe"value="';
                $mQry .= $item['title'];
                $mQry .= '"/>';
                $mQry .= '</td>';

                $mQry .= '<td>';
                $mQry .= '<button id="btn" class="btn btn-primary">';
                $mQry .= '保存' . '</button>';
                $mQry .= '</td>';


                $mQry .= '</tr>';

            }
            $this->assign('mQry', $mQry);
        }


        $this->display();
    }

    //保存描述
    public function saveDescriebHandle()
    {

        $id = $_POST['id'];
        $describe = $_POST['describe'];

        $userHelper = new UserHelper();

        $userHelper->saveDescrie($id, $describe);


        $this->ajaxReturn('保存成功!');
    }


    //会员列表
    public function MemberList()
    {
        $users = M('user');

        $u = $users->select();

        if (count($users) > 0) {

            $mList = '';
            $url = U('User/MemberList');
            foreach ($u as $item) {

                $mList .= '<tr>';
                $mList .= '<td>';
                $mList .= $item['email'];
                $mList .= '</td>';
                $mList .= '<td>';
                $mList .= $item['name'];
                $mList .= '</td>';
                $mList .= '<td>';
                $mList .= $item['registeron'];
                $mList .= '</td>';

                $mList .= '<td>';
                //添加

                $mList .= '<a href="' . $url . '"onclick="resetPassword(\'' . $item['id'] . '\')">';
                $mList .= '重置密码' . '</a>';
                //删除
                $mList .= '&nbsp;|&nbsp;';

                $mList .= '<a href="' . $url . '"onclick="removeToCart(\'' . $item['id'] . '\')">';
                $mList .= '删除' . '</a>';
                $mList .= '</td>';

                $mList .= '</tr>';

            }
            $this->assign('mList', $mList);
        }

        $this->display();
    }

    //重置会员密码
    public function resetPasswordHandle()
    {

        $id = $_POST['user_id'];
        $userHelper = new UserHelper();
        $password = $userHelper->resetPassword($id);

        if ($password) {
            $this->success();
        } else {
            $this->error();
        }

    }

    //添加角色
    public function addRoles()
    {

        $auth_group = M('auth_group');
        $auth_group = $auth_group->select();

        if (count($auth_group) > 0) {

            $mQry = '';

            foreach ($auth_group as $item) {

                $url = U('User/PageControl', array('id' => $item['id'], 'title' => $item['title']));

                $mQry .= '<tr>';
                $mQry .= '<td>';
                $mQry .= '<a href="' . $url . '">';
                $mQry .= $item['title'];
                $mQry .= '</a>';
                $mQry .= '</td>';
                $mQry .= '<td>';
                $mQry .= '<a href="#">';
                $mQry .= '编辑' . '</a>';
                $mQry .= '</td>';
                $mQry .= '</tr>';
            }
            $this->assign('mQry', $mQry);
        }


        $this->display();

    }

    public function AddRolesHandle()
    {

        $roleName = $_POST['RoleName'];

        $userHelper = new UserHelper();

        $helper = $userHelper->addRoles($roleName);
        switch ($helper) {
            case 1;
                $this->error('此角色已经存在!');
                break;
            case 2:
                $this->error('无法创建此角色!');
                break;
            case 3:
                $this->success('添加成功!');
                break;
        }

    }

    //用户注销登录
    public function logout()
    {

        /**
         * 如果没有登录，则跳转到前台首页
         * 如果已经登录，则注销登陆
         */
        if (empty(session('email'))) {
            $this->redirect('Home/Index/index');

        } else {
            session('uid', null);
            session('[destroy]');
            $this->success('退出成功！', U('Admin/Login/index'));
        }


    }
}