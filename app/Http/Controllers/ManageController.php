<?php

namespace App\Http\Controllers;

use DB;
use Mail;
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
        ->select('users.name as user_name', 'users.email as user_email', 'users.mobile as user_mobile', 'records.*', 'books.name as book_name')
        ->leftJoin('users', 'users.id', '=', 'records.user_id')
        ->leftJoin('books', 'books.id', '=', 'records.book_id')
        ->orderBy('records.time')
        ->get();
        // TODO : 这里应当读取即将逾期的记录，然后发送邮件/短信通知。
        foreach ($records as $key => $record) {
           if ($record->enable == 1 && $record->return_time == 0 && ($record->time+86400*60) > time() && ($record->time+86400*50) < time() && $record->notified == 0) {
                $msg_content = $record->user_name . '，你在暨南大学图书馆借阅的《' . $record->book_name . '》即将于' . date('Y-m-d', $record->time+86400*60) . '逾期！';
                Mail::send('emails.reminder', ['record' => $record], function ($m) use ($record, $msg_content) {
                    $m->from('carbon_forum@ourjnu.com', '暨南大学图书馆');
                    $m->to($record->user_email, $record->user_name)->subject($msg_content);
                 });

                $post = [
                    'studentno' => 2012052291,
                    'username' => $record->user_name,
                    'mobile' => $record->user_mobile,
                    'msg' => $msg_content
                ];
                
                // 发送短信模块，一条一毛钱
                $url = 'http://202.116.13.44/sms/sendmessage.jsp';

                $post_data = http_build_query($post);
                $ch = curl_init() ;
                curl_setopt($ch , CURLOPT_POST , 1);
                curl_setopt($ch , CURLOPT_HEADER , 0);
                curl_setopt($ch , CURLOPT_URL , $url);
                curl_setopt($ch , CURLOPT_POSTFIELDS , $post_data) ;
                $send_result = curl_exec ($ch) ;
                //var_dump($send_result);
                
                DB::table('records')
                ->where('id', intval($record->id))
                ->update(['notified' => 1]);
            }
        }
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
                'enable' => 0,//是否允许外借，默认为0，不允许
                'notified' => 0// 是否已发送即将逾期的提醒，默认为0，不发送
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

    public function update(Request $request, $id)
    {
        $column = $request->input('column');;
        $value = $request->input('value');;
        if(!in_array($column, ['enable', 'notified', 'return_time']) || intval($value) == 0){
            $result = [
                'status' => 0
            ];
        }else{
            if($column == 'return_time'){
                $value = $_SERVER['REQUEST_TIME'];
            }
            DB::table('records')
                ->where('id', intval($id))
                ->update([$column => $value]);
            $result = [
                'status' => 1
            ];
        }
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
