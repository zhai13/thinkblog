<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/17
 * Time: 10:39
 * 后台登陆控制器
 */
Class LoginAction extends Action {
    Public function _initialize () {    //_initialize：自动运行的方法
        if (isset($_SESSION['uid'])) {   //判断如果已经登陆就跳转至后台首页
            redirect(__GROUP__);
        }
    }
    //登陆页面视图
    Public function index() {
        $this->display();
    }
    //登录表单操作
    Public function login() {
        if (!IS_POST) halt('页面不存在');    //判断是否post提交
        if (I('code', '', 'strtolower') != session('verify')) $this->error('验证码错误');    //如果传过来的值转换为小写之后不等于sesson里存的值

        $db = M('user');    //M实例化一个数据表
        $user = $db->where(array('username' => I('username')))->find();     //根据用户名在该表下查找出所有数据
        if (!$user || $user['password'] != I('password', '', 'md5')) {      //如果填写的密码与数据库的密码不一致
            $this->error('账号或密码错误');
        }
        //更新最后一次登录时间与IP
        $data = array(
            'id' => $user['id'],
            'logintime' => time(),
            'loginip' => get_client_ip()    //获取客户端的ip
        );
        $db->save($data);
        //向sesson里面写入已登录账号的相关信息，在后台所有页面判断是否已登录会用到
        session('uid', $user['id']);
        session('username', $user['username']);
        session('logintime', date('Y-m-d H:i:s', $user['logintime']));
        session('loginip', $user['loginip']);

        //向sesson写入成功之后跳转至后台首页
        redirect(__GROUP__);    //__GROUP__指当前分组首页
    }

    Public function verify() {
        import('Class.Image', APP_PATH);    //引入自定义类
        Image::verify();    //调用verify函数
    }
}