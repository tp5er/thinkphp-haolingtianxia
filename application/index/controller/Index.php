<?php
namespace app\index\controller;
use think\Controller;
use app\model\Attri;
class Index extends Controller
{
    public function index()
    {
		return $this->fetch();
    }
    function dd($phone=''){
      if (!$this->request->isPost()){
        $arr['code']=0;
    	$arr['msg']='这是正确的访问方式吗';
      }else{
//   	$phone=input('phone');
    	$arr['code']=1;
    	$arr['msg']='成功';
    	$arr['data']= $this->database($phone);
      }
      return json($arr);
    }
    function database($phone){
    	$info=Attri::where('phone='.$phone)->find();
    	if($info){
    		return $info->toArray();
    	}else{
    		$type=rand(1,2);
    		$arr= $this->cha($phone,$type);
    		$arr->phone = $phone;
    		$arr->way = $type;
    		return $add=Attri::create($arr)->getData();
    	}
    }
    
    function cha($phone,$type=1){
        switch ($type){
            case 1 :return $this->chanuoyu($phone);break;
            case 2 :return $this->chanuoyutx($phone);break;
        }
    }
    function chanuoyu($num){
    	date_default_timezone_set("PRC");
    	$showapi_appid = '47315';  //替换此值,在官网的"我的应用"中找到相关值
	    $showapi_secret = 'b810cb11884949e8865c9a705535aab1';  //替换此值,在官网的"我的应用"中找到相关值
	    $paramArr = array(
	         'showapi_appid'=> $showapi_appid,
	         'num'=>$num
	    );
	    $param = $this->createParam($paramArr,$showapi_secret);
	    $url = 'http://route.showapi.com/6-1?'.$param; 
    	return  json_decode(file_get_contents($url))->showapi_res_body;
    }
    function chanuoyutx($num){
    	date_default_timezone_set("PRC");
    	$showapi_appid = '47311';  //替换此值,在官网的"我的应用"中找到相关值
	    $showapi_secret = '33f585856cc744f4a6c65b3b199fe7b8';  //替换此值,在官网的"我的应用"中找到相关值
	    $paramArr = array(
	         'showapi_appid'=> $showapi_appid,
	         'num'=>$num
	    );
	    $param = $this->createParam($paramArr,$showapi_secret);
	    $url = 'http://route.showapi.com/6-1?'.$param; 
    	return  json_decode(file_get_contents($url))->showapi_res_body;
    }
        //创建参数(包括签名的处理)
    function createParam ($paramArr,$showapi_secret) {
         $paraStr = "";
         $signStr = "";
         ksort($paramArr);
         foreach ($paramArr as $key => $val) {
             if ($key != '' && $val != '') {
                 $signStr .= $key.$val;
                 $paraStr .= $key.'='.urlencode($val).'&';
             }
         }
         $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
         $sign = strtolower(md5($signStr));
         $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
//       echo "排好序的参数:".$signStr."<br>\r\n";
         return $paraStr;
    }
}
