<?php

namespace App\Http\Controllers;
use Session;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\News;
use App\Models\Content;
use App\Models\Coupon;
use App\Models\Keywords;
use App\Models\Testimonial;
use App\Models\Notifications;
use App\Models\Partner;
use App\Models\Album;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Country;
use App\Models\State;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Color;
use App\Models\Merchandise;
use Auth;
use Stripe;
use App\Models\Vendor;
use App\Models\Category;

use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name',"logo")->latest()->first();
    
        $vendor = Vendor::where('is_active',1)->get();
        $category = Category::where('is_active',1)->where('is_menu',1)->get();
        View()->share('categorya',$category);
        View()->share('vendor',$vendor);
        View()->share('logo',$logo);
        View()->share('config',$this->getConfig());
    }

    public function cart()
    {
        if(!Session::has('cart'))
        {
            Session::forget('shipping');
        }
        $banner = Imagetable::where('table_name','cart-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('cart')->with('title','Cart')->with(compact('banner'));
    }

    public function save_cart(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'quantity_selected' => 'numeric|required|min:1',
        ]);    
        $color = Color::where('id', $request['color_id'])->first();
        if ($validator->passes()) {
            if(Session::has('cart') && !empty(Session::get('cart')))
            {
                $rowid = null;
                $flag = 0;
                $cart_data = Session::get('cart');
                foreach ($cart_data as $key => $value) 
                {
                    if(((intval($value['product_id'])) == (intval($request['product_id']))) && ((intval($value['color_id'])) == (intval($request['color_id']))))
                    {
                        if(null !== $request['color_id']){
                            $flag = 1;
                            $rowid = $value['cart_id'];

                            $cart_data[$rowid]['color'] = $color['name'];
                            $cart_data[$rowid]['code'] = $color['code'];
                            $cart_data[$rowid]['price'] = $color['price'];
                            $cart_data[$rowid]['quantity_selected'] += intval($request['quantity_selected']);
                            $cart_data[$rowid]['sub_total'] = intval($cart_data[$rowid]['price'])*intval($cart_data[$rowid]['quantity_selected']);                    
                            Session::forget($rowid);
                            Session::put('cart',$cart_data); 
                            return response()->json(['msg' => 'Product Added to cart Successfully', 'status' => 1]);
                        }
                    } 
                    
                    if ((intval($value['product_id'])) == (intval($request['product_id'])) && ((($request['color_id']) == null) )) {
                        $flag = 1;
                        $rowid = $value['cart_id'];
                        $cart_data[$rowid]['color'] = $color['name'];
                        $cart_data[$rowid]['code'] = $color['code'];
                        $cart_data[$rowid]['price'] = $color['price'];
                        $cart_data[$rowid]['quantity_selected'] += intval($request['quantity_selected']);
                        $cart_data[$rowid]['sub_total'] = intval($cart_data[$rowid]['price'])*intval($cart_data[$rowid]['quantity_selected']);                    
                        Session::forget($rowid);
                        Session::put('cart',$cart_data); 
                        return response()->json(['msg' => 'Product Added to cart Successfully', 'status' => 1]);
                    }                       
                }
            }

            $product_id = $request->product_id;
            $qty = $request->quantity_selected;
    
            $cart = array();
            $cartId = $product_id.$request->quantity_selected.$request->flavor_id.$request->size_id.$request->flavor_name.$request->size_name;
            if(Session::has('cart')){
                $cart = Session::get('cart');
            }
    
            if($qty == 0){
                $qty = 1;
            }
    
            if($product_id != "" && intval($qty) > 0)
            {
                if(!empty($cartId) && !empty($cart))
                {
                    unset($cart[$cartId]);
                }
            
                $product = Products::where('id',$product_id)->first();
                $cart[$cartId]['cart_id'] = $cartId;
                $cart[$cartId]['stock_qty'] = $product->qty;
                $cart[$cartId]['product_id'] = $product_id;
                $cart[$cartId]['name'] = $product->name;
                $cart[$cartId]['slug'] = $product->slug;
                $cart[$cartId]['quantity_selected'] = $qty;
                $cart[$cartId]['color_id'] = $request->color_id;
                $cart[$cartId]['size_id'] = $request->size_id;
                $cart[$cartId]['color_name'] = $request->color_name;
                $cart[$cartId]['color'] = $color['name'];
                $cart[$cartId]['code'] = $color['code'];
                $cart[$cartId]['price'] = $color['price'];
                $cart[$cartId]['sub_total'] = intval($color['price'])*intval($qty);
                $cart[$cartId]['image'] = !empty($product->img_path) ? $product->img_path : 'images/noimg.png';
    
                Session::put('cart',$cart);
                return response()->json(['msg'=>'Product Added To Cart!','status' => 1]);
            }
            else
            {
                return response()->json(['error'=>'Something Went Wrong, Please Try Again!','status' => 2]);
            }
        }
        else{
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
              
    }

    public function updatecart(Request $request)
    {
        // dd($request->all());
        $rowid = $request->rowid;
        $qty = $request->qty;
        $cart_data = Session::get('cart');
        // dd($cart_data);
        $cart_data[$rowid]['quantity_selected'] = $qty;
        $cart_data[$rowid]['sub_total'] = $cart_data[$rowid]['price']*$qty;
        // $cart[$cartId]['rental_deposit'] = floatval( $cart_data[$rowid]['rental_deposit']*$qty);
        Session::forget($rowid);
        Session::put('cart',$cart_data);

        return response()->json(['status' , 1]);
    }

    public function removecart(Request $request){
        $rowid = $request['rowid'];
        $cart_data = Session::get('cart');
        unset($cart_data[$rowid]);
        Session::forget('cart');
        Session::put('cart',$cart_data);
        
    }
    
    public function checkoutpost(Request $request)
    {

        if(Auth::check())
        {
            if(isset($_GET) && !empty($_GET))
            {
                Session::forget('shipping');
            }

            if(Session::has('cart') && !empty(Session::get('cart')) )
            {
                $shipping = $request->except(['_token']);
                // Session::put('shipping',$shipping);
                $banner = Imagetable::where('table_name','checkout-banner')->latest()->first();
                $cart_data = Session::get('cart');
                return view('checkout')->with('title','Checkout')->with(compact('banner','cart_data','shipping'));
            }
            else{
                return redirect()->route('cart')->with('notify_error','Your Cart Is Empty!');
            }
        }
        else{
            return redirect()->route('sign-in')->with('notify_error','You need to login first!');
        }
    }

    public function checkout()
    {
        if(Auth::check())
        {
            if(isset($_GET) && !empty($_GET))
            {
                Session::forget('shipping');
            }

            if(Session::has('cart') && !empty(Session::get('cart')) )
            {
            $banner = Imagetable::where('table_name','checkout-banner')->latest()->first();
            // $countries = Country::orderBy('country', 'ASC')->get();
            // $states = State::orderBy('state_name', 'ASC')->get();
            $cart_data = Session::get('cart');
            return view('checkout')->with('title','Checkout')->with(compact('banner','cart_data'));//->with(compact('banner','cart_data'));
            }
            else{
                return redirect()->route('cart')->with('notify_error','Your Cart Is Empty!');
            }
        }
        else{
            return redirect()->route('sign-in')->with('notify_error','You need to login first!');
        }
    }

    public function calc_dist(Request $request)
    {
        // dd($request->all());

        if(str_contains($request['address'],'USA'))
        {
        $config = $this->getConfig();
        $curl = curl_init();
           
        curl_setopt_array($curl, array(
      
        CURLOPT_URL => "https://api.distancematrix.ai/maps/api/distancematrix/json?origins={$config['COMPANYADDRESS']}&destinations={$request['address']}&key=fqt9CrYhTXw9WtbXPSNzebNVTS6WS"
        ,CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 50,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        //  echo 
        // exit;
        $response = curl_exec($curl);
        // dd();
        // echo "<pre>";
        // print_r($response);
        // exit;
        curl_close($curl);
         $response = json_decode($response);
        //  dd($response);
        // dd($response->rows[0]->elements[0]->status);
        if(isset($response) && !empty($response))
        {
         if($response->rows[0]->elements[0]->status == "OK")
         {
        //     dd($response);
        //    dd('OK');
        $km = $response->rows[0]->elements[0]->distance->text;
        $km = str_replace('km','',$km);
        $km = intval($km);
        // dd($km);
           $param = array();
           $param = ['distance_km'=>$km,'distance_miles'=>$km/1.609,
                    'duration'=>$response->rows[0]->elements[0]->duration->text,'response'=>$response->rows[0]->elements[0]->status];
            $miles = $param['distance_miles']-20;
            if(! $miles <= 0 )
            {
                $extra_miles_times = $miles / 10;
                $extra_fees = $extra_miles_times * 5;
                $param['extra_miles_occurance'] = $extra_miles_times;
                $extra_fees = round(($extra_miles_times * 5),3);
                $param['extra_miles'] = $miles;
              
               $param['extra_miles_fees'] = $extra_fees;
            }
            else
            {
                $param['extra_miles_fees'] = 0;
            }
        //   dd('not extra');
        // dd($param);
            //   return back()->with('notify_success','Crawl Ran Successfuly!')->with('crawl_success',true)->with('popup_message','Crawl Ran Successfuly!');
                return response()->json(['msg' => 'Distance Calculated Successfuly!', 'status' => 1,'data'=>$param]);
             //return 
         }
        }
         else
         {
            //  dd($response->rows[0]->elements[0]->status);
            //  return back()->with('notify_error','Something went wrong, please try again!');
            return response()->json(['msg' => 'Invalid Address!', 'status' => 0]);
             
             
         }

        }
        else
        {
            return response()->json(['status' =>0,'msg'=>'Address Must Contain USA Country Code!']);
        }
    }

    public function placeorder(Request $request)
    {
        if(Auth::check())
        {
            if(Session::has('cart'))
            {
                $ser = Session::get('ser');
                $validator = Validator::make($request->all(),[
                    'fname' => 'required|max:255',
                    'lname' => 'required|max:255',
                    'email' => 'required',
                    'address' => 'required|max:255',
                    'town' => 'required|max:255',
                    'zip' => 'required|max:255',
                    'phone' => 'required|max:255',
                    'note' => 'required|max:255',
                ]);
                if ($validator->passes()) {
                    $order = Orders::create([
                        'fname' => $request['fname'],
                        'lname' => $request['lname'],
                        'country' => $request['country'],
                        'address' => $request['address'],
                        'town' => $request['town'],
                        'state' => $request['state'],
                        'zip' => $request['zip'],
                        'phone' => $request['phone'],
                        'email' => $request['email'],
                        'note' => $request['note'],
                        'order_amount' => $request['sub_amount'],
                        'total_amount' => $request['total_amount'],
                        'delivery_fees' => isset($request['shipping_fee']) && null !== ($request['shipping_fee']) ? $request['shipping_fee'] :  0,
                        'user_id' => Auth::id(),
                    ]);

                    $order_detail = OrderDetail::create([
                        'details' => $ser,
                        'order_id' => $order->id
                    ]);

                    Session::put('order_id',$order->id);
                    $order_detail = unserialize($ser);
                    $mail_data = array('orders' => $order, 'order_detail' => $order_detail, 'request' => $request->all());
                    Session::put('mail_data',$mail_data);
                    $mail_data = Session::get('mail_data');
                    $orders = $mail_data['orders'];
                    $order_detail = $mail_data['order_detail'];
                    $request = $mail_data['request'];
                    // Mail::send('paymentpending', ['orders'=>$orders,'order_detail'=>$order_detail]
                    //     ,function($message) use ($orders,$order_detail,$request) {
                    //     $message->to($request['email']);
                    //     $message->subject('Order Payment Pending');
                    // });
                    // $notification = Notifications::create ([
                    //     "order_id" => $orders->id,
                    //     "subject" => "Order Payment Pending",
                    //     "title" => "Your order number # " . $order->id . "is delivered",
                    //     "user_id" => Auth::id(),
                    // ]);
                   return response()->json(['status' =>1,'msg'=>'Order Placed Successfuly!']);
                }
                else{
                    return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
                }
                $mail_data = Session::get('mail_data');
                $orders = $mail_data['orders'];
                $order_detail = $mail_data['order_detail'];
                $request = $mail_data['request'];
                Mail::send('paymentpending', ['orders'=>$orders,'order_detail'=>$order_detail]
                        ,function($message) use ($orders,$order_detail,$request) {
                    $message->to($request['email']);
                    $message->subject('Order Payment Pending');
                });
            }
            else{
                return response()->json(['status' =>0,'msg'=>'Your Cart Is Empty!']);
            }
        }
        else{
            return response()->json(['status' =>3,'msg'=>'Please Login First!']);
        }
    }

    public function paysecure()
    {
        if(isset($_GET['order_id']))
        {
            $order_id = $_GET['order_id'];
            $custom = $order_id;
            $orders = Orders::where('id',$order_id)->with('orderHasDetail')->first()->toArray();
            $ordersdetails = OrderDetail::where('order_id',$order_id)->first()->toArray();
            $ser = $ordersdetails['details'];
            $uns = unserialize($ser);
            $amount = $orders['total_amount'];
            foreach ($uns as $key => $val) {
                $data1[] = array(
                    'name' => $val['name'],
                    'quantity' => $val['quantity_selected'],
                    'price' => $val['sub_total'],
                    'image' => $val['image'],
                    'slug' => $val['slug'],
                    'currency' => 'USD'
                );
            }
        } 
        else{
            if(Session::has('cart'))
            {
                $order_id = Session::get('order_id');
                $custom = $order_id;
                $orders = Orders::where('id',$order_id)->with('orderHasDetail')->first()->toArray();
                $ser = Session::get('ser');
                $uns = unserialize($ser);
                $amount = $orders['total_amount'];
                foreach ($uns as $key => $val) {
                    $data1[] = array(
                        'name' => $val['name'],
                        'quantity' => $val['quantity_selected'],
                        'price' => $val['sub_total'],
                        'image' => $val['image'],
                        'slug' => $val['slug'],
                        'currency' => 'USD'
                    );
                }
               
            }
            else{
                return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
            }
        }
        $itemsss = $data1;
        $banner = Imagetable::where('table_name','checkout-landing-banner')->latest()->first();

        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        $transfer_group = rand(100, 999);
        
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
            $stripe = \Stripe\PaymentIntent::create([
                'amount' => $amount*100,
                'currency' => 'usd',
                'transfer_group' => $transfer_group,
            ]);

            $secret = $stripe->client_secret;
            return view('paysecure')->with('notify_success','Payment Charged Successfully!')->with(compact('banner','order_id','uns','amount','orders','itemsss','custom','secret', 'amount', 'user'));
            
        } catch(\Stripe\Exception\CardException $e) {
            return back()->with('notify_error',"a ".$e->getError()->message);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return back()->with('notify_error',"b ".$e->getError()->message);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return back()->with('notify_error',"c ".$e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return back()->with('notify_error',"d ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return back()->with('notify_error',"e ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->with('notify_error',"f ".$e->getError()->message);
        } catch (Exception $e) {
            return back()->with('notify_error',"g ".$e->getError()->message);
        }
    }

    public function order_submit()
    {
        $user = User::where('id', Auth::id())->first();
        $order = Orders::where('id', $_GET['order_id'])->Update([
            'payment_intent'    => $_GET['payment_intent'],
            'payment_intent_client_secret'  => $_GET['payment_intent_client_secret'],
            'total_amount'      => $_GET['amount'],
            'order_amount'      => $_GET['amount'],
            'redirect_status'   => $_GET['redirect_status'],
            'pay_status'       => $_GET['redirect_status']=='succeeded'?1:0
        ]);
        if($_GET['redirect_status'] == 'succeeded')
        {
            $order_detail = OrderDetail::where('order_id', $_GET['order_id'])->first();
            $uns = unserialize($order_detail->details);
            foreach ($uns as $key => $value) {
                $color = Color::where('id',$value['color_id'])->first();
                $qty = $color->qty;
                $color->qty = intval($qty)-intval($value['quantity_selected']);
                $color->save();
            }
        }
        $data = [
            'name' => $user->fullname,
            'amount' => $_GET['amount'],
            'status' => $_GET['redirect_status']
        ];

        // Mail::send('invoice', ['data'=>$data], function($message) use ($data) {
        //     $message->to(env('MAIL_FROM_ADDRESS'));
        //     $message->cc(Auth::user()->email);
        //     $message->subject('Your Order Invoice');
        // });
        // Mail::send('invoice', ['data'=>$data], function($message) use ($data) {
        //     $message->from(env('MAIL_USERNAME')); 
        //     $message->cc(Auth::user()->email);
        //     $message->to(env('MAIL_FROM_ADDRESS'))->subject('Your Order Invoice');
        // });
        $user = User::where('id', Auth::id())->first();
        $banner = Imagetable::where('table_name','checkout-landing-banner')->latest()->first();
            return view('checkout-landing')->with('title','Order Complete')->with(compact('banner'));
        return view('placeorder')->with('notify_success','Payment Charged Successfully!')->with(compact('user'));

    }

    public function stripePost(Request $request)
    {
        $order_upd = Orders::where('id',$request->custom)->first();
        $order_data = $order_upd;
        try {
            Stripe\Stripe::setApiKey("sk_test_VBMMsR6t4ns4sG7UZZFSpq8C");
            $stripe = Stripe\Charge::create ([
                "amount" => $order_upd->total_amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => 'Product Purchase'
            ]);
            $updateParam = 0;
            if($stripe->status == "succeeded")
            {
                $updateParam = 1;
            }
            else
            {
                $updateParam = 0;
            }
            $order_upd = Orders::where('id',$request->custom)->update([
                'is_active' => 1,
                'order_merchant' => 'STRIPE',
                'pay_status' => $updateParam,
                'order_response' => null,
                'order_merchant' => 'STRIPE'
            ]);
            $orders = $order_data;
            Mail::send('paymentsuccess', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Received');
            });

            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Received",
                "title" => "Your order number # " . $orders->id . " payment is received",
                "user_id" => Auth::id(),
            ]);
 
            return redirect()->route('checkout_landing',Crypt::encrypt($orders->id))->with('notify_success','Payment Charged Successfully!');
        } catch(\Stripe\Exception\CardException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);

            return back()->with('notify_error',$e->getError()->message);
        } catch (\Stripe\Exception\RateLimitException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        } catch (Exception $e) {
            $orders = $order_data;
            Mail::send('paymentdeclined', ['orders'=>$orders]
                ,function($message) use ($orders) {
                $message->to($orders->email);
                $message->subject('Order Payment Declined');
            });
            $notification = Notifications::create ([
                "order_id" => $orders->id,
                "subject" => "Order Payment Declined",
                "title" => "Your order number # " . $orders->id . " order payment declined",
                "user_id" => Auth::id(),
            ]);
            return back()->with('notify_error',$e->getError()->message);
        }
    }

    public function paystatus(Request $request)
    {
        $status_codes = array("Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5);
        $payment_status = $request['payment_status'];
        $updateParam = $status_codes[$payment_status];
        $order_upd = Orders::where('id',$request['custom'])->update([
            'pay_status' => $updateParam,
            'order_response' => serialize($request->all()),
            'order_merchant' => 'PAYPAL'
        ]);
    }

    public function checkout_landing($id)
    {
        $order_id = Crypt::decrypt($id);
        $comorder = Orders::where('id',$order_id)->first();
        $comorderdetail =OrderDetail::where('order_id',$comorder->id)->first();
        if(Session::has('cart') || isset($comorder) && !empty($comorder))
        {
            $ser = $comorderdetail['details'];
            $uns = unserialize($ser);
            foreach($uns as $key => $value){
                $product = Products::where('id',$value['product_id'])->first();
                $minusstock = $product->qty - $value['quantity_selected'];
                $stockupdate = Products::where('id',$value['product_id'])->update([
                    'qty' => $minusstock,
                ]);
            }
            $orders =  $comorder;
            $order_detail = $uns;
            Mail::send('invoice', ['orders'=>$orders,'order_detail'=>$order_detail]
                ,function($message) use ($orders,$order_detail) {
                $message->to($orders['email']);
                $message->subject('Your Order Invoice');
            });
            $banner = Imagetable::where('table_name','checkout-landing-banner')->latest()->first();
            return view('checkout-landing')->with('title','Order Complete')->with(compact('banner'));
        }
        else{
            return redirect()->route('home')->with('notify_error','Your Cart Is Empty!');
        }
    }

    public function apply_coupon(Request $request)
    {
        $validator = Validator::make($request->all(),[       
            'couponcode' => 'required ',
        ]); 
        if (Auth::check()) {
            $coupon = Coupon::where('is_active',1)->where('coupon_code',$request->couponcode)->first();
            if ($validator->passes()) {
                if(isset($coupon) && !empty($coupon->id)){
                    $checkvalidcoupon = User::where('id',Auth::id())->first();
                    $cid = (int)$checkvalidcoupon->coupon_id;
                    if($coupon->id !== $cid)
                    {  
                        if($coupon->coupon_code == $request->couponcode )
                        {
                            $discoupon = Coupon::where('coupon_code',$request->couponcode)->first();
                            session::put('discoupon_session',$discoupon);
                            return response()->json(['status' => 1]);
                        }
                        else{
                            return response()->json(['status' => 2]);
                        }
                    }
                    else
                    {
                        return response()->json(['status' => 0]);
                    }
                }
                else{
                    return response()->json(['status' => 4]);
                }
            }
            else
            {
                return response()->json(['error'=>$validator->errors()->all(),'status' => 3]);
            }
        }
        else{
            return response()->json(['error'=>"You need to login first!",'status' => 5]);
        }
    }

    public function calc_dimensions($calc)
    {
        $specs = ['weight'=>0,'height' => 0, 'length' => 0, 'width' =>0];
        foreach($calc as $key => $value)
        {
            if(isset($value['product_id']))
            {
                $specs['weight'] +=  $value['weight'] * $value['qty'];
                $specs['height'] +=  $value['height'] * $value['qty'];
                $specs['length'] +=  $value['length'] * $value['qty'];
                $specs['width'] +=  $value['width'] * $value['qty'];
            }
        }
        return $specs;
    }

    public function shipping_session($ship_data)
    {
        if(Session::has('shipping'))
        {
            Session::forget('shipping');
        }
    
        foreach($ship_data as $key => $value)
        {
            if($key == "ups")
            {
                $ship_data['ship_method'] = 'UPS';
                $ship_data['shipping_service'] = $ship_data['service_name'];
                unset($ship_data[$key]);
            }
        }
        Session::put('shipping',$ship_data);
    }

    public function ups(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'destination' => 'required',
            'ServiceType' => 'required',
        ]);  
        // dd($request->all());
        if ($validator->passes()) {
            $cart_calc =  Session::get('cart');
            $dest_zip = $request->destination;
            $servicetype = $request->ServiceType;
            $weight = $request->weight;

            $accessKey = '5DA5C306CAE1F5B5';
            $userId= 'Metroid47';
            $password= 'Metroid74!';
            $return = "";
            $rate = new \Ups\Rate(
                $accessKey,
                $userId,
                $password
            );

        try {
            // Start shipment
            $shipment = new \Ups\Entity\Shipment();

            // Set shipper
            $shipper = $shipment->getShipper();
            $shipper->setShipperNumber('81AF12');
            $shipper->setName('Charles Israel');
            $shipper->setAttentionName('Charles Israel');
            $shipperAddress = $shipper->getAddress();
            $shipperAddress->setAddressLine1('615 Ocean Blvd');
            $shipperAddress->setPostalCode('33160');
            $shipperAddress->setCity('Golden Beach');
            $shipperAddress->setStateProvinceCode('FL'); // required in US
            $shipperAddress->setCountryCode('US');
            $shipper->setAddress($shipperAddress);
            $shipper->setEmailAddress('codbeast11@gmail.com'); 
            $shipper->setPhoneNumber('3056076984');
            $shipment->setShipper($shipper);
            
            // To address 
            $address = new \Ups\Entity\Address();
            $address->setAddressLine1('100 W 31st St');
            $address->setPostalCode('10001');
            $address->setCity('New York');
            $address->setStateProvinceCode('NY');  // Required in US
            $address->setCountryCode('US');
            $shipTo = new \Ups\Entity\ShipTo();
            $shipTo->setAddress($address);
            $shipTo->setCompanyName('Omnicom');
            $shipTo->setAttentionName('Dummy Name');
            $shipTo->setEmailAddress('dummy@dummy.com'); 
            $shipTo->setPhoneNumber('+12345678910');
            $shipment->setShipTo($shipTo);

            // From address
            $address = new \Ups\Entity\Address();
            $address->setAddressLine1('615 Ocean Blvd');
            $address->setPostalCode('33160');
            $address->setCity('Golden Beach');
            $address->setStateProvinceCode('FL');  
            $address->setCountryCode('US');
            $shipFrom = new \Ups\Entity\ShipFrom();
            $shipFrom->setAddress($address);
            $shipFrom->setName('Charles Israel');
            $shipFrom->setAttentionName($shipFrom->getName());
            $shipFrom->setCompanyName($shipFrom->getName());
            $shipFrom->setEmailAddress('codbeast11@gmail.com');
            $shipFrom->setPhoneNumber('3056076984');
            $shipment->setShipFrom($shipFrom);

            // Sold to
            $address = new \Ups\Entity\Address();
            $address->setAddressLine1('100 W 31st St');
            $address->setPostalCode('10001');
            $address->setCity('New York');
            $address->setCountryCode('US');
            $address->setStateProvinceCode('NY');
            $soldTo = new \Ups\Entity\SoldTo;
            $soldTo->setAddress($address);
            $soldTo->setAttentionName('Dummy Name');
            $soldTo->setCompanyName($soldTo->getAttentionName());
            $soldTo->setEmailAddress('dummy@dummy.com');
            $soldTo->setPhoneNumber('+12345678910');
            $shipment->setSoldTo($soldTo);
           
            // Set service
            $service = new \Ups\Entity\Service;
            $service->setCode($request->ServiceType);
            $service->setDescription($service->getName());
            $shipment->setService($service);
            
            // Mark as a return (if return)
            $returnService = new \Ups\Entity\ReturnService;
            $returnService->setCode(\Ups\Entity\ReturnService::PRINT_RETURN_LABEL_PRL);
            $shipment->setReturnService($returnService);

            // Set description
            $shipment->setDescription('PARCEL FROM LIMELYNX');

            // Add Package
            $package = new \Ups\Entity\Package();
            $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
            $package->getPackageWeight()->setWeight($weight);
            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
            $package->getPackageWeight()->setUnitOfMeasurement($unit);

            // Set Package Service Options
            $packageServiceOptions = new \Ups\Entity\PackageServiceOptions();

            // $packageServiceOptions->setShipperReleaseIndicator(true);
            $package->setPackageServiceOptions($packageServiceOptions);
            
            // Set dimensions
            $dimensions = new \Ups\Entity\Dimensions();
            $dimensions->setHeight($request->height); //yahan height aayegi
            $dimensions->setWidth($request->width); //yahan width aayegi
            $dimensions->setLength($request->length); //yahan length aayegi
            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);
            $dimensions->setUnitOfMeasurement($unit);
            $package->setDimensions($dimensions);

            // Add descriptions because it is a package
            $package->setDescription('Some Parcel');

            // Add this package
            $shipment->addPackage($package);

            // Set payment information
            $shipment->setPaymentInformation(new \Ups\Entity\PaymentInformation('prepaid', (object)array('AccountNumber' => '81AF12')));
           
            $label_data = Session::put('label_data',$shipment);
            $param = array();
            $param['ups_shipping_amount'] = $rate->getRate($shipment)->RatedShipment[0]->TotalCharges->MonetaryValue;
        } catch (Exception $e) {
          echo json_encode($e->getMessage());
        }  
            $request['shipping_amount'] = $param['ups_shipping_amount'];
            $request['weight'] = 5;
            $request['height'] = 5;
            $request['length'] = 5;
            $request['width'] = 5;
            $this->shipping_session($request->all());
            echo json_encode($param);
        }
        else{
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    // public function ups(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'destination' => 'required',
    //         'ServiceType' => 'required',
    //     ]);      
    //     if ($validator->passes()) {
    //         $cart_calc =  Session::get('cart');
    //         $dest_zip = $request->destination;
    //         $servicetype = $request->ServiceType;
    //         $weight = $request->weight;
    //         $accessKey = '5DA5C306CAE1F5B5';
    //         $userId= 'Metroid47';
    //         $password= 'Metroid74!';
    //         $return = "";
    //         $rate = new \Ups\Rate(
    //             $accessKey,
    //             $userId,
    //             $password
    //         );
       
    //         try {
    //             // Start shipment
    //             $shipment = new \Ups\Entity\Shipment();
    //             // Set shipper
    //             $shipper = $shipment->getShipper();
    //             $shipper->setShipperNumber('81AF12');
    //             $shipper->setName('Charles Israel');
    //             $shipper->setAttentionName('Charles Israel');
    //             $shipperAddress = $shipper->getAddress();
    //             $shipperAddress->setAddressLine1('615 Ocean Blvd');
    //             $shipperAddress->setPostalCode('33160');
    //             $shipperAddress->setCity('Golden Beach');
    //             $shipperAddress->setStateProvinceCode('FL'); // required in US
    //             $shipperAddress->setCountryCode('US');
    //             $shipper->setAddress($shipperAddress);
    //             $shipper->setEmailAddress('codbeast11@gmail.com'); 
    //             $shipper->setPhoneNumber('3056076984');
    //             $shipment->setShipper($shipper);
    //             // To address 
    //             $address = new \Ups\Entity\Address();
    //             $address->setAddressLine1('100 W 31st St');
    //             $address->setPostalCode('10001');
    //             $address->setCity('New York');
    //             $address->setStateProvinceCode('NY');  // Required in US
    //             $address->setCountryCode('US');
    //             $shipTo = new \Ups\Entity\ShipTo();
    //             $shipTo->setAddress($address);
    //             $shipTo->setCompanyName('Omnicom');
    //             $shipTo->setAttentionName('Dummy Name');
    //             $shipTo->setEmailAddress('dummy@dummy.com'); 
    //             $shipTo->setPhoneNumber('+12345678910');
    //             $shipment->setShipTo($shipTo);
    //             // From address
    //             $address = new \Ups\Entity\Address();
    //             $address->setAddressLine1('615 Ocean Blvd');
    //             $address->setPostalCode('33160');
    //             $address->setCity('Golden Beach');
    //             $address->setStateProvinceCode('FL');  
    //             $address->setCountryCode('US');
    //             $shipFrom = new \Ups\Entity\ShipFrom();
    //             $shipFrom->setAddress($address);
    //             $shipFrom->setName('Charles Israel');
    //             $shipFrom->setAttentionName($shipFrom->getName());
    //             $shipFrom->setCompanyName($shipFrom->getName());
    //             $shipFrom->setEmailAddress('codbeast11@gmail.com');
    //             $shipFrom->setPhoneNumber('3056076984');
    //             $shipment->setShipFrom($shipFrom);
    //             // Sold to
    //             $address = new \Ups\Entity\Address();
    //             $address->setAddressLine1('100 W 31st St');
    //             $address->setPostalCode('10001');
    //             $address->setCity('New York');
    //             $address->setCountryCode('US');
    //             $address->setStateProvinceCode('NY');
    //             $soldTo = new \Ups\Entity\SoldTo;
    //             $soldTo->setAddress($address);
    //             $soldTo->setAttentionName('Dummy Name');
    //             $soldTo->setCompanyName($soldTo->getAttentionName());
    //             $soldTo->setEmailAddress('dummy@dummy.com');
    //             $soldTo->setPhoneNumber('+12345678910');
    //             $shipment->setSoldTo($soldTo);
    //             // Set service
    //             $service = new \Ups\Entity\Service;
    //             $service->setCode($request->ServiceType);
    //             $service->setDescription($service->getName());
    //             $shipment->setService($service);
    //             // Mark as a return (if return)
    //             $returnService = new \Ups\Entity\ReturnService;
    //             $returnService->setCode(\Ups\Entity\ReturnService::PRINT_RETURN_LABEL_PRL);
    //             $shipment->setReturnService($returnService);
    //             // Set description
    //             $shipment->setDescription('PARCEL FROM LIMELYNX');
    //             // Add Package
    //             $package = new \Ups\Entity\Package();
    //             $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
    //             $package->getPackageWeight()->setWeight($weight);
    //             $unit = new \Ups\Entity\UnitOfMeasurement;
    //             $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
    //             $package->getPackageWeight()->setUnitOfMeasurement($unit);
    //             // Set Package Service Options
    //             $packageServiceOptions = new \Ups\Entity\PackageServiceOptions();
    //             // $packageServiceOptions->setShipperReleaseIndicator(true);
    //             $package->setPackageServiceOptions($packageServiceOptions);
    //             // Set dimensions
    //             $dimensions = new \Ups\Entity\Dimensions();
    //             $dimensions->setHeight($request->height); //yahan height aayegi
    //             $dimensions->setWidth($request->width); //yahan width aayegi
    //             $dimensions->setLength($request->length); //yahan length aayegi
    //             $unit = new \Ups\Entity\UnitOfMeasurement;
    //             $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);
    //             $dimensions->setUnitOfMeasurement($unit);
    //             $package->setDimensions($dimensions);
    //             // Add descriptions because it is a package
    //             $package->setDescription('Some Parcel');
    //             // Add this package
    //             $shipment->addPackage($package);
    //             // Set payment information
    //             $shipment->setPaymentInformation(new \Ups\Entity\PaymentInformation('prepaid', (object)array('AccountNumber' => '81AF12')));
    //             $label_data = Session::put('label_data',$shipment);
    //             $param = array();
    //             $param['ups_shipping_amount'] = $rate->getRate($shipment)->RatedShipment[0]->TotalCharges->MonetaryValue;
    //         } catch (Exception $e) {
    //             echo json_encode($e->getMessage());
    //         }  
    //         $request['shipping_amount'] = $param['ups_shipping_amount'];
    //         $request['weight'] = 5;
    //         $request['height'] = 5;
    //         $request['length'] = 5;
    //         $request['width'] = 5;
    //         $this->shipping_session($request->all());
    //         echo json_encode($param);
    //     }
    //     else{
    //         return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
    //     }
    // }

}



  
