<?php
namespace Home\Controller;
use Think\Controller;
include("Home\Conf\config.php");
class AdminController extends Controller {
    public function index(){
        if(isset($_GET['btn'])){
            $Admin = M('administrators');
            $serachThing = I('get.searchThing');
            $where = "";
            empty($serachThing)?($where=""):($where="administrators_name like '%".$serachThing."%' or administrators_phone like '%".$serachThing."%' or administrators_email like '%".$serachThing."%'");
            $result = $Admin->where($where)->select();
            $this->assign('list',$result);
            $this->display();
        }else{
            $Admin = M('administrators');
            $list = $Admin->select();
            $this->assign('list',$list);
            $this->display();
        }
    }
    public function Updatado(){
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            $phone=$_POST['phone'];
            $idnumber=$_POST['idnumber'];
            $email=$_POST['email'];
            $sex=$_POST['sex'];
            $power=$_POST['power'];
            $state=$_POST['state'];
            $updata['administrators_realname']=$name;
            $updata['administrators_phone']=$phone;
            $updata['administrators_idnumber']=$idnumber;
            $updata['administrators_email']=$email;
            $updata['administrators_sex']=$sex;
            $updata['administrators_jurisdiction']=$power;
            $updata['administrators_state']=$state;
            $where['administrators_id']=$id;
            
            $data=D('administrators')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/admin';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/admin';</script>";
            }
        }
    }
    public function Adddo(){
        if(isset($_POST['sub1'])){
            $name=$_POST['name1'];
            $password=$_POST['password1'];
            $phone=$_POST['phone1'];
            $email=$_POST['email1'];
            $idnumber=$_POST['idnumber1'];
            $add = array(
                         'administrators_name' =>$name,
                         'administrators_password' =>$password,
                         'administrators_phone' =>$phone,
                         'administrators_email' =>$email,
                         'administrators_idNumber' =>$idnumber,
                );
            $data=M('administratorsregister')->add($add);
            if($data=1){
                echo "<script>alert('添加成功');location='http://localhost/speed/index.php/Home/admin';</script>";
            }else{
                echo "<script>alert('添加失败');location='http://localhost/speed/index.php/Home/admin';</script>";
            }
        }
    }

    public function delete(){
        $user = D("administrators");
        $id = $_GET['administrators_id'];
        $result = $user->where('administrators_id ='.$id)->delete();
        if ($result !== false){
            echo "<script>alert('删除成功');location='http://localhost/speed/index.php/Home/admin';</script>";
        }else{
            echo "<script>alert('删除失败');location='javascript:history.back(-1)';</script>";
        }
    }
} 