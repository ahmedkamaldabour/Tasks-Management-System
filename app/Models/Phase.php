<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Phase extends Model
{
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'name',
        'step',
    ];
    public $translatable = ['name'];

    public static $translatableData = [
        'name' => [
            'type' => 'text',
            'validate' => 'required|string|min:3|max:255'
        ],
    ];

    // phase belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // phase has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
