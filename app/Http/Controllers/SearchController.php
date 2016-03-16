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
        return $this->core($category, '', intval($page));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function core($category, $keyword, $page)
    {
        $list_show_num = 20;
        /*
        $classes = DB::select('SELECT name, classnumber 
            FROM `classes` 
            WHERE char_length(classnumber)<=3 
                  AND char_length(classnumber)>=1');
        $classes_tree = array();
        foreach ($classes as $class) {
            $classes_tree[substr($class->classnumber, 0, 1)][substr($class->classnumber, 0, 2)][$class->classnumber][] = $class->name;
        }
        //return view('home', ['classes_tree' => $classes_tree]);
        */
        

        if ( $keyword ) {
            $keyword_arr = explode(" ", $keyword);
            $keyword_sql = " MATCH (name,author,d_tags) AGAINST (? IN BOOLEAN MODE)";
            $parameter = $keyword;
            $title_short = "搜索包含 " . $keyword . " 的图书";
        }
        if ( $category ) {
            //获取分类信息（中图法）
            $query_sql = "SELECT name,content FROM `classes` WHERE classnumber = ?";
            $category_arr = get_object_vars(DB::select($query_sql, [$category])[0]);
            var_dump($category_arr);

            $append_sql = "classnumber like ?";
            $parameter = $category.'%';
            $title_short = "".$category_arr['name']."(分类号：".$category.")";
        }
        $c_num = intval(get_object_vars(DB::select("SELECT count(id) FROM `books` WHERE " . $append_sql, [$parameter])[0])['count(id)']);
        print_r($c_num);
        
        if ($c_num == 0) {
            exit('查无搜索结果');
        }

        // 处理正确的页数
        $taltol_page = ceil($c_num / $list_show_num);
        if ($page < 1) {
            exit('404');
        } else if ($page > $taltol_page) {
            exit('404');
        }
        
        
        
        // 获取所需的图书列表
        if ($page == 0)
            $page = 1;
        $query_sql = "SELECT id,name,author,image,get_id,publisher,rating 
            FROM `books` 
            WHERE " . $append_sql . " 
            ORDER BY rating DESC,id DESC 
            LIMIT " . ($page - 1) * $list_show_num . "," . $list_show_num;
        $books     = DB::select($query_sql, [$parameter]);
        print_r($books);

        // 页面变量
        $title = $title_short." - 暨南大学图书馆 - page " . $page;
        return $category. 'test';
    }
}
