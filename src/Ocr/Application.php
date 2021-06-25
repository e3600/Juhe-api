<?php

namespace JuheApi\Ocr;

use JuheApi\Kernel\Response;
use JuheApi\BasicService\BaseConfig;
use JuheApi\BasicService\RequestContainer;

/**
 * Class Application.
 */
class Application extends RequestContainer
{
    use Response;
    use BaseConfig;
    
    // 服务标识
    private $serverMark = 'ocr';
    
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        parent::__construct($this->initConfig($config, $this->serverMark), $this->serverMark, true);
    }
    
    public function id_card($params = [])
    {
        if (!file_exists($params['file'])) {
            $this->fail('要识别的【身份证】图片路径有误，请检查');
        }
        $file = $params['file'];
        unset($params['file']);
        
        return $this->httpUploadV1(
            [
                'file' => $file,
            ],
            array_merge([
                'action' => 'id_card',
            ], $params)
        );
    }
    
    public function bank_card($params = [])
    {
        if (!file_exists($params['file'])) {
            $this->fail('要识别的【银行卡】图片路径有误，请检查');
        }
        $file = $params['file'];
        unset($params['file']);
        
        return $this->httpUploadV1(
            [
                'file' => $file,
            ],
            array_merge([
                'action' => 'bank_card',
            ], $params)
        );
    }
    
    public function business_license($params = [])
    {
        if (!file_exists($params['file'])) {
            $this->fail('要识别的【营业执照】图片路径有误，请检查');
        }
        $file = $params['file'];
        unset($params['file']);
        
        return $this->httpUploadV1(
            [
                'file' => $file,
            ],
            array_merge([
                'action' => 'business_license',
            ], $params)
        );
    }
}
