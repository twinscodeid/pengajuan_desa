<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function suratIjinKegiatan()
    {
        return $this->hasMany(SuratIjinKegiatan::class);
    }
    public function pelaporanMasyarakat()
    {
        return $this->hasMany(PelaporanMasyarakat::class);
    }
    public function bantuanSosial()
    {
        return $this->hasMany(BantuanSosial::class);
    }

    public static function getTotalRoleUser()
    {
        return self::where('role_id', 2)->count();
    }

    public static function getProfileRoleUser($id)
    {
        return self::with('role')->where('id', $id)->first();
    }
}
