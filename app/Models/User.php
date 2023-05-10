<?php

namespace App\Models;

use function Illuminate\Events\queueable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
// use HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable;

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

    public function invitacion_evento()
    {
        return $this->hasMany(invitacion_evento::class);
    }

    public function Evento()
    {
        return $this->hasMany(Evento::class);
    }

    public function fotos()
    {
        return $this->hasMany(fotos::class);
    }

    public function album_evento()
    {
        return $this->hasMany(album_evento::class);
    }

    public function detalle_album_cliente()
    {
        return $this->hasMany(detalle_album_cliente::class);
    }

    public function detalle_album_evento()
    {
        return $this->hasMany(detalle_album_evento::class);
    }

    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }
}
