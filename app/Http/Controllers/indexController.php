<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonServiceFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

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
        /*$req = new \TimeGetRequest;
        $resp = $this->topClient->execute($req);
        echo $resp->time;
echo '<br>';
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Asia/Shanghai'));
        echo $date->format('Y-m-d H:i:s');*/

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
            // dd($data);
            $userId = 0;
            if (Auth::guard()->check()) {
                $user = Auth::user();
                $userId = $user['id'];
            }
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
            $refundValue = round($commissionValue * $refundRate / 100, 2);

            $detail = self::curlInfo($data->num_iid);
            dd($detail);
            $linkInput = [
                'num_iid' => $data->num_iid,
                'item_url' => $data->item_url,
                'pict_url' => $data->pict_url,
                'title' => $data->title,
                'coupon_share_url' => isset($data->coupon_share_url) ? $data->coupon_share_url : "",
                'zk_final_price' => $data->zk_final_price,
                'commission_rate' => isset($data->commission_rate) ? $data->commission_rate : "0",
                'coupon_amount' => isset($data->coupon_amount) ? $data->coupon_amount : "0",
                'coupon_id' => isset($data->coupon_id) ? $data->coupon_id : "0",
                'url' => $data->url,
                'refund_rate' => $refundRate,
                'refund_value' => $refundValue,
                'status' => 1,
                'commission_value' => $commissionValue,
                'user_id' => $userId,
                'coupon_token_short_url' => isset($detail['taoTokenInfo']['couponTokenShortUrl']) ? $detail['taoTokenInfo']['couponTokenShortUrl'] : "",
                'token_url' => isset($detail['taoTokenInfo']['url']) ? $detail['taoTokenInfo']['url'] : "",
                'token_short_url' => isset($detail['taoTokenInfo']['tokenShortUrl']) ? $detail['taoTokenInfo']['tokenShortUrl'] : "",
                'coupon_token_url' => isset($detail['taoTokenInfo']['couponUrl']) ? $detail['taoTokenInfo']['couponUrl'] : ""
            ];
            $link = CommonServiceFactory::mLinkService()->create($linkInput);
        }
        return view('share_link', ['data' => $link]);
    }

    public function link(Request $request)
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

            if (isset($data->commission_rate)) {
                $commissionValue = round($commissionValue * (float)$data->commission_rate / 10000, 2);
            } else {
                $commissionValue = 0;
            }

            $refundRate = 80;
            $refundValue = round($commissionValue * $refundRate / 100, 2);

            $detail = self::curlInfo($data->num_iid);
            dd($detail);

            $linkInput = [
                'num_iid' => $data->num_iid,
                'item_url' => $data->item_url,
                'pict_url' => $data->pict_url,
                'title' => $data->title,
                'coupon_share_url' => isset($data->coupon_share_url) ? $data->coupon_share_url : "",
                'zk_final_price' => $data->zk_final_price,
                'commission_rate' => isset($data->commission_rate) ? $data->commission_rate : "0",
                'coupon_amount' => isset($data->coupon_amount) ? $data->coupon_amount : "0",
                'coupon_id' => isset($data->coupon_id) ? $data->coupon_id : "0",
                'url' => $data->url,
                'refund_rate' => $refundRate,
                'refund_value' => $refundValue,
                'status' => 1,
                'commission_value' => $commissionValue,
                'user_id' => $userId,
                'coupon_token_short_url' => isset($detail['taoTokenInfo']['couponTokenShortUrl']) ? $detail['taoTokenInfo']['couponTokenShortUrl'] : "",
                'token_url' => isset($detail['taoTokenInfo']['url']) ? $detail['taoTokenInfo']['url'] : "",
                'token_short_url' => isset($detail['taoTokenInfo']['tokenShortUrl']) ? $detail['taoTokenInfo']['tokenShortUrl'] : "",
                'coupon_token_url' => isset($detail['taoTokenInfo']['couponUrl']) ? $detail['taoTokenInfo']['couponUrl'] : ""
            ];
            $link = CommonServiceFactory::mLinkService()->create($linkInput);
        }
        return view('link', ['data' => $link]);
    }

    private function curlInfo($id)
    {
        try {
            $cookie_file = dirname(__FILE__) . '/' . 'cookie.txt';
            /*$curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://pub.alimama.com/promo/search/index.htm?fn=search&showAllFilter=");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
            curl_exec($curl);
            curl_close($curl);*/

            $url = "http://pub.alimama.com/openapi/param2/1/gateway.unionpub/shareitem.json?shareUserType=1&unionBizCode=union_pub&shareSceneCode=item_search&materialId=" . $id . "&tkClickSceneCode=qtz_pub_search&siteId=1414400150&adzoneId=110148550222&materialType=1&needQueryQtz=true";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
            curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
            $data = curl_exec($curl);
            curl_close($curl);
            return json_decode($data, true)['data'];
        } catch (\Exception $e) {
            return [];
        }
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
                if (isset($data->coupon_share_url)) {
                    $url = $link->coupon_share_url;
                } else {
                    $url = $link->item_url;
                }
            }
        }

        if ($url !== '') {
            return response()->json(['url' => $url]);
        }
        return response('error', 400);
    }
}
