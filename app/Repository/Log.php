<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    protected $table = "logs";
    protected $primaryKey = "id";
    protected $fillable = [
        "model",
        "id_model",
        "action",
        "fields",
        "data",
        "id_user"
    ];

    public function loggable() {
        return $this->morphTo()->withTrashed();
    }  
    
    public function user() {
        return $this->belongsTo(User::class, "id_user");
    }
}