<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonServiceFactory;

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

    public function shareLink(Request $request)
    {
        $input = $request->all();
        $arrRules = [
            'url' => 'required',
        ];
        $validator = Validator::make($input, $arrRules);
        if ($validator->fails()) {
            exit;
        }

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
        $link = [];
        if (isset($resp->total_results) & ($resp->total_results > 0)) {
            $data = $resp->result_list->map_data[0];
            $userId = 0;
            if (Auth::guard()->check()) {
                $user = Auth::user();
                $userId = $user['id'];
            }
            $commissionValue = (float)$data->zk_final_price;
            if (isset($data->coupon_amount)) {
                $commissionValue = $commissionValue - (float)$data->coupon_amount;
            }
            $commissionValue = round($commissionValue * (float)$data->commission_rate / 10000, 2);
            $refundRate = 80;
            $refundValue = round($commissionValue * $refundRate / 100, 2);

            $linkInput = [
                'num_iid' => $data->num_iid,
                'item_url' => $data->item_url,
                'pict_url' => $data->pict_url,
                'title' => $data->title,
                'coupon_share_url' => $data->coupon_share_url,
                'zk_final_price' => $data->zk_final_price,
                'commission_rate' => $data->commission_rate,
                'coupon_amount' => $data->coupon_amount,
                'coupon_id' => $data->coupon_id,
                'url' => $data->url,
                'refund_rate' => $refundRate,
                'refund_value' => $refundValue,
                'status' => 1,
                'commission_value' => $commissionValue,
                'user_id' => $userId
            ];

            $link = CommonServiceFactory::mLinkService()->create($linkInput);
        }
        return view('share_link', ['data' => $link]);
    }

    public function openlink(Request $request)
    {
        $input = $request->all();
        $arrRules = [
            'id' => 'required',
        ];
        $validator = Validator::make($input, $arrRules);
        if ($validator->fails()) {
            exit;
        }

        $url = '';
        if (Auth::guard()->check()) {
            $user = Auth::user();
            $link = CommonServiceFactory::mLinkService()->findById($input['id']);
            if (!empty($link)) {
                if ($link->user_id == 0) {
                    $link->user_id = $user['id'];
                }
                $url = $link->coupon_share_url;
            }
        }

        if ($url !== '') {
            return response()->json(['url' => $url]);
        }
        return response('error', 400);
    }
}
