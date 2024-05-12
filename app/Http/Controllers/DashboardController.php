<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Customer;
use App\Repository\Scenario;
use App\Repository\Session;
use App\Repository\SessionActivity;
use App\Repository\SessionPerformanceResult;
use App\Service\CustomerService;
use App\Service\ScenarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         return view('dashboard');
    }

}
