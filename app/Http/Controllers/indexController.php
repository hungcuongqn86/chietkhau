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
        /*$c = new \TopClient;
        $c->appkey = '30074478';
        $c->secretKey = 'c066725d2eb12a5c296b5fc240a210ba';

        $req = new \TbkActivityInfoGetRequest;
        $req->setAdzoneId("110148550222");
        $req->setActivityMaterialId("557706784511");
        $resp = $c->execute($req);
        dd($resp);*/
        return view('index');
    }

    public function shareLink($id, $response = 'html')
    {
        $cookie_file = dirname(__FILE__) . '/' . 'cookie.txt';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://pub.alimama.com/openapi/param2/1/gateway.unionpub/shareitem.json?shareUserType=1&unionBizCode=union_pub&shareSceneCode=item_search&materialId=" . $id . "&tkClickSceneCode=qtz_pub_search&siteId=1414400150&adzoneId=110148550222&materialType=1&needQueryQtz=true");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
        $data = curl_exec($curl);
        curl_close($curl);
        if ($response == 'json') {
            return response()->json(json_decode($data, true)['data']);
        }
        // dd(json_decode($data, true)['data']);
        return view('share_link', ['data' => json_decode($data, true)['data']]);
    }
}
