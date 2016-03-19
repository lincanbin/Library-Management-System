<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends Controller
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
    public function category($category, $page){
        return $this->core($category, null, intval($page));
    }

    public function search($keyword, $page){
        return $this->core(null, $keyword, intval($page));
    }

    public function core($category, $keyword, $page)
    {
        $list_show_num = 18;//每页显示的条目数量
        $category_info = array();
        if ( $keyword ) {
            //$keyword_arr = explode(" ", $keyword);
            $append_sql = " MATCH (name, author, d_tags) AGAINST (? IN BOOLEAN MODE)";
            $parameter = $keyword;
            $title_short = "搜索包含 " . $keyword . " 的图书";
        }
        if ( $category ) {
            //获取分类信息（中图法）
            $query_sql = "
                SELECT name, content 
                FROM `classes` 
                WHERE classnumber = ?";
            $category_info = get_object_vars(DB::select($query_sql, [$category])[0]);
            //var_dump($category_info);

            $append_sql = "classnumber like ?";
            $parameter = $category.'%';
            $title_short = "".$category_info['name']."(分类号：".$category.")";
        }
        $result_num = intval(get_object_vars(DB::select("
            SELECT count(id) 
            FROM `books` 
            WHERE " . $append_sql, [$parameter])[0])['count(id)']);
        //print_r($result_num);
        
        if ($result_num == 0) {
            exit('查无搜索结果');
        }

        // 处理正确的页数
        $total_page = ceil($result_num / $list_show_num);
        if ($page < 1) {
            exit('404');
        } else if ($page > $total_page) {
            exit('404');
        }

        // 获取所需的图书列表
        if ($page == 0)
            $page = 1;
        $query_sql = "SELECT id, name, author, image, get_id, publisher, rating 
            FROM `books` 
            WHERE " . $append_sql . " 
            ORDER BY rating DESC,id DESC 
            LIMIT " . ($page - 1) * $list_show_num . "," . $list_show_num;
        $books     = DB::select($query_sql, [$parameter]);
        //print_r($books);

        // 页面变量
        $title = $title_short." - page " . $page;
        return view('search', [
            'title' => $title, 
            'keyword' => $keyword,
            'category' => $category,
            'books' => $books,
            'category_info' => $category_info,
            'page' => $page,
            'total_page' => $total_page,
            'result_num' => $result_num
        ]);
    }
}
