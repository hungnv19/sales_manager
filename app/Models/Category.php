<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $category_name
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_name', 'created_at', 'updated_at'];
}
