<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('check.session');
    }
    

    public function index(Request $request)
    {

        $params['menu'] = 'dashboard'; 
        return view('content.dashboard', $params);
        
    }

}
