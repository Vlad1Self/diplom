<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $email
 * @property string $token
 * @property string $status
 * @property int $user_id
 */

class ResetPasswordRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'status',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
