<?php
// 主动回复消息
namespace JuheApi\MiniProgram\Message;

use JuheApi\BasicService\RequestContainer;
use JuheApi\Kernel\Response;

class ServiceProvider extends RequestContainer
{
    use Response;
    
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function sendText($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendText'], $params));
    }
    
    public function sendLink($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendLink'], $params));
    }
    
    public function sendImage($params = [])
    {
        return $this->httpPostJsonV2(array_merge(['action' => 'sendImage'], $params));
    }
    
    public function sendImageAutoUpload($params = [])
    {
        if (!isset($params['imagePath']) || !file_exists($params['imagePath'])) {
            $this->fail('图片文件不存在，请检查');
        }
        
        if ($this->getFileType(file_get_contents($params['imagePath'])) !== 0) {
            $this->fail('当前只支持图片格式');
        }
        
        if (!isset($params['touser'])) {
            $this->fail('touser 不能为空');
        }
        
        return $this->httpUploadV2(
            [
                'file' => $params['imagePath'],
            ],
            [
                'action'   => 'sendImageAutoUpload',
                'touser'   => $params['touser'],
                'filename' => pathinfo($params['imagePath'], PATHINFO_BASENAME),
            ]
        );
    }
    
    
    private function getFileType($file, &$fileType = '')
    {
        // 文件头标识 (2 bytes)
        $bin     = substr($file, 0, 2);
        $strInfo = @unpack("C2chars", $bin);;
        $typeCode = intval($strInfo['chars1'] . $strInfo['chars2']);
        $fileType = "";
        switch ($typeCode) {
            case 255216 :
                $fileType = "image/jpeg";
                $ret      = 0;
                break;
            case 7173 :
                $fileType = "image/gif";
                $ret      = 0;
                break;
            case 13780 :
                $fileType = "image/png";
                $ret      = 0;
                break;
            case 6677:
                $fileType = 'image/bmp';
                $ret      = 0;
                break;
            case 7790:
                $fileType = 'exe';
                $ret      = 0;
                break;
            case 7784:
                $fileType = 'midi';
                $ret      = 0;
                break;
            case 8297:
                $fileType = 'rar';
                $ret      = 0;
                break;
            default :
                $fileType = "unknow";
                $ret      = -1;
                break;
        }
        return $ret;
    }
}
