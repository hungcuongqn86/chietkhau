<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    const URL_LOGIN = "http://chietkhau1688.com/login";
    const username = "Nguyễn Cường";
    const password = "dienvyhoa@2020";

    public $jar;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->jar = new CookieJar();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $c = new \TopClient;
        $c->appkey = '30074478';
        $c->secretKey = 'c066725d2eb12a5c296b5fc240a210ba';

        /*$req = new \HttpdnsGetRequest;

        $req->putOtherTextParam("name","test");
        $req->putOtherTextParam("value",0);

        var_dump($c->execute($req));*/

        $req = new \TbkItemInfoGetRequest;
        $req->setNumIids("610903374055");
        $req->setPlatform("1");
        $req->setIp("11.22.33.43");
        $resp = $c->execute($req);


        /*$client = new Client([
            'cookies' => $this->jar,
        ]);
        $client->request('POST', self::URL_LOGIN, [
            'form_params' => [
                'LoginForm' => [
                    'username' => self::username,
                    'password' => self::password,
                    'rememberMe' => 0
                ]
            ]
        ]);

        Cache::put('taobao_cookies', $this->jar, now()->addMinutes(60));*/

        /*$cacheJar = Cache::get('taobao_cookies');

        $client1 = new Client(array(
            'cookies' => $cacheJar
        ));

        $response = $client1->request('GET', 'http://chietkhau1688.com/rut-tien');
        dd($response->getBody()->getContents());*/
        return view('index');
    }
}
