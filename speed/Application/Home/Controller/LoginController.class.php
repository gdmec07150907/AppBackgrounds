<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }

    public function Logindo(){
        header("Content-type:text/html;charset=utf-8");
        $password = I('password');
        $username = I('username');
        $userInfo = D('administratorsregister')->where(array('administrators_name' => $username, 'administrators_password' => $password))->find();
        if(!empty($userInfo)){
            session_start();
            $_SESSION["user_name"] = $username; 
             echo "<script>alert('欢迎你管理员');location='http://localhost/speed/index.php/Home/index';</script>";
        }else{
             echo "<script>alert('帐号或者密码错误,请重新输入');location='javascript:history.back(-1)';</script>";
             $this->error();
        }
    }

    public function Registerdo(){
        header("Content-Type:text/html;charset=utf-8");
        if(empty($_POST)){

            $this->display();
        }
        else{

        $User = D("administratorsregister"); // 实例化User对象

        $validate = array(
            array('administrators_name','','帐号名称已经存在！',0,'unique',1), // 验证用户名是否已经存在
            array('administrators_password','6,30','密码长度最短为6个字符',0,'length'), // 验证密码是否在指定长度范围
            array('administrators_password2','administrators_password','密码不一致',0,'confirm'),// 验证确认密码是否和密码一致 
            array('administrators_email','email','Email格式错误！',2), // 如果输入则验证Email格式是否正确
            array('administrators_phone', '', '该手机号码已被占用', 0, 'unique', 1),
            array('administrators_phone', '/^1[34578]\d{9}$/', '手机号码格式不正确', 0), // 正则表达式验证手机号码
            /*array('administrators_idNumber', '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/', '身份证号不合法！', 1, 'regex', 3),
            array('administrators_email', '', '邮箱已经存在！', 1, 'unique', 3), // email唯一
            array('administrators_idNumber', '', '身份证号已经存在！', 1, 'unique', 3), // 身份证号唯一*/
        );
        $auto = array( 
            array('administrators_password','md5',1,'function')// 对password字段在新增和编辑的时候使md5函数处理
        );

        $u = $User->auto($auto)->validate($validate)->create();
        
        if (!$u){
             // 如果创建失败 表示验证没有通过 输出错误提示信息
              $info = $User->getError();
            echo "<script>alert('".$info."');location='javascript:history.back(-1)';</script>";
            //echo '<h1>'.$User->getError().' 点击此处 <a href="javascript:history.back(-1);">返回</a></h1>';
             //exit($User->getError());              
        }else{
             // 验证通过 可以进行其他数据操作
             $User->add();// 插入数据库
             echo "<script>alert('注册成功');location='http://localhost/speed/index.php/Home/login/index';</script>";
        }  
        }
    }
}
