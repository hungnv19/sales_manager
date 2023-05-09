<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property integer $supplier_id
 * @property string $product_name
 * @property string $product_code
 * @property string $root
 * @property string $buying_price
 * @property string $selling_price
 * @property string $buying_date
 * @property string $image
 * @property string $product_quantity
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'supplier_id', 'product_name', 'product_code', 'root', 'buying_price', 'selling_price', 'buying_date', 'image', 'product_quantity', 'created_at', 'updated_at'];
}