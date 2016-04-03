<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DB::table('records')
        ->select('users.name as user_name', 'records.*', 'books.name as book_name')
        ->leftJoin('users', 'users.id', '=', 'records.user_id')
        ->leftJoin('books', 'books.id', '=', 'records.book_id')
        ->orderBy('records.time')
        ->get();
        return view('manage', ['records' => $records]);
    }

    public function store(Request $request)
    {
        if (Auth::check()){
            DB::table('records')->insert([
                'id' => null,
                'user_id' => intval(Auth::user()->id),
                'book_id' => intval($request->input('id')),
                'time' => $_SERVER['REQUEST_TIME'],
                'return_time' => 0,
                'enable' => 0//是否允许外借，默认为0，不允许
            ]);
            $result=[
                'status' => 1
            ];
        }else{
            $result=[
                'status' => 0
            ];
        }
        return json_encode($result);
    }

    public function update($id)
    {
        DB::table('records')
            ->where('id', intval($id))
            ->update(['enable' => 1]);
        $result=[
            'status' => 1
        ];
        return json_encode($result);
    }


    public function destroy($id)
    {
        DB::table('records')
            ->where('id', intval($id))
            ->delete();
        $result=[
            'status' => 1
        ];
        return json_encode($result);
    }
}
