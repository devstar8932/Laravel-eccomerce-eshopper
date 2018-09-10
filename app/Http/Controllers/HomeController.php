<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class HomeController extends Controller
{
    public function index(){

        $all_published_product=DB::table('tbl_products')
                        ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                        ->join('manufacture', 'tbl_products.manufacture_id','=','manufacture.manufacture_id')
                        ->select('tbl_products.*','tbl_category.category_name','manufacture.manufacture_name')
                        ->limit(6)
                        ->where('tbl_products.publication_status',1)
                        ->get();
        $manage_published_product=view('pages.home_content')
                        ->with('all_published_product',$all_published_product);

        return view('layout')
        ->with('pages.home_content', $manage_published_product);
        //return view('pages.home_content');
    }
}
