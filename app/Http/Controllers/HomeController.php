<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Judge;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $issues = Issue::latest()->take(10)->get();
        return view('admin.home')->with(compact('issues'));
    }
}
