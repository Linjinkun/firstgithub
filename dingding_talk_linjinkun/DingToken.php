<?php

// +------------------------------------------------+
// |http://www.epwk.com                             |
// +------------------------------------------------+
// | Token 获取                                     |
// +------------------------------------------------+
// | Date:  2018.04.16                              |
// +------------------------------------------------+

class DingToken extends Dingtalk {
    /**
     * 获取ACCESS_TOKEN
     * @return string|boolean
     */
    public static function getAccessToken() {
        $accessToken = self::CheckAccessToken();
        if ($accessToken === false) {
            $accessToken = self::freshAccessToken();
        }
        return $accessToken;
    }
    /**
     * 缓存中token
     * @return mixed|boolean
     */
    private static function CheckAccessToken() {
        // 此处通常从database / redis /memcached 获取
        $data = @file_get_contents('access_token.txt');
        $access_token = json_decode($data, true);
        //access_token 两个小时左右会过期，重新取一次
        if (!empty($access_token)) {
            if ((time() - $access_token['time']) < 3500) {
                return $access_token['access_token'];
            }
        }
        return false;
    }

    /**
     * 从钉钉服务器获取token令牌 重新抓取一个token
     * @return boolean
     */
    private static function freshAccessToken() {
        $params = array(
            'corpid' => parent::config_init('corpid'),
            'corpsecret' => parent::config_init('corpsecret'),
        );
        $result = DingUtils::get('gettoken', $params, false);        
        if (false !== $result && $result['errmsg'] == 'ok') {       
          $result = array_merge($result,array('time'=>time(),'date'=> date("Y-m-d h:i:sa", time())));  
                  // 此处通常会存入database / redis /memcached
                  $f = fopen('access_token.txt', 'w+');
                  fwrite($f, json_encode($result));
                  fclose($f);          
            return $result['access_token'];
        } else {
            return false;
        }
    }

    /**
     * 获取 免登SsoToken
     * @return string|boolean
     */
    public static function sso() {
        $params = array(
            'corpid' => parent::config_init('corpid'),
            'corpsecret' => parent::config_init('ssosecret'),
        );
        $result = DingUtils::get('sso/gettoken', $params, false);
        if (false !== $result) {
            return $result['access_token'];
        } else {
            return false;
        }
    }

    /**
     * 获取jsapi_ticket
     * @return string|boolean
     */
    public static function jsapi() {
        $result = DingUtils::get('get_jsapi_ticket');
        if (false !== $result) {
            return $result['ticket'];
        } else {
            return false;
        }
    }

}
