<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $qty
 * @property string $sub_total
 * @property string $vat
 * @property string $total
 * @property string $pay
 * @property string $due
 * @property string $payBy
 * @property string $order_date
 * @property string $order_month
 * @property string $order_year
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'qty', 'sub_total', 'vat', 'total', 'pay', 'due', 'payBy', 'order_date', 'order_month', 'order_year', 'created_at', 'updated_at'];
}
