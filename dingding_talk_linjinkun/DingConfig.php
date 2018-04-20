<?php
// +------------------------------------------------+
// |www.epwk.com                             |
// +------------------------------------------------+
// | 钉钉SDK  所有配置文件信息                                      
// +------------------------------------------------+
// | Date:  2018.04.16
// | @author linjinkun                            |
// +------------------------------------------------+
return array(
    //钉钉配置信息
    'corpid' => 'ding32ca896d05d4848435c2f4657eb6378f', //企业id
    'corpsecret' => 'oQVq-fYYKRT2GFZn_1M_9bCeFaeTpqVe8nP7qxz2nuZwOAvn2XRu_HEhGexMJmFm', //企业应用的凭证密钥
    'ssosecret' => 'JWruOnXAdX1Y-EzY4fPm8WV5lY5gNAM3QsSjmZKxe-CddWwKWUZeIn59fNnsF0Wv', //后台管理应用密匙
    'agentid' => '24958455 ', //微应用id	-- 云消息
    'appid' => 'dingoapzw2ktnvznxzvxcb', //开放应用id
    'appsecret' => 'OwXyIUQOHDh2vkpkHQqtAybwEks2tgyhE-P524ltKtyR-GIPK5AO7jumNIaRlIMC', //开放应用密匙
    'suite_key' => 'suitezsnwbtva3snuqpnb', // suite key 套件key
    'suite_secret' => 'IZPQLj570_fcTr55e1olqeq6SUxKaT1lsvkFdn1j_P2S6Si1SF_PRGYFYh1rRatU', // 套件 suite secret
    'get_sns_token_url' => 'https://oapi.dingtalk.com/sns/gettoken', //开放应用获取token url
    'get_persistent_code' => 'https://oapi.dingtalk.com/sns/get_persistent_code',
    'get_sns_token' => 'https://oapi.dingtalk.com/sns/get_sns_token', //获取用户授权的SNS_TOKEN
    'sns_getuserinfo' => 'https://oapi.dingtalk.com/sns/getuserinfo', //获取授权用户信息
    //请求参数url
    'gettoken_url' => 'https://oapi.dingtalk.com/gettoken',
    'get_sso_token_url' => 'https://oapi.dingtalk.com/sso/gettoken', //后台免登token
    'get_jsapi_ticket' => 'https://oapi.dingtalk.com/get_jsapi_ticket', //获取jsapi_ticket
    'department_list' => 'https://oapi.dingtalk.com/department/list', //获取部门列表
    'department_list_detail' => 'https://oapi.dingtalk.com/department/get', //获取部门列表(详细信息)
    'user_simplelist' => 'https://oapi.dingtalk.com/user/simplelist', //获取部门成员列表
    'user_list' => 'https://oapi.dingtalk.com/user/list', //获取部门成员列表(带详细信息)
    'user_getinfo' => 'https://oapi.dingtalk.com/user/get', //通过用户id获取用户信息
    'user_getinfo_by_code' => 'https://oapi.dingtalk.com/user/getuserinfo', //通过code获取用户信息
    'get_userid_by_unionid' => 'https://oapi.dingtalk.com/user/getUseridByUnionid', // 通过unionid 获取userid
    'get_admin' => 'https://oapi.dingtalk.com/user/get_admin', // 获取管理员列表
    //微应用url
    'microapp_visible_scopes' => 'https://oapi.dingtalk.com/microapp/visible_scopes', //微应用可见范围
    'microapp_create' => 'https://oapi.dingtalk.com/microapp/create', //创建微应用
    //群会话接口
    'chat_create' => 'https://oapi.dingtalk.com/chat/create', //群会话创建接口
    'chat_update' => 'https://oapi.dingtalk.com/chat/update', //群会话修改接口
    'chat_get' => 'https://oapi.dingtalk.com/chat/get', //群会话获取接口
    'chat_send' => 'https://oapi.dingtalk.com/chat/send', //群会话获取接口

    /** ***会话消息接口**** */
    'message_send' => 'https://oapi.dingtalk.com/message/send', //发送企业会话消息
    'media_upload' => 'https://oapi.dingtalk.com/media/upload', //上传文件
    
    //获取CorpSecret授权范围
     'scopes_auth'=>"https://oapi.dingtalk.com/auth/scopes",
);
?>
