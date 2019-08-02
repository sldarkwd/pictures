<?php
/**
 * 2233娘的live2d看板娘插件(typecho)，支持换人换装！，如需WordPress插件请访问https://github.com/xb2016/poster-girl-l2d-2233
 * 
 * @package l2d233
 * @author Jrotty
 * @version 1.3.0
 * @link https://qqdie.com/archives/l2d233.html
 */
class l2d233_Plugin implements Typecho_Plugin_Interface
{ 
 public static function activate()
	{
   
        Typecho_Plugin::factory('Widget_Archive')->footer = array('l2d233_Plugin', 'footer');
   
    }
	/* 禁用插件方法 */
	public static function deactivate(){}
    public static function config(Typecho_Widget_Helper_Form $form){
     echo '<p>本插件需要加载jQuery库与Font Awesome支持，如果你的主题没有引用上述项目，请选择加载。<br />关于提示语的修改，请直接编辑js/waifu-tips.js。</p>';
  $l2dst= new Typecho_Widget_Helper_Form_Element_Checkbox('l2dst',  array(
'jq' => _t('配置是否加载JQ：勾选则加载不勾选则不加载'),'awesome' => _t('Font Awesome：勾选则加载不勾选则不加载'),
),
    array('jq','awesome'), _t('基本设置'));
        $form->addInput($l2dst);

    }
    



    public static function footer(){ if(!self::isMobile()){
        $options = Helper::options()->plugin('l2d233'); 
		echo '<div class="l2d_xb">'; 
      if (!empty(Helper::options()->plugin('l2d233')->l2dst) && in_array('awesome', Helper::options()->plugin('l2d233')->l2dst)){
echo '<link rel="stylesheet" href="'.Helper::options()->pluginUrl . '/l2d233/css/font-awesome.min.css" type="text/css">';
      }
    echo '<link rel="stylesheet" href="'.Helper::options()->pluginUrl . '/l2d233/css/waifu.min.css" type="text/css">';
    echo '
    <div class="waifu">
        <div class="waifu-tips"></div>
        <canvas id="live2d" width="230" height="250" class="live2d"></canvas>
        <div class="waifu-tool">
            <span class="fa fa-home"></span>
            <span class="fa fa-comments"></span>
            <span class="fa fa-drivers-license-o"></span>
            <span class="fa fa-street-view"></span>
            <span class="fa fa-camera"></span>
            <span class="fa fa-info-circle"></span>
            <span class="fa fa-close"></span>
        </div>
    </div>
             ';


 if (!empty(Helper::options()->plugin('l2d233')->l2dst) && in_array('jq', Helper::options()->plugin('l2d233')->l2dst)){
echo '<script  src="'.Helper::options()->pluginUrl . '/l2d233/js/jquery.min.js?v=2.1.4"></script>' . "\n";   }
      echo '<script>var l2d = {"xb":"'.Helper::options()->pluginUrl . '/l2d233"};</script>';
        echo '<script  src="'.Helper::options()->pluginUrl . '/l2d233/js/live2d.js?v=r3"></script><script  src="'.Helper::options()->pluginUrl . '/l2d233/js/waifu-tips.js?v=1.1"></script>  </div>' . "\n";        
 
    }
    }
   /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    /**
     * 移动设备识别
     *
     * @return boolean
     */
    private static function isMobile(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc","iuc", 'ucbrowser', // uc浏览器
            "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
            "iemobile", "windows ce", // windows phone
            "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry",
            "blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo",
            "lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony",
            "symbian","tablet","tianyu","wap","xda","xde","zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
}