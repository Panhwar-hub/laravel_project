<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Session;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;
use Hash;
use App\Rules\PasswordMatch;
use App\Models\Imagetable;
use Illuminate\Support\MessageBag;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name','logo')->latest()->first();
        View()->share('logo',$logo);
        View()->share('config',$this->getConfig());
    }
    public function get_login()
    {
       if(Auth::guard('admin')->check()){
           if(Auth::guard('admin')->user()->type == 1)
           {
               return redirect()->route('admin.dashboard')->with('notify_success','You are already logged in as Admin');
           }
           else
           {
                return redirect()->route('admin.dashboard')->with('notify_success','You are already logged in as Admin');
           }

        }
        return view('admin.login')->with('title','Admin Login');
    }

    public function performLogin(Request $request, MessageBag $message_bag){
        if(Auth::guard('admin')->check()){
            
            if(Auth::guard('admin')->user()->type == 1)
            {
               return redirect()->route('admin.dashboard')->with('notify_success','You are already logged in as Admin');
            }
            else
            {
                return redirect()->route('admin.dashboard')->with('notify_success','You are already logged in as Admin');
            }
        }

        if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password'=> $request->password])){
            return redirect()->route('admin.dashboard')->with('notify_success','You are already logged in as Admin');
           
        } else {
            return redirect()->back()->withInput($request->input())->with('notify_error','Invalid Credentials');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('notify_success','Logged Out!');
    }
}
