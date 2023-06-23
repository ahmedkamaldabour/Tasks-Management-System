<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Status extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
    ];
    public $translatable = ['name'];
    public static $translatableData = [
        'name' => [
            'type' => 'text',
            'validate' => 'required|string|min:3|max:255'
        ],
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
