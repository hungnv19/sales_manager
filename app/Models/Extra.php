<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $vat
 * @property string $logo
 * @property string $favicon
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 */
class Extra extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'extra';

    /**
     * @var array
     */
    protected $fillable = ['vat', 'logo', 'favicon', 'phone', 'email', 'address', 'created_at', 'updated_at'];
}
