<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Menuitems;
use App\Models\Core\Extraoptions;
use App\Models\Core\Setting;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Lang;

class MenuItemsController extends Controller
{
    public function __construct(Menuitems $item, Images $images, Categories $category, Setting $setting) {
        $this->category = $category;
        $this->images = $images;
        $this->item = $item;
        $this->Setting = $setting;

    }
    public function display(Request $request)
    {
        //dd($request->all());
       
        $result= array();
        $categories_id = $request->categories_id;
        $item = $request->item;

        $categories = Categories::all();
        $menuitems= DB::table('menuitems')
                    ->leftJoin('itemsto_categories', 'menuitems.item_id', '=', 'itemsto_categories.item_id')
                    ->leftJoin('categories', 'categories.categories_id', '=', 'itemsto_categories.categories_id')
                    ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
                    ->when($categories_id, function($q) use ($categories_id) {
                        return $q->where('itemsto_categories.categories_id', $categories_id);
                    })
                    ->when($item, function($q) use ($item) {
                        return $q->where('menuitems.item_name','like', '%'.$item. '%');
                    })
                    ->select('menuitems.*','categories_description.categories_id','categories_description.categories_name')
                    ->orderby('menuitems.item_id','DESC')
                    ->paginate(30);
        //dd($menuitems)  ;
        $tot_item= count($menuitems);
        //$menuitems = $this->item->paginator($request);
        $results['menuitems'] = $menuitems;
        $results['categories'] = $categories;
        $results['tot_item'] = $tot_item;
       // dd($results['tot_item']);
        return view("admin.menuitems.index")->with('results', $results)->with('categories_id', $categories_id)->with('item', $item);
    }

    public function add()
    {
        $allimage = $this->images->getimages();
        $result = array();
        $categories = Categories::sortable(['categories_id'=>'DESC'])
           ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
           ->where('categories.parent_id','!=',0)
            ->select('categories.categories_id as id', 'categories_description.categories_name as name')
            ->get();

        //$categories = Categories::all();
        $extras= Extraoptions::all();
        //dd($categories);
        $result['categories'] = $categories;
        $result['extras'] = $extras;

        return view("admin.menuitems.add")->with('result', $result)->with('allimage', $allimage);

    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $item_id = $this->item->insert($request);
        $message="Menuitem added successfully..";
        return redirect()->back()->withErrors([$message]);
        // if ($request->item_type == 1) {
        //     return redirect('/admin/menuitems/attach/addons/display/' . $item_id);
        // } else {  
        //     $message="Menuitem added successfully..";
        //     return redirect()->back()->withErrors([$message]);
        // }
    }

    public function additemaddons(Request $request)
    {
        //dd($request->id);
        $result = $this->item->additemaddons($request);
        //dd($result);
        return view("admin.menuitems.addons.add")->with('result', $result);
    }

    public function addnewitemaddons(Request $request)
    {
        //dd($request->all());
        $item_addons = $this->item->addnewitemaddons($request);
        return ($item_addons);
    }

    public function edit(Request $request)
    {
        $result = array();
        $categories = Categories::sortable(['categories_id'=>'DESC'])
           ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
           ->where('categories.parent_id','!=',0)
            ->select('categories.categories_id as id', 'categories_description.categories_name as name')
            ->get();
        //$extras= Extraoptions::all();
        $result = $this->item->edit($request);
       // dd($result);
        $result['categories'] = $categories;
        //$result['extras'] = $extras;
        //dd($result['categories']);
        return view("admin.menuitems.edit")->with('result', $result);

    }

    public function update(Request $request)
    {
        //dd($request->all());
        $result = $this->item->updaterecord($request);
       // dd($result);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeenupdatedMessage")]);
        // $products_id = $request->id;
        // if ($request->products_type == 1) {
        //     return redirect('admin/products/attach/attribute/display/' . $products_id);
        // } else {
        //     return redirect('admin/products/images/display/' . $products_id);
        // }
    }

    public function delete(Request $request)
    {
        //dd($request->all());
        $item_id = $request->products_id;
        $categories = DB::table('itemsto_categories')->where('item_id', $item_id)->delete();
        $categories = DB::table('menuitems')->where('item_id', $item_id)->delete();
        $categories = DB::table('items_addons')->where('item_id', $item_id)->delete();
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);
    }
}
