<?php
namespace Home\Controller;
use Think\Controller;
include("Home\Conf\config.php");
class GoodsController extends Controller {
    public function index(){
        $User = M('goodsdescribe');
        $list = $User->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function goodsUpdatado(){
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            $longness=$_POST['longness'];
            $breadth=$_POST['breadth'];
            $weight=$_POST['weight'];
            $type=$_POST['type'];
            $updata['goods_name']=$name;
            $updata['goods_long']=$longness;
            $updata['goods_wide']=$breadth;
            $updata['goods_weight']=$weight;
            $updata['goods_type']=$type;
            $where['goods_id']=$id;
            
            $data=M('goodsdescribe')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/goods';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/goods';</script>";
            }
        }
    }
}