<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Wishlist;
use App\Models\Config;
use App\Models\Review;
use App\Models\Products;
use App\Models\Category;

use App\Models\Password_resets;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function __construct()
    {
        $logo = imagetable::where('table_name','logo')->latest()->first();
        View()->share('logo',$logo);
        $vendor = Vendor::where('is_active',1)->get();
        View()->share('vendor',$vendor);
        $category = Category::where('is_active',1)->where('is_menu',1)->get();
        View()->share('categorya',$category);
        View()->share('config',$this->getConfig());
    }

    public function signin()
    {
        $banner = Imagetable::where('table_name','login-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('sign-in')->with('title','Login')->with(compact('banner'))->with('login_menu',true);
    }

    public function signin_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:255',
            'password' => 'required|max:50',
        ]);

        if ($validator->passes()) 
        {
            $email = User::where('email', $request->email)->first();
            if(!$email){
                return redirect()->back()->with('notify_error','Incorrupt Email');
            }elseif($email && ($email->email_verified_at == null)){
                $tok = rand ( 10000 , 99999 );
                $data = [
                    'tok' => $tok,
                    'user' => $email,
                    'title' => "Sign In Verification",
                ];
                $update = User::where('id', $email->id)->update(['verification_code' => $tok]);
                Mail::send('email.emailVerify', ['data' => $data], function($message) use($data){
                    $message->from(env('MAIL_FROM_ADDRESS'));
                    $message->to($data['user']->email);
                    $message->subject('Verification Email');
                });
                return redirect()->route('email-verification')->with('notify_error',' Email Varification required');
            }elseif($email && !Hash::check($request->password, $email->password)){
                return back()->with('notify_error','Invalid Credentials');
            }elseif($email && Hash::check($request->password, $email->password)){
                 
                $tok = rand ( 10000 , 99999 );
                $data = [
                    'tok' => $tok,
                    'user' => $email,
                    'title' => "Sign In Verification",
                ];
                $update = User::where('id', $email->id)->update(['verification_code' => $tok]);
                Mail::send('email.emailVerify', ['data' => $data], function($message) use($data){
                    $message->from(env('MAIL_FROM_ADDRESS'));
                    $message->to($data['user']->email);
                    $message->subject('Verification Email');
                });
                
                return redirect()->route('email-verification')->with('notify_error','Varification Code Sent on your Mail required');
                
            }
        }
        else
        {
            return back()->with('notify_error','Invalid Credentials');
        }
    }

    public function mail_vefify(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'verification' => 'required',
        ]);
        
        if ($validator->passes()) 
        {
            if(isset($request->user_id))
            {
                $user = User::where('id', $request->user_id)->where('verification_code',$request->verification)->first();
            }
            elseif(isset($request->email))
            {
                $user = User::where('email', $request->email)->where('verification_code',$request->verification)->first();   
            }

            if($user)
            {
                if($user->email_verified_at == null)
                {
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                }
                
                $user = Auth::loginUsingId($user->id);
                return redirect()->route('dashboard.index')->with('notify_success', "logIn Successfuly");
            }
            else
            {
                return redirect()->back()->with('notify_error','Invalid User');
            }
            
        }
        
    }
    
    public function signup()
    {
        $banner = Imagetable::where('table_name','signup-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('sign-up')->with('title','Sign Up')->with(compact('banner'))->with('login_menu',true);
    }

    public function signup_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/',
            ],
            'password_confirmation' => 'required|same:password',
            'email' => 'required|email|unique:users|max:255|',
       ]);

        if ($validator->passes()) 
        {

            $user = User::create([
                'fullname' => $request['fname'].' '.$request['lname'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            $tok = rand ( 10000 , 99999 );
            $data = [
                'tok' => $tok,
                'user' => $user,
                'title' => 'Email Verification'
            ];
            $update = User::where('id', $user->id)->update(['verification_code' => $tok]);
            
            Mail::send('email.emailVerify', ['data' => $data], function($message) use($data){
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->to($data['user']->email);
                $message->subject('Verification Email');
            });
    
            return redirect()->route('email-verification')->with('notify_success','Email Varification Code Sent on your Mail');
        }else{

            return redirect()->back()->with('notify_error',$validator->messages());
        }
    }

    public function signout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')->with('notify_success','Logged Out!');
    }

    /*****Panding***/ 
    public function contact_us_submit(Request $request)
    {
        $validator = $request->validate([
            
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $inquiry = Inquiry::create([
            'email'=> $request['email'],
            'message'=> $request['message']
        ]);
        // $external_email = Config::where('flag_type','EXTERNALEMAIL')->first();
      
        
        //   $data = [
        //         'no-reply' => $request->get('email'),
        //         'email'    => $request->get('email'),
        //         'message'    => $request->get('message'),
        //     ];
   
        //   \Mail::send('email.contact-temp', ['data' => $data],function ($message) use ($data){
        //         $message
        //             ->from($data['no-reply'])
        //             ->to($external_email['flag_value'])->subject('Inquiry|Edusaurus');
              
        //   });

    
        return redirect()->route('home')->with('notify_success','Inquiry Submitted!');
    }
    
    public function showForgetPasswordForm()
    {
        $banner = Imagetable::where('table_name','forgetpassword-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('forgot-password')->with('title','Forget Password')->with(compact('banner'));
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
          
        Mail::send('reset-password', ['token' => $token ,'request'=>$request], function($message) use($request){
            $message->from(env('MAIL_FROM_ADDRESS'));
            // $message->from('info@demo-websitedesignengine.com');
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        
        return back()->with('notify_success', 'We have e-mailed your password reset link!');
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->latest()->first();

        if(!$updatePassword){
            return back()->withInput()->with('notify_error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect()->route('sign-in')->with('notify_success', 'Your password has been changed!');
    }
    
    public function showResetPasswordForm($token) 
    { 
        $reset_email =  password_resets::where('token',$token)->first();
        $banner = Imagetable::where('table_name','forgetpassword-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('resetpasswordform', ['token' => $token,'email' => $reset_email])->with(compact('reset_email','banner'));
    }
    
    public function addToWishlist(Request $request)
    {
        $product =Products::where('id',$request['productid'])->where('is_active',1)->first();
        $wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$product->id)->first();
        if(isset($wishlist) && !empty($wishlist))
        {
            $wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$product->id)->delete();
            $param = ['status'=>2,'msg'=>'Product Removed From Wishlist'];
            return response()->json($param);
        }
        else
        {
            $wishlist = Wishlist::create([
                'user_id'=> Auth::id(),
                'product_id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'img_path'=>$product->img_path,
                'slug'=>$product->slug,
            ]);
            $param = ['status'=>1];
            return response()->json($param);
        }
    }
    
    public function removeFromWishlist(Request $request)
    {
        $wishlist = Wishlist::where('product_id',$request->productid)->where('user_id',Auth::id())->delete();
        $param = array();
        $param = ['status'=>1,'msg'=>'Product Removed From Wishlist'];
        echo json_encode($param);
    }
   
}
