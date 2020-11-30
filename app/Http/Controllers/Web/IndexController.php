<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Index;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Lang;
use View;
use DB;
use Cookie;
class IndexController extends Controller
{
    public function index()
    {
        return view('web.index');
    }
    //setcookie
    public function setcookie(Request $request)
    {
        Cookie::queue('cookies_data', 1, 4000);
        return json_encode(array('accept'=>'yes'));
    }
    //setsession
    public function setSession(Request $request){
        session(['device_id'=>$request->device_id]);
        
    }
    

}
