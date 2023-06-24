<?php

namespace App\Http\Controllers;
use Session;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\News;
use App\Models\Content;
use App\Models\Keywords;
use App\Models\Testimonial;
use App\Models\Newsletter;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Color;
use App\Models\Type;
use App\Models\Feature;
use App\Models\Address;
use Carbon\Carbon;
use Auth;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Variation;
use App\Models\Merchandise;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name',"logo")->latest()->first();
        View()->share('logo',$logo);
        View()->share('config',$this->getConfig());
        
    }

    public function search(Request $request){
        
        $search = $request->input('search');
        if(isset($request->cat_id)){
            $products = Products::query()->where('category_id', $request->cat_id)->where('name', 'LIKE', "%{$search}%")->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }else{
            $products = Products::query()->where('name', 'LIKE', "%{$search}%")->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }
        $slider = Imagetable::where('table_name','wishlist-banner')->where('type',2)->where('is_active_img',1)->first();            
        return view('search')->with('title','Search')->with(compact('slider','products'));
    }

    public function index()
    {
        $category = Category::all();
        $slider = Imagetable::where('type',4)->latest()->get();
        $reviews = Review::where('is_active', 1)->where('rating', '>',3)->get();
        return view('welcome')->with('title','Home')->with(compact('slider', 'reviews', 'category'))
        ->with('homemenu',true);
    }
    
    public function email_verification()
    {
        return view('email-verification');
    }

    public function restaurants($type = null, $slug = null)
    {
        $category = Category::where('slug', 'restaurants')->first();
        $slider = Imagetable::where('table_name','restaurants')->latest()->first();
        $address = Address::where('category_id',$category->id)->where('is_active', 1)->get();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        
        if($type!=null){
            if($type == 'address'){
                $add = Address::where('slug',$slug)->first();
                $products = Products::where('category_id', $category->id)->where('area', $add->address)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();                
            }else{
                $products = Products::where('category_id', $category->id)->where($type, 'like', '%"'.$slug.'";%')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
            }
        }else{
            $products = Products::where('category_id', $category->id)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }
        return view('restaurants')->with('title','Restaurants')->with(compact('types', 'category', 'slider','products','type', 'feature', 'address'))->with('restaurants',true);
    }

    public function music($type = null, $slug = null)
    {
        $category = Category::where('slug', 'music')->first();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        $address = Address::where('category_id',$category->id)->where('is_active', 1)->get();
        
        $product = Products::where('category_id', $category->id)->where('is_archive', '1')->where('consert', '<', date("Y-m-d"))->update(['is_archive'=> 2]);

        $slider = Imagetable::where('table_name','music')->latest()->first();
        if($type!=null){
            if($type == 'address'){
                $add = Address::where('slug',$slug)->first();
                $products = Products::where('category_id', $category->id)->where('area', $add->address)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();                
            }else{
                $products = Products::where('category_id', $category->id)->where($type, 'like', '%"'.$slug.'";%')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
            }        }else{
            $products = Products::where('category_id', $category->id)->where('is_active', 1)->where('is_archive','<>', '2')->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->orderBy('consert', 'ASC')->get();
        }
       
        
        return view('music')->with('title','Music')->with(compact('types', 'category', 'slider','products', 'type', 'feature', 'address'))->with('music',true);
    }

    public function getfeature($cat , $type)
    {
        $category = Category::where('slug', $cat)->first();
        $slider = Imagetable::where('table_name',$cat)->latest()->first();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        
        $get_type = Feature::where('slug', $type)->first();
        $product = Products::where('category_id', $category->id)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        $products = [];
        foreach ($product as $pro) {
            if($pro->feature != null){
                // dd($get_type);
                $unser = unserialize($pro->feature);
                if(in_array($get_type->slug, $unser) )
                    $products[] = $pro;
            }
        }
        if($type == null){
            $products = $product;
        }
        return view($cat)->with('title',$cat)->with(compact('types', 'category', 'slider','products', 'type', 'feature'))->with($cat,true)->with('features','Feature');
    }

    public function restaurants_details()
    {
        $slider = Imagetable::where('table_name','restaurants_details')->latest()->first();
        return view('restaurants-details')->with('title','Restaurants Details')->with(compact('slider'))->with('restaurants',true);
    }
    
    public function events($type = null, $slug = null)
    {
        $category = Category::where('slug', 'events')->first();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        $address = Address::where('category_id',$category->id)->where('is_active', 1)->get();
        
        $product = Products::where('category_id', $category->id)->where('is_archive', '1')->where('consert', '<', date("Y-m-d"))->update(['is_archive'=> 2]);

        $slider = Imagetable::where('table_name','events')->latest()->first();
        if($type!=null){
            if($type == 'address'){
                $add = Address::where('slug',$slug)->first();
                $products = Products::where('category_id', $category->id)->where('area', $add->address)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();                
            }else{
                $products = Products::where('category_id', $category->id)->where($type, 'like', '%"'.$slug.'";%')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
            }
        }else{
            $products = Products::where('category_id', $category->id)->where('is_archive','<>', '2')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }
        return view('events')->with('title','Events')->with(compact('types', 'category', 'slider','products', 'type', 'feature', 'address'))->with('events',true);
    }

    public function art_and_museums($type = null, $slug = null)
    {
        $category = Category::where('slug', 'art-and-museums')->first();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        $address = Address::where('category_id',$category->id)->where('is_active', 1)->get();
        
        $slider = Imagetable::where('table_name','art-and-museums')->latest()->first();
        if($type!=null){
            if($type == 'address'){
                $add = Address::where('slug',$slug)->first();
                $products = Products::where('category_id', $category->id)->where('area', $add->address)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();                
            }else{
                $products = Products::where('category_id', $category->id)->where($type, 'like', '%"'.$slug.'";%')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
            }
        }else{
            $products = Products::where('category_id', $category->id)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }
        return view('art-and-museums')->with('title','Art & Museums')->with(compact('types', 'category', 'slider','products', 'type', 'feature', 'address'))->with('art_and_museums',true);
    }

    public function lifestyle($type = null, $slug = null)
    {
        $category = Category::where('slug', 'lifestyle')->first();
        $types = Type::where('category_id', $category->id)->where('is_active', 1)->get();
        $feature = Feature::where('category_id', $category->id)->where('is_active', 1)->get();
        $address = Address::where('category_id',$category->id)->where('is_active', 1)->get();
        
        if($type!=null){
            $products = Products::where('category_id', $category->id)->where($type, 'like', '%"'.$slug.'";%')->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }else{
            $products = Products::where('category_id', $category->id)->where('is_active', 1)->with('productHasReviews','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->get();
        }
        $slider = Imagetable::where('table_name','lifestyle')->latest()->first();
        return view('lifestyle')->with('title','Lifestyle')->with(compact('types', 'category', 'slider', 'products', 'type', 'feature', 'address'))->with('lifestyle',true);
    }

    public function new_to_the_area($type = null, $slug = null)
    {
        $slider = Imagetable::where('table_name','new_to_the_area')->latest()->first();
        $blogs = Blog::where('is_active', 1)->get();
        return view('new-to-the-area')->with('title','New To The Area')->with(compact('blogs', 'slider'))->with('new_to_the_area',true);
    }
    
        public function new_to_the_area_detail($slug)
    {
        $slider = Imagetable::where('table_name','new_to_the_area')->latest()->first();
        $blog = Blog::where('is_active', 1)->where('slug', $slug)->first();
        $blogs = Blog::where('is_active', 1)->latest()->take(4)->get();
        return view('new-to-the-area-detail')->with('title','New To The Area')->with(compact('blog', 'blogs', 'slider'))->with('new_to_the_area',true);
    }
    
    public function contact_us()
    {
        $slider = Imagetable::where('table_name','contact_us')->latest()->first();
        return view('contact-us')->with('title','Contact Us')->with(compact('slider'))->with('contact_us',true);
    }
    
    public function product_detail($slug)
    {
        $product = Products::where('is_active',1)->where('slug',$slug)->with('productHasReviews','productBelongsToVendor','productBelongsToCategory','productsHasMultiImages', 'productHasFaqs')->first();
        $category = Category::where('id', $product->category_id)->first();
        $reviews = Review::where('is_active',1)->where('item_id',$product->id)->get();
        $slider = Imagetable::where('table_name','restaurants')->latest()->first();
        $faqs = Faq::where('product_id',$product->id)->where('is_active',1)->latest()->get();
        return view("restaurants-details")->with('title',$product->title)->with(compact('category', 'reviews','slider','product'))->with('productsmenu',true);
    }
    
    public function add_reviews(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'review' => 'required|max:500',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
            ]);   
      
            if ($validator->passes()) {  
                
                $review = Review::create([
                    'review' =>  $request['review'],
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'rating' => $request['rating-input2'],
                    'user_id' =>  Auth::id(),
                    'type' =>  1,
                    'item_id' =>  $request['product_id'],
                    'is_active' => 1,
                ]);
                // return back()->with('notify_success','Review Pending For Admin Approval!');
                return back()->with('notify_success','Review Submit Succesful!');
            }
            else
            {

                return back()->with('notify_error',"Some field are missing");
            }
        }
        else
        {
            return back()->with('notify_error','Please Login To Post Reviews!');
        }
    }
    
    public function testimonials()
    {
        $banner = Imagetable::where('table_name','testimonials-banner')->where('type',2)->where('is_active_img',1)->first();
        $testimonials = Testimonial::where('is_active',1)->latest()->get();
        return view('testimonial')->with('title','Testimonials')->with(compact('banner','testimonials'))->with('testimonialsmenu',true);
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->first();
        $banner = Imagetable::where('table_name','wishlist-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('wishlist')->with('title','Wishlist')->with(compact('banner','wishlist'))->with('wishlistsmenu',true);
    }

    public function products()
    {
        $products = Products::where('is_active',1)->with('productHasReviews','productBelongsToVendor','productBelongsToCategory')->latest()->paginate(12);
        $category = Category::where('is_active',1)->with('categoryHasSubCategory')->get();
        $color = Color::where('is_active',1)->get();
        $banner = Imagetable::where('table_name','products-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('products')->with('title','Products')->with(compact('banner','products','category', 'color'))->with('productsmenu',true);
    }

    public function categories($slug, Request $request)
    {
       if(isset($request->perpage) && !empty($request->perpage))
       {
            $page_count = $request->perpage;
       }
       else
       {
            $page_count = 12;
       }
       if(isset($request->orderby) && !empty($request->orderby))
       {
            $orderby = $request->orderby;
       }
       else
       {
            $orderby = "desc";
       }
        $categoryid = Category::where('is_active',1)->where('slug',$slug)->first();
        $category = Category::where('is_active',1)->get();
        $products = Products::where('is_active',1)->where('category_id',$categoryid->id)->with('productHasReviews','productBelongsToCategory')->orderBy('id', $orderby)->paginate($page_count);

        $banner = Imagetable::where('table_name','categories-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('category')->with('title','Categories')->with(compact('products','category','categoryid'))->with('categorysmenu',true);
 
    }

    public function products_search($slug, Request $request)
    {
        if(isset($slug))
        {
            $cat = Category::where('slug',$slug)->first();
            $products =  Products::where('is_active',1)->whereIn('category_id',[$cat->id])->with('productHasReviews','productBelongsToVendor','productBelongsToCategory')->latest()->paginate(12);
        }else{
            $products =  Products::where('is_active',1)->whereIn('category_id',$request->search_cat)->with('productHasReviews','productBelongsToVendor','productBelongsToCategory')->latest()->paginate(12);
        }
        $category = Category::where('is_active',1)->get();
        $banner = Imagetable::where('table_name','products-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('products')->with('title','Products')->with(compact('banner','products','category'))->with('productsmenu',true);
    }

    public function aboutus()
    {
        $banner = Imagetable::where('table_name','aboutus-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('aboutus')->with('title','About Us')->with(compact('banner'))->with('aboutusmenu',true);
    }

    public function shipping()
    {
        $banner = Imagetable::where('table_name','shipping-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('shipping')->with('title','Shipping')->with(compact('banner'))->with('shippingmenu',true);
    }

    public function privacy_policy()
    {
        $slider = Imagetable::where('table_name','privacy-policy')->latest()->first();
        return view('privacy_policy')->with('title','Privacy Policy')->with(compact('slider'))->with('privacy_policymenu',true);
    }

    public function blog()
    {
        $blog = Blog::where('is_active',1)->get();
        $banner = Imagetable::where('table_name','blog-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('blog')->with('title','Blog')->with(compact('banner','blog'))->with('blogmenu',true);
    }

    public function blog_detail($slug)
    {
        $blog = Blog::where('is_active',1)->where('slug',$slug)->first();
        $banner = Imagetable::where('table_name','blog-detail-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('blog-detail')->with('title','Blog')->with(compact('banner','blog'))->with('blogmenu',true);
    }

    public function news()
    {
        $news = News::where('is_active',1)->get();
        $banner = Imagetable::where('table_name','news-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('news')->with('title','News')->with(compact('banner','news'))->with('newsmenu',true);
    }

    public function news_detail($slug)
    {
        $news = News::where('is_active',1)->where('slug',$slug)->first();
        $banner = Imagetable::where('table_name','news-detail-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('news-detail')->with('title','News')->with(compact('banner','news'))->with('newsmenu',true);
    }

    public function faqs()
    {
        $banner = Imagetable::where('table_name','faqs-banner')->where('type',2)->where('is_active_img',1)->first();
        $faqs = Faq::where('is_active',1)->latest()->get();
        return view('faqs')->with('title','FAQS')->with(compact('banner','faqs'))->with('faqsmenu',true);
    }

    public function contact()
    {
        $banner = Imagetable::where('table_name','contact-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('contact')->with('title','Contact')->with(compact('banner'))->with('contactmenu',true);
    }

    public function terms()
    {
        $banner = Imagetable::where('table_name','terms-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('terms')->with('title','Terms')->with(compact('banner'))->with('termsmenu',true);
    }

    public function shop()
    {
        if(isset($request->perpage) && !empty($request->perpage))
        {
                $page_count = $request->perpage;
        }
        else
        {
            $page_count = 12;
        }
        if(isset($request->orderby) && !empty($request->orderby))
        {
            $orderby = $request->orderby;
        }
        else
        {
            $orderby = "desc";
        }
        $category = Category::where('is_active',1)->with('categoryHasSubCategory')->get();
        $brand = Brand::where('is_active',1)->get();
        $products = Products::where('is_active',1)->with('productHasReviews','productBelongsToCategory')->orderBy('id', $orderby)->paginate($page_count);
        $banner = Imagetable::where('table_name','categories-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('shop')->with('title','Shop')->with(compact('brand','banner','products','category'))->with('shopmenu',true); 
    }

    public function shop_detail($slug)
    {
        $product = Products::where('is_active',1)->where('slug',$slug)->with(['productBelongsToCategory','productsHasMainImage','productsHasMultiImages'])->first();
        $merchandises = Merchandise::where('is_active',1)->with(['merchandiseHasMainImage'])->latest()->take(4)->get();
        $banner = Imagetable::where('table_name','shop-detail-banner')->where('type',2)->where('is_active_img',1)->first();
        $reviews = Review::where('is_active',1)->where('item_id',$product->id)->where('type',1)->get();
        return view('shop-detail')->with('title','Shop Detail')->with(compact('banner','product','merchandises','reviews'))->with('shopmenu',true);
    }
    
    public function contactus()
    {
        $faqs= Faq::where('is_active',1)->get();
        $banner = Imagetable::where('table_name','contactus-banner')->where('type',2)->where('is_active_img',1)->first();
        
        return view('contact-us')->with(compact('banner','faqs'))->with('contactmenu',true);
    }
       
    public function search_news(Request $request)
    {
        $search = $request->search;
        $content = Content::where('id',5)->first();
        $news = News::where('title','like', '%'.$request->search.'%')->where('is_active',1)->get();
        if(count($news) > 0)
        {
            return view('news')->with('title','News')->with(compact('news','content','search'));
        }
        else
        {
            return back()->with('notify_error','No Record Found!');
        }
    }
    
    public function create_review(Request $request)
    {
        if(Auth::check()){
            $validator = Validator::make($request->all(),[
                'review' => 'required|max:500',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:255',
                'rating' => 'required'
            ]);   
      
            if ($validator->passes()) {  
                $review = Review::create([
                    'review' =>  $request['review'],
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'rating' => $request['rating'][0],
                    
                    'user_id' =>  Auth::id(),
                    'type' => $request['type'],
                    'item_id' =>  $request['item_id'],
                ]);
                return response()->json(['msg' => 'Review Pending For Admin Approval!', 'status' => 1]);
            }
            else
            {
                return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
            }
        }
        else
        {
            return response()->json(['error'=>'Please Login To Post Reviews!','status' => 2]);
        }
    }
   
    public function newsletterstore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:newsletter,email|max:255',
        ],
        [
            'email.unique' => 'Sorry! You have already subscribed',
        ]);      
        if ($validator->passes()) {  
            $newsletter = Newsletter::create([
                'email' => $request['email'],
            ]);
            return redirect()->route('home')->with('notify_success','Thanks For Subscribing Our Newsletter!!');
        }
        else
        {
            return back()->with('notify_error',$validator->errors()->all())->with('status', 2);
        }
    }
   
}
