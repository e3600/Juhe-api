<?php
namespace JuheApi\Kernel;

use JuheApi\Kernel\Response;
use GuzzleHttp\Client;

class Http extends Response
{
    public static function httpGet(string $url, array $query = [])
    {
        return self::request($url, 'GET', ['query' => $query]);
    }
    
    public function httpPost(string $url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }
    
    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }
    
    public function httpUpload(string $url, array $files = [], array $form = [], array $query = [])
    {
        $multipart = [];
        $headers   = [];
        
        if (isset($form['filename'])) {
            $headers = [
                'Content-Disposition' => 'form-data; name="media"; filename="' . $form['filename'] . '"',
            ];
        }
        
        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
                'headers'  => $headers,
            ];
        }
        
        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }
        
        return $this->request(
            $url,
            'POST',
            [
                'query'           => $query,
                'multipart'       => $multipart,
                'connect_timeout' => 30,
                'timeout'         => 30,
                'read_timeout'    => 30,
            ]
        );
    }
    
   public static function request($url, $method = 'GET', array $options = [], $returnRaw = false)
    {
        $client = new Client();
        $res    = $client->request($method, $url, $options);
        var_dump($res);
        return $res;
    }
    
    public function requestRaw(string $url, $method = 'GET', array $options = [])
    {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }
}
