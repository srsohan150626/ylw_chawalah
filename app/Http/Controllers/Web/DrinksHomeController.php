<?php

namespace App\Http\Controllers\Web;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\CategoryDescription;

class DrinksHomeController extends Controller
{
    public function index()
    {
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
                    ->where('categories.categories_status',1)
                    ->where('categories.parent_id',10)
                    ->get();
        $parent_name= CategoryDescription::where('categories_id',10)->first();
        //dd($parent_name->categories_name);
       return view('web.drinks.index',compact('categories','parent_name'));
    }

    public function menulist($id)
    {
        $menuitems= DB::table('menuitems')
        ->leftjoin('itemsto_categories','itemsto_categories.item_id','=','menuitems.item_id')
        ->leftjoin('categories','categories.categories_id','=','itemsto_categories.categories_id')
        ->leftjoin('categories_description','categories_description.categories_id','=','itemsto_categories.categories_id')
         ->where('menuitems.item_status',1)
         ->where('itemsto_categories.categories_id',$id)
         ->select('menuitems.*','categories.categories_id','categories_description.categories_name')
         ->get();

        $tot_item= count($menuitems);

        $categories= DB::table('categories')
        ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
        ->where('categories.categories_status',1)
        ->where('categories.parent_id',10)
        ->get();

        if($tot_item==0)
        {
            //dd($categories);
            return view('web.drinks.empty',compact('categories'));
        }
        
        return view('web.drinks.menulist',compact('menuitems','tot_item'));
    }

    public function menudetailsbk($id,$slug)
    {
       $id= $id;
       $slug= $slug;
       $menuitemsindividual= DB::table('menuitems')
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
                     ->where('menuitems.item_slug',$slug)
                     ->select('menuitems.*','categories.categories_id','categories_description.categories_name','categoryTable.path as imgpath')
                     ->get();
         
        //dd($slug);
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
                     ->where('menuitems.item_slug','!=',$slug)
                     ->where('itemsto_categories.categories_id',$id)
                     ->select('menuitems.*','categories.categories_id','categories_description.categories_name','categoryTable.path as imgpath')
                     ->get();
        //dd($menuitems);
        $tot_item= count($menuitems);
       // dd($tot_item);
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
                    ->where('categories.categories_status',1)
                    ->where('categories.parent_id',10)
                    ->get();

        return view('web.drinks.menudetails',compact('menuitemsindividual','menuitems','tot_item','categories'));

    }

    public function menudetails($id)
    {
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
        //dd($menuitems);
        $tot_item= count($menuitems);
       // dd($tot_item);
        $categories= DB::table('categories')
                    ->leftjoin('categories_description','categories.categories_id','=','categories_description.categories_id')
                    ->where('categories.categories_status',1)
                    ->where('categories.parent_id',10)
                    ->get();

        return view('web.drinks.menudetails',compact('menuitems','tot_item','categories'));

    }
}
