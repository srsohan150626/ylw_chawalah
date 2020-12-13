<?php

namespace App\Http\Controllers\AdminControllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeTextController extends Controller
{
    public function display()
    {
        $hometexts= DB::table('hometexts')  
                    ->orderby('id','DESC')
                    ->paginate(30);
                    
       // dd($extraoptions);
        return view("admin.hometext.index",compact('hometexts'));
    }

      public function add(Request $request){
        return view("admin.hometext.add");
      }
    
      public function insert(Request $request){
      //  dd($request->all());
        $request->validate([
            'upper_text' => 'required',
            'lower_text' => 'required',
            'status' => 'required',
        ]);
    
            $upper_text = $request->upper_text;
            $lower_text = $request->lower_text;
            $status = $request->status;
            //dd($status);
            DB::table('hometexts')->insertGetId([
                'upper_text' => $upper_text,
                'lower_text'   =>   $lower_text,
                'status' => $status
            ]);
   
            $message = "HomeText Added Successfully..";
            return redirect()->back()->withErrors([$message]);
      }
    
      public function edit(Request $request){
    
        $hometext = DB::table('hometexts')
                            ->where('hometexts.id', $request->id)
                            ->get();

        return view("admin.hometext.edit",compact('hometext'));
       }
    
       public function update(Request $request){
       // dd($request->all());
          $request->validate([
            'upper_text' => 'required',
            'lower_text' => 'required',
            'status' => 'required',
        ]);
    
        $upper_text = $request->upper_text;
        $lower_text = $request->lower_text;
        $status = $request->status;
        
        if($status==1)
        {
            DB::table('hometexts')->where('status',1)->update(
                [
                    'status'=>0
                ]);
        }
        DB::table('hometexts')->where('id', $request->id)->update(
            [
                'upper_text' => $upper_text,
                'lower_text'   =>   $lower_text,
                'status'=>$status
            ]);
    
         $message = "HomeText has been updated successfully.";
         return redirect()->back()->withErrors([$message]);
        }
    
        public function delete(Request $request){
          //dd($request->all());
        $hometext_id = $request->id;  
        DB::table('hometexts')->where('id', $hometext_id)->delete();
      
        $message = "Hometext Deleted Successfully..";
        return redirect()->back()->withErrors([$message]);

        }
}
