<?php

namespace App\Models;

use App\Traits\HasGravatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $array)
 * @method static find(int|string|null $id)
 * @method static latest()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasGravatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function roi()
    {
        return $this->investments()->where('status', 'open');
    }

    public function all_roi()
    {
        return $this->investments();
    }

    public function ira_roi()
    {
        return $this->investments()->where(['acct_type' => 'basic_ira']);
    }

    public function offshore_roi()
    {
        return $this->investments()->where(['acct_type' => 'offshore']);
    }

    public function deposits()
    {
        return $this->transactions()->where('type', 'deposit');
    }

    public function ira_deposit()
    {
        return $this->transactions()->where(['acct_type' => 'basic_ira', 'type' => 'deposit']);
    }

    public function ira_payout()
    {
        return $this->transactions()->where(['acct_type' => 'basic_ira', 'type' => 'payout']);
    }

    public function offshore_deposit()
    {
        return $this->transactions()->where(['acct_type' => 'offshore', 'type' => 'deposit']);
    }

    public function offshore_payout()
    {
        return $this->transactions()->where(['acct_type' => 'offshore', 'type' => 'payout']);
    }

    public function payouts()
    {
        return $this->transactions()->where('type', 'payout');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function invoices(): Collection
    {
        return $this->documents()->where('type', 'invoice')->get();
    }

    public function receipts(): Collection
    {
        return $this->documents()->where('type', 'receipt')->get();
    }

    public function getNameAttribute(): string
    {
        return $this->attributes['first_name'];
    }

    public function getFullNameAttribute(): string
    {
        return $this->attributes['first_name']. ' '. $this->attributes['last_name'];
    }

    public function getGravatarAttribute(): string
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }

    public function isWaitingApproval(): bool
    {
        return $this->attributes['status'] == 'pending';
    }

    public function isDeclined(): bool
    {
        return $this->attributes['status'] == 'declined';
    }

    public function isSuspended(): bool
    {
        return $this->attributes['status'] == 'suspended';
    }

    public function copyBots()
    {
        return $this->belongsToMany(CopyBot::class);
    }

    public function updateWallet($crypto, $trading)
    {
        $data = [
            'crypto' => $crypto,
            'trading' => $trading,
        ];

        $dataJson = json_encode($data);

        $this->update(['wallet' => $dataJson]);
    }
}
