<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\UserMeta;
use App\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoleAndPermission;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
protected $fillable = [
    'user_type',
    'first_name',
    'last_name',
    'user_name',
    'user_email',
    'email_verified_at',
    'password',
    'remember_token',
    'gender',
    'profile_photo',
    'remember_me_key',
    'recovery_key',
    'confirmation_key',
    'confirmed',
    'confirmed_date',
    'banned',
    'banned_date',
    'banned_till',
    'address',
    'city',
    'state',
    'zip',
    'subscription',
    'subscription_date',
    'trial_date',
    'ip',
    'status',
];

    public $timestamps = false; // ✅ Turn off timestamps!

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the meta for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id');
    }

    /**
     * Get a specific meta value for the User
     *
     * @param  string  $key
     * @return mixed
     */
    public function getMeta($key)
    {
        $meta = $this->meta()->where('key', $key)->first();
        return $meta ? $meta->value : null;
    }
}
