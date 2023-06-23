<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function auth;

class TaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'changed_column',
        'old_value',
        'new_value',
        'task_id',
        'user_id',
    ];

    public function phase_old_value()
    {
        return $this->belongsTo(Phase::class, 'old_value', 'id');
    }

    public function phase_new_value()
    {
        return $this->belongsTo(Phase::class, 'new_value', 'id');
    }

    public function status_old_value()
    {
        return $this->belongsTo(Status::class, 'old_value', 'id');
    }

    public function status_new_value()
    {
        return $this->belongsTo(Status::class, 'new_value', 'id');
    }

    public function client_old_value()
    {
        return $this->belongsTo(Client::class, 'old_value', 'id');
    }

    public function client_new_value()
    {
        return $this->belongsTo(Client::class, 'new_value', 'id');
    }

    public function assigned_old_value()
    {
        return $this->belongsTo(User::class, 'old_value', 'id');
    }

    public function assigned_new_value()
    {
        return $this->belongsTo(User::class, 'new_value', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeEmployee(Builder $query): Builder
    {
        if (!auth()->user()->isAdmin()) {
            return $query->where('user_id', auth()->id());
        }
        return $query;
    }
}
