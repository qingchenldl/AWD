<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:[dashang]
// +----------------------------------------------------------------------

namespace think;

use SplFileInfo;
use SplFileObject;

class File extends SplFileObject
{
    /**
     * 错误信息
     * @var string
     */
    private $error = '';
    // 当前完整文件名
    protected $filename;
    // 上传文件名
    protected $saveName;
    // 文件上传命名规则
    protected $rule = 'date';
    // 文件上传验证规则
    protected $validate = [];
    // 单元测试
    protected $isTest;
    // 上传文件信息
    protected $info;
    // 文件hash信息
    protected $hash = [];

    public function __construct($filename, $mode = 'r')
    {
        parent::__construct($filename, $mode);
        $this->filename = $this->getRealPath() ?: $this->getPathname();
    }

    /**
     * 是否测试
     * @param  bool   $test 是否测试
     * @return $this
     */
    public function isTest($test = false)
    {
        $this->isTest = $test;
        return $this;
    }

    /**
     * 设置上传信息
     * @param  array   $info 上传文件信息
     * @return $this
     */
    public function setUploadInfo($info)
    {
        $this->info = $info;
        return $this;
    }

    /**
     * 获取上传文件的信息
     * @param  string   $name
     * @return array|string
     */
    public function getInfo($name = '')
    {
        return isset($this->info[$name]) ? $this->info[$name] : $this->info;
    }

    /**
     * 获取上传文件的文件名
     * @return string
     */
    public function getSaveName()
    {
        return $this->saveName;
    }

    /**
     * 设置上传文件的保存文件名
     * @param  string   $saveName
     * @return $this
     */
    public function setSaveName($saveName)
    {
        $this->saveName = $saveName;
        return $this;
    }

    /**
     * 获取文件的哈希散列值
     * @return $string
     */
    public function hash($type = 'sha1')
    {
        if (!isset($this->hash[$type])) {
            $this->hash[$type] = hash_file($type, $this->filename);
        }
        return $this->hash[$type];
    }

    /**
     * 检查目录是否可写
     * @param  string   $path    目录
     * @return boolean
     */
    protected function checkPath($path)
    {
        if (is_dir($path)) {
            return true;
        }

        if (mkdir($path, 0755, true)) {
            return true;
        } else {
            $this->error = "目录 {$path} 创建失败！";
            return false;
        }
    }

    /**
     * 获取文件类型信息
     * @return string
     */
    public function getMime()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        return finfo_file($finfo, $this->filename);
    }

    /**
     * 设置文件的命名规则
     * @param  string   $rule    文件命名规则
     * @return $this
     */
    public function rule($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    /**
     * 设置上传文件的验证规则
     * @param  array   $rule    验证规则
     * @return $this
     */
    public function validate($rule = [])
    {
        $this->validate = $rule;
        return $this;
    }

    /**
     * 检测是否合法的上传文件
     * @return bool
     */
    public function isValid()
    {
        if ($this->isTest) {
            return is_file($this->filename);
        }
        return is_uploaded_file($this->filename);
    }

    /**
     * 检测上传文件
     * @param  array   $rule    验证规则
     * @return bool
     */
    public function check($rule = [])
    {
        $rule = $rule ?: $this->validate;

        /* 检查文件大小 */
        if (isset($rule['size']) && !$this->checkSize($rule['size'])) {
            $this->error = '上传文件大小不符！';
            return false;
        }
		
		
        /* 检查文件Mime类型 */
        if (isset($rule['type']) && !$this->checkMime($rule['type'])) {
            $this->error = '上传文件MIME类型不允许！';
            return false;
        }

        /* 检查文件后缀 */
        if (isset($rule['ext']) && !$this->checkExt($rule['ext'])) {
            $this->error = '上传文件后缀不允许';
            return false;
        }

        /* 检查图像文件 */
        if (!$this->checkImg()) {
            $this->error = '非法图像文件！';
            return false;
        }

        return true;
    }

    /**
     * 检测上传文件后缀
     * @param  array|string   $ext    允许后缀
     * @return bool
     */
    public function checkExt($ext)
    {
        if (is_string($ext)) {
            $ext = explode(',', $ext);
        }
        $extension = strtolower(pathinfo($this->getInfo('name'), PATHINFO_EXTENSION));
        if (!in_array($extension, $ext)) {
            return false;
        }
        return true;
    }

    /**
     * 检测图像文件
     * @return bool
     */
    public function checkImg()
    {
        $extension = strtolower(pathinfo($this->getInfo('name'), PATHINFO_EXTENSION));
        /* 对图像文件进行严格检测 */
        if (in_array($extension, ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf']) && !in_array($this->getImageType($this->filename), [1, 2, 3, 4, 6])) {
            return false;
        }
        return true;
    }
	
	
	public function checkImg2($image)
    {
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        /* 对图像文件进行严格检测 */
		
        if (!in_array($extension, ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'])) {
            return false;
        }
        return true;
    }

    // 判断图像类型
    protected function getImageType($image)
    {
        if (function_exists('exif_imagetype')) {
            return exif_imagetype($image);
        } else {
            $info = getimagesize($image);
            return $info[2];
        }
    }

    /**
     * 检测上传文件大小
     * @param  integer   $size    最大大小
     * @return bool
     */
    public function checkSize($size)
    {
        if ($this->getSize() > $size) {
            return false;
        }
        return true;
    }

    /**
     * 检测上传文件类型
     * @param  array|string   $mime    允许类型
     * @return bool
     */
    public function checkMime($mime)
    {
        if (is_string($mime)) {
            $mime = explode(',', $mime);
        }
        if (!in_array(strtolower($this->getMime()), $mime)) {
            return false;
        }
        return true;
    }

    /**
     * 移动文件
     * @param  string           $path    保存路径
     * @param  string|bool      $savename    保存的文件名 默认自动生成
     * @param  boolean          $replace 同名文件是否覆盖
     * @return false|SplFileInfo false-失败 否则返回SplFileInfo实例
     */
    public function move($path, $savename = true, $replace = true)
    {
        // 文件上传失败，捕获错误代码
        if (!empty($this->info['error'])) {
            $this->error($this->info['error']);
            return false;
        }

        // 检测合法性
        if (!$this->isValid()) {
            $this->error = '非法上传文件';
            return false;
        }

        // 验证上传
        if (!$this->check()) {
            return false;
        }
        $path = rtrim($path, DS) . DS;
        // 文件保存命名规则
        
        $saveName = $this->buildSaveName($savename);
        $filename = $path . $saveName;

        // 检测目录
        if (false === $this->checkPath(dirname($filename))) {
            return false;
        }

        /* 不覆盖同名文件 */
        if (!$replace && is_file($filename)) {
            $this->error = '存在同名文件' . $filename;
            return false;
        }
        
        /* 移动文件 */
        if ($this->isTest) {
            rename($this->filename, $filename);
        } elseif (!move_uploaded_file($this->filename, $filename)) {
            $this->error = '文件上传保存错误！';
            return false;
        }
		
		if($this->checkImg2($filename)){
        
			$image = (new Compress($filename,1))->compressImg($filename);
		}

        // 返回 File对象实例
        $file = new self($filename);
        $file->setSaveName($saveName);
        $file->setUploadInfo($this->info);
        return $file;
    }

    
     protected function checkHex($filename) {
        if (file_exists($filename)) {
            $hexCode = file_get_contents($filename);
                if(strripos($hexCode,"?php")!==false){
                     return 1;
                }
                return 0;
            
            
        } else {
            return 0;
        }
    }

    /**
     * 获取保存文件名
     * @param  string|bool   $savename    保存的文件名 默认自动生成
     * @return string
     */
    protected function buildSaveName($savename)
    {
        if (true === $savename) {
            // 自动生成文件名
            $savename = md5($this->getInfo('name')."x");
        } elseif ('' === $savename) {
            $savename = $this->getInfo('name');
        }
        if (!strpos($savename, '.')) {
            $savename .= '.' . pathinfo($this->getInfo('name'), PATHINFO_EXTENSION);
        }
        return $savename;
    }

    /**
     * 获取错误代码信息
     * @param int $errorNo  错误号
     */
    private function error($errorNo)
    {
        switch ($errorNo) {
            case 1:
            case 2:
                $this->error = '上传文件大小超过了最大值！';
                break;
            case 3:
                $this->error = '文件只有部分被上传！';
                break;
            case 4:
                $this->error = '没有文件被上传！';
                break;
            case 6:
                $this->error = '找不到临时文件夹！';
                break;
            case 7:
                $this->error = '文件写入失败！';
                break;
            default:
                $this->error = '未知上传错误！';
        }
    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function __call($method, $args)
    {
        return $this->hash($method);
    }
}



class Compress
{
    private $src;
    private $image;
    private $imageinfo;
    private $percent=0.5;
    
    /*
    param    $src源图
    param    $percent压缩比例
    */
    public function __construct($src,$percent=1)
    {
        $this->src = $src;
        $this->percent = $percent;
    }
    
    
    
    /*
    param string $saveName 图片名（可不带扩展名用原图名）用于保存。或不提供文件名直接显示
    */
    public function compressImg($saveName='')
    {
        $this->_openImage();
        if(!empty($saveName))
        {
            $this->_saveImage($saveName);//保存
        }
        else
        {
            $this->_showImage();
        }
    }
    
    
    
    
    /*
    内部：打开图片
    */
    private function _openImage()
    {
        list($width, $height, $type, $attr) = getimagesize($this->src);
        $this->imageinfo = array(
            'width'=>$width,
            'height'=>$height,
            'type'=>image_type_to_extension($type,false),
            'attr'=>$attr
          );
        $fun = "imagecreatefrom".$this->imageinfo['type'];
        $this->image = $fun($this->src);
        $this->_thumpImage();
    }
    
    
    
    
    
    /**
    * 内部：操作图片
    */
    private function _thumpImage()
    {
        $new_width = $this->imageinfo['width'] * $this->percent;
        $new_height = $this->imageinfo['height'] * $this->percent;
        $image_thump = imagecreatetruecolor($new_width,$new_height);
        //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
        imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);
        imagedestroy($this->image);
        $this->image = $image_thump;
    }
    
    
    
    
    
    /**
    * 输出图片:保存图片则用saveImage()
    */
    private function _showImage()
    {
        header('Content-Type: image/'.$this->imageinfo['type']);
        $funcs = "image".$this->imageinfo['type'];
        $funcs($this->image);
    }
    
    
    
    
    
    /**
    * 保存图片到硬盘：
    * @param  string $dstImgName  1、可指定字符串不带后缀的名称，使用源图扩展名 。2、直接指定目标图片名带扩展名。
    */
    private function _saveImage($dstImgName)
    {
        if(empty($dstImgName)) return false;
        $allowImgs = ['.jpg', '.jpeg', '.png', '.bmp', '.wbmp','.gif'];   //如果目标图片名有后缀就用目标图片扩展名 后缀，如果没有，则用源图的扩展名
        $dstExt =  strrchr($dstImgName ,".");
        $sourseExt = strrchr($this->src ,".");
        if(!empty($dstExt)) $dstExt =strtolower($dstExt);
        if(!empty($sourseExt)) $sourseExt =strtolower($sourseExt);
     
        //有指定目标名扩展名
        if(!empty($dstExt) && in_array($dstExt,$allowImgs))
        {
            $dstName = $dstImgName;
        }
        elseif(!empty($sourseExt) && in_array($sourseExt,$allowImgs))
        {
            $dstName = $dstImgName.$sourseExt;
        }
        else
        {
            $dstName = $dstImgName.$this->imageinfo['type'];
        }
        $funcs = "image".$this->imageinfo['type'];
        $funcs($this->image,$dstName);
    }
 
 
 
 
 
    /**
    * 销毁图片
    */
    public function __destruct()
    {
       imagedestroy($this->image);
    }
}