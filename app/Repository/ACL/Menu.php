<?php

namespace App\Repository\ACL;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public static $morphClass = 'MorphMenu';
    protected $table = "acl_menu";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'url',
        'slug',
        'id_parent'
    ];
}
