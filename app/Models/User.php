<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function getProfilePhotoAttribute($value)
    {
        return $value == null ? 'https://res.cloudinary.com/soha/image/upload/v1698927551/l6edizafzfculb2mftwl.webp' : $value;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'other_names',
        'email',
        'phone_number',
        'role',
        'role_id',
        'password',
        'email_verified_at',
        'taxpayer_type',
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
        'password'          => 'hashed',
    ];

    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole', 'role_id');
    }

    public function individual()
    {
        return $this->hasOne('App\Models\IndividualTaxpayer', 'user_id');
    }

    public function corporate()
    {
        return $this->hasOne('App\Models\CorporateTaxpayer', 'user_id');
    }

    public function taxpayer()
    {
        return $this->hasOne('App\Models\TaxPayer', 'user_id');
    }

}
