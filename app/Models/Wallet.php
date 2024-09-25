<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($wallet) {
            $wallet->balance = max(0, $wallet->balance);
            $wallet->ic_wallet = max(0, $wallet->ic_wallet);
            $wallet->it_wallet = max(0, $wallet->it_wallet);
            $wallet->oc_wallet = max(0, $wallet->oc_wallet);
            $wallet->ot_wallet = max(0, $wallet->ot_wallet);
            $wallet->swap = max(0, $wallet->swap);
            $wallet->margin = max(0, $wallet->margin);
        });
    }
}
