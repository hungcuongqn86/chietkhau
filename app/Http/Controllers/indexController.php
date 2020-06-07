<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        /*$c = new \TopClient;
        $c->appkey = '30074478';
        $c->secretKey = 'c066725d2eb12a5c296b5fc240a210ba';
        $c->format = 'json';

        $req = new \TbkDgMaterialOptionalRequest;
        $req->setPageSize("10");
        $req->setPageNo("1");
        $req->setCat("");
        $req->setQ("https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.118.4e654174mrWEc6&id=7675223939");
        $req->setAdzoneId("110148550222");
        $req->setMaterialId("6707");
        $req->setIncludePayRate30("true");
        $req->setIncludeGoodRate("true");
        $req->setIncludeRfdRate("true");
        $resp = $c->execute($req);
        dd($resp);*/


        /*$req = new \TbkDgOptimusMaterialRequest;
        $req->setPageSize("100");
        $req->setPageNo("1");
        $req->setAdzoneId("110148550222");
        $req->setMaterialId("6708");
        $resp = $c->execute($req);
        dd($resp);*/

        /*$req = new \TbkItemShareConvertRequest;
        $req->setFields("num_iid,click_url");
        $req->setNumIids("7675223939");
        $req->setSubPid("mm_566430049_1414400150_110148550222");
        $req->setAdzoneId("110148550222");
        $resp = $c->execute($req);
        dd($resp);*/


        /*$req = new \TbkCouponGetRequest;
        $req->setItemId("7675223939");
        $req->setActivityId("ec4ff6a423e14acbbc49ed7266769854");
        $resp = $c->execute($req);
        dd($resp);*/

        return view('index');
    }

    public function shareLink(Request $request, $response = 'html')
    {
        $input = $request->all();

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
