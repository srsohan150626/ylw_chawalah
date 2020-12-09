<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Categories;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Menuitems extends Model
{
    use Sortable;
    public $sortable =['item_id','updated_at'];
    public $sortableAs =['categories_name','item_name'];


    public function insert($request){

        $date_added	= date('Y-m-d h:i:s');
    
        if($request->image_id !== null){
          $uploadImage = $request->image_id;
        }else{
            $uploadImage = '';
        }

        $item_id = DB::table('menuitems')->insertGetId([
            'item_image' => $uploadImage,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_date_added' => $date_added,
            'item_status' => $request->item_status,
            'item_slug' => 0,
            'is_new' => $request->is_new,
            'item_description' => $request->item_description,
            'item_type' => 0,
        ]);
    
        $slug_flag = false;

            //slug
        if($slug_flag==false){
            $slug_flag=true;
            $slug = $request->item_name;
            $old_slug = $request->item_name;
            $slug_count = 0;
            do{
                if($slug_count==0){
                    $currentSlug = $this->slugify($slug);
                }else{
                    $currentSlug = $this->slugify($old_slug.'-'.$slug_count);
                }
                $slug = $currentSlug;
                $checkSlug = DB::table('menuitems')->where('item_slug', $currentSlug)->get();
                $slug_count++;
            }
            while(count($checkSlug)>0);
            DB::table('menuitems')
                ->where('item_id', $item_id)
                ->update([
                'item_slug' => $slug
            ]);
        }
        //special product
        if($request->isSpecial == 'yes'){
          DB::table('specials')
          ->where('products_id', '=', $products_id)
          ->update([
              'specials_last_modified' => $date_added,
              'date_status_change' => $date_added,
              'status' => 0,
          ]);
          DB::table('specials')
          ->insert([
              'products_id' => $products_id,
              'specials_new_products_price' => $request->specials_new_products_price,
              'specials_date_added' => time(),
              'expires_date' => $expiryDateFormate,
              'status' => $request->status,
          ]);
    
        }

        DB::table('itemsto_categories')
            ->insert([
              'item_id' => $item_id,
              'categories_id' => $request->categories_id
          ]);
    
          return $item_id;
    
}

public function additemaddons($request){
    $item_id      =   $request->id;

    $options = DB::table('extraoptions')->get();
    $result['options'] = $options;
    $result['data'] = array('item$item_id'=>$item_id);

    $item_addons = DB::table('items_addons')
        ->join('extraoptions', 'extraoptions.extra_options_id', '=', 'items_addons.extra_options_id')
        ->select('items_addons.*', 'extraoptions.*')
        ->where('items_addons.item_id', '=', $item_id)
        ->orderBy('items_addons_id', 'DESC')
        ->get();
    $result['item_addons'] = $item_addons;

    return $result;
  }

  public function addnewitemaddons($request){

    $item_addons = '';
    $item_id= $request->item_id;
    if(!empty($request->extra_options_id) and !empty($request->item_id) and !empty($request->extra_options_price)){
      $checkRecord = DB::table('items_addons')->where([
          'extra_options_id' => $request->extra_options_id,
          'item_id' => $request->item_id
      ])->get();
        if(count($checkRecord)>0){
            $products_attributes = 'already';
        }else{

          $item_addons_id = DB::table('items_addons')->insertGetId([
              'item_id' => $request->item_id,
              'extra_options_id' => $request->extra_options_id,
              'extra_options_price' => $request->extra_options_price
          ]);

        $item_addons = DB::table('items_addons')
        ->join('extraoptions', 'extraoptions.extra_options_id', '=', 'items_addons.extra_options_id')
        ->select('items_addons.*', 'extraoptions.*')
        ->where('items_addons.item_id', '=', $item_id)
        ->orderBy('items_addons_id', 'DESC')
        ->get();

        }
    }else{
        $item_addons = 'empty';
    }

    return $item_addons;
  }

public function edit($request){

    $item_id      =   $request->id;
    $result = array();

    $item = DB::table('menuitems')
        ->LeftJoin('image_categories', function ($join) {
            $join->on('image_categories.image_id', '=', 'menuitems.item_image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });

        })
        ->where('menuitems.item_id', '=', $item_id)
        ->get();
    $result['item'] = $item;

    $itemsto_categories = DB::table('itemsto_categories')
        ->leftJoin('categories', 'categories.categories_id', '=', 'itemsto_categories.categories_id')
        ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
        ->where('item_id', '=', $item_id)
        ->where('categories_status', '1')
        ->get();

    $result['itemsto_categories'] = $itemsto_categories;

    return $result;
  }

  public function updaterecord($request)
  {
    $item_id      =   $request->id;
    $item_last_modified	= date('Y-m-d h:i:s');
    
    if($request->image_id !== null){
        $uploadImage = $request->image_id;
    }else{
        $uploadImage = $request->oldImage;
    }

     DB::table('menuitems')->where('item_id',$item_id)->update([
        'item_image' => $uploadImage,
        'item_name' => $request->item_name,
        'item_price' => $request->item_price,
        'item_last_modified' => $item_last_modified,
        'item_status' => $request->item_status,
        'is_new' => $request->is_new,
        'item_description' => $request->item_description
    ]);

     //delete categories
     DB::table('itemsto_categories')->where([
        'item_id' => $item_id,
    ])->delete();
    
    DB::table('itemsto_categories')->insert([
          'item_id' => $item_id,
          'categories_id' => $request->categories_id
      ]);

   

      return $item_id;


  }
 // slugify method
 public function slugify($slug)
 {

     // replace non letter or digits by -
     $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);

     // transliterate
     if (function_exists('iconv')) {
         $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
     }

     // remove unwanted characters
     $slug = preg_replace('~[^-\w]+~', '', $slug);

     // trim
     $slug = trim($slug, '-');

     // remove duplicate -
     $slug = preg_replace('~-+~', '-', $slug);

     // lowercase
     $slug = strtolower($slug);

     if (empty($slug)) {
         return 'n-a';
     }

     return $slug;
 }
}