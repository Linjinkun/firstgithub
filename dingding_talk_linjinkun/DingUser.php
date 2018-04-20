<?php

// +------------------------------------------------+
// |www.epwk.com                             |
// +------------------------------------------------+
// | 人员管理                                       |
// +------------------------------------------------+
// | Date:  2018.03.28                              |
// +------------------------------------------------+
include_once('Dingtalk.php');
include_once('DingUtils.php');

/**
 * 用户管理
 */
class DingUser extends Dingtalk {

    /**
     * 获取企业员工人数
     * @param  integer $active  0:总数，1:已激活
     * @return array|boolean
     */
    public static function count($active = 0) {
        $params = array(
            'onlyActive' => $active,
        );

        $result = DingUtils::get('user/get_org_user_count', $params);

        // var_dump($result);exit;
        if (false !== $result) {
            return $result['count'];
        } else {
            return false;
        }
    }

    /**
     * 获取用户详情
     * @param  string $userid 员工在企业内的UserID
     * @return array|boolean
     */
    public static function get($userid) {
        $params = array(
            'userid' => $userid,
        );

        $result = DingUtils::get('user/get', $params);

        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 创建成员
     * @param  [type] $name       [description]
     * @param  string $mobile     [description]
     * @param  array  $department [description]
     * @return [type]             [description]
     */
    public static function create($name, $mobile, $department = array(), $other_info = array()) {
        if (empty($name) || empty($mobile) || empty($department)) {
            return false;
        }
        $params = array(
            'name' => $name,
            'mobile' => $mobile,
            'department' => $department,
        );
        if ($other_info && is_array($other_info)) {
            $params = array_merge($params, $other_info);
        }
        $result = DingUtils::post('user/create', $params);
        if (false !== $result) {
            return $result['userid'];
        } else {
            return false;
        }
    }

    /**
     * 更新成员
     * @param  [type] $userid [description]
     * @param  [type] $name   [description]
     * @param  array  $data   [description]
     * @return [type]         [description]
     */
    public static function update($userid, $name, $data = array()) {
        #Todo..
        if (!$userid)
            return "缺少userid";
        if (!$name)
            return "缺少name";
        $params = array(
            'userid' => $userid,
            'name' => $name,
        );

        $result = DingUtils::post('user/update', $params);
        if (false !== $result) {
            if ($result['errcode'] == "0") {
                return "updated success";
            } else {
                return "updated fails";
            }
        } else {
            return false;
        }
    }

    /**
     * 删除成员
     * @param  [type] $userid [description]
     * @return [type]         [description]
     */
    public static function delete($userid) {
        $params = array(
            'userid' => $userid,
        );

        $result = DingUtils::get('user/delete', $params);

        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 批量删除用户
     * @param  array  $useridlist
     * @return boolean
     */
    public static function batchDelete($useridlist = array()) {
        $params = array(
            'useridlist' => $useridlist,
        );

        $result = DingUtils::post('user/batchdelete', $params);

        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取管理员列表
     * @return array|boolean
     */
    public static function admin() {
        $result = DingUtils::get('user/get_admin');

        if (false !== $result) {
            return $result['adminList'];
        } else {
            return false;
        }
    }

    /**
     * 通过CODE换取用户身份
     * @param  string $code requestAuthCode接口中获取的CODE
     * @return string|boolean
     */
    public static function code($code) {
        $params = array(
            'code' => $code,
        );

        $result = DingUtils::get('user/getuserinfo', $params);

        if (false !== $result) {
            return $result['userid'];
        } else {
            return false;
        }
    }

}
