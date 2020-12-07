<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
                    ->where('categories.categories_status',1)
                    ->get();
       // dd($categories);
       return view('web.index',compact('categories'));
    }

    public function menudetails($id)
    {
        //dd($id);
        $menuitems= DB::table('menuitems')
                    ->leftjoin('itemsto_categories','itemsto_categories.item_id','=','menuitems.item_id')
                    ->leftjoin('categories','categories.categories_id','=','itemsto_categories.categories_id')
                    ->leftjoin('categories_description','categories_description.categories_id','=','itemsto_categories.categories_id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                        $join->on('categoryTable.image_id', '=', 'menuitems.item_image')
                            ->where(function ($query) {
                                $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                    ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                            });
                     })
                     ->where('menuitems.item_status',1)
                     ->where('itemsto_categories.categories_id',$id)
                     ->select('menuitems.*','categories.categories_id','categories_description.categories_name','categoryTable.path as imgpath')
                     ->get();
        $tot_item= count($menuitems);
        return view('web.menudetails',compact('menuitems','tot_item'));
    }

    public function list()
    {
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
                    ->where('categories.categories_status',1)
                    ->get();
       // dd($categories);
       return view('web.list',compact('categories'));
    }

}
