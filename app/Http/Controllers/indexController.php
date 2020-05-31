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

        /*$req = new \TbkItemInfoGetRequest;
        $req->setNumIids("610903374055");
        $req->setPlatform("1");
        $req->setIp("11.22.33.43");
        $resp = $c->execute($req);*/

        $req = new \TbkDgOptimusMaterialRequest;
        $req->setPageSize("20");
        $req->setAdzoneId("110148550222");
        $req->setPageNo("1");
        $req->setMaterialId("13256");
        $req->setItemId("618962533617");
        // $req->setQ("610903374055");
        // $req->setMaterialId("610903374055");
        $resp = $c->execute($req);
        echo "<pre>";
        var_dump($resp);


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
