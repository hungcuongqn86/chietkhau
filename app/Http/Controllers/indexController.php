<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    const appkey = "30074478";
    const secretKey = "c066725d2eb12a5c296b5fc240a210ba";
    const adzoneId = "110148550222";

    public $topClient;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->topClient = new \TopClient;
        $this->topClient->appkey = self::appkey;
        $this->topClient->secretKey = self::secretKey;
        $this->topClient->format = 'json';
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

    public function shareLink(Request $request, $response = 'html')
    {
        $input = $request->all();
        $arrRules = [
            'url' => 'required',
        ];
        $validator = Validator::make($input, $arrRules);
        if ($validator->fails()) {
            if ($response == 'json') {
                return response()->json([]);
            }
            exit;
        }

        /*        if (Auth::guard()->check()) {
            $user = Auth::user();
            dd($user);
        }*/

        $req = new \TbkDgMaterialOptionalRequest;
        $req->setPageSize("10");
        $req->setPageNo("1");
        $req->setCat("");
        $req->setQ($input['url']);
        $req->setAdzoneId(self::adzoneId);
        $req->setMaterialId("6707");
        $req->setIncludePayRate30("true");
        $req->setIncludeGoodRate("true");
        $req->setIncludeRfdRate("true");
        $resp = $this->topClient->execute($req);
        $data = [];
        if(isset($resp->total_results) & ($resp->total_results > 0)){
            $data = $resp->result_list->map_data[0];
        }
        if ($response == 'json') {
            return response()->json($data);
        }
        // dd($data);
        return view('share_link', ['data' => $data]);
    }
}
