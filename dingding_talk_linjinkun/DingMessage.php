<?php

// +------------------------------------------------+
// +//www.epwk.com                           |
// +------------------------------------------------+
// | 消息会话  |
// +------------------------------------------------+
// | Date:  2018.03.28                              |
// +------------------------------------------------+
include_once('Dingtalk.php');
include_once('DingUtils.php');

/**
 * 会话消息
 */
class DingMessage extends Dingtalk {

    /**
     * 发送企业会话消息
     * @param  [type] $touser  [description]
     * @param  [type] $agentid [description]
     * @param  [type] $msgtype [description]
     * @param  [type] $msgbody [description]
     * @return [type]          [description]
     */
    public static function send($touser, $agentid, $msgtype, $msgbody) {
        $params = array(
            'touser' => $touser,
            'agentid' => $agentid,
            'msgtype' => $msgtype,
        );

        $result = DingUtils::post('message/send', array_merge($params, $msgbody));
        if (false !== $result) {
            unset($result['errcode']);
            unset($result['errmsg']);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 获取企业会话消息已读未读状态
     * @param  string $messageId 消息id
     * @return array|boolean
     */
    public static function status($messageId) {
        $params = array(
            'messageId' => $messageId,
        );
        $result = DingUtils::post('message/list_message_status', $params);
        if (false !== $result) {
            unset($result['errcode']);
            unset($result['errmsg']);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 发送普通会话消息
     * @param  [type] $sender  [description]
     * @param  [type] $cid     [description]
     * @param  [type] $msgtype [description]
     * @param  [type] $msgbody [description]
     * @return [type]          [description]
     */
    public static function common($sender, $cid, $msgtype, $msgbody) {
        $params = array(
            'sender' => $sender,
            'cid' => $cid,
            'msgtype' => $msgtype,
        );

        $result = DingUtils::post('message/send_to_conversation', array_merge($params, $msgbody));
        if (false !== $result) {
            return $result['receiver'];
        } else {
            return false;
        }
    }

}
