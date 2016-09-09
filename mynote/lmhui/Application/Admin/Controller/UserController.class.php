<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
    /**
     * 后台登录首页
     * @author 钟土佳
     */
    public function index(){
        $this->display();
    }
    /**
     * 后台登录验证
     * login方法实现后台登录验证
     * @author 钟土佳
     * @params
     */
    public function login(){

    }

    /**
     * 用户列表
     */
    public function lists(){
        $user_lists = D('User')->lists();
        $this->assign('user_lists',$user_lists);
        $this->display();
    }

}