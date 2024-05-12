<?php

namespace App\Repository;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends BaseModel
{
    use SoftDeletes;
    protected $table = "employee";
    protected $primaryKey = "id";
    protected $fillable = [
        "nik",
        "name",
        "divisi",
        "id_user"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
