<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'response_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'session_id',
        'flow_step_id',
        'field_name',
        'field_value',
    ];

    protected $casts = [
        'field_value' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::ulid();
            }
        });
    }

    // Relaciones

    // UserResponse pertenece a una sesión (chat_session)
    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class, 'session_id', 'session_id');
    }

    // UserResponse pertenece a un paso del flujo
    public function flowStep()
    {
        return $this->belongsTo(FlowStep::class, 'flow_step_id', 'step_id');
    }
}
