<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller
{

     public $user;
    /**
     * 构造函数
     * @return [type] [description]
     */
    public function _initialize(){
        header("Content-type:text/html;charset=utf-8");
        $this->user = D('user');//实例化
        $this->check_login();
    }


    /**
     * 首页
     * @return [type] [description]
     */
    public function index(){
        $this->display();
    }


    /**
     * 退出登录
     * @return [type] [description]
     */
    public function user_exit(){
        session(null);//删除session
        $this->redirect('Home/Index/login');
    }

    /**
     * 判断是否登录
     * @return [type] [description]
     */
    public function check_login(){
        if ("?session('username')&&?session('password')") {
            $res = $this->user->where(array('username'=>$_SESSION['username'],'password'=>$_SESSION['password']))->find();
            if ($res) {
                return true;
            }
            else{
                $this->redirect('Home/Index/login');
            }
        }
        else{

            $this->redirect('Home/Index/login');
        }
    }
}