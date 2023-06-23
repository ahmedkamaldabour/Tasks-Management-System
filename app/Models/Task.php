<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use function auth;

class Task extends Model
{
    use HasFactory;
    use HasTranslations;


    protected $fillable = [
        'uuid',
        'title',
        'description',
        'link',
        'payment_status',
        'reporter_id',
        'assigned_id',
        'phase_id',
        'status_id',
        'client_id',
        'delivery_date'
    ];

    protected $translatable = [
        'title',
        'description',
    ];

    public static $originalAttributes = [];

    public static $translatableData = [
        'title' => [
            'type' => 'text',
            'validate' => 'required|string|min:3|max:255'
        ],
        'description' => [
            'type' => 'textarea',
            'validate' => 'required|string|min:3'
        ],
    ];

    public static function rules()
    {
        return [
            'link' => 'nullable|url',
            'payment_status' => 'required|in:paid,unpaid',
            'delivery_date' => 'nullable|date',
            'assigned_id' => 'required|exists:users,id',
            'phase_id' => 'required|exists:phases,id',
            'status_id' => 'required|exists:statuses,id',
            'client_name' => 'required',
        ];
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_id', 'id');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function taskHistory()
    {
        return $this->hasMany(TaskHistory::class);
    }

    public function scopeEmployee(Builder $query): Builder
    {
        if (!auth()->user()->isAdmin()) {
            return $query->where('assigned_id', auth()->id());
        }
        return $query;
    }


}
