<?php

namespace JuheApi\BasicService;

trait CheckConfig
{
    protected function checkConfig($config)
    {
        if (!$config['project_key']) {
            $this->fail('project_key 不能为空');
        }
    }
}
