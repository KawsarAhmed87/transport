<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{

    public $user;

     public function __construct()
    {
    $this->middleware('auth');
    } 

    public function index()
    {
   
        return view('backend.pages.dashboard.index');

    }
}
