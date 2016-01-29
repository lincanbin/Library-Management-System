<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = DB::select('SELECT name, classnumber 
            FROM `classes` 
            WHERE char_length(classnumber)<=3 
                  AND char_length(classnumber)>=1');
        return view('home', ['classes' => $classes]);
    }
}
