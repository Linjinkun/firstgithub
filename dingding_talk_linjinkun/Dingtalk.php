<?php
// +------------------------------------------------+
// |http://www.epwk.com                             |
// +------------------------------------------------+
// | 钉钉SDK 基类                                       |
// +------------------------------------------------+
// | Date:  2018.04.16                              |
// +------------------------------------------------+
class Dingtalk
{
    /**
     * 钉钉实例
     * @var object
     */
    protected static $instance = null;

    /**
     * 接口调用地址
     * @var string
     */
    protected static $baseUrl = 'https://oapi.dingtalk.com/';

    /**
     * 请求头信息
     * @var array
     */
    protected static $headers = array(
        'Content-Type' => 'application/json',
       // "Content-type: application/json;charset='utf-8'","Accept: application/json"
    );

    /**
     * 错误信息
     * @var null
     */
    protected static $error = null;

    /**
     * 钉钉的配置信息
     * @var array
     */
     public static function config_init($keyword="",$newarray=array())
    {   
         $config = array();    
         $config = include('DingConfig.php');       
         if($newarray){           
           $config = array_merge($config, $newarray);
         }
         if(!empty($keyword)){          
             if(array_key_exists($keyword, $config)){
                return $config[$keyword];  
             }                 
         }
         return $config;
    }
  //  protected static $config  = array();
//    protected static $config = array(
//        'agentid'      => '',
//        'corpid'       => 'ding32ca896d05d4848435c2f4657eb6378f',
//        'corpsecret'   => 'oQVq-fYYKRT2GFZn_1M_9bCeFaeTpqVe8nP7qxz2nuZwOAvn2XRu_HEhGexMJmFm',
//        'ssosecret'    => 'JWruOnXAdX1Y-EzY4fPm8WV5lY5gNAM3QsSjmZKxe-CddWwKWUZeIn59fNnsF0Wv',
//        'access_token' => '972f715dd2f4379780769812720aa7b9',
//    );

    /**
     * 实例化钉钉SDK
     * @param array $config 配置信息
     */
    public function __construct($config = array())
    {  // echo "132";exit;
//        if (!empty($config) && is_array($config)) {
//            self::$config = array_merge(self::$config, $config);
//        }
        if (!empty($config) && is_array($config)) {    
            self::config_init('',$config);
        }
        
    }

    /**
     * 实例化的静态方法
     * @param  array   $config 配置信息
     * @param  boolean $force  强制重新实例化
     * @return \tools\DDing
     */
    public static function instance($config = array(), $force = false)
    {
        if (is_null(self::$instance) || $force == true) {
            self::$instance = new static($config);
        }
        return self::$instance;
    }

    /**
     * 设置/获取 配置变量
     * @param  string $key
     * @param  string $value
     * @return string
     */
    public static function config($key, $value = null)
    {
        if (is_null($value)) {
            return self::$config[$key];
        } else {
            self::$config[$key] = $value;
        }
    }

    /**
     * JS-API权限验证参数生成
     * @return array
     */
    public static function ddConfig()
    {
        $nonceStr  = uniqid();
        $timestamp = time();
        $config    = array(
            'agentId'   => self::$config['agentid'],
            'corpId'    => self::$config['corpid'],
            'timeStamp' => $timestamp,
            'nonceStr'  => $nonceStr
        );
        $config['signature'] = self::sign($nonceStr, $timestamp);
        return $config;
    }

    /**
     * 钉钉签名算法
     * @param  string $noncestr
     * @param  string $timestamp
     * @return string
     */
    private static function sign($noncestr, $timestamp)
    {
        $signArr = array(
            'jsapi_ticket' => self::$config['jsapi_ticket'],
            'noncestr'     => $noncestr,
            'timestamp'    => $timestamp,
            'url'          => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // 获取当前页面地址 有待优化
        );
        ksort($signArr);
        $signStr = urldecode(http_build_query($signArr));
        return sha1($signStr);
    }

    /**
     * 设置/获取 错误信息
     * @param  string $msg
     * @return string
     */
    public static function error($msg = null)
    {
        if (!is_null($msg)) {
            self::$error = $msg;
        } else {
            return self::$error;
        }
    }
}
