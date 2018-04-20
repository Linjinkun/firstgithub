<?php
// +------------------------------------------------+
// +//www.epwk.com                           |
// +------------------------------------------------+
// | 消息体  |
// +------------------------------------------------+
// | Date:  2018.04.19                              |
// +------------------------------------------------+
class MessageBody
{
    /**
     * 文本消息
     * @param  $text
     * @return array
     */
    public static function text($text)
    {
        $content = array();             
        $content['text'] = array('content'=>$media_id);
        return $content;
    }
    /**
     * 图片消息
     * @param string $media_id
     * @return array
     */
    public static function image($media_id)
    {
        $content = array();             
        $content['image'] = array('media_id'=>$media_id);
        return $content;
    }
    /**
     * voice 消息
     * @param string $media_id 语音媒体文件id
     * @param string $duration 正整数 小于60,表示音频的时长
     * @return array
     */
    public static function voice($media_id,$duration)
    {
        $content  = array();
        $content['voice']   = array(
            "media_id"=>$media_id,
            "duration"=>$duration          
        );
        return $content;
    }

    /**
     * file消息
     * @param string $media_id 文件媒体id
     * @return array
     */
    public static function file($media_id)
    {
        $content = array();             
        $content['file'] = array('media_id'=>$media_id);
        return $content;
    }
    /**
     * link 消息
     * @param string $url 消息点击链接地址
     * @param string $picUrl 图片媒体文件id
     * @param string $title 消息标题
     * @param string $text 消息描述
     * @return array
     */
    public static function link($url,$picUrl,$title,$text)
    {
          $conten = array();
          $content['link']   = array(
                                        "messageUrl"=>$url,
                                        "picUrl"=>$picUrl,
                                        "title"=>$title,
                                         "text"=>$text   
                                    );
        return $content;
    }


    /**
     * @desc oa 消息格式
     * @param string $messageUrl  消息点击url
     * @param string $head_text 跳转网页标题头
     * @param string $body_title oa消息体 标题
     * @param array  $body_form oa form内容例如 $body_form 	= ['0'=>['key'=>'商品名','value'=>'恰恰瓜子 500g/包'],];
     * @param string $body_content 内容
     * @param string $body_author 作者
     * @param string $body_image 缩略图
     * @param string $body_file_count 文件个数
     * @param string $rich_num 富文本信息数目
     * @param string $rich_unit  富文本信息单位
     * @return array  返回 oa 消息格式
     */
    public static function oaMessage($messageUrl,$head_text,$body_title,$body_form,$body_content,$body_author,$body_image = null,$body_file_count = null,$rich_num = null,$rich_unit = null)
    {       
        $content = array();
        $content['oa'] = array(
                 "message_url"=>$messageUrl,
                 " head"=>array(
                                       "bgcolor"=> "FFBBBBBB",
                                        "text"=>"头部标题"                
                                 )     
        );
       $content['body'] = array(
                 "title"=>$body_title,
                 " form"=>array(
                                  array(
                                           "key"=> "姓名",
                                           "value"=>"阿康"
                                          ),      
                                  array(
                                           "key"=> "年龄",
                                           "value"=>"20"
                                             ),   
                                  array(
                                           "key"=> "身高",
                                           "value"=>"2m"
                                             ),   
                                  array(
                                           "key"=> "学历",
                                           "value"=>"本硕连读"
                                             ),   
                                 ),
                 "rich"=>array(
                     "num"=>$rich_num,
                     "unit"=>$rich_unit
                 ),
           "content"=>$body_content,
           "image"=>$body_image,
           "file_count"=>$body_file_count,
           "author"=>$body_author,
           
        );
        return $content;
    }

}
?>
