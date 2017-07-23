<?php
namespace Home\Controller;
use Think\Controller;
include("Home\Conf\config.php");
class AddressController extends Controller {
    public function index(){
        $User = M('deliveryaddressinfo');
        $list = $User->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function addressUpdatado(){
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $postcode=$_POST['postcode'];
            $province=$_POST['province'];
            $city=$_POST['city'];
            $area=$_POST['area'];
            $street=$_POST['street'];
            $streetno=$_POST['streetno'];
            $updata['address_id']=$postcode;
            $updata['delivery_province']=$province;
            $updata['delivery_city']=$city;
            $updata['delivery_area']=$area;
            $updata['delivery_street']=$street;
            $updata['delivery_streetNO']=$streetno;
            $where['goods_id']=$id;
            
            $data=M('deliveryaddressinfo')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/address';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/address';</script>";
            }
        }
    }
}