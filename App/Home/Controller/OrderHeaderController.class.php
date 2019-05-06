<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/11
 * Time: 21:54
 *
 * 订单
 */
namespace Home\Controller;

use Home\Common\Comm;
use Home\Common\CartHelper;
use Home\Common\AuthController;
use Think\Controller;
class OrderHeaderController extends AuthController
{

    /**
     * 结算订单界面
     * @param $total 总价
     */
    public function index($total)
    {

        $this->assign('total', $total);
        session('total',$total);
        $time = date('Y-m-d H:i:s', time());
        $this->assign('time', $time);
        $this->display();
    }

    /**
     * 结算订单
     */
    public function SettlementOrderHandle()
    {

        //1.存储到orderheaders表

        $ContactName = $_POST['ContactName'];//原生php方法
        $ContactPhoneNo = I('post.ContactPhoneNo');//TP封装的方法
        $ContactAddress = $_POST['ContactAddress'];
        $total = session('total');
        $Memo = $_POST['Memo'];
        $sortid = Comm::newSortID('orderheaders');
        $orderheaders_userid = session('user')['id'];

        $data['id']=Comm::getNewGuid();
        $data['contactname'] = $ContactName;
        $data['contactphoneno'] = $ContactPhoneNo;
        $data['contactaddress'] = $ContactAddress;
        $data['totalprice'] = $total;
        $data['memo'] = $Memo;
        $data['sortid'] = $sortid;
        $data['orderheaders_userid'] = $orderheaders_userid;

        $OrderHeader = D('orderheaders');
        //对数据进行验证，此验证要用到D方法
        if ($OrderHeader->create($data)) {
            $OrderHeader->add($data);

            //2.存储到orderdetails表
            //2.1获取当前orderheaders的id
            //2.2获取购物车里的产品信息

            $orderdetails_orderheaderid = Comm::getOrderHeadersId();
            $cart = new CartHelper();
            $products = $cart->allProduct();

            foreach ($products as $item) {
                $orderdetails = D('orderdetails');
                $data['id'] = Comm::getNewGuid();
                $data['price'] = $item['price'];
                $data['amount'] = $item['num'];
                $data['orderdetails_productsid'] = $item['id'];
                $data['orderdetails_orderheaderid'] = $orderdetails_orderheaderid;

                if ($orderdetails->create($data)) {
                    $orderdetails->add($data);

                   //3.清空购物车
                    $cart->clear();
                    session('total',null);
                    $this->redirect('Home/User/index');
                } else {
                    $this->error('订单详情信息不完整！', 'register', 1);
                }

            }

        } else {
            $this->error('订单信息不完整！', 'register', 1);
        }


    }


}