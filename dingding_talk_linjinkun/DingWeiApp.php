<?php
// +------------------------------------------------+
// +//www.epwk.com                           |
// +------------------------------------------------+
// | 微应用管理  |
// +------------------------------------------------+
// | Date:  2018.04.17                              |
// +------------------------------------------------+
include_once('Dingtalk.php');
include_once('DingUtils.php');
/**
 * 微应用
 */
class DingWeiApp extends Dingtalk
{
    
  /**
     * 创建微应用
     * @return [type] [description]
     */
    public static function create($params)
    {
        if(!is_array($params)||empty($params)){
            return false;
        }
      
        $result = DingUtils::post('microapp/create', $params);
        if (false !== $result) {
            return $result['agentId'];
        } else {
            return false;
        }
    }
    
      /**
     * 更新微应用
     * @return [type] [description]
     */
    public static function update($params)
    {
        if(!is_array($params)||empty($params)){
            return false;
        }
      
        $result = DingUtils::post('microapp/update', $params);
        if (false !== $result) {
            return $result['agentId'];
        } else {
            return false;
        }
    }
  
      /**
     * 列出所有微应用
     * @return [type] [description]
     */
    public static function lists()
    {
        $result = DingUtils::post('microapp/list',array());
        if (false !== $result) {
            return $result['appList'];
        } else {
            return false;
        }
    }
       
    /**
     * 获取企业设置的微应用可见范围
     * @param [type] $agentId [description]
     */
    public static function scopes($agentId)
    {
        $params = array(
            'agentId' => $agentId,
        );

        $result = DingUtils::post('microapp/visible_scopes', $params);
        if (false !== $result) {
            unset($result['errcode']);
            unset($result['errmsg']);
            return $result;
        } else {
            return false;
        }
    }
    /**
     * 设置微应用的可见范围
     * @param [type] $agentId [description]
     * @param [type] $params  [description]
     * $params = array(
                "agentId"=> "171844060",
                "isHidden"=>false,//是否仅限管理员可见，true代表仅限管理员可见
                "deptVisibleScopes"=>array(),
                "userVisibleScopes"=>array()
      );
     */
    public static function setScopes($params=array())
    {       
        if(empty($params)||!is_array($params)){
            return false;
        }   
        $result = DingUtils::post('microapp/set_visible_scopes', $params);
        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    public static function common($sender, $cid, $msgtype, $msgbody)
    {
        $params = array(
            'sender'  => $sender,
            'cid'     => $cid,
            'msgtype' => $msgtype,
        );

        $result = DingUtils::post('message/send_to_conversation', array_merge($params, $msgbody));
        if (false !== $result) {
            return $result['receiver'];
        } else {
            return false;
        }
    }
      /**
     * 获取CorpSecret授权范围
     * oapi.dingtalk.com/auth/scopes?access_token=ACCESS_TOKEN
     * @return array|boolean
     */
    public static function Corcopes()
    {
        $result = DingUtils::get('auth/scopes');
        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }
      
}

