<?php

// +------------------------------------------------+
// |www.epwk.com                             |
// +------------------------------------------------+
// | 部门管理                                       |
// +------------------------------------------------+
// | Date:  2018.03.28                              |
// +------------------------------------------------+
include_once('Dingtalk.php');
include_once('DingUtils.php');

class DingDepartment extends Dingtalk {

    /**
     * 获取部门列表/子部门列表
     * 	父部门id(如果不传，默认部门为根部门，根部门ID为1)
     * @param type $parent_id
     * @return array|boolean
     */
    public static function lists($parent_id = "") {
        if ($parent_id) {
            $params = array(
                'id' => $parent_id,
            );
            $result = DingUtils::get('department/list_ids', $params);
            if (false !== $result) {
                return $result['sub_dept_id_list']; //返回子部门id列表
            } else {
                return false;
            }
        } else {
            $result = DingUtils::get('department/list');
            if (false !== $result) {
                return $result['department'];
            } else {
                return false;
            }
        }
    }

    /**
     * 获取部门详情
     * @param  integer $id 部门ID
     * @return array|boolean
     */
    public static function info($id) {
        $params = array(
            'id' => $id,
        );
        $result = DingUtils::get('department/get', $params);
        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 创建部门
     * @param  string|array $name
     * @param  integer      $parentid
     * @return integer|boolean
     */
    public static function create($name, $parentid = 1) {
        if (is_array($name)) {
            $params = $name;
        } else {
            $params = array(
                'name' => $name,
                'parentid' => $parentid,
            );
        }
        $result = DingUtils::post('department/create', $params);

        if (false !== $result) {
            return $result['id'];
        } else {
            return false;
        }
    }

    /**
     * 更新部门
     * {
      "name": "钉钉事业部",
      "parentid": "1",
      "order": "1",
      "id": "1",
      "createDeptGroup": true,
      "autoAddUser": true,
      "deptManagerUseridList": "manager1111|2222",
      "deptHiding" : true,
      "deptPerimits" : "3|4",
      "userPerimits" : "userid1|userid2",
      "outerDept" : true,
      "outerPermitDepts" : "1|2",
      "outerPermitUsers" : "userid3|userid4",
      "orgDeptOwner": "manager1111"
      }
     * @param  array $params
     * @return boolean
     */
    public static function update($params) {
        if (!is_array($params)) {
            return false;
        }
        $result = DingUtils::post('department/update', $params);
        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除部门
     * @param  integer      $id
     * @return boolean
     */
    public static function delete($id) {
        $params = array(
            'id' => $id,
        );
        $result = DingUtils::get('department/delete', $params);

        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取部门用户列表
     * @param  integer $departmentId
     * @param  boolean $isDetail
     * @return array|boolean
     */
    public static function users($departmentId, $isDetail = false) {
        $params = array(
            'department_id' => $departmentId,
        );
        $result = DingUtils::get($isDetail ? 'user/list' : 'user/simplelist', $params);
        if (false !== $result) {
            return $result['userlist'];
        } else {
            return false;
        }
    }

}
