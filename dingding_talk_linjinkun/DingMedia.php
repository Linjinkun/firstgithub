<?php
// +------------------------------------------------+
// +//www.epwk.com                           |
// +------------------------------------------------+
// | 媒体应用  |
// +------------------------------------------------+
// | Date:  2018.04.17                              |
// +------------------------------------------------+
include_once('Dingtalk.php');
include_once('DingUtils.php');
/**
 * 媒体信息处理
 */
class DingMedia extends Dingtalk
{
       /**
        * 
     * 上传多媒体文件/ 完成
     * @return [type] [description]
        $params = [
            'type'  => $type,
            'media' => $media,
        ];
       * */
    public static function upload($params)
    {
        if(!is_array($params)||empty($params)||empty($params['media'])||empty($params['type'])){
            return false;
        }
        $data['media'] = $params['media'];
        $type = $params['type'];
        $result = DingUtils::httpfulpost($data, "media/upload",$type);
        if (false !== $result) {
            return $result['media_id'];
        } else {
            return false;
        }
    }

    /**
     * 获取媒体文件
     * @param  string $mediaId 媒体文件的唯一标示
     * @return [type]
     */
    public static function get($mediaId)
    {
        $params = [
            'media_id' => $mediaId,
        ];
        $result = DingUtils::get('media/downloadFile', $params,true,true);
        
        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }
     
}

