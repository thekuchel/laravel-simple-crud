<?php

namespace App\Repository\ACL;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $morphClass = 'MorphRole';
    protected $table = "acl_role";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "nama",
        "kode"
    ];

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}
