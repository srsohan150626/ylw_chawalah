<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Core\Extraoptions;
use App\Models\Core\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;

class ExtrasController extends Controller
{
    public function __construct(Extraoptions $extraoptions, Setting $setting)
    {
        $this->Extraoptions = $extraoptions;
        $this->Setting = $setting;
    }

    public function display()
    {
        $extraoptions = $this->Extraoptions->paginator();
       // dd($extraoptions);
        return view("admin.extraoptions.index",compact('extraoptions'));
    }
    public function filter(Request $request){
        $extraoptions = $this->Extraoptions->filter($request);
        return view("admin.extraoptions.index")->with(['extraoptions'=> $extraoptions, 'name'=> $request->FilterBy, 'param'=> $request->parameter]);
      }
    
      public function add(Request $request){
        $images = new Images;
        $allimage = $images->getimages();
        return view("admin.extraoptions.add")->with('allimage', $allimage);
      }
    
      public function insert(Request $request){
    
            $result = array();
    
            $optionName = $request->optionName;
            $uploadImage = $request->image_id;
            $option_status  = $request->option_status;
    
            $options_id = $this->Extraoptions->insert($uploadImage,$option_status,$optionName);
   
            $message = "Extra Option Added Successfully..";
            return redirect()->back()->withErrors([$message]);
      }
    
      public function edit(Request $request){
        $images = new Images;
        $allimage = $images->getimages();
    
        $result = array();
        $result['message'] = array();
    
        $editextraoption = $this->Extraoptions->editextraoption($request);
    
        $result['editextraoption'] = $editextraoption;
    
        return view("admin.extraoptions.edit")->with('result', $result)->with('allimage', $allimage);
       }
    
       public function update(Request $request){

         $optionName = $request->optionName;
         $extra_options_id = $request->id;
         $option_status  = $request->option_status;
    
         if($request->image_id!==null){
             $uploadImage = $request->image_id;
         }else{
             $uploadImage = $request->oldImage;
         }
    
         $updateCategory = $this->Extraoptions->updaterecord($extra_options_id,$uploadImage,$optionName,$option_status);
    
         $message = "Option has been updated successfully.";
         return redirect()->back()->withErrors([$message]);
        }
    
        public function delete(Request $request){
          //dd($request->all());
          $deletecategory = $this->Extraoptions->deleterecord($request);
          $message = "Option Deleted Successfully..";
          return redirect()->back()->withErrors([$message]);
        }
}
