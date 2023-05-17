<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property integer $product_id
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['content', 'user_id', 'product_id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
