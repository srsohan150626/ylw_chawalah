<?php

namespace App\Http\Controllers;
use App\Models\Web\Cart;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Http\Controllers\Web\AlertController;
use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Products;
use Auth;
use Hash;
use Lang;
use Session;
class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
       // dd($request->all());
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $cart = new Cart();
        $result = array();
        $cart_items = $cart->myCart($result);
        $result['cart'] = $cart_items;
        //dd($cart_items);
        $date_added = date('Y-m-d h:i:s');
        if (Session::get('guest_checkout') == 1) {
            $email = session('shipping_address')->email;
            $check = DB::table('users')->where('role_id', 2)->where('email', $email)->first();
            if ($check == null) {
                $customers_id = DB::table('users')
                    ->insertGetId([
                        'role_id' => 2,
                        'email' => $email = session('shipping_address')->email,
                        'password' => Hash::make('123456dfdfdf'),
                        'first_name' => session('shipping_address')->firstname,
                        'last_name' => session('shipping_address')->lastname,
                        'phone' => session('billing_address')->billing_phone,
                    ]);
                session(['customers_id' => $customers_id]);
            } else {
                $customers_id = $check->id;
                $email = $check->email;
                session(['customers_id' => $customers_id]);
            }
        } else {
            $customers_id = auth()->guard('customer')->user()->id;
            $email = auth()->guard('customer')->user()->email;
        }
        //deliver address
        $delivery_first_name= session('shipping_address')->firstname;
        $delivery_last_name= session('shipping_address')->lastname;
        $delivery_name=$delivery_first_name . ' ' . $delivery_last_name;
        // $delivery_email= session('shipping_address')->email;
        //dd($email);
        $delivery_phone= session('billing_address')->billing_phone;
        $delivery_company = "Test";
        $delivery_street_address = session('shipping_address')->street;
        $delivery_suburb = '';
        $delivery_city = session('shipping_address')->city;
        $delivery_postcode = session('shipping_address')->postcode;
        $delivery_state = 'other';
        $country = DB::table('countries')->where('countries_id', '=', session('shipping_address')->countries_id)->get();
        $delivery_country = $country[0]->countries_name;

        //billing address
        $billing_firstname = session('billing_address')->billing_firstname;
        $billing_lastname = session('billing_address')->billing_lastname;
        $billing_street_address = session('billing_address')->billing_street;
        $billing_suburb = '';
        $billing_city = session('billing_address')->billing_city;
        $billing_postcode = session('billing_address')->billing_zip;
        $billing_phone = session('billing_address')->billing_phone;
        if (!empty(session('billing_company')->company)) {
            $billing_company = session('billing_address')->company;
        }
        $billing_state = 'other';
        $country = DB::table('countries')->where('countries_id', '=', session('billing_address')->billing_countries_id)->get();
        $billing_country = $country[0]->countries_name;

        $payment_method = session('payment_method');

        $cc_type = '';
        $cc_owner = '';
        $cc_number = '';
        $cc_expires = '';

        $last_modified = date('Y-m-d H:i:s');
        $date_purchased = date('Y-m-d H:i:s');

        //price
        if (!empty(session('shipping_detail'))) {
            $shipping_price = session('shipping_detail')->shipping_price;
        } else {
            $shipping_price = 0;
        }
        $tax_rate = number_format((float) session('tax_rate'), 2, '.', '');
        $coupon_discount = number_format((float) session('coupon_discount'), 2, '.', '');
        $order_price = (session('products_price') + $tax_rate + $shipping_price) - $coupon_discount;
        $shipping_cost = session('shipping_detail')->shipping_price;
        $shipping_method = session('shipping_detail')->shipping_method;
        $orders_status = '1';
        if (!empty(session('order_comments'))) {
            $comments = session('order_comments');
        } else {
            $comments = '';
        }

        $web_setting = DB::table('settings')->get();
        $currency = $web_setting[19]->value;
        $total_tax = number_format((float) session('tax_rate'), 2, '.', '');
        $products_tax = 1;
        $coupon_amount = 0;
        if (!empty(session('coupon')) and count(session('coupon')) > 0) {

            $code = array();
            $exclude_product_ids = array();
            $product_categories = array();
            $excluded_product_categories = array();
            $exclude_product_ids = array();

            $coupon_amount = number_format((float) session('coupon_discount'), 2, '.', '') + 0;

            foreach (session('coupon') as $coupons_data) {

                //update coupans
                $coupon_id = DB::statement("UPDATE `coupons` SET `used_by`= CONCAT(used_by,',$customers_id') WHERE `code` = '" . $coupons_data->code . "'");

            }
            $code = json_encode(session('coupon'));

        } else {
            $code = '';
            $coupon_amount = '';
        }
        $payment_method_name = "ssl_commerze";
        $payment_status = 'success';
        $order_information = array();
         //check if order is verified
         if ($payment_status == 'success') {            

            $orders_id = DB::table('orders')->insertGetId(
                ['customers_id' => $customers_id,
                    'customers_name' => $delivery_name,
                    'customers_street_address' => $delivery_street_address,
                    'customers_suburb' => $delivery_suburb,
                    'customers_city' => $delivery_city,
                    'customers_postcode' => $delivery_postcode,
                    'customers_state' => $delivery_state,
                    'customers_country' => $delivery_country,
                    //'customers_telephone' => $customers_telephone,
                    'email' => $email,
                    // 'customers_address_format_id' => $delivery_address_format_id,

                    'delivery_name' => $delivery_name,
                    'delivery_street_address' => $delivery_street_address,
                    'delivery_suburb' => $delivery_suburb,
                    'delivery_city' => $delivery_city,
                    'delivery_postcode' => $delivery_postcode,
                    'delivery_state' => $delivery_state,
                    'delivery_country' => $delivery_country,
                    // 'delivery_address_format_id' => $delivery_address_format_id,

                    'billing_name' => $billing_firstname . ' ' . $billing_lastname,
                    'billing_street_address' => $billing_street_address,
                    'billing_suburb' => $billing_suburb,
                    'billing_city' => $billing_city,
                    'billing_postcode' => $billing_postcode,
                    'billing_state' => $billing_state,
                    'billing_country' => $billing_country,
                    //'billing_address_format_id' => $billing_address_format_id,

                    'payment_method' => $payment_method_name,
                    'cc_type' => $cc_type,
                    'cc_owner' => $cc_owner,
                    'cc_number' => $cc_number,
                    'cc_expires' => $cc_expires,
                    'last_modified' => $last_modified,
                    'date_purchased' => $date_purchased,
                    'order_price' => $order_price,
                    'shipping_cost' => $shipping_cost,
                    'shipping_method' => $shipping_method,
                    // 'orders_status' => $orders_status,
                    //'orders_date_finished'  => $orders_date_finished,
                    'currency' => $currency,
                    'order_information' => json_encode($order_information),
                    'coupon_code' => $code,
                    'coupon_amount' => $coupon_amount,
                    'total_tax' => $total_tax,
                    'ordered_source' => '1',
                    'delivery_phone' => $delivery_phone,
                    'billing_phone' => $billing_phone,
                ]);

            //orders status history
            $orders_history_id = DB::table('orders_status_history')->insertGetId(
                ['orders_id' => $orders_id,
                    'orders_status_id' => $orders_status,
                    'date_added' => $date_added,
                    'customer_notified' => '1',
                    'comments' => $comments,
                ]);
            $total_amount=0;
            foreach ($cart_items as $products) {
                //get products info
                $total_amount+=$products->final_price * $products->customers_basket_quantity;
                $orders_products_id = DB::table('orders_products')->insertGetId(
                    [
                        'orders_id' => $orders_id,
                        'products_id' => $products->products_id,
                        'products_name' => $products->products_name,
                        'products_price' => $products->price,
                        'final_price' => $products->final_price * $products->customers_basket_quantity,
                        'products_tax' => $products_tax,
                        'products_quantity' => $products->customers_basket_quantity,
                    ]);
                $inventory_ref_id = DB::table('inventory')->insertGetId([
                    'products_id' => $products->products_id,
                    'reference_code' => '',
                    'stock' => $products->customers_basket_quantity,
                    'admin_id' => 0,
                    'added_date' => time(),
                    'purchase_price' => 0,
                    'stock_type' => 'out',
                ]);

                if (Session::get('guest_checkout') == 1) {
                    DB::table('customers_basket')->where('session_id', Session::getId())->where('products_id', $products->products_id)->update(['is_order' => '1']);

                } else {
                    DB::table('customers_basket')->where('customers_id', $customers_id)->where('products_id', $products->products_id)->update(['is_order' => '1']);

                }

                if (!empty($products->attributes) and count($products->attributes)>0) {

                    foreach ($products->attributes as $attribute) {
                        DB::table('orders_products_attributes')->insert(
                            [
                                'orders_id' => $orders_id,
                                'products_id' => $products->products_id,
                                'orders_products_id' => $orders_products_id,
                                'products_options' => $attribute->attribute_name,
                                'products_options_values' => $attribute->attribute_value,
                                'options_values_price' => $attribute->values_price,
                                'price_prefix' => $attribute->prefix,
                            ]);

                        DB::table('inventory_detail')->insert([
                            'inventory_ref_id' => $inventory_ref_id,
                            'products_id' => $products->products_id,
                            'attribute_id' => $attribute->products_attributes_id,
                        ]);
                    }
                }

            }

            $responseData = array('success' => '1', 'data' => array(), 'message' => "Order has been placed successfully.");

            //send order email to user
            $order = DB::table('orders')
                ->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

            //foreach
            foreach ($order as $data) {
                $orders_id = $data->orders_id;

                $orders_products = DB::table('orders_products')
                    ->join('products', 'products.products_id', '=', 'orders_products.products_id')
                    ->select('orders_products.*', 'products.products_image as image')
                    ->where('orders_products.orders_id', '=', $orders_id)->get();
                $i = 0;
                $total_price = 0;
                $product = array();
                $subtotal = 0;
                foreach ($orders_products as $orders_products_data) {
                    $product_attribute = DB::table('orders_products_attributes')
                        ->where([
                            ['orders_products_id', '=', $orders_products_data->orders_products_id],
                            ['orders_id', '=', $orders_products_data->orders_id],
                        ])
                        ->get();

                    $orders_products_data->attribute = $product_attribute;
                    $product[$i] = $orders_products_data;
                    //$total_tax     = $total_tax+$orders_products_data->products_tax;
                    $total_price = $total_price + $orders_products[$i]->final_price;
                    $subtotal += $orders_products[$i]->final_price;
                    $i++;
                }

                $data->data = $product;
                $orders_data[] = $data;
            }

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->orderBy('orders_status_history.date_added', 'desc')
                ->where('orders_id', '=', $orders_id)->get();

            $orders_status = DB::table('orders_status')->get();

            $ordersData['orders_data'] = $orders_data;
            $ordersData['total_price'] = $total_price;
            $ordersData['orders_status'] = $orders_status;
            $ordersData['orders_status_history'] = $orders_status_history;
            $ordersData['subtotal'] = $subtotal;

            //notification/email
            $myVar = new AlertController();
            $alertSetting = $myVar->orderAlert($ordersData);

            if (session('step') == '4') {
                session(['step' => array()]);
            }

            session(['orders_id' => $orders_id]);
            session(['paymentResponseData' => '']); 
            
            session(['paymentResponse'=>'']);
            session(['payment_json','']);

            //change status of cart products
            if (Session::get('guest_checkout') == 1) {
                DB::table('customers_basket')->where('session_id', Session::getId())->update(['customers_id' => Session::get('customers_id')]);
                DB::table('customers_basket')->where('session_id', Session::getId())->update(['is_order' => '1']);
            } else {
                DB::table('customers_basket')->where('customers_id', auth()->guard('customer')->user()->id)->update(['is_order' => '1']);
            }  
        } 
        //dd($name);
        $post_data = array();
        $post_data['total_amount'] = $order_price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $delivery_name;
        $post_data['cus_email'] = $email;
        $post_data['cus_add1'] = $delivery_street_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $delivery_city;
        $post_data['cus_state'] = $delivery_state;
        $post_data['cus_postcode'] = $delivery_postcode;
        $post_data['cus_country'] = $delivery_country;
        $post_data['cus_phone'] = $billing_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $delivery_name;
        $post_data['ship_add1'] = $delivery_street_address;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = $delivery_city;
        $post_data['ship_state'] = $delivery_city;
        $post_data['ship_postcode'] = $delivery_postcode;
        $post_data['ship_phone'] = $billing_phone;
        $post_data['ship_country'] = $delivery_country;

        $post_data['shipping_method'] = $shipping_method;
        $post_data['product_name'] = "Test";
        $post_data['product_category'] = "test";
        $post_data['product_profile'] = "test";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders_new')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders_new"
        # In orders_new table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders_new')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders_new')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders_new')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);
                return redirect('/thankyou');
               // echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders_new')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            //echo "Transaction is successfully Completed";
            return redirect('/thankyou');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
            return redirect()->back()->with('error', Lang::get("website.Error while placing order"));
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders_new')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders_new')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders_new')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders_new')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders_new')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders_new')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders_new')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
