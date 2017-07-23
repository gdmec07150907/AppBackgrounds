<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller {
    public function index(){
        $User = M('userinfo');

        if(isset($_GET['btn'])){
        $serachThing = I('get.searchThing');
        $where = "";
        empty($serachThing)?($where=""):($where="user_name like '%".$serachThing."%' or user_phone like '%".$serachThing."%' or user_email like '%".$serachThing."%'");
        $result = $User->where($where)->select();
        $this->assign('list',$result);
        $this->display();
        }else{

            $list = $User->select();
            $this->assign('list',$list);
            $this->display();
        }
    }
    public function userAdddo(){
        header("Content-type:text/html;charset=utf-8");
        if(isset($_POST['sub1'])){
            $name=$_POST['name1'];
            $password=$_POST['password1'];
            $realname=$_POST['realname1'];
            $sex=$_POST['sex1'];
            $phone=$_POST['phone1'];
            $email=$_POST['email1'];
            $idnumber=$_POST['idnumber1'];
            $add = array(
                         'user_name' =>$name,
                         'user_password' =>$password,
                         'user_phone' =>$phone,
                         'user_email' =>$email,
                         'user_realName' =>$realname,
                         'user_idNumber' =>$idnumber,
                         'user_gender' =>$sex,
                );
            $data=M('userregister')->add($add);
            if($data=1){
                echo "<script>alert('添加成功');location='http://localhost/speed/index.php/Home/index';</script>";
            }else{
                echo "<script>alert('添加失败');location='http://localhost/speed/index.php/Home/index';</script>";
            }
        }
    }
    public function userUpdatado(){
        header("Content-type:text/html;charset=utf-8");
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            $realname=$_POST['realname'];
            $sex=$_POST['sex'];
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $idnumber=$_POST['idnumber'];
            $credit=$_POST['credit'];
            $state=$_POST['state'];
            $updata['user_name']=$name;
            $updata['user_realName']=$realname;
            $updata['user_phone']=$phone;
            $updata['user_idNumber']=$idnumber;
            $updata['user_email']=$email;
            $updata['user_gender']=$sex;
            $updata['user_state']=$state;
            $updata['user_credit']=$credit;
            $where['user_id']=$id;
            
            $data=M('userinfo')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/index';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/index';</script>";
            }
        }
    }

    public function delete(){
        header("Content-type:text/html;charset=utf-8");
        $user = D("userinfo");
        $id = $_GET['user_id'];
        $result = $user->where('user_id ='.$id)->delete();
        if ($result !== false){
            echo "<script>alert('删除成功');location='http://localhost/speed/index.php/Home/index';</script>";
        }else{
            echo "<script>alert('删除失败');location='javascript:history.back(-1)';</script>";
        }
    }
}   
