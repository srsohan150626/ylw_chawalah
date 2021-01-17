<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;

class BackgroundImageController extends Controller
{
    public function display()
    {
        $background_images= DB::table('background_image')
                            ->orderBy('id','DESC')
                            ->get();
        //dd(count($background_images));
        return view("admin.bg_image.index",compact('background_images'));
    }

    public function add()
    {
        return view("admin.bg_image.add");
    }

    public function insert(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'status' => 'required',
        ]);

        if($request->hasFile('image')) {
            $imageName = time().'-'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            //$item_image = $imageName;
        } else{
            $imageName= "";
        }
        
        $item_id= DB::table('background_image')->insertGetId([
            'bg_image' => $imageName,
            'status' => $request->status
        ]);

        if($request->status==1)
        {
            DB::table('background_image')->where('id','!=',$item_id)->where('status',1)->update(
                [
                    'status'=>0
                ]);
        }

        $message="Background Image added successfully..";
        return redirect()->back()->withErrors([$message]);
    }

    public function edit(Request $request){
    
        $background_image = DB::table('background_image')
                            ->where('id', $request->id)
                            ->get();
       // dd($background_image);
        return view("admin.bg_image.edit",compact('background_image'));
    }

    public function update(Request $request)
    {
        $item_id      =   $request->id;
        
        if($request->hasFile('image')) {
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $imageName = time().'-'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
    
            //deleting old image
            $oldfile = public_path('images/').$request->oldImage;
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }
        } else{
            $imageName= $request->oldImage;
        }
        
        if($request->status==1)
        {
            DB::table('background_image')->where('status',1)->update(
                [
                    'status'=>0
                ]);
        }

        DB::table('background_image')->where('id',$item_id)->update([
            'bg_image' => $imageName,
            'status' => $request->status
        ]);

        $message="Background Image updated successfully..";
        return redirect()->back()->withErrors([$message]);
    }

    public function delete(Request $request){
        //dd($request->all());
      $bgimage_id = $request->id;  
      DB::table('background_image')->where('id', $bgimage_id)->delete();
    
      $message = "Background Image Deleted Successfully..";
      return redirect()->back()->withErrors([$message]);

      }
}
