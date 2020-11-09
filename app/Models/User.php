<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasFactory, Notifiable, HasApiTokens;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'display_name',
            'username',
            'email',
            'password',
            'avatar',
            'country',
            'href',
            'uri',
            'access_token',
            'refresh_token',
            'token_expires_at',
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

        /**
         * Returns the avatar of the user.
         *
         * @return string
         */
        public function getAvatarAttribute($value): string
        {
            if ($value !== null) {
                return $value;
            }

            return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'?s=200&d=retro';
        }
    }
