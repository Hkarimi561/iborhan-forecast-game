<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CountScores;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//use App\Http\Controllers\Controller;

use Auth;
use App\Models\Admin;
use Yajra\Datatables\Datatables;

class Employee extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.home');
    }



}
