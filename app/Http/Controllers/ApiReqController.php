<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonServiceFactory;

class ApiReqController extends Controller
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
            $commissionValue = (float)$data->zk_final_price;
            if (isset($data->coupon_amount)) {
                $commissionValue = $commissionValue - (float)$data->coupon_amount;
            }

            if (isset($data->commission_rate)) {
                $commissionValue = round($commissionValue * (float)$data->commission_rate / 10000, 2);
            } else {
                $commissionValue = 0;
            }

            $refundRate = 80;
            $refundValue = number_format(round($commissionValue * $refundRate / 100, 2), 2);

            $link = [
                'num_iid' => $data->num_iid,
                'refund_value' => $refundValue,
                'url' => $refundValue,
            ];
        }
        return response()->json($link);
    }
}
