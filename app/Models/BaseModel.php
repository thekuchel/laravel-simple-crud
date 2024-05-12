<?php

namespace App\Models;

use App\Repository\Log;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {

            Log::create([
                'model' => get_class($model),
                'id_model' => $model->id,
                'fields' => json_encode($model->getDirty()),
                'data' => json_encode($model->toArray()),
                'action' => 'create',
                'id_user' => auth()->user() ? auth()->user()->id : null
            ]);
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            Log::create([
                'model' => get_class($model),
                'id_model' => $model->id,
                'fields' => json_encode($model->getDirty()),
                'data' => json_encode($model->toArray()),
                'action' => 'edit',
                'id_user' => auth()->user() ? auth()->user()->id : null
            ]);
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            Log::create([
                'model' => get_class($model),
                'id_model' => $model->id,
                'fields' => json_encode($model->getDirty()),
                'data' => json_encode($model->toArray()),
                'action' => 'delete',
                'id_user' => auth()->user() ? auth()->user()->id : null
            ]);
        });
    }
}
