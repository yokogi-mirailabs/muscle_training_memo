<?php

namespace App\Models;

use App\Notifications\ResetPasswordForMultiAuth; // 👈 追加しました
use App\Notifications\VerifyEmailForMultiAuth;// 👈 追加しました
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'password' => 'hashed',
    ];

    // 👇 以降、オーバーライドしました
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordForMultiAuth($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailForMultiAuth());
    }
}
