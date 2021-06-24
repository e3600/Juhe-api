<?php

namespace JuheApi\OfficialAccount\Login;

use JuheApi\BasicService\RequestContainer;

class ServiceProvider extends RequestContainer
{
    public function __construct($config = null)
    {
        parent::__construct($config);
    }
    
    public function auto($params, $call)
    {
        if (!$call) {
            exit('call 必须提供');
        }
        
        // 创建并自动跳转到授权地址
        !isset($_GET['code']) && $this->create($params, function ($res) {
            if (isset($res['authUrl'])) {
                header("Location: " . $res['authUrl']);
                exit();
            }
        });
        
        // 取Token && getUserInfo
        isset($_GET['code']) && $this->autoSuccess($call);
    }
    
    public function create($params = [], $call = null)
    {
        // 带有code的应该走到了第二步[success]
        if ($call && isset($_GET['code'])) {
            return false;
        }
        
        if (!$params['redirect_uri'] && substr($params['redirect_uri'], 0, 4) != 'http') {
            if ($call) {
                $call(['message' => 'Login redirect_uri 不能为空']);
                return false;
            } else {
                return ['message' => 'Login redirect_uri 不能为空'];
            }
        }
        
        $res = $this->httpPostJsonV2(
            [
                'action'       => 'login_create',
                'redirect_uri' => $params['redirect_uri'],
                'scope'        => $params['scope'],
                'state'        => $params['state'],
            ]
        );
        
        if ($call) {
            $call(['authUrl' => $res]);
            return;
        }
        return ['authUrl' => $res];
    }
    
    private function autoSuccess($call)
    {
        $res  = $this->getAccessToken($this->input('code'));
        if (!isset($res['success'])) {
            $call(['message' => $res['message'] ?? 'getAccessToken fail']);
            return;
        }
        
        $userInfo = $this->getUserInfo($res['access_token'], $res['openid']);
        if (!isset($res['success'])) {
            $call(['message' => $res['message'] ?? 'getAccessToken fail']);
            return;
        }
        $call(['state' => $this->input('state'), 'userinfo' => $userInfo]);
    }
    
    /**
     * code换取token
     *
     * @param $code
     * @return mixed
     */
    public function getAccessToken($code)
    {
        return $this->httpPostJsonV2(
            [
                'action' => 'login_authorization_code',
                'code'   => $code,
            ]
        );
    }
    
    /**
     * 刷新token
     * 由于access_token拥有较短的有效期，当access_token超时后，可以使用refresh_token进行刷新，refresh_token有效期为30天，当refresh_token失效之后，需要用户重新授权
     *
     * @param string $refresh_token 填写通过getAccessToken()获取到的refresh_token参数
     */
    public function refreshToken($refresh_token)
    {
        return $this->httpPostJsonV2(
            [
                'action'        => 'login_refresh_token',
                'refresh_token' => $refresh_token,
            ]
        );
    }
    
    /**
     * 取用户信息
     *
     * @param string $access_token 网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同
     * @param string $openid       用户的唯一标识
     * @param string $lang         返回国家地区语言版本，zh_CN 简体，zh_TW 繁体，en 英语
     * @return mixed
     */
    public function getUserInfo($access_token, $openid, $lang = 'zh_CN')
    {
        return $this->httpPostJsonV2(
            [
                'action'       => 'login_userinfo',
                'access_token' => $access_token,
                'openid'       => $openid,
                'lang'         => $lang,
            ]
        );
    }
}
