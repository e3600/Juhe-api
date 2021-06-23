<?php

namespace JuheApi\OfficialAccount\Menu;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function create($menus = [])
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'createMenu',
                'menus'  => json_encode(['button' => $menus], JSON_UNESCAPED_UNICODE),
            ]
        );
    }
    
    /**
     * 获取当前菜单
     *
     * @param bool $returnJson 是否返回JSON格式，默认为false，返回Array格式
     * @return mixed 返回JSON格式
     */
    public function list($returnJson = false)
    {
        $res = $this->httpPostJsonV2(
            ['action' => 'getMenu']
        );
        if (isset($res['button'])) {
            return $returnJson ? json_encode($res['button'], JSON_UNESCAPED_UNICODE) : $res['button'];
        }
        return $res;
    }
    
    public function delete()
    {
        return $this->httpPostJsonV2(
            ['action' => 'delMenu']
        );
    }
}
