<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 */
class PasswordReset extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at', 'updated_at'];
}
