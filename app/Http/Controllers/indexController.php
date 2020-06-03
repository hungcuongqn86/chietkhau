<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
        dd(json_decode($data, true)['data']);
        return view('share_link', ['data' => json_decode($data, true)['data']]);
    }
}
