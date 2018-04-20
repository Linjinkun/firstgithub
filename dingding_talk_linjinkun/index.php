<?php
include_once('DingUser.php');
$res = DingUser::admin();







DingUtils::dump($res);exit;


//include_once('Dingtalk.php');
include_once('DingUtils.php');
DingUtils::CorpLog("6jldskjfdsaflsadfjlasdfjlsadkflasdjlfk66");exit;

include_once('Dingtalk.php');
include_once('DingToken.php');
include_once('DingUtils.php');
include_once('DingUser.php');
include_once('DingMessage.php');
include_once('DingMessageBody.php');
include_once 'DingDepartment.php';
include_once('DingWeiApp.php');
include_once('DingMedia.php');
//  172319347   logo:   @lALPBY0V4zQbE-M8zQEn    voice :  @lAXPBY0V4zQd2SrOEfzMEM5-S3Ey   file:  @lAjPBY0V4zQfFzbOdAQCXM4wAB3o






//$filename = "logo.png";
//$filename = 'voice.mp3';
//$filename = 'access_token.txt';
//$filename = realpath($filename);
//$param = array(
//    'type'=>'file',
//    'media'=>$filename
//    
//);
//
//$res = DingMedia::upload($param);
//DingUtils::dump($res);exit;
//
//$params  = array(
//    
//    "appIcon"=> "@lALPBY0V4zNAyFPNAijNAyo",
//    "appName"=> "一品威客微应用",
//    "appDesc"=> "测试使用的微应用",
//    "homepageUrl"=> "http://www.epwk.com",
//    "pcHomepageUrl"=> "http://www.epwk.com",
//    "ompLink"=> "http://www.epwk.com",
//    "agentId"=>"172319347"
//    
//    
//);
//
//
////创建微应用
//$res = DingWeiApp::update($params);
//DingUtils::dump($res);exit;






$touser = "manager1879";//manager1879   171937470620108560
$agentid = "171844060";
$msgtype = "file";
$media_id = "@lAjPBY0V4zQfFzbOdAQCXM4wAB3o";


$msgbody = MessageBody::file($media_id);//图片
//$msgbody = MessageBody::link("https://www.mengino.cn/index.php?s=/Home/public/login.html", "@lALPBY0V4zNAyFPNAijNAyo", "我的标题", "阿康阿康");//link
//$msgbody = MessageBody::oaMessage();//图片

//DingUtils::dump($msgbody);exit;


$res = DingMessage::send($touser, $agentid, $msgtype, $msgbody);
//$res = DingMessage::status("5b3e566460e238d1ba1b34dcca2eafc5");

DingUtils::dump($res);exit;



$res = DingMedia::get("@lALPBY0V4zNAyFPNAijNAyo");
DingUtils::dump($res);exit;












require_once(__DIR__ . "/httpful/src/Httpful/Request.php");
require_once(__DIR__ . "/httpful/src/Httpful/Http.php");
require_once(__DIR__ . "/httpful/src/Httpful/Bootstrap.php");

$filename = "666.png";
$filename = realpath($filename);

$data = array('media'=>$filename);//media id @lALPBY0V4zNAyFPNAijNAyo   @lADPBY0V4zOmJOnNAgDNAgA
$url = "https://oapi.dingtalk.com/media/upload?access_token=a6384d6abe553f539178244cdbb6b215&type=image";

 //$response = \Httpful\Request::post($url);exit;


 $response = \Httpful\Request::post($url)
            ->expects(\Httpful\Mime::JSON)
            ->attach($data)
            ->send();

var_dump($response);exit;




//var_dump($_FILES['file']);exit;


//$_FILES[‘upload’][‘tmp_name’]

//測試
//include_once('Dingtalk.php');
//include_once('DingToken.php');
//include_once('DingUtils.php');
//include_once('DingUser.php');
//include_once('DingMessage.php');
//include_once 'DingDepartment.php';
//include_once('DingWeiApp.php');
//include_once('DingMedia.php');
$filename = "666.png";
$filename = realpath($filename);











   header('content-type:text/html;charset=utf8');
    $curl = curl_init();
    $data = array('media'=>'@'. $filename);
    curl_setopt($curl, CURLOPT_URL, "https://oapi.dingtalk.com/media/upload?access_token=d9a9bb3e9271374f8d2088d40f411874&type=image");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, htt);
    $result = curl_exec($curl);
    curl_close($curl);
    var_dump($result);
    echo '<hr>';exit;
    echo json_decode($result);
    exit;












//$filename = "666.png";
$filename = realpath($filename);
//$filename =  new \CURLFile($filename);
        $params = array(
            'media'=>$filename
        );
$res = DingMedia::upload($params);
DingUtils::dump($res);exit;



//DingUtils::CorpLog("6666");exit;
//$filename = realpath($filename);

//
//    function upload($type, $file) {
//       // $url = $this->apiPrefix . self::API_UPLOAD . '?access_token=' . $this->accessToken . '&type=' . $type;
//       
//        $url ="https://oapi.dingtalk.com/media/upload?access_token=0365507aa3723524a1f2db8c6d504deb&type=image";
//        $response = Request::post($url)
//            ->attach(['media' => $file])
//            ->expects(Mime::JSON)
//            ->send();
//        $data = $this->filterResult($response->body);
//        return $data;
//    }
//
//    
//    $res = upload($type, $filename);
//    DingUtils::dump($res);exit;
    
    
    
//var_dump($_FILES);exit;

//$res = DingUtils::sendMultipart($_FILES['file']);
//DingUtils::dump($res);exit;





//$filename = "666.png";
//$filename = realpath($filename);
//$filename =  new \CURLFile($filename);
   
 //  var_dump($filename);exit;
   // if(!$filename) throw new \Exception('资源路径错误！');
        
      //  $multipart = [];

       // foreach ($filename as $name => $path) {
//            $multipart = [
//                'name' => $filename,
//                'contents' => fopen($filename, 'r'),
//            ];
//       // }
     //  var_dump($multipart);exit;
   
	//form-data中媒体文件标识，有、filelength、content-type等信息

//        $params = array(
//            'media'=>array(
//                'filename'=>"666",
//                'filelength'=>"666.png",
//                'content-type'=>'multipart/form-data'
//            )
//         );
 // var_dump($params);exit;
//DingUtils::dump($params);exit;
//$res = DingMedia::upload($params);
//DingUtils::dump($res);exit;







//$params = array(
//    
//    "agentId"=> "171844060",
//    "isHidden"=>false,
//    "deptVisibleScopes"=>array(),
//    "userVisibleScopes"=>array()
//
//    
//);
//
//$res = DingWeiApp::setScopes($params);
//DingUtils::dump($res);exit;
//
//$params  = array(
//    
//    "appIcon"=> "@HIdsabikkhjsdsas",
//    "appName"=> "测试微应用",
//    "appDesc"=> "测试使用的微应用",
//    "homepageUrl"=> "http=>//mengino.cn",
//    "pcHomepageUrl"=> "http=>//mengino.cn",
//    "ompLink"=> "mengino.cn"  
//    
//    
//    
//    
//);
//
//
////创建微应用
//$res = DingWeiApp::create($params);
//DingUtils::dump($res);exit;







$touser = "manager1879";//manager1879   171937470620108560
$agentid = "171844060";
$msgtype = "text";
$msgbody = array('text'=>array('content'=>"阿康0.，d阿康，老板晚上请哪里"));

$res = DingMessage::send($touser, $agentid, $msgtype, $msgbody);
//$res = DingMessage::status("5b3e566460e238d1ba1b34dcca2eafc5");


DingUtils::dump($res);exit;
        









//include_once 'keke_dingtalk_class.php';

//$a = keke_dingtalk_class::sync_members();

//token测试
// $token = DingToken::getAccessToken();
// var_dump($token);exit;
 //公司人员统测试  $active  0:总数，1:已激活
//$count = DingUser::count($active=1);
//var_dump($count);exit;



            
//创建部门
//$creat_department = DingDepartment::create($name="JAVA组",'62992267');
//DingUtils::dump($creat_department);exit;
 //创建成员
 //
//$other_info = array(
//    "orderInDepts" =>"{64002130:10}",
//    "position"=> "产品经理",
//    "mobile"=> "15913215421",
//    "tel" => "010-123333",
//    "workPlace" =>"软件园三期",
//    "remark" => "我是一个小胖子",
//    "email"=> "zhangsan@gzdev.com",
//    "jobnumber"=> "111111",
//    "isHide"=> false,
//    "isSenior"=> false,
//    "extattr"=> array(
//                "爱好"=>"旅游",
//                "年龄"=>"24"
//                )
//);
 // $res =  DingUser::create('蔡老板', '13606064448','[63933167]');
  //DingUtils::dump($res);         
                
$department_list = DingDepartment::lists('62992267');       
DingUtils::dump($department_list);exit;



//获取部门列表
$department_list = DingDepartment::lists();
DingUtils::dump($department_list);

$department_list_userinfo = array();
foreach ($department_list as $val){  
    $userinfo = DingDepartment::users($val['id']);
    if(empty($userinfo))        continue;
    $department_list_userinfo[$val['name']]=$userinfo ;
}




DingUtils::dump($department_list_userinfo);

exit;


//授权范围测试
//
//$creat_department = DingDepartment::scopes();
// DingUtils::dump($creat_department);exit;       

//创建部门
//$creat_department = DingDepartment::create($name="测试事业部");
//DingUtils::dump($creat_department);exit;

//删除部门
//$creat_department = DingDepartment::delete("64047083");
//DingUtils::dump($creat_department);exit;


//更新部门列表
$param = array('id'=>'64002130','name'=>'目的地事业部');
$department_list = DingDepartment::update($param);
DingUtils::dump($department_list);exit;

//用户详情测试
//$usr_info = DingUser::get($userid="182167396226401203");
//dump($usr_info);exit;








//测试 userid   182167396226401203  李秋乐



// $token = DingToken::get();
// echo $token;
// exit;
//$count = DingUser::count();
/* 
$depart_list = DingDepartment::lists();
dump($depart_list);exit; */






$a = DingUser::create("李秋乐", '13774868655','[1]');

var_dump($a);exit;



echo 333;

var_dump($token);exit;







$data = array(
    'foo'=>'bar', 
    'baz'=>'boom', 
    'site'=>'localhost', 
    'name'=>'nowa magic'); 
$data = http_build_query($data); 
//$postdata = http_build_query($data);
$options = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type:application/x-www-form-urlencoded',
        'content' => $data
        //'timeout' => 60 * 60 // 超时时间（单位:s）
    )
);
$url = "http://localhost:8080/ding_talk/test2.php";
$context = stream_context_create($options);



//var_dump($context);exit;
$result = file_get_contents($url, false, $context);
echo $result;exit;





?>