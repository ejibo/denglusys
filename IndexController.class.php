<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public $user;
    /**
     * 构造函数
     * @return [type] [description]
     */
    public function _initialize(){
        header("Content-type:text/html;charset=utf-8");
        $this->user = D('user');//实例化
    }

    /**
     * 首页  自动跳转到登录界面
     * @return [type] [description]
     */
    public function index(){
        $this->redirect('Home/Index/login');
    }

    /**
     * 登录界面 显示登录的界面
     * @return [type] [description]
     */
    public function login(){
        $this->display();
    }


    /**
     * 判断登录是否正确 如果正确，返回一个正确的值，错误，提示
     * @return [type] [description]
     */
    public function judge_login(){
        //查找是否存在对应的用户名和密码
        $res = $this->user->where(array('username'=>$_POST['username']))->select();
        //通过用户名查找，如果存在就判断密码
        if ($res) {
            //判断密码是否正确
            foreach ($res as $key => $value) {
                if ($value['password'] == $_POST['password']) {
                    $msg = array('status'=>1);
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    $this->ajaxReturn($msg,'json');
                    exit;
                }
                else{
                    $msg = array('status'=>0);
                    $this->ajaxReturn($msg,'json');
                    exit;
                }
            }
        }
        else{
            $msg = array('status'=>-1);
            $this->ajaxReturn($msg,'json');
            exit;
        }
    }

}