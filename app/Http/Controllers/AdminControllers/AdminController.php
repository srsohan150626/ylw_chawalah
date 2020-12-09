<?php
namespace App\Http\Controllers\AdminControllers;
use App\Models\Admin\Admin;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Menuitems;
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
	public function __construct(Admin $admin)
    {
        $this->Admin = $admin;
    }

	public function dashboard(Request $request){
		$total_category= Categories::all();
		$total_items= Menuitems::all();
		//dd($total_category);
		return view("admin.dashboard",compact('total_category','total_items'));
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

	public function profile(Request $request){

        $result = array();
        $images = new Images;
        $allimage = $images->getimages();
        $result['admin'] = $this->Admin->edit(auth()->user()->id);
        return view("admin.admin.profile")->with('result', $result)->with('allimage', $allimage);
    }

    public function update(Request $request){
     $validator = Validator::make(
        array(
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'address' => $request->address,
          'phone' => $request->phone,
          'city' => $request->city,
          'country' => "Bangladesh",
          'zip' => $request->zip
          ),
        array(
          'first_name' => 'required',
          'last_name' => 'required',
          'address' => 'required',
          'phone' => 'required',
          'city' => 'required',
          'zip' => 'required'
          )
      );
      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
      }

       $update = $this->Admin->updaterecord($request);
        $message = Lang::get("labels.ProfileUpdateMessage");
       return redirect()->back()->with(['success' => $message]);
     }

     public function updatepassword(Request $request){
        $update = $this->Admin->updatepassword($request);
        $message = Lang::get("labels.PasswordUpdateMessage");
        return redirect()->back()->withErrors([$message]);
      }

	//admins
	public function admins(Request $request){
		$result = array();

		$admins = DB::table('users')
			->leftJoin('user_types','user_types.user_types_id','=','users.role_id')
			->select('users.*','user_types.*')
			->where('users.role_id','>','10')
			->paginate(50);

		$result['admins'] = $admins;
		return view("admin.admins.index",compact('result'));

	}
	//add admins
	public function addadmins(Request $request){

		$adminTypes = DB::table('user_types')->where('isActive', 1)->where('user_types_id','>','10')->get();
		$result['adminTypes'] = $adminTypes;
		return view("admin.admins.add",compact('result'));

	}

	//addnewadmin
	public function addnewadmin(Request $request){

		$result = array();
		$message = array();
		$errorMessage = array();

		//check email already exists
		$existEmail = DB::table('users')->where('email', '=', $request->email)->get();
		if(count($existEmail)>0){
			$errorMessage = Lang::get("labels.Email address already exist");
			return redirect()->back()->with('errorMessage', $errorMessage);
		}else{

			$customers_id = DB::table('users')->insertGetId([
						'user_name'		 		    =>   $request->first_name.'_'.$request->last_name.time(),
						'first_name'		 		=>   $request->first_name,
						'last_name'			 		=>   $request->last_name,
						'phone'	 					=>	 $request->phone,
						'email'	 					=>   $request->email,
						'password'		 			=>   Hash::make($request->password),
						'status'		 	 		=>   $request->isActive,
						'role_id'					=>	 $request->adminType
						]);


			$message = Lang::get("labels.New admin has been added successfully");
			return redirect()->back()->with('message', $message);

		}
	}
	  //editadmin
	  public function editadmin(Request $request){
		$myid        	 =   $request->id;

		$result = array();
		$message = array();
		$errorMessage = array();

		$adminTypes = DB::table('user_types')->where('isActive', 1)->where('user_types_id','>','10')->get();

		$result['adminTypes'] = $adminTypes;

		$result['myid'] = $myid;

		$admins = DB::table('users')->where('id','=', $myid)->get();
		$result['admins'] = $admins;

		return view("admin.admins.edit")->with('result', $result);
	}
	  //update admin
	  public function updateadmin(Request $request){

		$myid = $request->myid;
		$result = array();
		$message = array();
		$errorMessage = array();

		//check email already exists
		$existEmail = DB::table('users')->where([['email','=',$request->email],['id','!=',$myid]])->get();
		if(count($existEmail)>0){
			$errorMessage = Lang::get("labels.Email address already exist");
			return redirect()->back()->with('errorMessage', $errorMessage);
		}else{

			$admin_data = array(
				'first_name'		 		=>   $request->first_name,
				'last_name'			 		=>   $request->last_name,
				'phone'	 					=>	 $request->phone,
				'email'	 					=>   $request->email,
				'status'		 	 		=>   $request->isActive,
				'role_id'	 				=>	 $request->adminType,
			);

			if($request->changePassword == 'yes'){
				$admin_data['password'] = Hash::make($request->password);
			}

			$customers_id = DB::table('users')->where('id', '=', $myid)->update($admin_data);

			$message = Lang::get("labels.Admin has been updated successfully");
			return redirect()->back()->with('message', $message);
		}

	}

	public function deleteadmin(Request $request){
		$myid = $request->myid;
		//dd($myid);
		DB::table('users')->where('id','=', $myid)->delete();
		return redirect()->back()->withErrors([Lang::get("labels.DeleteAdminMessage")]);

	}
	//manageroles
	public function manageroles(Request $request){

		$result = array();
		$message = array();
		$errorMessage = array();

		$adminTypes = DB::table('user_types')->where('user_types_id','>','10')->paginate(50);

		$result['message'] = $message;
		$result['errorMessage'] = $errorMessage;
		$result['adminTypes'] = $adminTypes;

		return view("admin.admins.roles.manageroles",compact('result'));

	}
	//add admins type
	public function addadmintype(Request $request){

		$result = array();
		$message = array();
		$errorMessage = array();

		$adminTypes = DB::table('user_types')->where('isActive', 1)->get();
		$result['adminTypes'] = $adminTypes;
		return view("admin.admins.roles.addadmintype")->with('result', $result);
	}

	//addnewtype
	public function addnewtype(Request $request){
		$result = array();
		$message = array();
		$errorMessage = array();
		$customers_id = DB::table('user_types')->insertGetId([
						'user_types_name'	 		=>   $request->user_types_name,
						'created_at'			 	=>   time(),
						'isActive'		 	 		=>   $request->isActive,
						]);
		$message = Lang::get("labels.Admin type has been added successfully");
		return redirect()->back()->with('message', $message);

	}

	//editadmintype
	public function editadmintype(Request $request){
		$user_types_id        	 =   $request->id;

		$result = array();

		$result['user_types_id'] = $user_types_id;

		$user_types = DB::table('user_types')->where('user_types_id','=', $user_types_id)->get();

		$result['user_types'] = $user_types;
		return view("admin.admins.roles.editadmintype")->with('result', $result);
	}

	//updatetype
	public function updatetype(Request $request){

		$result = array();
		$message = array();
		$errorMessage = array();

		$customers_id = DB::table('user_types')->where('user_types_id',$request->user_types_id)->update([
						'user_types_name'	 		=>   $request->user_types_name,
						'updated_at'			 	=>   time(),
						'isActive'		 	 		=>   $request->isActive,
						]);


		$message = Lang::get("labels.Admin type has been updated successfully");
		return redirect()->back()->with('message', $message);

	}


	//deleteProduct
	public function deleteadmintype(Request $request){
		$user_types_id = $request->user_types_id;
		DB::table('user_types')->where('user_types_id','=', $user_types_id)->delete();
		return redirect()->back()->withErrors([Lang::get("labels.DeleteAdminTypeMessage")]);

	}
	//managerole
	public function addrole(Request $request){

		$result = array();
		$user_types_id = $request->id;
		$result['user_types_id'] = $user_types_id;

		$adminType = DB::table('user_types')->where('user_types_id',$user_types_id)->get();
		$result['adminType'] = $adminType;

		$roles = DB::table('manage_role')->where('user_types_id','=', $user_types_id)->get();

		if(count($roles)>0){
			$dashboard_view = $roles[0]->dashboard_view;


			$categories_view   = $roles[0]->categories_view;
			$categories_create = $roles[0]->categories_create;
			$categories_update = $roles[0]->categories_update;
			$categories_delete = $roles[0]->categories_delete;

			$products_view = $roles[0]->products_view;
			$products_create = $roles[0]->products_create;
			$products_update = $roles[0]->products_update;
			$products_delete = $roles[0]->products_delete;

			$media_view   = $roles[0]->view_media;
			$media_create = $roles[0]->add_media;
			$media_update = $roles[0]->edit_media;
			$media_delete = $roles[0]->delete_media;

			$manage_admins_view   = $roles[0]->manage_admins_view;
			$manage_admins_create = $roles[0]->manage_admins_create;
			$manage_admins_update = $roles[0]->manage_admins_update;
			$manage_admins_delete = $roles[0]->manage_admins_delete;

			$profile_view = $roles[0]->profile_view;
			$profile_update = $roles[0]->profile_update;

			$admintype_view = $roles[0]->admintype_view;
			$admintype_create = $roles[0]->admintype_create;
			$admintype_update = $roles[0]->admintype_update;
			$admintype_delete = $roles[0]->language_delete;
			$manage_admins_role = $roles[0]->manage_admins_role;

		}else{
			$dashboard_view = '0';

			$categories_view = '0';
			$categories_create = '0';
			$categories_update = '0';
			$categories_delete = '0';

			$products_view   = '0';
			$products_create = '0';
			$products_update = '0';
			$products_delete = '0';

			$media_view   = '0';
			$media_create = '0';
			$media_update = '0';
			$media_delete = '0';

			$manage_admins_view = '0';
			$manage_admins_create = '0';
			$manage_admins_update = '0';
			$manage_admins_delete = '0';

			$profile_view = '0';
			$profile_update = '0';

			$admintype_view = '0';
			$admintype_create = '0';
			$admintype_update = '0';
			$admintype_delete = '0';
			$manage_admins_role = '0';
		}


		$result2[0]['link_name'] = 'dashboard';
		$result2[0]['permissions'] = array('0'=>array('name'=>'dashboard_view','value'=>$dashboard_view));

		$result2[2]['link_name'] = 'categories';
		$result2[2]['permissions'] = array(
					'0'=>array('name'=>'categories_view','value'=>$categories_view),
					'1'=>array('name'=>'categories_create','value'=>$categories_create),
					'2'=>array('name'=>'categories_update','value'=>$categories_update),
					'3'=>array('name'=>'categories_delete','value'=>$categories_delete)
					);

		$result2[3]['link_name'] = 'products';
		$result2[3]['permissions'] = array(
					'0'=>array('name'=>'products_view','value'=>$products_view),
					'1'=>array('name'=>'products_create','value'=>$products_create),
					'2'=>array('name'=>'products_update','value'=>$products_update),
					'3'=>array('name'=>'products_delete','value'=>$products_delete)
					);

		

		$result2[16]['link_name'] = 'manage_admins';
		$result2[16]['permissions'] = array(
					'0'=>array('name'=>'manage_admins_view','value'=>$manage_admins_view),
					'1'=>array('name'=>'manage_admins_create','value'=>$manage_admins_create),
					'2'=>array('name'=>'manage_admins_update','value'=>$manage_admins_update),
					'3'=>array('name'=>'manage_admins_delete','value'=>$manage_admins_delete)
					);

		

		$result2[18]['link_name'] = 'profile';
		$result2[18]['permissions'] = array(
					'0'=>array('name'=>'profile_view','value'=>$profile_view),
					'1'=>array('name'=>'profile_update','value'=>$profile_update)
					);


		$result2[19]['link_name'] = 'Admin Types';
		$result2[19]['permissions'] = array(
					'0'=>array('name'=>'admintype_view','value'=>$admintype_view),
					'1'=>array('name'=>'admintype_create','value'=>$admintype_create),
					'2'=>array('name'=>'admintype_update','value'=>$admintype_update),
					'3'=>array('name'=>'admintype_delete','value'=>$admintype_delete),
					'4'=>array('name'=>'manage_admins_role','value'=>$manage_admins_role)
					);

		$result2[20]['link_name'] = 'Media';
		$result2[20]['permissions'] = array(
					'0'=>array('name'=>'media_view','value'=>$media_view),
					'1'=>array('name'=>'media_create','value'=>$media_create),
					'2'=>array('name'=>'media_update','value'=>$media_update),
					'3'=>array('name'=>'media_delete','value'=>$media_delete),
					);

	

		$result['data'] = $result2;
		return view("admin.admins.roles.addrole")->with('result', $result);

	}
	//addnewroles
	public function addnewroles(Request $request){

		$user_types_id = $request->user_types_id;
		DB::table('manage_role')->where('user_types_id',$user_types_id)->delete();

		$roles = DB::table('manage_role')->where('user_types_id',$request->user_types_id)->insert([
						'user_types_id'			=>	 $request->user_types_id,
						'dashboard_view'=>$request->dashboard_view,

						'view_media' => $request->media_view,
						'add_media' => $request->media_create,
						'edit_media' => $request->media_update,
						'delete_media' => $request->media_delete,

						'categories_view' => $request->categories_view,
						'categories_create' => $request->categories_create,
						'categories_update' => $request->categories_update,
						'categories_delete' => $request->categories_delete,

						'products_view' => $request->products_view,
						'products_create' => $request->products_create,
						'products_update' => $request->products_update,
						'products_delete' => $request->products_delete,

						'manage_admins_view' => $request->manage_admins_view,
						'manage_admins_create' => $request->manage_admins_create,
						'manage_admins_update' => $request->manage_admins_update,
						'manage_admins_delete' => $request->manage_admins_delete,

						'profile_view' => $request->profile_view,
						'profile_update' => $request->profile_update,

						'admintype_view' => $request->admintype_view,
						'admintype_create' => $request->admintype_create,
						'admintype_update' => $request->admintype_update,
						'admintype_delete' => $request->admintype_delete,
						'manage_admins_role' => $request->manage_admins_role,
						
						]);

		$message = Lang::get("labels.Roles has been added successfully");
		return redirect()->back()->with('message', $message);

	}

	
	
	


}
