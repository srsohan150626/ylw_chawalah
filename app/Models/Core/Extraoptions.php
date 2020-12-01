<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Extraoptions extends Model
{
    use Sortable;
    public function images(){
        return $this->belongsTo('App\Images');
    }

    public $sortable =['extra_options_id','created_at'];
    public $sortableAs =['extra_options_name'];

    public function paginator(){

        $extraoptions = Extraoptions::sortable(['extra_options_id'=>'ASC'])
             ->LeftJoin('image_categories as categoryTable', function ($join) {
                  $join->on('categoryTable.image_id', '=', 'extraoptions.extra_options_image')
                      ->where(function ($query) {
                          $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                              ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                      });
              })
              ->select('extraoptions.*','categoryTable.path as imgpath')
              ->paginate(50);
              //->paginate($commonsetting['pagination']);
  
              return ($extraoptions);
      }

    public function insert($uploadImage,$extra_options_status,$optionName){
        $extraoptions = DB::table('extraoptions')->insertGetId([
            'extra_options_name' => $optionName,
            'extra_options_image'   =>   $uploadImage,
            'extra_options_status' => $extra_options_status
        ]);
        return $extraoptions;
    }

    public function editextraoption($request){
        $editextraoption = DB::table('extraoptions')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'extraoptions.extra_options_image')
            ->select('extraoptions.*','categoryTable.path as imgpath')
            ->where('extraoptions.extra_options_id', $request->id)->get();
        return $editextraoption;
    }
    
    public function updaterecord($extra_options_id,$uploadImage,$optionName,$option_status){
        DB::table('extraoptions')->where('extra_options_id', $extra_options_id)->update(
        [
            'extra_options_name' => $optionName,
            'extra_options_image'   =>   $uploadImage,
            'extra_options_status'=>$option_status
        ]);
  
      }

    public function deleterecord($request){
        $option_id = $request->id;  
        DB::table('extraoptions')->where('extra_options_id', $option_id)->delete();
        return "success";
    }

    public function filter($data){
        $name = $data['FilterBy'];
        $param = $data['parameter'];

        $extraoptions = Extraoptions::sortable(['extra_options_id'=>'ASC'])
        ->leftJoin('images','images.id', '=', 'extraoptions.extra_options_image')
        ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'extraoptions.extra_options_image')
        ->select('extraoptions.*','categoryTable.path as imgpath')
        ->where(function($query) {
            $query->where('categoryTable.image_type', '=',  'THUMBNAIL')
                ->where('categoryTable.image_type','!=',   'THUMBNAIL')
                ->orWhere('categoryTable.image_type','=',   'ACTUAL');
        })
        ->where('extraoptions.extra_options_name', 'LIKE', '%' . $param . '%')
        ->paginate(10);

          return $extraoptions;
      }
}
