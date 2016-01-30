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
        $classes_tree = array();
        foreach ($classes as $class) {
            $classes_tree[substr($class->classnumber, 0, 1)][substr($class->classnumber, 0, 2)][$class->classnumber][] = $class->name;
        }
        return view('home', ['classes_tree' => $classes_tree]);
    }
}
