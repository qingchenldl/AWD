<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\SiyouModel;
use think\Db;
class Siyou extends Base
{


    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];          
        }       
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('siyou')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $siyou = new SiyouModel();
        $lists = $siyou->getSiyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $siyou = new SiyouModel();
            $flag = $siyou->insertSiyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

       
        return $this->fetch();
    }
	
	public function editprice(){
		
		$id=input("post.id");
		$neirong=input("post.neirong");
		if($id==null  or $neirong==null){
		echo "<script>location.href='index.php'</script>";
		exit;
		}
		if (strpos($neirong, '-') !== false) {
			$p = explode('-',$neirong); 
			$sj=$p[0];
			$money=$p[1];
		}else{
			$sj=$neirong;
			$money=$neirong;
		}
		Db::name('siyou')->where(['id'=>$id])->update(['sj'=>$sj,"money"=>$money]);
		echo json_encode(array('zt'=>"1"));
	}

    public function edit()
    {
        $siyou = new SiyouModel();
        
        if(request()->isAjax()){

            $param = input('post.');         
            $flag = $siyou->updateSiyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $cate = new SiyouCateModel();
        $this->assign('cate',$cate->getAllCate());
        $this->assign('siyou',$siyou->getOneSiyou($id));
        return $this->fetch();
    }



    public function del()
    {
        $id = input('param.id');
        $cate = new SiyouModel();
        $flag = $cate->delSiyou($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }








  

}