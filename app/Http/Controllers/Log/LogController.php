<?php

namespace App\Http\Controllers\Log;

use App\Exports\LogExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Log\Log;
use App\Service\Log\LogService;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{

    public function index()
    {
        return view('log.log-list');
    }

    public function list_datatables()
    {
        return LogService::list_datatables();
    }

}
