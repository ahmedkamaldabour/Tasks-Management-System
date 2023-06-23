<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use function auth;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $translatable = [
        'name',
    ];

    public static $translatableData = [
        'name' => [
            'type' => 'text',
            'validate' => 'required|string|min:3|max:255'
        ],
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

    public static function rules()
    {
        return [
            'role' => ['required', 'in:employee,admin'],
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_id', 'id');
    }

    public function taskHistory()
    {
        return $this->hasMany(TaskHistory::class, 'user_id', 'id');
    }





}
