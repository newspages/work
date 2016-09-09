<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
class IndexController extends Controller {
    public function index(){
        if(!cookie('user')){
            //$this->redirect('Index/login','',2,'您还没登录，请先登录');
            $this->redirect('Index/login');
            exit;
        }
        $this->assign('user',cookie('user'));
        $this->display();
    }
    public function login(){
        if(!IS_POST){
            $this->display();exit(0);
        }
        $data = I('post.');
        if(D('User')->login($data)){
            //创建cookie
            cookie('user',$data['name']);
            $this->redirect('Index/index','',2,'恭喜登录成功，页面跳转中...');
        }
    }
    public function logout(){
        cookie('user',null);
        redirect('Index/login');
    }
}