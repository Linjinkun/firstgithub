<?php

// +------------------------------------------------+
// |http://www.epwk.com                             |
// +------------------------------------------------+
// | 基础工具类                                     |
// +------------------------------------------------+
// | Date:  2018.03.28                              |
// +------------------------------------------------+
//引入第三方库begin
require_once(__DIR__ . "/httpful/src/Httpful/Request.php");
require_once(__DIR__ . "/httpful/src/Httpful/Http.php");
require_once(__DIR__ . "/httpful/src/Httpful/Bootstrap.php");
//第三方库end

include_once('Dingtalk.php');
include_once('DingToken.php');

class DingUtils extends Dingtalk {

    private $_formdata = array();

    /**
     * GET 方式请求接口
     * @param  string  $api
     * @param  array   $params
     * @param  boolean $token
     * @return array|boolean
     */
    public static function get($api, $params = array(), $token = true, $is_media = false, $media_type = "image") {
        $url = Dingtalk::$baseUrl . $api;
        if ($token === true) {
            $access_token = DingToken::getAccessToken();
            $params['access_token'] = $access_token;
        }
        $url .= '?' . http_build_query($params);
        if ($is_media) {
            $result = self::downfile($url, $media_type);
        } else {
            $result = self::http($url, 'GET', $params, Dingtalk::$headers);
            if ($result !== false) {
                $result = json_decode($result, true);
                if ($result['errcode'] == 0) {
                    return $result;
                } else {
                    Dingtalk::error($result['errmsg']);
                    self::CorpLog($result['errmsg']);
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public static function downfile($url, $media_type) {
        $file = file_get_contents($url);
        if (!$file) {
            Dingtalk::error("获取（下载）多媒体文件失败");
            self::CorpLog("获取（下载）多媒体文件失败");
            return false;
        }
        if ($media_type == "image") {
            header("Content-Type: image/jpeg;text/html; charset=utf-8");
            echo $file;
            file_put_contents('Upload/image/' . date("Ymdhis") . '.jpg', $file);
            exit;
        } elseif ($media_type == "voice") {
            echo "音频信息下载成功";
            file_put_contents('Upload/voice/' . date("Ymdhis") . '.mp3', $file);
            exit;
        } elseif ($media_type == "file") {
            echo "file 下载成功";
            file_put_contents('Upload/file/' . date("Ymdhis") . '.txt', $file);
            exit;
        } else {
            echo "文件下载成功";
            file_put_contents('Upload/file/' . date("Ymdhis") . '.txt', $file);
            exit;
        }
    }

    /**
     * POST 方式请求接口
     * @param  string $api
     * @param  array  $params
     * @return array|boolean
     */
    public static function post($api, $params) {
        $access_token = DingToken::getAccessToken();
        $url = Dingtalk::$baseUrl . $api . '?access_token=' . $access_token;
        //$url = Dingtalk::$baseUrl . $api . '?access_token=' . $access_token."&type=image";      
        $result = self::http($url, 'POST', json_encode($params), Dingtalk::$headers);
        // print_r($result);exit;            
        if ($result !== false) {
            $result = json_decode($result, true);
            if ($result['errcode'] == 0) {
                return $result;
            } else {
                Dingtalk::error($result['errmsg']);
                self::CorpLog($result['errmsg']);
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * curl操作函数
     * @param  string $url        请求地址
     * @param  string $method     提交方式
     * @param  array  $postFields 提交内容
     * @param  array  $header     请求头
     * @return mixed              返回数据
     */
    public static function http($url, $method = 'GET', $postFields = null, $headers = null) {
        $method = strtoupper($method);
        if (!in_array($method, array('GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD', 'OPTIONS'))) {
            return false;
        }
        $opts = array(
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_URL => $url,
            CURLOPT_FAILONERROR => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 30,
        );
        if ($method == 'POST' && !is_null($postFields)) {
            //兼容5.0-5.6版本的curl
//            if (class_exists('\CURLFile')) {           
//                if($postFields['media']){              
//                }
//                $postFields['media'] = new \CURLFile(realpath($postFields['media']));
//            } else {
//                if (defined('CURLOPT_SAFE_UPLOAD')) {
//                    $opts[CURLOPT_SAFE_UPLOAD]= FALSE;
//                }
//            }
            $opts[CURLOPT_POSTFIELDS] = $postFields;
        }

        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == 'https') {
            $opts[CURLOPT_SSL_VERIFYPEER] = false;
            $opts[CURLOPT_SSL_VERIFYHOST] = false;
        }
        if (!empty($headers) && is_array($headers)) {
            $httpHeaders = array();
            foreach ($headers as $key => $value) {
                array_push($httpHeaders, $key . ':' . $value);
            }
            $opts[CURLOPT_HTTPHEADER] = $httpHeaders;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $err = curl_errno($ch);
        curl_close($ch);
        if ($err > 0) {
            Dingtalk::error(curl_error($ch));
            self::CorpLog(curl_error($ch));
            return false;
        } else {
            return $data;
        }
    }

    /**
     * 浏览器友好的变量输出
     * @param mixed $var 变量
     * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
     * @param string $label 标签 默认为空
     * @param boolean $strict 是否严谨 默认为true
     * @return void|string
     */
    public static function dump($var, $echo = true, $label = null, $strict = true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else
            return $output;
    }

    /**
     * 
     * @param type $url
     * @param type $data
     * @return type
     * 第三方库httpful  入口(多媒体上传)
     */
    public static function httpfulpost($data, $api, $type = "image") {
        if (empty($data)) {
            self::CorpLog("httpfulpost 数据为空或者异常");
            return false;
        }
        $access_token = DingToken::getAccessToken();
        $url = Dingtalk::$baseUrl . $api . '?access_token=' . $access_token . "&type={$type}";
        $response = \Httpful\Request::post($url)
                ->expects(\Httpful\Mime::JSON)
                ->attach($data)
                ->send();
        if ($response->hasErrors()) {
            Dingtalk::error($response);
            self::CorpLog($response);
        }
        if ($response->body->errcode != 0) {
            Dingtalk::error($response);
            self::CorpLog($response);
        }
        $result = json_encode($response->body); //把她转换为json字符串  
        $result = json_decode($result, true);
        if ($result['errcode'] == 0) {
            return $result;
        } else {
            Dingtalk::error($result['errmsg']);
            self::CorpLog($result['errmsg']);
            return false;
        }
    }

    //错误日志(写日志)
    public static function CorpLog($msg) {
        define('DIR_ROOT', dirname(__FILE__) . '/');
        $filename = DIR_ROOT . "/log/corp.log";
        $logFile = fopen($filename, "aw");
        fwrite($logFile, date(" Y-m-d h:i:s") . "  " . $msg . "\n");
        fclose($logFile);
    }

}
