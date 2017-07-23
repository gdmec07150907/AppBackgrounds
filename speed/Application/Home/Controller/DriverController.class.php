<?php
namespace Home\Controller;
use Think\Controller;
class DriverController extends Controller {
    public function index(){
        if(isset($_GET['btn'])){
            $Driver = M('driverinfo');
            $serachThing = I('get.searchThing');
            $where = "";
            empty($serachThing)?($where=""):($where="driver_name like '%".$serachThing."%' or driver_phone like '%".$serachThing."%' or driver_email like '%".$serachThing."%'");
            $result = $Driver->where($where)->select();
            $this->assign('list',$result);
            $this->display();
        }else{
            $Driver = M('driverinfo');
            $list = $Driver->select();
            $this->assign('list',$list);
            $this->display();
        }
    }
        public function driverAdddo(){
        if(isset($_POST['sub1'])){
            $name=$_POST['name1'];
            $password=$_POST['password1'];
            $realname=$_POST['realname1'];
            $sex=$_POST['sex1'];
            $phone=$_POST['phone1'];
            $email=$_POST['email1'];
            $idnumber=$_POST['idnumber1'];
            $add = array(
                         'driver_name' =>$name,
                         'driver_password' =>$password,
                         'driver_phone' =>$phone,
                         'driver_email' =>$email,
                         'driver_realName' =>$realname,
                         'driver_idNumber' =>$idnumber,
                         'driver_gender' =>$sex,
                );
            $data=M('driverregister')->add($add);
            if($data=1){
                echo "<script>alert('添加成功');location='http://localhost/speed/index.php/Home/driver';</script>";
            }else{
                echo "<script>alert('添加失败');location='http://localhost/speed/index.php/Home/driver';</script>";
            }
        }
    }
        public function driverUpdatado(){
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            $realname=$_POST['realname'];
            $sex=$_POST['sex'];
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $idnumber=$_POST['idnumber'];
            $credit=$_POST['credit'];
            $star=$_POST['star'];
            $state=$_POST['state'];
            $updata['driver_name']=$name;
            $updata['driver_realName']=$realname;
            $updata['driver_phone']=$phone;
            $updata['driver_idNumber']=$idnumber;
            $updata['driver_email']=$email;
            $updata['driver_gender']=$sex;
            $updata['driver_state']=$state;
            $updata['driver_credit']=$credit;
            $updata['driver_star']=$star;
            $where['driver_id']=$id;
            
            $data=M('driverinfo')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/driver';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/driver';</script>";
            }
        }
    }
    public function delete(){
        $user = D("driverinfo");
        $id = $_GET['driver_id'];
        $result = $user->where('driver_id ='.$id)->delete();
        if ($result !== false){
            echo "<script>alert('删除成功');location='http://localhost/speed/index.php/Home/driver';</script>";
        }else{
            echo "<script>alert('删除失败');location='javascript:history.back(-1)';</script>";
        }
    }

}   
