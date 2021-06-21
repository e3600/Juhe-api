<?php

namespace JuheApi\Kernel;

use JuheApi\Kernel\Response as Client;

class Http
{
    public static function httpGet(string $url, array $query = [])
    {
        return self::request($url, 'GET', ['query' => $query]);
    }
    
    public static function httpPost(string $url, array $data = [])
    {
        return self::request($url, 'POST', ['form_params' => $data]);
    }
    
    public static function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return self::request($url, 'POST', ['query' => $query, 'json' => $data]);
    }
    
    public static function httpUpload(string $url, array $files = [], array $form = [], array $query = [])
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
        
        return self::request(
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
        return $client->request($method, $url, $options);
    }
}
