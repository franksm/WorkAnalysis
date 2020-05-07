<?php
namespace App\Http\Controllers\Tool;
use Illuminate\Http\Request;

class UseApi
{
    function CallApi($method,$url,$data=false)
    {
        $request = Request::create($url, $method, $data);
        $response = app()->handle($request);
        $result = $response->getData();
        $result = json_decode(json_encode($result), true);
        return $result;
    }
    
}