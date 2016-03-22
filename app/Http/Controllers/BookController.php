<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class BookController extends Controller
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
    public function show($id)
    {
        $book_info = DB::table('books')->where('id', $id)->first();
        if(!$book_info){
            exit('404');
        }
        return var_dump($book_info);
        //return view('book', ['book_info' => $book_info]);
    }
}
