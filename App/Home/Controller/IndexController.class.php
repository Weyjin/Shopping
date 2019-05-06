<?php
namespace Home\Controller;

use Think\Controller;
use Home\Common\Comm;

class IndexController extends Controller
{

    /**
     * 产品分类首页
     */
    public function index()
    {

        //产品分类
        $ProductCategories = D('productcategories');
        $m = $ProductCategories->order('sortid desc')->select();

        //产品
        $Product = M('products');

        $mQry = "";
        if (count($m) > 0) {

            foreach ($m as $item) {
                $data['productcategories_productsid'] = $item['id'];
                //查询此产品分类下有多少产品
                $p = $Product->where($data)->count();

                $mQry .= '<li class="list-group-item">';

                $url = '';
                //使用U方法生成url，直接拼接会出现奇奇怪怪的问题
                $url .= U('Index/productList', array('id' => $item['id']));
                $mQry .= '<a href="' . $url . '">';

                $mQry .= $item['name'];
                $mQry .= '</a>';
                $mQry .= '<span class="badge pull-right">';
                $mQry .= $p . '</span>';
                $mQry .= '</li>';
            }

        }
        if (empty(session('email'))) {

            $name = '';
            $this->assign('name', $name);
        } else {
            $name = 'name';
            $this->assign('name', $name);
        }

        $this->assign('mQry', $mQry);

        $this->display();
    }

    //产品列表
    public function productList($id)
    {
        $m = M('products');
        $where['productcategories_productsid'] = $id;

        $p = Comm::getpage($m, $where, 1);
        //查询分页数据
        $list = $m->where($where)->order('sortid desc')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->list = $list;
        $page = $p->show();
        $this->assign('page', $page);

        //产品分类名称
        $ProductCategoryName=Comm::getProductCategoryName($id);
        $this->assign('ProductCategoryName',$ProductCategoryName);
        $this->display();
    }


    //产品详情
    public function productDetail($id)
    {

        $products = M('products');
        $data['id'] = $id;
        $product = $products->where($data)->find();

        $this->assign('mProduct', $product);

        //判断是否登录，如果登录则添加到购物车
        //如果没有登录，则跳转到登录页
        $mCart='';
        if (empty(session('user'))){

            $url= U('Index/Login');
            $mCart.='<a href="' . $url . '">';
            $mCart.='添加购物车'.'</a>';
            $this->assign('mCart', $mCart);
        }else{
          //todo:添加到购物车

        }

        $this->display();
    }

    //注册界面
    public function register()
    {
        //如果已经登录，则跳转到首页
        if(session('user')){
            $this->redirect('Home/Index/index');
        }else{
            $this->display();
        }
    }

    public function RegisterHandle()
    {

        $email = $_POST['email'];//原生php方法
        $name = I('post.name');//TP封装的方法
        $password = $_POST['password'];
        $Confirmpassword = I('post.Confirmpassword');

        if ($password != $Confirmpassword) {
            $this->error("前后密码不一致", "register", 1);
            return;
        }


        $user = D('user');

        $data['email'] = $email;
        $data['name'] = $name;
        $data['password'] = $password;
        $data['registeron'] = date('Y-m-d H:i:s', time());

        //对数据进行验证，此验证要用到D方法
//        if ($user->create($data)) {
//            $user->add($data);
//            $this->success('注册成功! ', U('Home/User/index'), 1);
//        } else {
//            $this->error('信息不完整！', 'register', 1);
//        }
        switch (Comm::addUser($email, $password, $name)) {
            case 0:

                $this->error('该邮箱已被注册');
                break;
            case 1:

                $this->success('注册成功！');
                break;
            case 2:
                $var = $user->getError();
                $this->error($var);
                break;

        }
    }

    //登录界面

    public function Login()
    {
        if(session('user')){
            $this->redirect('Home/Index/index');
        }else{
            $this->display();
        }

    }

    public function LoginHandle()
    {

        $email = $_POST['email'];
        $password = I('post.password');

        if (Comm::checkUer($email, $password)) {
            $this->redirect('Home/User/index');
        } else {
            $this->error('邮箱或密码错误');
        }

    }
    //用户注销登录

    public function logout()
    {

        session_start();
        $_SESSION = array();
        $this->redirect('Home/Index/index');

    }
}