<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Categories;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;

class CategoriesController extends Controller
{
  public function __construct(Categories $categories, Setting $setting)
  {
      $this->Categories = $categories;
      $this->Setting = $setting;
  }

  public function display(){
    $categories = $this->Categories->paginator();
    //dd($categories->toArray());
    return view("admin.categories.index",compact('categories'));
  }

  public function filter(Request $request){
    $title = array('pageTitle' => Lang::get("labels.SubCategories"));
    $categories = $this->Categories->filter($request);
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.categories.index", $title)->with('result', $result)->with(['categories'=> $categories, 'name'=> $request->FilterBy, 'param'=> $request->parameter]);
  }

  public function add(Request $request){
    $images = new Images;
    $allimage = $images->getimages();
    $categories = $this->Categories->paginator();
    //dd($categories);
    return view("admin.categories.add")->with('allimage', $allimage)->with('categories', $categories);
  }

  public function insert(Request $request){

        $date_added	= date('y-m-d h:i:s');
        $result = array();

        $categoryName = $request->categoryName;
        $uploadImage = $request->image_id;
        $categories_status  = $request->categories_status;
        $parent_id = $request->parent_id;

        $categories_id = $this->Categories->insert($uploadImage,$date_added,$categories_status,$parent_id);
        $slug_flag = false;

        //slug
        if($slug_flag==false){
            $slug_flag=true;
            $slug = $request->categoryName;
            $old_slug = $request->categoryName;
            $slug_count = 0;
            do{
                if($slug_count==0){
                    $currentSlug = $this->Categories->slugify($old_slug);
                }else{
                    $currentSlug = $this->Categories->slugify($old_slug.'-'.$slug_count);
                }
                $slug = $currentSlug;
                $checkSlug = $this->Categories->checkSlug($currentSlug);
                $slug_count++;
            }
              while(count($checkSlug)>0);
              $updateSlug = $this->Categories->updateSlug($categories_id,$slug);
        }

        $categoryNameSub = $categoryName;
        $subcatoger_des = $this->Categories->insertcategorydescription($categoryNameSub,$categories_id);
        
        $categories =  $this->Categories->subcategorydes();
        $result['categories'] = $categories;
        $message = Lang::get("labels.AddCategoryMessage");
        return redirect()->back()->withErrors([$message]);
  }

  public function edit(Request $request){
    $images = new Images;
    $allimage = $images->getimages();

    $result = array();
    $result['message'] = array();

    $editSubCategory = $this->Categories->editsubcategory($request);
    $categories = $this->Categories->paginator();
    $description_data = array();
    
    $id = $request->id;
    $description = $this->Categories->editdescription($id);
    if(count($description)>0){
        $description_data[1]['name'] = $description[0]->categories_name;
    }else{
        $description_data[1]['name'] = '';
    }
    
    $result['description'] = $description_data;
    $result['editSubCategory'] = $editSubCategory;
    //dd($result['editSubCategory']);
    $result['categories'] = $categories;

    return view("admin.categories.edit")->with('result', $result)->with('allimage', $allimage);
   }

   public function update(Request $request){

     $result = array();
     $result['message'] = Lang::get("labels.Category has been updated successfully");
     $last_modified 	=   date('y-m-d h:i:s');
     $categories_id = $request->id;
     $categories_status  = $request->categories_status;
     $parent_id = $request->parent_id;

     //check slug
     if($request->old_slug!=$request->slug){
         $slug = $request->slug;
         $slug_count = 0;
         do{
             if($slug_count==0){
                 $currentSlug = $this->Categories->slugify($request->slug);
             }else{
                 $currentSlug = $this->Categories->slugify($request->slug.'-'.$slug_count);
             }
             $slug = $currentSlug;
             $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->where('categories_id','!=',$request->id)->get();
             $slug_count++;
         }
         while(count($checkSlug)>0);
     }else{
         $slug = $request->slug;
     }
     if($request->image_id!==null){
         $uploadImage = $request->image_id;
     }else{
         $uploadImage = $request->oldImage;
     }

     $updateCategory = $this->Categories->updaterecord($categories_id,$uploadImage,$last_modified,$slug,$categories_status,$parent_id);

       $checkExist = $this->Categories->checkExit($categories_id);
         $categories_name = $request->category_name;
         if(count($checkExist)>0){
           $category_des_update = $this->Categories->updatedescription($categories_name,$categories_id);
       }else{
           $updat_des = $this->Categories->insertcategorydescription($categories_name,$categories_id);
       }
     

     $message = Lang::get("labels.CategorieUpdateMessage");
     return redirect()->back()->withErrors([$message]);
    }

    public function delete(Request $request){
     // dd($request->all());
      $deletecategory = $this->Categories->deleterecord($request);
      $message = Lang::get("labels.CategoriesDeleteMessage");
      return redirect()->back()->withErrors([$message]);
    }
}
