<?php
namespace Home\Controller;
use Think\Controller;
include("Home\Conf\config.php");
class EvaluateController extends Controller {
    public function index(){
        $User = M('evaluation');
        $list = $User->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function evaluateUpdatado(){
       if(isset($_POST['sub'])){
            $id=$_POST['id'];
            $content=$_POST['content'];
            $speed=$_POST['speed'];
            $attitude=$_POST['attitude'];
            $state=$_POST['state'];
            $updata['evaluation_content']=$content;
            $updata['delivery_speed']=$speed;
            $updata['service_attitude']=$attitude;
            $updata['goods_state']=$state;
            $where['evaluation_id']=$id;
            
            $data=M('evaluation')->where($where)->save($updata);
            if($data=1){
                echo "<script>alert('修改成功');location='http://localhost/speed/index.php/Home/evaluate';</script>";    
            }else{
                echo "<script>alert('修改失败');location='http://localhost/speed/index.php/Home/evaluate';</script>";
            }
        }
    }
}
