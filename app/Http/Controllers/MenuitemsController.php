<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MenuitemsController extends Controller
{
    public function index()
    {
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','categories_description.categories_id')
                    ->where('categories_status',1)
                    ->orderby('categories.categories_id','ASC')
                    ->get();

        $menuitems= DB::table('menuitems')
        ->leftjoin('itemsto_categories','itemsto_categories.item_id','=','menuitems.item_id')
        ->leftjoin('categories','categories.categories_id','=','itemsto_categories.categories_id')
        ->leftjoin('categories_description','categories_description.categories_id','=','itemsto_categories.categories_id')
        ->where('menuitems.item_status',1)
        ->select('menuitems.*','categories.categories_id','categories_description.categories_name')
        ->orderby('itemsto_categories.categories_id','ASC')
        ->get();
        //dd($menuitems);
        return view('web.menuitems.index',compact('categories','menuitems'));
    }
}
