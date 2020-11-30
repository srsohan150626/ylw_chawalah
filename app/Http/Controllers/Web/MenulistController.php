<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Menuitems;
use App\Models\Core\Extraoptions;
use App\Models\Core\Setting;
use Illuminate\Support\Facades\DB;
use Validator;

class MenulistController extends Controller
{
    public function menulist(Request $request)
    {
        $categories= DB::table('categories')
                     ->leftjoin('categories_description','categories_description.categories_id','=','categories.categories_id')
                     ->LeftJoin('image_categories as categoryTable', function ($join) {
                        $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                            ->where(function ($query) {
                                $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                    ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                            });
                     })
                     ->where('categories.categories_status',1)
                     ->select('categories.*','categories_description.categories_name','categoryTable.path as imgpath')
                     ->get();

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
                     ->orderby('itemsto_categories.categories_id','ASC')
                     ->select('menuitems.*','categories.categories_id','categories_description.categories_name','categoryTable.path as imgpath')
                     ->get();

       //dd($menuitems);
        return view('web.menuitems',compact('categories','menuitems'));
    }
    public function itemDetail(Request $request)
    {
        $item_slug= $request->slug;
        $menuitems= DB::table('menuitems')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                        $join->on('categoryTable.image_id', '=', 'menuitems.item_image')
                            ->where(function ($query) {
                                $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                    ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                    ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                            });
                     })
                     ->where('menuitems.item_slug',$item_slug)
                     ->select('menuitems.*','categoryTable.path as imgpath')
                     ->get();
        $item_id = $menuitems[0]->item_id;
        $extras= DB::table('items_addons')
                 ->leftJoin('extraoptions','extraoptions.extra_options_id','=','items_addons.extra_options_id')
                 ->where('items_addons.item_id',$item_id)
                 ->select('items_addons.*','extraoptions.*')
                 ->get();
       //dd($extras);
       return view('web.itemsdetails',compact('menuitems','extras'));
    }
}
