<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Categories extends Model
{
    //
    use Sortable;
    public function images(){
        return $this->belongsTo('App\Images');
    }

    public function categories_description(){
        return $this->beliesngsTo('App\Categories_description');
    }

    public $sortable =['categories_id','created_at'];
    public $sortableAs =['categories_name'];


    public function paginator(){

      $categories = Categories::sortable(['categories_id'=>'ASC'])
           ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
           ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('categories.categories_id as id', 'categories.categories_image as image','categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name','categoryTable.path as imgpath','categories.categories_status  as categories_status')
            ->paginate(50);
            //->paginate($commonsetting['pagination']);

            return ($categories);
    }

    public function getter($language_id){
      $listingCategories = DB::table('categories')
          ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
          ->select('categories.categories_id as id', 'categories.categories_image as image',  'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug'
          , 'categories.parent_id')
          ->where('categories_description.language_id','=', $language_id )
          ->where('parent_id','>', '0')
          ->where('categories_status', '1')
          ->get();

       return $listingCategories;
    }


    public function allcategories($language_id){
        $listingCategories = DB::table('categories')
            ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image',  'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug')
            ->where('categories_description.language_id','=', $language_id )
            ->where('categories_status', '1')
            ->get();
  
         return $listingCategories;
      }

    public function filter($data){
      $name = $data['FilterBy'];
      $param = $data['parameter'];
      $categories = Categories::sortable(['categories_id'=>'ASC'])
      ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
          ->leftJoin('images','images.id', '=', 'categories.categories_image')
          ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'categories.categories_image')
          ->select('categories.categories_id as id', 'categories.categories_image as image',
           'categories.created_at as date_added','categories.updated_at as last_modified', 'categories_description.categories_name as name','categoryTable.path as imgpath','categories.categories_status  as categories_status')
          ->where(function($query) {
              $query->where('categoryTable.image_type', '=',  'THUMBNAIL')
                  ->where('categoryTable.image_type','!=',   'THUMBNAIL')
                  ->orWhere('categoryTable.image_type','=',   'ACTUAL');
          })
          ->where('categories_description.categories_name', 'LIKE', '%' . $param . '%')
          ->paginate(10);

        return $categories;
    }

    public function insert($uploadImage,$date_added,$categories_status){
        $categories = DB::table('categories')->insertGetId([
            'categories_image'   =>   $uploadImage,
            'created_at'		 =>   $date_added,
            'categories_slug'    =>   'Null',
            'categories_status' => $categories_status
        ]);
        return $categories;
    }

    public function insertcategorydescription($categoryNameSub,$categories_id){
        DB::table('categories_description')->insert([
            'categories_name'   =>   $categoryNameSub,
            'categories_id'     =>   $categories_id,
        ]);
    }

    public function checkSulg($currentSlug){
        $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->get();
        return $checkSlug;
    }

    public function edit($request){
        $category = DB::table('categories') ->leftJoin('images','images.id', '=', 'categories.categories_image')
            ->leftJoin('image_categories as ImageTable','ImageTable.image_id', '=', 'categories.categories_image')
            ->leftJoin('image_categories as IconTable','IconTable.image_id', '=', 'categories.categories_icon')
            ->select('categories.categories_id as id', 'categories.categories_image as image',
            'categories.categories_icon as icon',  'categories.created_at as date_added',
            'categories.updated_at as last_modified', 'categories.categories_slug as slug',
            'ImageTable.path as imagepath','IconTable.path as iconpath')
            ->where('categories.categories_id', $request->id)->get();
        return $category;
    }

    public function updaterecord($categories_id,$uploadImage,$last_modified,$slug,$categories_status){
        DB::table('categories')->where('categories_id', $categories_id)->update(
        [
            'categories_image'   =>   $uploadImage,
            'updated_at'  	     =>   $last_modified,
            'categories_slug'    =>   $slug,
            'categories_status'=>$categories_status
        ]);
  
      }
  

    public function checkExit($categories_id){
        $checkExist = DB::table('categories_description')->where('categories_id','=',$categories_id)->get();
        return $checkExist;
    }

    public function updatedescription($categories_name,$categories_id){
       $category =  DB::table('categories_description')->where('categories_id','=',$categories_id)->update([
            'categories_name' =>  $categories_name,
        ]);
       return $category;
    }


    public function checkSlug($currentSlug){
        $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->get();
        return $checkSlug;
    }

    public function updateSlug($categories_id,$slug){
       $updateSlug = DB::table('categories')->where('categories_id',$categories_id)->update([
            'categories_slug'	 =>   $slug
        ]);
       return $updateSlug;
    }

    public function subcategorydes(){
        $categories = DB::table('categories')
            ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as mainId', 'categories_description.categories_name as mainName')
            ->get();
        return $categories;
    }

    public function editsubcategory($request){
        $editSubCategory = DB::table('categories')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'categories.categories_image')
            ->select('categories.categories_id as id', 'categories.categories_image as image','categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories.categories_slug as slug', 'categories.categories_status  as categories_status','categoryTable.path as imgpath')
            ->where('categories.categories_id', $request->id)->get();
        return $editSubCategory;
    }

    public function editdescription($id){
        $description = DB::table('categories_description')->where([
            ['categories_id', '=', $id]
        ])->get();
        return $description;
    }

    public function deleterecord($request){
        $category_id = $request->id;

        //check if this is parent id 
       // $category = DB::table('categories')->where('categories_id', $category_id)->first();   

        DB::table('categories')->where('categories_id', $category_id)->delete();
        DB::table('categories_description')->where('categories_id', $category_id)->delete();

        /* check product is associated categories if 
         * this product is associated only with this category 
         * then assign it to uncategorized.
         */ 

        // $categories = DB::table('products_to_categories')->where('categories_id', $category_id)->groupby('products_id')->get();

        // if(!empty($categories) and count($categories)>0){

        //     foreach($categories as $category){

        //         //check count of products
        //         $products = DB::table('products_to_categories')->where('products_id', $category->products_id)->count();
        //         if($products == 1){
        //             DB::table('products_to_categories')->insert([
        //                 'products_id' => $category->products_id,
        //                 'categories_id' => -1
        //             ]);
        //         }

        //     }

        //    DB::table('products_to_categories')->where('categories_id', $category_id)->delete();
        // }
        return "success";
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
