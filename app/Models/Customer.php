<?php

namespace App\Models;

use App\Jobs\SendEmailVerificationCode;
use App\Models\Business;
use App\Models\CustomerOtp;
use App\Models\CustomerSubscription;
use App\Models\CustomerWallet;
use App\Models\NotificationSetting;
use App\Models\Referral;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = [];

    // Other model properties and methods...

    public function toArray()
    {
        $data = parent::toArray();

        if ($this->account_type === 'artisan') {
            $data['biography'] = $this->artisan->biography;
            $data['profession'] = $this->artisan->profession;
        }

        return $data;
    }

    public function customerSubscription()
    {
        return $this->hasMany('App\Models\CustomerSubscription');
    }

    public function business()
    {
        return $this->hasOne('App\Models\Business');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\JobListing');
    }

    public function wallet()
    {
        return $this->hasOne('App\Models\CustomerWallet');
    }

    public function activePlan()
    {
        $plan = CustomerSubscription::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", "active")->first();

        return $plan;
    }

    public function hasReviewed($businessId)
    {
        $reviewed = BusinessReviews::where("customer_id", Auth::user()->id)->where("business_id", $businessId)->first();
        if (isset($reviewed)) {
            return true;
        } else {
            return false;
        }
    }

    public function posts()
    {
        return $this->hasMany('App\Models\ForumPosts')->where("customer_id", Auth::user()->id);
    }

    public function topics()
    {
        return $this->hasMany('App\Models\ForumTopics')->where("customer_id", Auth::user()->id);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\PostComments')->where("customer_id", Auth::user()->id)->where("comment_type", "main");
    }

    public function replies()
    {
        return $this->hasMany('App\Models\PostComments')->where("customer_id", Auth::user()->id)->where("comment_type", "reply");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'photo',
        'gender',
        'country',
        'account_pin',
        'verification_status',
        'account_type',
        'status',
        'device_token',
        'email_verified_at',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'username',
        'account_pin',
        'password',
        'remember_token',
        'token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'referee' => 'customers:id,paytag',
        'email_verified_at' => 'datetime',
    ];

    public static function booted()
    {
        static::creating(function ($customer) {
            $password = request()->input('password');
            $customer->password = Hash::make($password);
        });

        static::created(function ($customer) {
            $customer->referral_code = Customer::generateReferralCode($customer->id);
            $customer->save();

            $otp = CustomerOtp::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                    'otp_type' => 'email',
                ], [
                    'otp' => Customer::generateOtp(),
                    'otp_expiration' => Carbon::now()->addMinutes(5),
                ]);

            if ($otp) {
                SendEmailVerificationCode::dispatch($otp);
            }

            if (request()->input('referral_code') != null) {
                $referee = Customer::where("referral_code", request()->input('referral_code'))->first();
                if ($referee != null) {
                    $referral = new Referral;
                    $referral->customer_id = $referee->id;
                    $referral->referral_id = $customer->id;
                    $referral->save();

                }
            }

            $business = new Business;
            $business->customer_id = $customer->id;
            $business->save();

            $subscription = new CustomerSubscription;
            $subscription->customer_id = $customer->id;
            $subscription->plan_id = 1;
            $subscription->card_details = "N/A for Trial Plan";
            $subscription->subscription_amount = 0;
            $subscription->auto_renew = 0;
            $subscription->status = "active";
            $subscription->next_due_date = Carbon::now()->addDays(30);
            $subscription->save();

            $customerWallet = new CustomerWallet;
            $customerWallet->customer_id = $customer->id;
            $customerWallet->save();

            $notSet = new NotificationSetting;
            $notSet->customer_id = $customer->id;
            $notSet->save();
        });
    }

    /**
     * generateOtp
     *
     * @return void
     */
    public static function generateOtp()
    {
        $pin = range(0, 9);
        $set = shuffle($pin);
        $otp = "";
        for ($i = 0; $i < 4; $i++) {
            $otp = $otp . "" . $pin[$i];
        }

        return $otp;
    }

    /**
     * generateReferralCode
     *
     * @param mixed id
     *
     * @return void
     */
    public static function generateReferralCode($id)
    {

        if (strlen($id) == 1) {
            return "ART0000" . $id;
        } else if (strlen($id) == 2) {
            return "ART000" . $id;
        } else if (strlen($id) == 3) {
            return "ART00" . $id;
        } else if (strlen($id) == 4) {
            return "ART0" . $id;
        } else if (strlen($id) == 5) {
            return "ART" . $id;
        }

    }

}
