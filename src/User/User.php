<?php

namespace AIGenerate\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use AIGenerate\Models\Payment\PointHistory;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\Prompt\PromptFavorite;
use AIGenerate\Models\Prompt\PromptGenerate;
use AIGenerate\Models\Stock\StockFavorite;
use AIGenerate\Models\Stock\StockGenerate;
use AIGenerate\Models\Stock\StockLike;
use AIGenerate\Models\Stock\StockReview;
use AIGenerate\Models\User\Contracts\UserContract;

class User extends Authenticatable implements UserContract
{
    use HasFactory, Notifiable;

    protected $with = [
        'information',
        'count',
        'constant',
        'pointHistories',
        'stripeCustomerAccount',
        'stripeConnectAccount',
        'personalize'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function information(): HasOne
    {
        return $this->hasOne(UserInformation::class, 'user_id');
    }

    public function count(): HasOne
    {
        return $this->hasOne(UserCount::class, 'user_id');
    }

    public function constant(): HasOne
    {
        return $this->hasOne(UserConstant::class, 'user_id');
    }

    /*public function favorites(): HasManyThrough
    {
        return $this->hasManyThrough(Prompt::class, PromptFavorite::class, 'user_id', 'id', 'id', 'prompt_id');
    }*/

    public function favorites(): HasMany
    {
        return $this->hasMany(PromptFavorite::class, 'user_id');
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class, 'user_id');
    }

    public function promptGenerates(): HasMany
    {
        return $this->hasMany(PromptGenerate::class)->enabled();
    }

    public function sellerPromptGenerates(): HasManyThrough
    {
        return $this->hasManyThrough(PromptGenerate::class, Prompt::class, 'user_id', 'prompt_id', 'id', 'id');
    }

    public function getPointHistory(): Collection
    {
        return $this->pointHistories;
    }

    public function stripeCustomerAccount(): HasOne
    {
        return $this->hasOne(UserStripeCustomerAccount::class, 'user_id');
    }

    public function stripeConnectAccount(): HasOne
    {
        return $this->hasOne(UserStripeConnectAccount::class, 'user_id');
    }

    public function getPoint(): float
    {
        return $this->pointHistories->last()->remained ?? 0;
    }

    public function pointHistories(): HasMany
    {
        return $this->hasMany(PointHistory::class, 'user_id');
    }

    public function personalize(): HasOne
    {
        return $this->hasOne(UserPersonalize::class, 'user_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(StockLike::class, 'user_id');
    }

    public function stockFavorites(): HasMany
    {
        return $this->hasMany(StockFavorite::class, 'user_id');
    }

    public function stockGenerates(): HasMany
    {
        return $this->hasMany(StockGenerate::class, 'user_id');
    }

    public function stockReviews(): HasMany
    {
        return $this->hasMany(StockReview::class, 'user_id');
    }

}
