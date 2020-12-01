<?php
namespace App\Http\Controllers\AdminControllers;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use Validator;
use Hash;
use Auth;
use File;

class AdminController extends Controller
{

	public function dashboard(Request $request){

		return view("admin.dashboard");
	}


	public function login(){

		if (Auth::check()) {
		  return redirect('/admin/dashboard');
		}else{
			$title = array('pageTitle' => Lang::get("labels.login_page_name"));
			return view("admin.login",$title);
		}
	}

	//login function
  public function checkLogin(Request $request){
		$validator = Validator::make(
			array(
					'email'    => $request->email,
					'password' => $request->password
				),
			array(
					'email'    => 'required | email',
					'password' => 'required',
				)
		);
		//check validation
		if($validator->fails()){
			return redirect('admin/login')->withErrors($validator)->withInput();
		}else{
			//check authentication of email and password
			$adminInfo = array("email" => $request->email, "password" => $request->password);

			if(auth()->attempt($adminInfo)) {
				$admin = auth()->user();
				$administrators = DB::table('users')->where('id', $admin->myid)->get();

				$categories_id = '';
				//admin category role
				if(auth()->user()->adminType != '1'){
					$categories_role = DB::table('categories_role')->where('admin_id', auth()->user()->myid)->get();
					if(!empty($categories_role) and count($categories_role)>0){
						$categories_id = $categories_role[0]->categories_ids;
					}else{
						$categories_id = '';
					}
				}

				session(['categories_id' => $categories_id]);
				return redirect()->intended('admin/dashboard')->with('administrators', $administrators);
			}else{
				return redirect('admin/login')->with('loginError',Lang::get("labels.EmailPasswordIncorrectText"));
			}

		}

	}

	//logout
	public function logout(){
		Auth::logout();
		return redirect('/admin/login');
	}

	
	


}
