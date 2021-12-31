<?php

namespace App\Http;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class HttpClient
{
    /**
     * Request to API
     *
     * @return json_decode object
     */
    public static function request($method, $url, $json = null)
    {
        $access_token = Session::get('access_token');
        $client = new Client([
            'base_uri' => env('APP_URL'),
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '.$access_token
            ],
            'http_errors' => false
        ]);
        $response = $client->request($method, $url, ['json' => $json]);
        return response($response->getBody()->getContents(), $response->getStatusCode());
    }

    public static function login($method, $url, $json = null)
    {
        $client = new Client([
            'base_uri' => env('APP_URL'),
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
            'http_errors' => false
        ]);
        $response = $client->request($method, $url, ['json' => $json]);

        return response($response->getBody()->getContents(), $response->getStatusCode());
    }

    public static function upload($url, $form_data)
    {
        $access_token = Session::get('access_token');
        $client = new Client([
            'base_uri' => env('APP_URL'),
            'headers' => [
                'Content-Type' => 'multipart/form-data',
                'Authorization' => 'Bearer '.$access_token
            ],
        ]);
        $response = $client->request('POST', $url, $form_data);
        return response()->json(json_decode($response->getBody()->getContents()), $response->getStatusCode());
    }

    public static function download($url, $filename)
    {
        $access_token = Session::get('access_token');
        $client = new Client([
            'base_uri' => env('APP_URL'),
            'headers' => [
                'Authorization' => 'Bearer '.$access_token
            ],
        ]);
        $temp = tempnam(sys_get_temp_dir(), $filename.'_');
        $resource = fopen($temp, 'w');
        $response = $client->request('get', $url, ['sink' => $resource]);
        $status_code = $response->getStatusCode();
        $name = $response->getHeader('File-name');
        $data = (!empty($name)) ? ['path' => $temp, 'name' => $name[0], $status_code] : ['path' => $temp, 'name' => $filename, $status_code];
        return response()->json($data);
    }

    public static function paginate($items, $total, $per_page, $current_page)
    {
        return new LengthAwarePaginator(
            $items, $total, $per_page, $current_page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }
}
