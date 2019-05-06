<?php
/**
 * Created by PhpStorm.
 * Date: 2016/10/12
 * Time: 18:09
 * 购物车
 */
namespace Home\Controller;
use Home\Common\CartHelper;
use Home\Common\AuthController;
use Think\Controller;
class CartController extends AuthController{

    //购物车界面
    public function index(){

        $cart=new CartHelper();
        $products=$cart->allProduct();
         if(count($products)>0){
             $mQry='';
             $mPrice=0;
             $url= U('Cart/index');
             foreach($products as $item){
                 $mQry.='<tr>';
                 $mQry.='<td>';
                 $mQry.=$item['name'];
                 $mQry.='</td>';
                 $mQry.='<td>';
                 $mQry.='￥'.$item['price'];
                 $mQry.='</td>';
                 $mQry.='<td>';
                 $mQry.=$item['num'];
                 $mQry.='</td>';
                 $mQry.='<td>';
                 $mQry.='￥'.$item['price']*$item['num'];
                 $mQry.='</td>';

                 $mQry.='<td>';
                 //添加

                 $mQry.='<a href="' . $url . '"onclick="buy(\''.$item['id'].'\')">';
                 $mQry.='添加'.'</a>';
                 //删除
                 $mQry.='&nbsp;|&nbsp;';

                 $mQry.='<a href="'.$url.'"onclick="removeToCart(\''.$item['id'].'\')">';
                 $mQry.='删除'.'</a>';
                 $mQry.='</td>';

                 $mQry.='</tr>';
                 $mPrice+=$item['price']*$item['num'];
             }


             $this->assign('mQry',$mQry);
             $this->assign('mPrice',$mPrice);
             if(!empty(session('Cart'))){
                 $mBtn='';
                 $mBtn.='<button type="button" id="btn_clear" onclick="clearToCart()" class="btn btn-danger">清空购物车</button>';
                 $mBtn.='&nbsp;&nbsp;';
                 $mBtn.='<button type="button" onclick="priceOrderToCart()" class="btn btn-success">结算订单</button>';

                 $this->assign('mBtn',$mBtn);
             }
         }

        $this->display();
    }

    /**
     * 加入购物车
     */
    public function AddToCartHandle(){
        $productid=$_POST['productsid'];

        $cart=new CartHelper();
        $condtion['id']=$productid;

        $products=M('products');
        $productQry=$products->where($condtion)->find();

        $addSuccess=$cart->addItem(
            $productid,
            $productQry['name'],
            $productQry['price']
        );

        if ($addSuccess==1){
            $this->success();
        }else{
            $this->error();
        }


    }

    /**
     * 移除购物车的商品
     */
    public function RemoveToCartHandle(){

        $productid=$_POST['productsid'];

        $cart=new CartHelper();


       $del=$cart->deleteItem($productid);


        if ($del==1){
            $this->success();
        }else{
            $this->error();
        }

    }

    /**
     * 清空购物车
     */
    public function ClearToCartHandle(){

        $cart=new CartHelper();
        $cart->clear();
        $this->success();
    }

}