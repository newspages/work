<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/17
 * Time: 14:16
 */
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    protected $patchValidate = ture;//以数组形式返回自动验证错误信息（tp手册中将其称为批量验证，一起验证再将所有的验证错误信息以数组的形式返回，使用$this->getError()捕获错误信息）
    protected $_map = array(
        'name'  =>  'username',//将表单提交过来的 name 字段映射到数据表中 username 字段
        'pwd'   =>  'password',
    );
    protected $_validate = array(
        array('username','require','用户名不能为空'),
        array('password','require','密码不能为空'),
    );
    protected $_auto = array(
        array('password','md5',1,'function'),//插入数据时将 password 进行 md5 加密
        array('create_time','time',1,'function'),//插入数据时将 create_time 设置为当前时间
    );
    /**
     * 后台登录处理
     */
    public function login($data){
        if(!$this->create($data)){
            return $this->getError();//捕获自动验证错误信息
        }
        $result = $this->where("username = '".$data['username']."'")->getField('password');
        if($this->where("password = '".$data['password']."'")){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * 用户注册
     */
    public function register($data){
        if(!$this->create($data)){
            return $this->getError();//捕获自动验证错误信息
        }
        if($this->add()){
            return '登录成功';
        }else{
            return $this->getLastSql();
        }
    }

    /**
     * 用户列表
     */
    public function lists(){
        return $this->select();
    }
}