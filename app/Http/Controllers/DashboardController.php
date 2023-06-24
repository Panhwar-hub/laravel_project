<?php
namespace App\Http\Controllers;

use View;
use Illuminate\Support\Str;
use App\Models\inquiry;
use App\Models\Orderrequest;
use App\Models\Imagetable;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Route;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Album;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Review;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Merchandise;
use App\Models\categories;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $logo = imagetable::where('table_name','logo')->latest()->first();
        $user = User::where('id',Auth::id())->with('img_tab')->first();
        View()->share('logo',$logo);
        View()->share('user',$user);
        View()->share('config',$this->getConfig());
    }

    public function dashboard()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        return view('userdash.dashboard.index')->with('title','My Dashboard')->with(compact('user'))
        ->with('dashMenu',true);
    }

    public function myProfile()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        return view('userdash.dashboard.myprofile')->with('title','My Profile')->with(compact('user'))
        ->with('myProfileMenu',true);
    }

    public function editprofile()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        return view('userdash.dashboard.edit-profile')->with('title','Edit Profile')->with(compact('user'))
        ->with('myProfileMenu',true);
    }

    public function saveprofile(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'country' => 'required',
        ]);  
        
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        $user->fullname= $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->country = $request->country;

        if(request()->hasFile('avatar')){
           $avatar = request()->file('avatar')->store('Uploads/avatar/'.Auth::user()->id.rand().rand(10,100), 'public');
           $user->img_path = $avatar;
        }
        $user->save(); 
        return redirect()->route('dashboard.editProfile')->with('notify_success','Profile Updated!');
    }

    public function delete_profile($id)
    {
        $id = Crypt::decryptString($id);
        $user = User::where('id',$id)->delete();

         return redirect()->route('home')->with('notify_success','Your acount deleted Successfuly!!');
    }

    public function reviews_listing()
    {
        $reviews = Review::where('user_id', Auth::id())->with(['reviewBelongsToUser','reviewBelongsToProducts','reviewBelongsToMerchandise'])->latest()->get();
        return view('userdash.dashboard.reviews-list')->with('title','Reviews Management')->with('reviews_menu',true)->with(compact('reviews'));
    }


    public function edit_reviews($decrypt)
    {
        $id = Crypt::decryptString($decrypt);
        $reviews = Review::where('id',$id)->first();
        // dd($review);
        return view('userdash.dashboard.edit-reviews')->with('title','Edit Reviews')->with('reviews_menu',true)->with(compact('reviews'));
    }

    public function savereviews(Request $request)
    {
        $request->validate([
            'review' => 'required|max:500',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $id = Crypt::decryptString($request->id);
        $review = Review::where('id',$id)->update([
            'review' =>  $request['review'],
            'name' => $request['name'],
            'email' => $request['email'],
            'rating' => $request['rating'],
        ]);

         return redirect()->route('dashboard.reviews_listing')->with('notify_success','Reviews Updated Successfuly!!');
    }

    
    public function suspend_reviews($id)
    {
        $reviews = Review::where('id',$id)->first();
        if($reviews->is_active == 0)
        {
            $reviews->is_active= 1;
            $reviews->save();
            return redirect()->route('userdash.dashboard.reviews-list')->with('notify_success','Reviews Activated Successfuly!!');
        }
        else{
            $reviews->is_active= 0;
            $reviews->save();
            return redirect()->route('userdash.dashboard.reviews-list')->with('notify_success','Reviews Suspended Successfuly!!');
        }
    }

    public function delete_reviews($id)
    {
        $reviews = Review::where('id',$id)->delete();
        return redirect()->route('userdash.dashboard.reviews-list')->with('notify_success','Reviews Deleted Successfuly!!');
       
    }

    public function myorders()
    {
        $orders = Orders::where('user_id',Auth::id())->with('orderHasDetail')->get();
        return view('userdash.dashboard.mybooking')->with('title','My Orders')->with(compact('orders'))
        ->with('mybookingMenu',true);
    }

    public function vieworders($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $orders=Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('orderHasDetail')->first();
       
        if(!empty($orders) && isset($orders))
        {
            $order_detail = unserialize($orders->orderHasDetail->details);
            return view('userdash.dashboard.viewbooking')->with('title','View Order')->with(compact('orders','order_detail'))->with('mybookingMenu',true);
        }
        else{
            return back()->with('notify_error', 'No Details Found!');
        }
    }

    public function deleteorders($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $orders=Orders::where('id',$decrypted)->where('user_id',Auth::id())->with('orderHasDetail')->delete();
        return back()->with('notify_success', 'Order Deleted!');
    }

    public function mybookings()
    {
        $bookings = Booking::where('user_id',Auth::id())->get();
        return view('userdash.dashboard.orderbooking')->with('title','My Bookings')->with(compact('bookings'))
        ->with('orderbookingMenu',true);
    }

    public function viewbookings($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $bookings=Booking::where('id',$decrypted)->where('user_id',Auth::id())->first();
        return view('userdash.dashboard.vieworderbooking')->with('title','View Booking')->with(compact('bookings'))->with('orderbookingMenu',true);
    }

    public function deletebookings($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $bookings=Booking::where('id',$decrypted)->where('user_id',Auth::id())->delete();
        return back()->with('notify_success', 'Booking Deleted!');
    }

    public function passwordchange()
    {
        $user = User::where('id',Auth::id())->with('img_tab')->first(); 
        return view('userdash.dashboard.password-change')->with('title','Change Password')->with(compact('user'))->with('passChangeMenu',true);
    }

    public function updatepassword(Request $request)
    {
       $validator = $request->validate([
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::where('id', Auth::id())->first();
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect()->route('dashboard.passwordChange')->with('notify_success','Password Updated!');
    }

    public function myWishlist()
    {
       $wishlist = Wishlist::where('user_id',Auth::id())->get();
       return view('userdash.dashboard.wishlist.index')->with('title','My Wishlist')->with('mywishlistMenu',true)->with(compact('wishlist'));
    }
  
    public function refund()
    {
        $orderrequest = Orderrequest::where(['user_id' => Auth::id() , 'request_type' => 2 ])->get();
        return view('userdash.dashboard.refund.index')->with('title','Refund Management')->with(compact('orderrequest'))->with('refundMenu',true);
    }

    public function request_form()
    {
        return view('userdash.dashboard.refund.add')->with('title','Add Request')->with('refund')->with('refundMenu',true);
    }

    public function submitrequest(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'reason' => 'required'
        ]);  

        $Orderrequest =Orderrequest::create([
            'request_type' => $request['request_type'],
            'order_id' => $request['order_id'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'reason' => $request['reason'],
            'user_id' => Auth::id(),
        ]);
  
        if($Orderrequest->request_type == 2){
            return redirect()->route('dashboard.refund')->with('notify_success','Request Generated Successfuly!!');
        }
        if($Orderrequest->request_type == 1){
            return redirect()->route('dashboard.return')->with('notify_success','Request Generated Successfuly!!');
        }
        if($Orderrequest->request_type == 0){
            return redirect()->route('dashboard.ordercancel')->with('notify_success','Request Generated Successfuly!!');
        }   
    }

    public function return()
    {
        $orderrequest = Orderrequest::where(['user_id' => Auth::id() , 'request_type' => 1 ])->get();
        return view('userdash.dashboard.return.index')->with('title','Refund Management')->with(compact('orderrequest'))->with('returnMenu',true);
    }
   
    public function request_formreturn()
    {
        return view('userdash.dashboard.return.add')->with('title','Add Request')->with('refund')->with('returnMenu',true);
    } 

    public function ordercancel()
    {
        $orderrequest = Orderrequest::where(['user_id' => Auth::id() , 'request_type' => 0 ])->get();
        return view('userdash.dashboard.cancel.index')->with('title','Order Cancel Management')->with(compact('orderrequest'))->with('cancelMenu',true);
    }
   
    public function request_formcancel()
    {
        return view('userdash.dashboard.cancel.add')->with('title','Add Request')->with('refund')->with('cancelMenu',true);
    } 

}