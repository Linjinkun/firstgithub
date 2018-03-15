<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){



    	$this->success('dd66');exit;
			header("Content-type: text/html; charset=utf-8");




333





						$dor_path = dirname(dirname(dirname(dirname(__FILE__))))."/Public/";

			//权限
			@chmod($dor_path,0777);
			 
			//文件路径
			$write_file=$dor_path."zhidao.txt";

			 
			//写入内容
			$content="当前的时间戳是：".time();;


file_put_contents($write_file, $content."\r\n",FILE_APPEND);


	if (is_writable($write_file)) {
			file_put_contents($write_file, $content."\r\n",FILE_APPEND);
			echo "文件写入成功！".time();
			}else{
			echo "请检查zhidao.txt文件是否有写入权限！";
    	    }
    	    exit;
			//文件目录[项目/test/]

// $file_nameA = dirname(dirname(dirname(dirname(__FILE__)))).'/Public/333.txt';
// dump($file_nameA);exit();
// if (file_exists($file_nameA)) {
// 	echo 1;
// }else{echo "string";}exit;






				$dor_path = dirname(dirname(dirname(dirname(__FILE__))))."/Public/";
				//echo $dor_path;exit;

			//	$dor_path="./";
			//权限
			//@chmod($dor_path,0777);
			 
			//文件路径
			$write_file=$dor_path."zhidao.txt";

			 
			//写入内容
			$content="当前的时间戳是：".time();;


file_put_contents($write_file, $content."\r\n",FILE_APPEND);


			//判断写入
			if (is_writable($write_file)) {
			file_put_contents($write_file, $content."\r\n",FILE_APPEND);
			echo "文件写入成功！".time();
			}else{
			echo "请检查zhidao.txt文件是否有写入权限！";
    	    }
     }
}