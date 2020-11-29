<?php
namespace App\Http\Controllers\Web;

//validator is builtin class in laravel
use App\Models\Web\Currency;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Languages;
use App\Models\Web\Cart;
//for authenitcate login data
use App\Models\Web\Products;
use Auth;

//for requesting a value
use DB;
//for Carbon a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Session;
//email

class ProductsController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Cart $cart
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->cart= $cart;
        $this->theme = new ThemeController();
    }

    public function reviews(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $check = DB::table('reviews')
                ->where('customers_id', Auth::guard('customer')->user()->id)
                ->where('products_id', $request->products_id)
                ->first();

            if ($check) {
                return 'already_commented';
            }
            $id = DB::table('reviews')->insertGetId([
                'products_id' => $request->products_id,
                'reviews_rating' => $request->rating,
                'customers_id' => Auth::guard('customer')->user()->id,
                'customers_name' => Auth::guard('customer')->user()->first_name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => Session::get('language_id'),
                    'reviews_text' => $request->reviews_text,
                ]);
            return 'done';
        } else {
            return 'not_login';

        }
    }
    //shop new 
    public function shop(Request $request)
    {
        //dd($request->all());
        $result = array();

        $categorytree= Index::categorytree();
        //category
        if (!empty($request->category) and $request->category != 'all') {
            //dd($request);
            $category = $this->products->getCategories($request);
           //dd($category);
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $sub_category_slug='';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $sub_category_slug= $category[0]->categories_slug;
                    $main_category = $this->products->getMainCategories($category[0]->parent_id);
                    //dd($main_category);
                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
                $sub_category_slug='';
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
            $sub_category_slug='';
        }
        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['categories_status'] = $categories_status;
        $result['subcategory_slug'] = $sub_category_slug;
        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }
        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }
        $data = array('categories_id' => $categories_id, 'search' => $search,'type' => $type);
        $products = $this->products->products($data);        
        $result['products'] = $products;
        $result['commonContent'] = $this->index->commonContent_fashion();
        $data= array();
        $result['cart'] = $this->cart->myCart($data);
        //dd($products);
        return view('web.fashion.shop',compact('categorytree','result'));
    }
    //shop old
    // public function shop(Request $request)
    // {
    //     $title = array('pageTitle' => Lang::get('website.Shop'));
    //     $result = array();

    //     $result['commonContent'] = $this->index->commonContent();
    //     $final_theme = $this->theme->theme();
    //     if (!empty($request->page)) {
    //         $page_number = $request->page;
    //     } else {
    //         $page_number = 0;
    //     }

    //     if (!empty($request->limit)) {
    //         $limit = $request->limit;
    //     } else {
    //         $limit = 15;
    //     }

    //     if (!empty($request->type)) {
    //         $type = $request->type;
    //     } else {
    //         $type = '';
    //     }

    //     //min_max_price
    //     if (!empty($request->price)) {
    //         $d = explode(";", $request->price);
    //         $min_price = $d[0];
    //         $max_price = $d[1];
    //     } else {
    //         $min_price = '';
    //         $max_price = '';
    //     }
    //     $exist_category = '1';
    //     $categories_status = 1;
    //     //category
    //     if (!empty($request->category) and $request->category != 'all') {
    //         $category = $this->products->getCategories($request);
            
    //         if(!empty($category) and count($category)>0){
    //             $categories_id = $category[0]->categories_id;
    //             //for main
    //             if ($category[0]->parent_id == 0) {
    //                 $category_name = $category[0]->categories_name;
    //                 $sub_category_name = '';
    //                 $category_slug = '';
    //                 $categories_status = $category[0]->categories_status;
    //             } else {
    //                 //for sub
    //                 $main_category = $this->products->getMainCategories($category[0]->parent_id);

    //                 $category_slug = $main_category[0]->categories_slug;
    //                 $category_name = $main_category[0]->categories_name;
    //                 $sub_category_name = $category[0]->categories_name;
    //                 $categories_status = $category[0]->categories_status;
    //             }
    //         }else{
    //             $categories_id = '';
    //             $category_name = '';
    //             $sub_category_name = '';
    //             $category_slug = '';
    //             $categories_status = 0;
    //         }
                            

    //     } else {
    //         $categories_id = '';
    //         $category_name = '';
    //         $sub_category_name = '';
    //         $category_slug = '';
    //         $categories_status = 1;
    //     }

    //     $result['category_name'] = $category_name;
    //     $result['category_slug'] = $category_slug;
    //     $result['sub_category_name'] = $sub_category_name;
    //     $result['categories_status'] = $categories_status;

    //     //search value
    //     if (!empty($request->search)) {
    //         $search = $request->search;
    //     } else {
    //         $search = '';
    //     }

    //     $filters = array();
    //     if (!empty($request->filters_applied) and $request->filters_applied == 1) {
    //         $index = 0;
    //         $options = array();
    //         $option_values = array();

    //         $option = $this->products->getOptions();

    //         foreach ($option as $key => $options_data) {
    //             $option_name = str_replace(' ', '_', $options_data->products_options_name);

    //             if (!empty($request->$option_name)) {
    //                 $index2 = 0;
    //                 $values = array();
    //                 foreach ($request->$option_name as $value) {
    //                     $value = $this->products->getOptionsValues($value);
    //                     $option_values[] = $value[0]->products_options_values_id;
    //                 }
    //                 $options[] = $options_data->products_options_id;
    //             }
    //         }

    //         $filters['options_count'] = count($options);

    //         $filters['options'] = implode($options, ',');
    //         $filters['option_value'] = implode($option_values, ',');

    //         $filters['filter_attribute']['options'] = $options;
    //         $filters['filter_attribute']['option_values'] = $option_values;

    //         $result['filter_attribute']['options'] = $options;
    //         $result['filter_attribute']['option_values'] = $option_values;
    //     }

    //     $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
    //         'categories_id' => $categories_id, 'search' => $search,
    //         'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);

    //     $products = $this->products->products($data);        
    //     $result['products'] = $products;

    //     $data = array('limit' => $limit, 'categories_id' => $categories_id);
    //     $filters = $this->filters($data);
    //     $result['filters'] = $filters;

    //     $cart = '';
    //     $result['cartArray'] = $this->products->cartIdArray($cart);

    //     if ($limit > $result['products']['total_record']) {
    //         $result['limit'] = $result['products']['total_record'];
    //     } else {
    //         $result['limit'] = $limit;
    //     }

    //     //liked products
    //     $result['liked_products'] = $this->products->likedProducts();
    //     $result['categories'] = $this->products->categories();

    //     $result['min_price'] = $min_price;
    //     $result['max_price'] = $max_price;

    //     return view("web.shop", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    // }

    public function filterProducts(Request $request)
    {

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //if(!empty($request->category_id)){
        if (!empty($request->category) and $request->category != 'all') {
            $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories_slug', $request->category)->where('language_id', Session::get('language_id'))->get();

            $categories_id = $category[0]->categories_id;
        } else {
            $categories_id = '';
        }

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $filters['options_count'] = count($request->options_value);
            $filters['options'] = $request->options;
            $filters['option_value'] = $request->options_value;
        } else {
            $filters = array();
        }

        $data = array('page_number' => $request->page_number, 'type' => $type, 'limit' => $limit, 'categories_id' => $categories_id, 'search' => $search, 'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        $result['commonContent'] = $this->index->commonContent();
        return view("web.filterproducts")->with('result', $result);

    }

    public function ModalShow(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal1")->with('result', $result);
    }

    //access object for custom pagination
    public function accessObjectArray($var)
    {
        return $var;
    }

     //productDetail
     public function productDetail(Request $request)
     {
 
         $title = array('pageTitle' => Lang::get('website.Product Detail'));
         $result = array();
         $productslug= $request->slug;
         $products = $this->products->getProductsBySlug($request->slug);
         //dd($productslug);
        
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
             
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
             
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
            //  $isFlash = $this->products->getFlashSale($products[0]->products_id);
             
            //  if (!empty($isFlash) and count($isFlash) > 0) {
            //      $type = "flashsale";
            //  } else {
            //      $type = "";
            //  }
             $type = "";
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;

             $products_images = DB::table('products_images')
             ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')
             ->select('image_categories.path as image_path', 'image_categories.image_type','products_images.products_attributes_id')
             ->where('products_id', '=', $products[0]->products_id)
             ->where('image_type','=','ACTUAL')
             ->orderBy('sort_order', 'ASC')
             ->groupby('products_attributes_id')
             ->get();

             $result['products_images'] = $products_images;

             //dd($products_images);
             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId);
             $simliar_products = $this->products->products($data);
             $result['simliar_products'] = $simliar_products;
             //dd($result['simliar_products']);
             $cart = '';
             $result['cartArray'] = $this->products->cartIdArray($cart);
             
             //liked products
            //  $result['liked_products'] = $this->products->likedProducts();
 
            //  $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
            //  $top_seller = $this->products->products($data);
            //  $result['top_seller'] = $top_seller;		
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }
         $categorytree= Index::categorytree();
         $result['commonContent'] = $this->index->commonContent_fashion();
         $data= array();      
         $result['cart'] = $this->cart->myCart($data);
         //dd($result['detail']['product_data'][0]->attributes);
         return view('web.fashion.products.detail',compact('categorytree','result','productslug'));
     }
    public function productDetailByAttr($slug ,$id)
    {
        $currentDate = time();
        $title = array('pageTitle' => Lang::get('website.Product Detail'));
        $result = array();
        $productslug= $slug;
        $products_attribute_id= $id;
        $attribute_name= DB::table('products_attributes')
                         ->leftJoin('products_options_values', 'products_attributes.options_values_id', '=', 'products_options_values.products_options_values_id')
                         ->where('products_attributes.products_attributes_id',$products_attribute_id)
                         ->get();

        $result['attribute_name']= $attribute_name;
        //dd($attribute_name);
         $products = $this->products->getProductsBySlug($slug);
         //dd($products);
        
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
             
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
             
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
            //  $isFlash = $this->products->getFlashSale($products[0]->products_id);
             
            //  if (!empty($isFlash) and count($isFlash) > 0) {
            //      $type = "flashsale";
            //  } else {
            //      $type = "";
            //  }
             $type = "";
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'product_attribute_id' => $products_attribute_id);
             $detail = $this->products->products($data);
             $result['detail'] = $detail;
            // dd($result['detail']);
             $products_images = DB::table('products_images')
             ->LeftJoin('image_categories', 'products_images.image', '=', 'image_categories.image_id')
             ->LeftJoin('products', 'products_images.products_id', '=', 'products.products_id')
             ->LeftJoin('products_description', 'products_images.products_id', '=', 'products_description.products_id')
             ->LeftJoin('products_attributes', 'products_images.products_id', '=', 'products_attributes.products_id')
             ->LeftJoin('specials', function ($join) use ($currentDate) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1')->where('expires_date', '>', $currentDate) ;})
             ->select('products_description.products_name','products.products_price','image_categories.path as image_path', 'image_categories.image_type','products_images.products_attributes_id','products_attributes.options_values_price','specials.specials_new_products_price as discount_price')
             ->where('products_images.products_id', '=', $products[0]->products_id)
             ->where('products_attributes.products_attributes_id', '=', $products_attribute_id)
             ->where('image_type','=','ACTUAL')
             ->orderBy('sort_order', 'ASC')
             ->groupby('products_attributes_id')
             ->get();

             $result['products_images'] = $products_images;

             //dd($products_images);
             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId);
             $simliar_products = $this->products->products($data);
             $result['simliar_products'] = $simliar_products;
             //dd($result['simliar_products']);
             $cart = '';
             $result['cartArray'] = $this->products->cartIdArray($cart);
             
             //liked products
            //  $result['liked_products'] = $this->products->likedProducts();
 
            //  $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
            //  $top_seller = $this->products->products($data);
            //  $result['top_seller'] = $top_seller;		
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }
         $categorytree= Index::categorytree();
         $result['commonContent'] = $this->index->commonContent_fashion();
         $data= array();      
         $result['cart'] = $this->cart->myCart($data);
        // dd($result['detail']['product_data'][0]->default_images);
         return view('web.fashion.products.detail2',compact('categorytree','result','productslug','products_attribute_id'));
    }
    //filters
    public function filters($data)
    {
        $response = $this->products->filters($data);
        return ($response);
    }

    //getquantity
    public function getquantity(Request $request)
    {
        //dd($request->products_id);
        $data = array();
        $data['products_id'] = $request->products_id;
        $data['attributes'] = $request->attributeid;
        $result = $this->products->productQuantity($data);
        //dd($result);
        print_r(json_encode($result));
    }

}
