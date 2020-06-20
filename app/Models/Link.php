<?php


namespace App\Models;

class Link extends AppModel
{
    protected $table = 'links';
    protected $primaryKey = 'id';
    protected $fillable = [
        'num_iid',
        'item_url',
        'pict_url',
        'title',
        'coupon_share_url',
        'zk_final_price',
        'commission_rate',
        'coupon_amount',
        'coupon_id',
        'url',
        'user_id',
        'refund_rate',
        'refund_value',
        'status',
        'commission_value',
        'coupon_token_short_url',
        'token_url',
        'token_short_url',
        'coupon_token_url',
        'created_at',
        'updated_at',
        'created_by',
        'update_by',
        'deleted_at'
    ];
}
