<?php

namespace App\Service\Log;

use App\Repository\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Yajra\DataTables\Facades\DataTables;
use DB;

class LogService
{

    public static function list_datatables() {
        
        // $data = Log::where("id", "!=", null);
        // return DataTables::of($data)->make();

        // $data = Log::with(["user:id,name", "loggable" => function(MorphTo $morphTo){
        //     $morphTo->morphWith([Kawasan::class => [""]]);
        // }])->select(DB::raw("log.*"));

        $data = Log::with(["user:id,name", "loggable"])->select(DB::raw("logs.*"))->orderBy('created_at', 'desc');
        return DataTables::of($data)->make();
    }

}
