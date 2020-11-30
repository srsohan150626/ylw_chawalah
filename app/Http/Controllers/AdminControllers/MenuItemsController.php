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
        $result= array();
        $categories_id = $request->categories_id;
        $item = $request->item;

        $categories = Categories::all();
        $menuitems = $this->item->paginator($request);
        $results['menuitems'] = $menuitems;
        $results['categories'] = $categories;
       // dd($results['menuitems']);
        return view("admin.menuitems.index")->with('results', $results)->with('categories_id', $categories_id)->with('item', $item);
    }

    public function add()
    {
        $allimage = $this->images->getimages();
        $result = array();
        $categories = Categories::all();
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
        if ($request->item_type == 1) {
            return redirect('/admin/menuitems/attach/addons/display/' . $item_id);
        } else {  
            $message="Menuitem added successfully..";
            return redirect()->back()->withErrors([$message]);
        }
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
        //dd($request->id);
        $allimage = $this->images->getimages();
        $result = array();
        $categories = Categories::all();
        $extras= Extraoptions::all();
        $result = $this->item->edit($request);
        dd($result['addons']);
        $result['categories'] = $categories;
        $result['extras'] = $extras;

        return view("admin.menuitems.edit")->with('result', $result)->with('allimage', $allimage)->with('item', $item);

    }
}
