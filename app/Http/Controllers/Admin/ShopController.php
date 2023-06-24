<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Crawls;
use App\Models\Keywords;
use App\Http\Requests\AdminLoginRequest;

use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Lesson;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Variationimage;
use App\Models\Category;
use App\Models\Album;
use App\Models\Review;
use App\Models\Photos;
use App\Models\Brand;
use App\Models\Sub_category;
use App\Models\Feature;
use App\Models\Type;
use App\Models\Country;
use App\Models\Address;

use Auth;
use App\Models\Faq;
use App\Models\ShopImage;
use App\Models\Size;
use App\Models\Color;
use App\Models\Vendor;
use App\Models\Variation;
use App\Models\Products;
use App\Models\Merchandise;
use App\Rules\PasswordMatch;
use Illuminate\Support\MessageBag;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class ShopController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name','logo')->latest()->first();
        View()->share('logo',$logo);
        View()->share('config',$this->getConfig());
    }

    public function get_sub_cat(Request $request)
    {
        $sub_cat  = Sub_category::where('is_active',1)->where('category_id',$request->cat_id)->get(); 
        $param = array();
        if(sizeof($sub_cat) > 0)
        {
            $param = ['status'=>1,'data'=>$sub_cat];
            return response()->json($param);
        }
        else
        {
            $param = ['status'=>0];
            return response()->json($param);
        }
    }

    /******************Product Listing**********************/ 
    public function products_listing()
    {
        $products = Products::with(['productBelongsToCategory','productBelongsToSubCategory'])->get();
        return view('admin.products-management.list')->with('title','Products Management')->with('products_menu',true)->with(compact('products'));
    }

    public function add_products()
    {
        $countries = Country::orderBy('id', 'desc')->get();
        $cat = Category::where('is_active',1)->get();
        $feature = Feature::where('is_active',1)->get();
        $address = Address::where('is_active',1)->get();
        $type = Type::where('is_active',1)->get();
        return view('admin.products-management.add')->with('title','Add Products')->with(compact('feature','cat','type', 'countries', 'address'))->with('products_menu',true);
    }
    
    public function get_products(Request $request)
    {
        $products  = Products::where('is_active',1)->where('category_id',$request->category_id)->get(); 
        $param = array();
        if(sizeof($products) > 0)
        {
            $param = ['status'=>1,'data'=>$products];
            return response()->json($param);
        }
        else{
            $param = ['status'=>0];
            return response()->json($param);
        }
    }

    public function get_type_feature(Request $request)
    {
        $type  = Type::where('is_active',1)->where('category_id',$request->cat_id)->get(); 
        $feature  = Feature::where('is_active',1)->where('category_id',$request->cat_id)->get(); 
        $address  = Address::where('is_active',1)->where('category_id',$request->cat_id)->get();
        
        $param = ['status'=>1,'type'=>$type,'feature'=>$feature,'address'=>$address];
        return response()->json($param);
    }
    
    public function create_products(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            // 'price' => 'required',
            'main_image' => 'required|mimes:jpeg,jpg,png,gif,webp',
        ],[
        ]);
        
        if ($validator->passes()) {  
            $pro = Products::where('slug', $request['slug'])->first();
            if($pro){
                return redirect()->back()->with('notify_error', 'Product already exists');
            }
            $color = null;
            $size = null;
            $products = Products::create([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                // 'price' => $request['price'],
                'category_id' =>  $request['category'],
                'start_time'=>  $request['start_time'],
                'end_time' =>  $request['end_time'],

                'outdoor' =>  $request['outdoor']??0,
                'delivery' =>  $request['delivery']??0,
                'takeout' =>  $request['takeout']??0,

                'country' =>  $request['country'],
                'city' =>  $request['city'],
                'state' =>  $request['state'],
                'area' =>  $request['area'],
                'zip_code' =>  $request['zip_code'],
                'address' =>  $request['address'],

                'consert' =>  $request['consert'],
                'status' =>  $request['status'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'live_streaming' =>  $request['live_streaming'],
                
            ]);
            
            if($request->feature){
                $product = Products::where('id',$products->id)->update([
                    'feature' => serialize($request->feature)
                ]);
            }

            if($request->type){
                $product = Products::where('id',$products->id)->update([
                    'suggestion' => serialize($request->type)
                ]);
            }
            
            if($request['category'] == 1){
                $monday = [$request->monday_from, $request->monday_to];
                $tuesday = [$request->tuesday_from, $request->tuesday_to];
                $wednesday = [$request->wednesday_from, $request->wednesday_to];
                $thrusday = [$request->thrusday_from, $request->thrusday_to];
                $friday = [$request->friday_from, $request->friday_to];
                $saturday = [$request->saturday_from, $request->saturday_to];
                $sunday = [$request->sunday_from, $request->sunday_to];
                
                $product = Products::where('id',$products->id)->update([
                    'Monday' => serialize($monday),
                    'Tuesday' => serialize($tuesday),
                    'Wednesday' => serialize($wednesday),
                    'Thrusday' => serialize($thrusday),
                    'Friday' => serialize($friday),
                    'Saturday' => serialize($saturday),
                    'Sunday' => serialize($sunday),
                ]);
            }

            if(request()->hasFile('main_image')){
                $main_image = request()->file('main_image')->store('Uploads/products/main_image/'.$products->id.rand().rand(10,100), 'public');
                $image = Products::where('id',$products->id)->update(
                [
                    'img_path' => $main_image,
                ]);
            }
            if(request()->hasFile('other_image')){
                $documents = $request->file('other_image');  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/products/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'products',
                        'img_path' => $image,
                        'ref_id' => $products->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Product Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function delete_multiimg($id)
    {
        $delete_img = ShopImage::where('id',$id)->delete();
        return back()->with('notify_success','Image Deleted!');
    }

    public function edit_products($slug)
    {
        $countries = Country::all();
        $product = Products::where('slug',$slug)->with(['productsHasMultiImages','productBelongsToCategory','productBelongsToSubCategory'])->first();
        $colors = Color::where('is_active',1)->get();
        $cat = Category::where('is_active',1)->get();
        $brand = Brand::where('is_active',1)->get();
        
        $feature = Feature::where('is_active',1)->get();
        $type = Type::where('is_active',1)->get();
        $address = Address::where('category_id', $product->category_id)->where('is_active',1)->get();
        return view('admin.products-management.edit')->with('title','Edit Product')->with('products_menu',true)
        ->with(compact('product','colors','cat','brand', 'countries', 'feature', 'type', 'address'));
    }

    public function saveproducts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            // 'price' => 'required',
            // 'start_time' => 'required',
            // 'end_time' => 'required',
        ],[
        ]);      
        if ($validator->passes()) { 
           
            $products = Products::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                // 'price' => $request['price'],
                'category_id' =>  $request['category'],
                'start_time'=>  $request['start_time'],
                'end_time' =>  $request['end_time'],

                'outdoor' =>  $request['outdoor']??0,
                'delivery' =>  $request['delivery']??0,
                'takeout' =>  $request['takeout']??0,

                'country' =>  $request['country'],
                'city' =>  $request['city'],
                'state' =>  $request['state'],
                'area' =>  $request['area'],
                'zip_code' =>  $request['zip_code'],
                'address' =>  $request['address'],

                'consert' =>  $request['consert'],
                'status' =>  $request['status'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'live_streaming' =>  $request['live_streaming'],
            ]);
            if($request->feature){
                $product = Products::where('id',$request->id)->update([
                    'feature' => serialize($request->feature)
                ]);
            }

            if($request->type){
                $product = Products::where('id',$request->id)->update([
                    'suggestion' => serialize($request->type)
                ]);
            }
            
            if($request['category'] == 1){
                $monday = [$request->monday_from, $request->monday_to];
                $tuesday = [$request->tuesday_from, $request->tuesday_to];
                $wednesday = [$request->wednesday_from, $request->wednesday_to];
                $thrusday = [$request->thrusday_from, $request->thrusday_to];
                $friday = [$request->friday_from, $request->friday_to];
                $saturday = [$request->saturday_from, $request->saturday_to];
                $sunday = [$request->sunday_from, $request->sunday_to];
                
                $product = Products::where('id',$request->id)->update([
                    'Monday' => serialize($monday),
                    'Tuesday' => serialize($tuesday),
                    'Wednesday' => serialize($wednesday),
                    'Thrusday' => serialize($thrusday),
                    'Friday' => serialize($friday),
                    'Saturday' => serialize($saturday),
                    'Sunday' => serialize($sunday),
                ]);
            }

            if(request()->hasFile('main_image')){
                $validator = Validator::make($request->all(),[
                    'main_image' => 'required|mimes:jpeg,jpg,png,gif,webp',
                ]);      
                $main_image = request()->file('main_image')->store('Uploads/products/main_image/'.$request->id.rand().rand(10,100), 'public');
                $image = Products::where('id',$request->id)->update(
                [
                    'img_path' => $main_image,
                ]);
            }
            if(request()->hasFile('other_image')){
                $validator = Validator::make($request->all(),[
                    'other_image' =>'required',
                    'other_image.*' => 'image|mimes:jpeg,png,jpg'
                ]);  
                $documents = $request->file('other_image');
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/products/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'products',
                        'img_path' => $image,
                        'ref_id' => $request->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Product Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_products($id)
    {
        $products = Products::where('id',$id)->first();
        if($products->is_active == 0)
        {
            $products->is_active= 1;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Activated Successfuly!!');
        }
        else
        {
            $products->is_active= 0;
            $products->save();
            return redirect()->route('admin.products_listing')->with('notify_success','Product Suspended Successfuly!!');
        }
    }

    public function delete_products($id)
    {
        $products = Products::where('id',$id)->delete();
        return redirect()->route('admin.products_listing')->with('notify_success','Product Deleted Successfuly!!');
    }

    /******************Type Listing**********************/ 
    public function type_listing()
    {
        
        $type = Type::with('typeBelongsToCategory')->get();
        return view('admin.type-management.list')->with('title','type Management')->with('type_menu',true)->with(compact('type'));
    }

    public function add_type()
    {
        $cat = Category::where('is_active',1)->get();
        return view('admin.type-management.add')->with('title','Add type')->with(compact('cat'))->with('type_menu',true);
    }
    
    public function get_type(Request $request)
    {
        $type  = Type::with('typeBelongsToCategory')->where('is_active',1)->where('category_id',$request->category_id)->get(); 
        $param = array();
        if(sizeof($type) > 0)
        {
            $param = ['status'=>1,'data'=>$type];
            return response()->json($param);
        }
        else
        {
            $param = ['status'=>0];
            return response()->json($param);
        }
    }
    
    public function create_type(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
        ],[
        ]);
        if ($validator->passes()) {  
            $type = Type::create([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);

            return response()->json(['msg' => 'Product Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function edit_type($slug)
    {
        $type = Type::where('slug',$slug)->with(['typeBelongsToCategory'])->first();
        $cat = Category::where('is_active',1)->get();
        return view('admin.type-management.edit')->with('title','Edit Product')->with('type_menu',true)
        ->with(compact('type','cat'));
    }

    public function savetype(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
        ],[
        ]);      
        if ($validator->passes()) { 
            $check_slug = Type::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            $type = Type::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);
            return response()->json(['msg' => 'Product Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_type($id)
    {
        $type = Type::where('id',$id)->first();
        if($type->is_active == 0)
        {
            $type->is_active= 1;
            $type->save();
            return redirect()->route('admin.type_listing')->with('notify_success','Product Activated Successfuly!!');
        }
        else
        {
            $type->is_active= 0;
            $type->save();
            return redirect()->route('admin.type_listing')->with('notify_success','Product Suspended Successfuly!!');
        }
    }

    public function delete_type($id)
    {
        $type = Type::where('id',$id)->delete();
        return redirect()->route('admin.type_listing')->with('notify_success','Product Deleted Successfuly!!');
    }


    /******************Feature Listing**********************/ 
    public function feature_listing()
    {
        $feature = Feature::with(['featureBelongsToCategory'])->get();
        return view('admin.feature-management.list')->with('title','Feature Management')->with('feature_menu',true)->with(compact('feature'));
    }

    public function add_feature()
    {
        $cat = Category::where('is_active',1)->get();
        return view('admin.feature-management.add')->with('title','Add feature')->with(compact('cat'))->with('feature_menu',true);
    }
    
    public function get_feature(Request $request)
    {
        $feature  = Feature::where('is_active',1)->where('category_id',$request->category_id)->get(); 
        $param = array();
        if(sizeof($feature) > 0)
        {
            $param = ['status'=>1,'data'=>$feature];
            return response()->json($param);
        }
        else{
            $param = ['status'=>0];
            return response()->json($param);
        }
    }
    
    public function create_feature(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
        ],[
        ]);
        
        if ($validator->passes()) {  
            $feature = Feature::create([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);
            return response()->json(['msg' => 'Product Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function edit_feature($slug)
    {
        $feature = Feature::where('slug',$slug)->with(['featureBelongsToCategory'])->first();
        $cat = Category::where('is_active',1)->get();
        return view('admin.feature-management.edit')->with('title','Edit feature')->with('feature_menu',true)
        ->with(compact('feature','cat'));
    }

    public function savefeature(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
        ],[
        ]);      
        if ($validator->passes()) { 
            $check_slug = Feature::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            $feature = Feature::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);
            return response()->json(['msg' => 'Product Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_feature($id)
    {
        $feature = Feature::where('id',$id)->first();
        if($feature->is_active == 0)
        {
            $feature->is_active= 1;
            $feature->save();
            return redirect()->route('admin.feature_listing')->with('notify_success','Product Activated Successfuly!!');
        }
        else
        {
            $feature->is_active= 0;
            $feature->save();
            return redirect()->route('admin.feature_listing')->with('notify_success','Product Suspended Successfuly!!');
        }
    }

    public function delete_feature($id)
    {
        $feature = Feature::where('id',$id)->delete();
        return redirect()->route('admin.feature_listing')->with('notify_success','Product Deleted Successfuly!!');
    }
    /************       Feature        ***********/ 
    
    
    /******************Address Listing**********************/ 
    public function address_listing()
    {
        $address = Address::with('addressBelongsToCategory')->get();
        return view('admin.address-management.list')->with('title','address Management')->with('address_menu',true)->with(compact('address'));
    }

    public function add_address()
    {
        $cat = Category::where('is_active',1)->get();
        return view('admin.address-management.add')->with('title','Add address')->with(compact('cat'))->with('address_menu',true);
    }

    public function create_address(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'address' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
        ],[
        ]);
        if ($validator->passes()) {  
            $address = Address::create([
                'address' =>  $request['address'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);

            return response()->json(['msg' => 'Product Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function edit_address($slug)
    {
        $address = Address::where('slug',$slug)->with(['addressBelongsToCategory'])->first();
        $cat = Category::where('is_active',1)->get();
        return view('admin.address-management.edit')->with('title','Edit Product')->with('address_menu',true)
        ->with(compact('address','cat'));
    }

    public function saveaddress(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'address' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ],[
        ]);      
        if ($validator->passes()) { 
            $check_slug = Address::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            $address = Address::where('id',$request->id)->update([
                'address' =>  $request['address'],
                'slug' =>  $request['slug'],
                'category_id' =>  $request['category_id'],
            ]);
            return response()->json(['msg' => 'Product Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }
    
    public function suspend_address($id)
    {
        $address = Address::where('id',$id)->first();
        if($address->is_active == 0)
        {
            $address->is_active= 1;
            $address->save();
            return redirect()->route('admin.address_listing')->with('notify_success','Product Activated Successfuly!!');
        }
        else
        {
            $address->is_active= 0;
            $address->save();
            return redirect()->route('admin.address_listing')->with('notify_success','Product Suspended Successfuly!!');
        }
    }

    public function delete_address($id)
    {
        $address = Address::where('id',$id)->delete();
        return redirect()->route('admin.address_listing')->with('notify_success','Product Deleted Successfuly!!');
    }
    /******************Address Listing**********************/
    
    
    public function merchandise_listing()
    {
        $merchandise = Merchandise::with('merchandiseBelongsToCategory')->get();
        return view('admin.merchandise-management.list')->with('title','Merchandise Management')->with('merchandise_menu',true)->with(compact('merchandise'));
    }

    public function add_merchandise()
    {
        $categories = Category::where('is_active',1)->get();
        return view('admin.merchandise-management.add')->with('title','Add Merchandise')->with(compact('categories'))->with('merchandise_menu',true);
    }

    public function create_merchandise(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required|unique:merchandise',
            'price' => 'required',
            'qty' => 'required|numeric|min:1',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'info_desc' => 'required',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'depth' => 'required|numeric|min:1',
            'weight_pound' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'category' => 'required',
            'main_image' => 'required|mimes:jpeg,jpg,png,gif,webp',
            'other_image' =>'required',
            'other_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp'
        ]);      
        if ($validator->passes()) {  
            $merchandise = Merchandise::create([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'price' => $request['price'],
                'qty' =>  $request['qty'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'info_desc' =>  $request['info_desc'],
                'width' =>  $request['width'],
                'height' =>  $request['height'],
                'depth' =>  $request['depth'],
                'weight_pound' =>  $request['weight_pound'],
                'weight_kg' =>  $request['weight_kg'],
                'category_id' =>  $request['category'],
            ]);
            if(request()->hasFile('main_image')){
                $main_image = request()->file('main_image')->store('Uploads/merchandise/main_image/'.$merchandise->id.rand().rand(10,100), 'public');
                $image = ShopImage::create(
                [
                    'cat_type' => 'merchandise',
                    'img_path' => $main_image,
                    'ref_id' => $merchandise->id,
                    'img_type' => 1
                ]);
            }
            if(request()->hasFile('other_image')){
                $documents = $request->file('other_image');  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/merchandise/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'merchandise',
                        'img_path' => $image,
                        'ref_id' => $merchandise->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Merchandise Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function edit_merchandise($slug)
    {
        $merchandise = Merchandise::where('slug',$slug)->with(['merchandiseBelongsToCategory','merchandiseHasMainImage','merchandiseHasMultiImages'])->first();
        $categories = Category::where('is_active',1)->get();
        return view('admin.merchandise-management.edit')->with('title','Edit Merchandise')->with('merchandise_menu',true)->with(compact('merchandise','categories'));
    }

    public function savemerchandise(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required',
            'price' => 'required',
            'qty' => 'required|numeric|min:1',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'info_desc' => 'required',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'depth' => 'required|numeric|min:1',
            'weight_pound' => 'required|numeric',
            'weight_kg' => 'required|numeric',
            'category' => 'required',
        ]);      
        if ($validator->passes()) { 
            $check_slug = Merchandise::where('slug',$request->slug)->where('id','!=',$request->id)->first();
            if($check_slug)
            {
                return response()->json(['error'=>'Unique Slug Is Required!','status' => 2]);
            } 
            $merchandise = Merchandise::where('id',$request->id)->update([
                'name' =>  $request['name'],
                'slug' =>  $request['slug'],
                'price' => $request['price'],
                'qty' =>  $request['qty'],
                'short_desc' =>  $request['short_desc'],
                'long_desc' =>  $request['long_desc'],
                'info_desc' =>  $request['info_desc'],
                'width' =>  $request['width'],
                'height' =>  $request['height'],
                'depth' =>  $request['depth'],
                'weight_pound' =>  $request['weight_pound'],
                'weight_kg' =>  $request['weight_kg'],
                'category_id' =>  $request['category'],
            ]);

            if(request()->hasFile('main_image')){
                $validator = Validator::make($request->all(),[
                    'main_image' => 'required|mimes:jpeg,jpg,png,gif,webp',
                ]);      
                $main_image = request()->file('main_image')->store('Uploads/merchandise/main_image/'.$request->id.rand().rand(10,100), 'public');
                $delete_img = ShopImage::where('cat_type','merchandise')->where('ref_id',$request->id)->where('img_type',1)->delete();
                $image = ShopImage::create(
                [
                    'cat_type' => 'merchandise',
                    'img_path' => $main_image,
                    'ref_id' => $request->id,
                    'img_type' => 1
                ]);
            }
            if(request()->hasFile('other_image')){
                $validator = Validator::make($request->all(),[
                    'other_image' =>'required',
                    'other_image.*' => 'image|mimes:jpeg,png,jpg'
                ]);  
                $documents = $request->file('other_image');
                $delete_img = ShopImage::where('cat_type','merchandise')->where('ref_id',$request->id)->where('img_type',2)->delete();  
                foreach($documents as $index  => $p)
                {
                    $file_name =  $request->file('other_image')[$index]->getClientOriginalName();   
                    $image =   $request->file('other_image')[$index]->store('Uploads/merchandise/other_image/'.rand().rand(10,1000), 'public');
                    $other_image = ShopImage::create (
                    [
                        'cat_type' => 'merchandise',
                        'img_path' => $image,
                        'ref_id' => $request->id,
                        'img_type' => 2
                    ]);
                }
            }
            return response()->json(['msg' => 'Merchandise Updated Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function suspend_merchandise($id)
    {
        $merchandise = Merchandise::where('id',$id)->first();
        if($merchandise->is_active == 0)
        {
            $merchandise->is_active= 1;
            $merchandise->save();
            return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Activated Successfuly!!');
        }
        else{
            $merchandise->is_active= 0;
            $merchandise->save();
            return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Suspended Successfuly!!');
        }
    }

    public function delete_merchandise($id)
    {
        $merchandise = Merchandise::where('id',$id)->with(['merchandiseHasMainImage','merchandiseHasMultiImages'])->delete();
        return redirect()->route('admin.merchandise_listing')->with('notify_success','Merchandise Deleted Successfuly!!');
    }

    /**************Color***********************/ 
    public function suspend_color($id)
    {
        $color =Color::where('id',$id)->first();
        if($color->is_active == 0)
        {
            $color->is_active= 1;
            $color->save();
            return redirect()->route('admin.color_listing')->with('notify_success','Color Activated Successfuly!!');
        }
        else{
            $color->is_active= 0;
            $color->save();
            return redirect()->route('admin.color_listing')->with('notify_success','Color Suspended Successfuly!!');
        }
    }

    public function delete_color($id)
    {
        $color = Color::where('id',$id)->delete();
        return redirect()->route('admin.color_listing')->with('notify_success','Color Deleted Successfuly!!');
    }

    public function color_listing()
    {
        $color = Color::with('productBelongsToColor')->latest()->get();
        return view('admin.color-management.list')->with('title','Color Management')->with('color_menu',true)->with(compact('color'));
    }

    public function add_color()
    {
        $products = Products::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        return view('admin.color-management.add')->with('title','Add Flavor')->with('flavor_menu',true)->with(compact('products', 'categories'));
    }

    public function create_color(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'qty' => 'required',
            
        ]);  

        $color = Color::create([
            'product_id' => $request['product_id'],
            'name' => $request['name'],
            'code' => $request['code'],
            'price' => $request['price'],
            'qty' => $request['qty'],
            
        ]);
        return redirect()->route('admin.color_listing')->with('notify_success','Color Created Successfuly!!');
    }

    public function edit_color($id)
    {

        $color = Color::where('id',$id)->with('productBelongsToColor')->first();
        return view('admin.color-management.edit')->with('title','Edit Color')->with('color_menu',true)->with(compact('color'));
    }

    public function savecolor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);  

        $flavor = Color::where('id',$request->id)->update([
            'name' => $request['name'],
            'code' => $request['code'],
            'price' => $request['price'],
            'qty' => $request['qty'],
        ]);

        return redirect()->route('admin.color_listing')->with('notify_success','Flavor Updated Successfuly!!');
    }
    /**************Color ENd*************************/

    public function suspend_size($id)
    {
        $size = Size::where('id',$id)->first();
        if($size->is_active == 0)
        {
            $size->is_active= 1;
            $size->save();
            return redirect()->route('admin.size_listing')->with('notify_success','Size Activated Successfuly!!');
        }
        else{
            $size->is_active= 0;
            $size->save();
            return redirect()->route('admin.size_listing')->with('notify_success','Size Suspended Successfuly!!');
        }
    }

    public function delete_size($id)
    {
        $size = Size::where('id',$id)->delete();
        return redirect()->route('admin.size_listing')->with('notify_success','Size Deleted Successfuly!!');
       
    }

    public function size_listing()
    {
        $size = Size::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.list')->with('title','Size Management')->with('size_menu',true)->with(compact('size'));
    }

    public function add_size()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.add')->with('title','Add Size')->with('size_menu',true);
    }

    public function create_size(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            // 'type' => 'required',
        ]);  

        $size = Size::create([
            // 'faq_type_id' => $request['type'],
            'name' => $request['name'],
            'code' => $request['code'],
           
           
        ]);

       

          return redirect()->route('admin.size_listing')->with('notify_success','Size Created Successfuly!!');
    }

    public function edit_size($id)
    {
        $size = Size::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.size-management.edit')->with('title','Edit Size')->with('size_menu',true)->with(compact('size'));
    }

    public function savesize(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);  

        $size = Size::where('id',$request->id)->update([
            'name' => $request['name'],
            'code' => $request['code'],
        ]);

        return redirect()->route('admin.size_listing')->with('notify_success','Size Updated Successfuly!!');
    }

    public function suspend_variation($id)
    {
        $variation = Variation::where('id',$id)->first();
        if($variation->is_active == 0)
        {
            $variation->is_active= 1;
            $variation->save();
            return redirect()->route('admin.variation_listing')->with('notify_success','Variation Activated Successfuly!!');
        }
        else{
            $variation->is_active= 0;
            $variation->save();
            return redirect()->route('admin.variation_listing')->with('notify_success','Variation Suspended Successfuly!!');
        }
    }

    public function delete_variation($id)
    {
        $variation = Variation::where('id',$id)->delete();
        return redirect()->route('admin.variation_listing')->with('notify_success','Variation Deleted Successfuly!!');
       
    }

    public function variation_listing()
    {
        $variation = Variation::with('variationBelongsToColor','variationBelongsToProduct','variationBelongsToSize')->latest()->get();
        return view('admin.variation-management.list')->with('title','Variation Management')->with('variation_menu',true)->with(compact('variation'));
    }

    public function add_variation()
    {
        $products = Products::where('is_active',1)->latest()->get();
        $color = Flavor::where('is_active',1)->latest()->get();
        $size = Size::where('is_active',1)->latest()->get();
        return view('admin.variation-management.add')->with('title','Add Variation')->with('variation_menu',true)->with(compact('products','color','size'));
    }

    public function create_variation(Request $request)
    {
        $request->validate([
                'product'=> 'required',
                'color'=> 'required',
                'size_id' => 'required|unique:variation,size_id',
            ],
            [
                'size_id.unique'=> 'The size has already been taken',
            ]
        );  

        $variation = Variation::create([
            'product_id' => $request['product'],
            'color_id' => $request['color'],
            'size_id' => $request['size_id'],
            'stock' => $request['stock'],
        ]);
        return redirect()->route('admin.variation_listing')->with('notify_success','Variation Created Successfuly!!');
    }

    public function edit_variation($id)
    {
        $variation = Variation::where('id',$id)->with('variationBelongsToColor','variationBelongsToProduct','variationBelongsToSize')->first();
        $products = Products::where('is_active',1)->latest()->get();
        $color = Flavor::where('is_active',1)->latest()->get();
        $size = Size::where('is_active',1)->latest()->get();
        $id =$id;
        return view('admin.variation-management.edit')->with('title','Edit Variation')->with('variation_menu',true)->with(compact('variation','products','color','size','id'));
    }

    public function savevariation(Request $request)
    {
        $request->validate([
            'product'=> 'required',
            'color'=> 'required',
            'size_id' => 'required',
        ]);  

        $variation = Variation::where('id',$request->id)->update([
            'product_id' => $request['product'],
            'color_id' => $request['color'],
            'size_id' => $request['size_id'],
            'stock' => $request['stock'],
        ]);

        return redirect()->route('admin.variation_listing')->with('notify_success','Variation Updated Successfuly!!');
    }

    public function suspend_variationimage($id)
    {
        $variationimage = Variationimage::where('id',$id)->first();
        if($variationimage->is_active == 0)
        {
            $variationimage->is_active= 1;
            $variationimage->save();
            return redirect()->route('admin.variationimage_listing')->with('notify_success','Variation Image Activated Successfuly!!');
        }
        else{
            $variationimage->is_active= 0;
            $variationimage->save();
            return redirect()->route('admin.variationimage_listing')->with('notify_success','Variation Image Suspended Successfuly!!');
        }
    }

    public function delete_variationimage($id)
    {
        $variationimage = Variationimage::where('id',$id)->with('variationimageBelongsToColor','variationimageBelongsToProduct','variationimageBelongsToSize')->delete();
        return redirect()->route('admin.variationimage_listing')->with('notify_success','Variation Image Deleted Successfuly!!');
       
    }

    public function variationimage_listing()
    {
        $variationimage = Variationimage::with('variationimageBelongsToColor','variationimageBelongsToProduct','variationimageBelongsToSize')->latest()->get();
        return view('admin.variation-image-management.list')->with('title','Variation Image Management')->with('variationimage_menu',true)->with(compact('variationimage'));
    }

    public function add_variationimage()
    {
        $products = Products::where('is_active',1)->latest()->get();
        $color = Flavor::where('is_active',1)->latest()->get();
        $size = Size::where('is_active',1)->latest()->get();
        return view('admin.variation-image-management.add')->with('title','Add Variation Image')->with('variation_menu',true)->with(compact('products','color','size'));
    }

    public function create_variationimage(Request $request)
    {
        $request->validate([
            'product'=> 'required',
            'color'=> 'required',
            'main_image' => 'required|mimes:jpeg,jpg,png,gif,webp',
        ]);  

        $variationimage = Variationimage::create([
            'product_id' => $request['product'],
            'color_id' => $request['color'],
        ]);

        if(request()->hasFile('main_image')){
            $main_image = request()->file('main_image')->store('Uploads/variationimage/image/'.$variationimage->id.rand().rand(10,100), 'public');
            $image = Variationimage::where('id',$variationimage->id)->update(
            [
                'img_path' => $main_image,
            ]);
        }
        return redirect()->route('admin.variationimage_listing')->with('notify_success','Variation Image Created Successfuly!!');
    }

    public function edit_variationimage($id)
    {
        $variationimage = Variationimage::where('id',$id)->first();
        $products = Products::where('is_active',1)->latest()->get();
        $color = Flavor::where('is_active',1)->latest()->get();
        $size = Size::where('is_active',1)->latest()->get();
        return view('admin.variation-image-management.edit')->with('title','Edit Variation Image')->with('variationimage_menu',true)->with(compact('variationimage','products','color','size'));
    }

    public function savevariationimage(Request $request)
    {
        $request->validate([
            'product'=> 'required',
            'color'=> 'required',
        ]);  

        $variation = Variationimage::where('id',$request->id)->update([
            'product_id' => $request['product'],
            'color_id' => $request['color'],
        ]);

        if(request()->hasFile('main_image')){
            $main_image = request()->file('main_image')->store('Uploads/variationimage/image/'.$request->id.rand().rand(10,100), 'public');
            $image = Variationimage::where('id',$request->id)->update(
            [
                'img_path' => $main_image,
            ]);
        }
        return redirect()->route('admin.variationimage_listing')->with('notify_success','Variation Updated Successfuly!!');
    }

    public function get_color(Request $request)
    {
        $color  = variationimage::where('is_active',1)->where('product_id',$request->product_id)->with('variationimageBelongsToColor','variationimageBelongsToProduct','variationimageBelongsToSize')->get(); 
       
       $param = array();
        if(sizeof($color) > 0)
        {
            $param = ['status'=>1,'data'=>$color];
            return response()->json($param);
        }
        else{
            $param = ['status'=>0];
            return response()->json($param);
        }
    }

}
