<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const PHOTO_ALLOWED = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    protected $appends = [
        'photo_url',
    ];

    protected function getPhotoUrlAttribute()
    {
        if(substr($this->photo, 0, 4) != 'http'){
            if ($this->photo && config('filesystems.default') == 'public' && Storage::exists($this->photo)) {
                return asset($this->photo);
            }

            return Storage::exists($this->photo) ? $this->photo : null;
        }

        return $this->photo;
        
    }
}
