<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Crawls;
use App\Models\Keywords;
use App\Models\Orderrequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\Newsletter;
use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Lesson;
use App\Models\Partner;
use App\Models\Blog;
use App\Models\Vendor;
use App\Models\Config;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Review;
use App\Models\Sub_category;
use Auth;
use App\Models\Faq;
use App\Rules\PasswordMatch;
use Illuminate\Support\MessageBag;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class AdminDashController extends Controller
{
    public function __construct()
    {
         $logo = Imagetable::where('table_name','logo')->latest()->first();
         View()->share('logo',$logo);
         View()->share('config',$this->getConfig());
    }

    public function dashboard()
    {
        $users = User::get();
        return view('admin.dashboard')->with('title','Admin Dashboard')->with('user_menu',true)->with(compact('users'));
    }

    public function suspend_faq($id)
    {
        $faq = Faq::where('id',$id)->first();
        if($faq->is_active == 0)
        {
            $faq->is_active= 1;
            $faq->save();
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Activated Successfuly!!');
        }
        else{
            $faq->is_active= 0;
            $faq->save();
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Suspended Successfuly!!');
        }
    }

    public function delete_faq($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $faq = Faq::where('id',$id)->delete();
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Deleted Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.faq_listing')->with('notify_error','Only Admin Can Deleted!!');
        }
    }

    public function faq_listing()
    {
        $faq = Faq::latest()->get();
        return view('admin.faq-management.list')->with('title','Faq Management')->with('faq_menu',true)->with(compact('faq'));
    }

    public function add_faq()
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            return view('admin.faq-management.add')->with('title','Add Faq')->with('faq_menu',true);
        }
        else
        {
            return redirect()->route('admin.faq_listing')->with('notify_error','Only Admin Can Add!!');
        }
    }

    public function create_faq(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);  
        
        if(Auth::guard('admin')->user()->type == 1)
        {
            $faq = Faq::create([
                'question' => $request['question'],
                'answer' => $request['answer'],
            ]);
            return redirect()->route('admin.faq_listing')->with('notify_success','Faq Created Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.faq_listing')->with('notify_error','Only Admin Can Add!!');
        }
    }

    public function edit_faq($id)
    {
        $faq = Faq::where('id',$id)->first();
        return view('admin.faq-management.edit')->with('title','Edit Faq')->with('faq_menu',true)->with(compact('faq'));
    }

    public function savefaq(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);  

        $faq = Faq::where('id',$request->id)->update([
            'question' => $request['question'],
            'answer' => $request['answer'],
        ]);

        return redirect()->route('admin.faq_listing')->with('notify_success','Faq Updated Successfuly!!');
    }

   
    public function testimonial_listing()
    {
        $testimonial = Testimonial::get();
        return view('admin.testimonial-management.list')->with('title','Testimonial Management')->with('testimonial_menu',true)->with(compact('testimonial'));
    }

    public function add_testimonial()
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            return view('admin.testimonial-management.add')->with('title','Add Testimonial')->with('testimonial_menu',true);        }
        else
        {
            return redirect()->route('admin.testimonial_listing')->with('notify_error','Only Admin Can Add!!');
        }

    }

    public function create_testimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            // 'designation' => 'required|max:255',
        ]);  

        if(Auth::guard('admin')->user()->type == 1)
        {
            $testimonial = Testimonial::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'designation' => $request['designation'],
            ]);

            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Created Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.testimonial_listing')->with('notify_error','Only Admin Can Add!!');
        }
    }

    public function edit_testimonial($id)
    {
        $testimonial = Testimonial::where('id',$id)->first();
        return view('admin.testimonial-management.edit')->with('title','Edit Testimonial')->with('testimonial_menu',true)->with(compact('testimonial'));
    }

    public function savetestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            // 'designation' => 'required|max:255',
        ]);  

        $testimonial = Testimonial::where('id',$request->id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'designation' => $request['designation'],
        ]);

        return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Updated Successfuly!!');
    }

    
    public function suspend_testimonial($id)
    {
        $testimonial = Testimonial::where('id',$id)->first();
        if($testimonial->is_active == 0)
        {
            $testimonial->is_active= 1;
            $testimonial->save();
            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Activated Successfuly!!');
        }
        else{
            $testimonial->is_active= 0;
            $testimonial->save();
            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Suspended Successfuly!!');
        }
    }

    public function delete_testimonial($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $testimonial = Testimonial::where('id',$id)->delete();
            return redirect()->route('admin.testimonial_listing')->with('notify_success','Testimonial Deleted Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.testimonial_listing')->with('notify_error','Only Admin Can Delete!!');
        }
    }

    public function reviews_listing()
    {
        $reviews = Review::with(['reviewBelongsToUser','reviewBelongsToProducts','reviewBelongsToMerchandise'])->latest()->get();
        return view('admin.reviews-management.list')->with('title','Reviews Management')->with('reviews_menu',true)->with(compact('reviews'));
    }
    
    public function reviewfeedback(Request $request)
    {
        $external_email = Config::where('flag_type','EXTERNALEMAIL')->first();
        $logo = Imagetable::where('table_name','logo')->latest()->first();
        $review = Review::where('id', $request->review_id)->first();
        
        $data = [
            'review' => $review,
            'from' => $external_email['flag_value'],
            'subject'    => $request->get('subject'),
            'message'    => $request->get('message'),
            'logo'    => $logo->img_path,
        ];
       
        \Mail::send('email.review-temp', ['data' => $data],function ($message) use ($data){
            $message
                ->from($data['from'])
                ->to($data['review']['email'])->subject($data['subject']);
        });
        return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Created Successfuly!!');
    }

    public function suspend_reviews($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $reviews = Review::where('id',$id)->first();
            if($reviews->is_active == 0)
            {
                $reviews->is_active= 1;
                $reviews->save();
                return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Activated Successfuly!!');
            }
            else{
                $reviews->is_active= 0;
                $reviews->save();
                return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Suspended Successfuly!!');
            }
        }
        else
        {
            return redirect()->route('admin.reviews_listing')->with('notify_error','Only Admin Can Suspend!!');
        }
    }

    public function delete_reviews($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $reviews = Review::where('id',$id)->delete();
            return redirect()->route('admin.reviews_listing')->with('notify_success','Reviews Deleted Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.reviews_listing')->with('notify_error','Only Admin Can Delete!!');
        }
    }

    public function blog_listing()
    {
        $blog = Blog::get();
        return view('admin.blog-management.list')->with('title','Blog Management')->with('blog_menu',true)->with(compact('blog'));
    }

    public function add_blog()
    {
        return view('admin.blog-management.add')->with('title','Add Blog')->with('blog_menu',true);
    }

    public function create_blog(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'created_by' => 'required',
            'thumbnails' => 'required',
        ]);  

        $check_slug = Blog::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
        $blog = Blog::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'created_by' => $request['created_by'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$blog->id.rand().rand(10,100), 'public');
            $image = Blog::where('id', $blog->id)->update (
            [
                'blog_img' => $thumbnail,
            ]);
        }
        return redirect()->route('admin.blog_listing')->with('notify_success','Blog Created Successfuly!!');
    }

    public function edit_blog($id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.blog-management.edit')->with('title','Edit Blog')->with('blog_menu',true)->with(compact('blog'));
    }

    public function saveblog(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'created_by' => 'required',
        ]);  
        
        $check_slug = Blog::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        
        $blog = Blog::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'created_by' => $request['created_by'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Blog::where('id',$request->id)->update(
            [
                'blog_img' => $thumbnail,
            ]);
        }

        return redirect()->route('admin.blog_listing')->with('notify_success','Blog Updated Successfuly!!');
    }

    public function suspend_blog($id)
    {
        $blog = Blog::where('id',$id)->first();
        if($blog->is_active == 0)
        {
            $blog->is_active= 1;
            $blog->save();
            return redirect()->route('admin.blog_listing')->with('notify_success','Blog Activated Successfuly!!');
        }
        else
        {
            $blog->is_active= 0;
            $blog->save();
            return redirect()->route('admin.blog_listing')->with('notify_success','Blog Suspended Successfuly!!');
        }
    }

    public function delete_blog($id)
    {
        $blog = Blog::where('id',$id)->delete();
        return redirect()->route('admin.blog_listing')->with('notify_success','Blog  Deleted Successfuly!!');
    }

    public function news_events_listing()
    {
        $news = News::get();
        return view('admin.news-management.list')->with('title','News Events Management')->with('news_menu',true)->with(compact('news'));
    }

    public function add_news_events()
    {
        return view('admin.news-management.add')->with('title','Add News Events')->with('news_menu',true);
    }

    public function create_news_events(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'date' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
        ]);  

        $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
        $news = News::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'date' => $request['date'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$news->id.rand().rand(10,100), 'public');
            $image = News::where('id', $news->id)->update (
            [
                'news_img' => $thumbnail,
            ]);
        }
        return redirect()->route('admin.news_events_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_news_events($id)
    {
        $news = News::where('id',$id)->first();
        return view('admin.news-management.edit')->with('title','Edit News Events')->with(' news_menu',true)->with(compact('news'));
    }

    public function savenews_events(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'date' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);  
        
        $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }

        $news = News::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'date' => $request['date'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/news/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = News::where('id',$request->id)->update(
            [
                'news_img' => $thumbnail,
            ]);
        }

        return redirect()->route('admin.news_events_listing')->with('notify_success','News Updated Successfuly!!');
    }

    public function suspend_news_events($id)
    {
        $news = News::where('id',$id)->first();
        if($news->is_active == 0)
        {
            $news->is_active= 1;
            $news->save();
            return redirect()->route('admin.news_events_listing')->with('notify_success','News Activated Successfuly!!');
        }
        else{
            $news->is_active= 0;
            $news->save();
            return redirect()->route('admin.news_events_listing')->with('notify_success','News Suspended Successfuly!!');
        }
    }

    public function delete_news_events($id)
    {
        $news = News::where('id',$id)->delete();
        return redirect()->route('admin.news_events_listing')->with('notify_success','News  Deleted Successfuly!!');
    }

    public function check_slug(Request $request)
    {
        $slug = Str::slug($request->title,'-');
        return response()->json(['slug' => $slug]);
    }

    public function NewWebCrawl()
    {
        return view('admin.newwebcrawl')->with('title','New Web Crawl')->with('web_crawl',true);
    }
    
    public function ListWebCrawl()
    {
        $all_crawls = Keywords::where('is_active',1)->with('keywordHasCrawls')->latest()->get();
        return view('admin.webcrawl-listing')->with('title','List Web Crawls')->with('web_crawl',true)->with(compact('all_crawls'));
    }
    
    public function crawlDetail($id)
    {
        $main_cat = Category::where('is_active',1)->get();
        $sub_cat = Sub_category::where('is_active',1)->get();
        $crawlDetail = Keywords::where('id',$id)->with('keywordHasCrawls')->first();
        if($crawlDetail)
        {
              return view('admin.crawl-detail')->with('title','Web Crawls Details')->with('web_crawl',true)->with(compact('crawlDetail','main_cat','sub_cat'));
        }
        else
        {
            return back()->with('notify_error','No Data Availible!');   
        }
    }
    
    public function crawlEdit($id)
    {
        $crawlDetail = Crawls::where('id',$id)->first();
        return view('admin.edit-crawl')->with('title','Web Crawls Edit')->with('web_crawl',true)->with(compact('crawlDetail'));
    }
    
    public function crawlUpdate(Request $request)
    {
        $crawlUpdate = Crawls::where('id',$request->id)->update([
            'result_title'=> $request['result_title'],
            'result_url'=> $request['result_url'],
        ]);
        $crawl =  Crawls::where('id',$request->id)->first();
        $keyword = Keywords::where('id',$crawl->keyword_id)->first();
        return redirect()->route('admin.crawlDetail',$keyword->id)->with('notify_success','Crawl Updated!');

    }
    
    public function crawlDelete($id)
    {
        $keywords_delete = Keywords::where('id',$id)->delete();
        $crawl_delete = Crawls::where('keyword_id',$id)->delete();
        return back()->with('notify_success','Crawl Deleted Successfuly!')->with('crawl_success',true)->with('popup_message','Crawl Deleted Successfuly!');
    }
    
    public function crawlStatusUpdate(Request $request)
    {
        foreach($request['link_id'] as $link)
        {
            if($request->has('is_published-'.$link))
            {
                 $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                    'is_published' => $request['is_published-'.$link]
                ]);
            }
          
            if($request->has('is_archived-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                    'is_archived' => $request['is_archived-'.$link]
                ]);
            }
          
            if($request->has('main_category-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                    'main_category_id' => $request['main_category-'.$link]
                ]);
            }
            if($request->has('sub_category-'.$link))
            {
                $update_status =  Crawls::where('keyword_id',$keyword_id)->where('id',$link)->update([
                    'sub_category_id' => $request['sub_category-'.$link]
                ]);
            }
        }
        return redirect()->route('admin.crawlDetail',$keyword_id)->with('notify_success','Crawl Status Updated Successfully!');
    }

    public function searchCrawl(Request $request)
    {
        if($request['domain_name'] == 1)
        {
            $request['domain'] = "www.google.com";
        }
        else if($request['domain_name'] == 2)
        {
            $request['domain'] = "www.bing.com";
        }
        else if($request['domain_name'] == 3)
        {
            $request['domain'] = "www.yahoo.com";
        }
        $curl = curl_init();
       
        curl_setopt_array($curl, array(
      
        CURLOPT_URL => 'https://api.proxycrawl.com/scraper?token=7x4WyHfeqchHH4mz0BKVDw&url=https%3A%2F%2Fwww.google.com%2Fsearch%3Fq%3D'.str_replace('%2B+','%2B',str_replace(',','%2B',str_replace(' ','+',$request->keywords))).'%26num%3D100'
        ,CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 50,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
         $response = json_decode($response);
         if(!empty($response))
         {
            $create_keyword = Keywords::create([
                'keywords' => $request->keywords,
                ]);
             foreach($response->body->searchResults as $key => $value)
             {
                 $find_crawl = Crawls::where('result_url',$value->url)->get();
                 if(!empty($find_crawl->items))
                 {
                    continue; 
                 }
                 else
                 {
                     $create_crawl = Crawls::create([
                         'keyword_id' => $create_keyword->id,
                         'domain_name' => $request['domain'],
                         'position' => $value->position,
                         'result_title' => mb_strtolower($value->title),
                         'result_url' => $value->url,
                         'result_destination' => $value->destination,
                         'result_description' => $value->description,
                         ]);
                 }

             }
            return response()->json(['msg' => 'Crawl Ran Successfuly!', 'status' => 1]);
         }
         else
         {
            return response()->json(['msg' => 'Something went wrong, please try again!', 'status' => 0]);
         }
    }

    public function inquiries_listing()
    {
        $inquiries = Inquiry::get();
        return view('admin.inquiries.list')->with('title','Inquiries')->with('inquiry_menu',true)->with(compact('inquiries'));
    }

    public function inquiries_listing_view($id)
    {
        $inquiry = Inquiry::where('id',$id)->first();
        if($inquiry)
        {
            $is_read = Inquiry::where('id',$id)->update([
                'is_read' => 1
            ]);
        }
      
        return view('admin.inquiries.view')->with('title','View Inquiry')->with('inquiry_menu',true)->with(compact('inquiry'));
    }
    
    public function inquiries_listing_delete($id)
    {
        $inquiry = Inquiry::where('id',$id)->delete();
        return back()->with('notify_success','Inquiry Deleted!');
    }


    public function users_listing()
    {
        $users = User::get();
        return view('admin.users-management.list')->with('title','User Management')->with('user_mgmmenu',true)->with(compact('users'));
    }

    public function add_users()
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $users = User::get();
            return view('admin.users-management.add')->with('title','Add New User')->with('user_mgmmenu',true)->with(compact('users'));
        }
        else
        {
            return redirect()->route('admin.dashboard')->with('notify_error','Only Admin Can Add!!');
        }
    }

    public function create_users(Request $request)
    {
          $validator = Validator::make($request->all(),[
            'fullname' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password|max:255',
            'email' => 'required|unique:users|max:255',
            'is_active' => 'required',
        ]);
        if(Auth::guard('admin')->user()->type == 1)
        {
            if ($validator->passes()) {  
                $user = User::create([
                    'fullname' => $request['fullname'],
                
                    'email' => $request['email'],
                    'password' => bcrypt($request['password']),
                    'is_active' => $request['is_active'],
                ]);
    
                if(request()->hasFile('avatar')){
                    $avatar = request()->file('avatar')->store('Uploads/avatar/'.$user->id.rand().rand(10,100), 'public');
                    $image = User::where('id',$user->id)->update (
                    [
                        'img_path' => $avatar,
                    ]);
                }
                return response()->json(['msg' => 'User Added Successfully!', 'status' => 1]);
            }
             else
            {
                return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
            }
        }
        else
        {
            return response()->json(['error'=>'Only Admin Can Add!!','status' => 2]);
        }
    }

    public function edit_user($id)
    {
        $user = User::where('id',$id)->with('img_tab')->first();
        if($user)
        {
            return view('admin.users-management.edit')->with('title','Edit User')->with('user_mgmmenu',true)->with(compact('user'));
        }
        else{
            return back()->with('notify_error','User Not Found!');
        }
    }
    
    public function delete_user($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $id = Crypt::decryptString($id);
            $user = User::where('id',$id)->delete();
            return redirect()->route('admin.users_listing')->with('notify_success','News Deleted Successfuly!!');
        }
        else
        {
            return redirect()->route('admin.users_listing')->with('notify_error','Only Admin can delete!!');
        }
       
    }

    public function saveprofile(Request $request)
    {

        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'is_active'=> 'required'
        ]);  

        $user = User::where('id',$request->id)->where('email',$request->email)->with('img_tab')->first(); 
        $user->fullname= $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->is_active = $request->is_active;
        $user->save(); 

        if(request()->hasFile('avatar')){
            $avatar = request()->file('avatar')->store('Uploads/avatar/'.$request->id.rand().rand(10,100), 'public');
            $image = User::where('id',$request->id)->update (
              
             [
             
             'img_path' => $avatar,
             
         ]);
          }
         return redirect()->route('admin.users_listing')->with('notify_success','User Updated Successfuly!!');
    }

    public function suspend_user($id)
    {
        $user = User::where('id',$id)->first();
        if($user->is_active == 0)
        {
            $user->is_active= 1;
            $user->save();
            return redirect()->route('admin.users_listing')->with('notify_success','User Activated Successfuly!!');
        }
        else{
            $user->is_active= 0;
            $user->save();
            return redirect()->route('admin.users_listing')->with('notify_success','User Suspended Successfuly!!');
        }
 

    }

    public function suspend_news($id)
    {
        $news = News::where('id',$id)->first();
        if($news->is_active == 0)
        {
            $news->is_active= 1;
            $news->save();
            return redirect()->route('admin.news_listing')->with('notify_success','News Activated Successfuly!!');
        }
        else{
            $news->is_active= 0;
            $news->save();
            return redirect()->route('admin.news_listing')->with('notify_success','News Suspended Successfuly!!');
        }
    }

    public function delete_news($id)
    {
        $news = News::where('id',$id)->delete();
        return redirect()->route('admin.news_listing')->with('notify_success','News Deleted Successfuly!!');
       
    }

    public function news_listing()
    {
        $news = News::get();
        return view('admin.news-management.list')->with('title','News Management')->with('news_menu',true)->with(compact('news'));
    }

    public function add_news()
    {
        return view('admin.news-management.add')->with('title','Add News')->with('news_menu',true);
    }

    public function create_news(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
            'pictures'=> 'required',
        ]);  

        $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
       //dd($check_slug);
        $news = News::create([
            'title' => $request['name'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/thumbnails/'.$news->id.rand().rand(10,100), 'public');
            $image = imagetable::create (
             [
             'table_name' => 'news-thumbnail',
             'img_path' => $thumbnail,
             'ref_id' => $news->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          if(request()->hasFile('pictures')){
            $picture = request()->file('pictures')->store('Uploads/pictures/'.$news->id.rand().rand(10,100), 'public');
            $image = imagetable::create (
             [
             'table_name' => 'news-picture',
             'img_path' => $picture,
             'ref_id' => $news->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          return redirect()->route('admin.news_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_news($id)
    {
        $news = News::where('id',$id)->with('thumbnail','picture')->first();
        return view('admin.news-management.edit')->with('title','Edit News')->with('news_menu',true)->with(compact('news'));
    }

    public function savenews(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);  
        
         $check_slug = News::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }

        $news = News::where('id',$request->id)->update([
            'title' => $request['name'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = imagetable::updateOrCreate (
                [
                 'ref_id' => $request->id,
                 'table_name' => 'news-thumbnail',
                ],
             [
             'table_name' => 'news-thumbnail',
             'img_path' => $thumbnail,
             'ref_id' => $request->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          if(request()->hasFile('pictures')){
            $picture = request()->file('pictures')->store('Uploads/pictures/'.$request->id.rand().rand(10,100), 'public');
            $image = imagetable::updateOrCreate  (
                [
                 'ref_id' => $request->id,
                 'table_name' => 'news-picture',
                ],
             [
             'table_name' => 'news-picture',
             'img_path' => $picture,
             'ref_id' => $request->id,
             'type' => 1,
             'is_active_img'=>1,
         ]);
          }

          return redirect()->route('admin.news_listing')->with('notify_success','News Updated Successfuly!!');
    }
    
    
    
    public function admins_listing()
    {
        $admins = Admin::get();
        return view('admin.admin-management.list')->with('title','Admin Management')->with('admin_mgmmenu',true)->with(compact('admins'));
    }

    public function add_admins()
    {
        $admins = Admin::get();
        return view('admin.admin-management.add')->with('title','Add New Admin')->with('admin_mgmmenu',true)->with(compact('admins'));
    }

    public function create_admin(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password|max:255',
            'email' => 'required|unique:admin|max:255',
            'is_active' => 'required',
            'type' => 'required'
        ]);
        
        if($request['type'] == 3){
            $user = User::create([
                'fullname' => $request['name'],
                'role_id' => 1,
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'is_active' => $request['is_active'],
            ]);
            return redirect()->route('admin.admin_listing')->with('notify_success','User Created Successfuly!!');
        }
        else if(Auth::guard('admin')->user()->type == 1)
        {
            $admin = Admin::create([
                'name' => $request['name'],
                'type' => $request['type'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'is_active' => $request['is_active'],
            ]);

            return redirect()->route('admin.admin_listing')->with('notify_success',($request['type']==1?'Admin':'Manager').' Created Successfuly!!');
        }
        else
        {
            if($request['type'] == 2)
            {
                $admin = Admin::create([
                    'name' => $request['name'],
                    'type' => $request['type'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password']),
                    'is_active' => $request['is_active'],
                ]);
                return redirect()->route('admin.admin_listing')->with('notify_success','Manager Created Successfuly!!');
            }else{
                return redirect()->route('admin.admin_listing')->with('notify_error','Only Add User an Manager!!');
            }
        }

    }

    public function edit_admin($id)
    {
        $admin = Admin::where('id',$id)->first();
        if($admin)
        {
            return view('admin.admin-management.edit')->with('title','Edit Admin')->with('admin_mgmmenu',true)->with(compact('admin'));
        }
        else{
            return back()->with('notify_error','Admin Not Found!');
        }
    }
    
    public function delete_admin($id)
    {
        if(Auth::guard('admin')->user()->type == 2 && Auth::guard('admin')->user()->id == $id)
        {
            $admin = Admin::where('id',$id)->Delete();
            return back()->with('notify_success','Record Deleted Successfuly!');
        }
        elseif(Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->id != $id)
        {
            $admin = Admin::where('id',$id)->Delete();
            return back()->with('notify_success','Record Deleted Successfuly!');
        }
        return back()->with('notify_error','Record Deleted Failed!');
    }
    
    public function saveadmin(Request $request)
    {
      $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
    if($admin->type == 1)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);  

        $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
        $admin->name= $request->name;
        if($request['password'])
        {
           // dd('yes');
            $admin->password = bcrypt($request->password);
        }
        $admin->save(); 
    }
    else
    {
        $request->validate([
            'name' => 'required|max:255',
          
            'type' => 'required',
            'is_active' => 'required'
        ]);  

        $admin = Admin::where('id',$request->id)->where('email',$request->email)->first(); 
        $admin->name= $request->name;
        $admin->type = $request->type;
      
        $admin->is_active = $request->is_active;
        if($request['password'])
        {
           // dd('yes');
            $admin->password = bcrypt($request->password);
        }
        $admin->save(); 

      
    }
         return redirect()->route('admin.admin_listing')->with('notify_success','Admin Updated Successfuly!!');
    }
    
     public function suspend_admin($id)
    {
        $admin = Admin::where('id',$id)->first();
        if($admin->is_active == 0)
        {
            $admin->is_active= 1;
            $admin->save();
            return redirect()->route('admin.admin_listing')->with('notify_success','Admin Activated Successfuly!!');
        }
        else{
            $admin->is_active= 0;
            $admin->save();
            return redirect()->route('admin.admin_listing')->with('notify_success','Admin Suspended Successfuly!!');
        }
 

    }



    public function subcategory_listing()
    {
        $subcategory = Sub_category::with('category')->get();
        // dd($subcategory);
        return view('admin.subcategory-management.list')->with('title','Sub Category Management')->with('subcategory_menu',true)->with(compact('subcategory'));
    }

    public function add_subcategory()
    {
        $maincategory = Category::where('is_active',1)->get();
        // dd($maincategory);
        return view('admin.subcategory-management.add')->with('title','Sub Category')->with('subcategory_menu',true)->with(compact('maincategory'));
    }

    public function create_subcategory(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'slug' => 'required|unique:sub_category'
            
        ]
        ,[

            'category_id.required' => 'The category field is required.'
                        
        ]);  
 
        $subcategory = Sub_category::create([

            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'slug' => $request['slug'],
        
        ]);

          return redirect()->route('admin.subcategory_listing')->with('notify_success','SubCategory Created Successfuly!!');
    }

    public function edit_subcategory($id)
    {

        $subcategory = Sub_Category::where('id',$id)->with('category')->first();
        $maincategory = Category::where('is_active',1)->with('categoryHasSubCategory')->get();
        return view('admin.subcategory-management.edit')->with('title','Edit sub category')->with('subcategory_menu',true)->with(compact('subcategory','maincategory'));
    }
    public function savesubcategory(Request $request)
    {


        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'slug' => 'required|unique:sub_category'
            
        ]
        ,[

            'category_id.required' => 'The category field is required.'
                        
        ]); 
                
        $subcategory = Sub_category::where('id',$request->id)->update([
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'slug' => $request['slug'],
        
        ]);

          return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Updated Successfuly!!');
    }

   

    
    public function suspend_subcategory($id)
    {
        
    //    dd($id);
        $subcategory = Sub_category::where('id',$id)->first();
        if($subcategory->is_active == 0)
        {
            $subcategory->is_active= 1;
            $subcategory->save();
            return redirect()->route('admin.subcategory_listing')->with('notify_success',' Sub Category Activated Successfuly!!');
        }
        else{
            $subcategory->is_active= 0;
            $subcategory->save();
            return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Suspended Successfuly!!');
        }
    }

    public function delete_subcategory($id)
    {
        $subcategory = Sub_category::where('id',$id)->delete();
        return redirect()->route('admin.subcategory_listing')->with('notify_success','Sub Category Deleted Successfuly!!');
       
    }


    public function category_listing()
    {
        $category = Category::get();
        return view('admin.category-management.list')->with('title','Category Management')->with('category_menu',true)->with(compact('category'));
    }

    public function add_category()
    {
        return view('admin.category-management.add')->with('title','Category News')->with('category_menu',true);
    }
    
    public function savecategory(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            // 'slug' => 'required',
        ]);  
                
        $category = Category::where('id',$request->id)->update([
            'title' => $request['title'],
            // 'slug' => $request['slug'],
            'is_menu' => $request['is_menu'],
        
        ]);
        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/category/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Category::where('id', $request->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.category_listing')->with('notify_success','Category Updated Successfuly!!');
    }

    public function create_category(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:category',

            
        ]);  
 
        $category = Category::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'is_menu' => $request['is_menu'],

         ]);
         if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/category/thumbnails/'.$category->id.rand().rand(10,100), 'public');
            $image = Category::where('id', $category->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.category_listing')->with('notify_success','Category Created Successfuly!!');
    }

    public function edit_category($id)
    {

        $category = Category::where('id',$id)->first();
        return view('admin.category-management.edit')->with('title','Edit category')->with('category_menu',true)->with(compact('category'));
    }
    
    public function suspend_category($id)
    {
        $category = category::where('id',$id)->first();
        if($category->is_active == 0)
        {
            $category->is_active= 1;
            $category->save();
            return redirect()->route('admin.category_listing')->with('notify_success','Category Activated Successfuly!!');
        }
        else{
            $category->is_active= 0;
            $category->save();
            return redirect()->route('admin.category_listing')->with('notify_success','Category Suspended Successfuly!!');
        }
    }

    public function delete_category($id)
    {
        $category = Category::where('id',$id)->delete();
        return redirect()->route('admin.category_listing')->with('notify_success','Category Deleted Successfuly!!');
       
    }

    //  bra
    public function brand_listing()
    {
        $brand = Brand::get();
        return view('admin.brand-management.list')->with('title','Brand Management')->with('brand_menu',true)->with(compact('brand'));
    }

    public function add_brand()
    {
        return view('admin.brand-management.add')->with('title','Add Brand')->with('brand_menu',true);
    }
    
    public function savebrand(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
        ]);  
                
        $brand = Brand::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'], 
        ]);
        // if(request()->hasFile('thumbnails')){
        //     $thumbnail = request()->file('thumbnails')->store('Uploads/category/thumbnails/'.$request->id.rand().rand(10,100), 'public');
        //     $image = Category::where('id', $request->id)->update (
        //      [
        //      'img_path' => $thumbnail,
        //  ]);
        //   }

          return redirect()->route('admin.brand_listing')->with('notify_success','Category Updated Successfuly!!');
    }

    public function create_brand(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:category',            
        ]);  
 
        $brand = Brand::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
         ]);
         
        //  if(request()->hasFile('thumbnails')){
        //     $thumbnail = request()->file('thumbnails')->store('Uploads/brand/thumbnails/'.$category->id.rand().rand(10,100), 'public');
        //     $image = Brand::where('id', $category->id)->update (
        //      [
        //      'img_path' => $thumbnail,
        //  ]);
        //   }

          return redirect()->route('admin.brand_listing')->with('notify_success','Brand Created Successfuly!!');
    }

    public function edit_brand($id)
    {

        $brand = Brand::where('id',$id)->first();
        return view('admin.brand-management.edit')->with('title','Edit Brand')->with('brand_menu',true)->with(compact('brand'));
    }
    
    public function suspend_brand($id)
    {
        $brand = Brand::where('id',$id)->first();
        if($brand->is_active == 0)
        {
            $brand->is_active= 1;
            $brand->save();
            return redirect()->route('admin.brand_listing')->with('notify_success','Brand Activated Successfuly!!');
        }
        else{
            $brand->is_active= 0;
            $brand->save();
            return redirect()->route('admin.brand_listing')->with('notify_success','Brand Suspended Successfuly!!');
        }
    }

    public function delete_brand($id)
    {
        $category = Brand::where('id',$id)->delete();
        return redirect()->route('admin.brand_listing')->with('notify_success','Brand Deleted Successfuly!!');
       
    }
    // dd
    public function lesson_listing()
    {
        $lesson = Lesson::get();
        return view('admin.lesson-management.list')->with('title','News Management')->with('lesson_menu',true)->with(compact('lesson'));
    }

    public function add_lesson()
    {
        return view('admin.lesson-management.add')->with('title','Add News')->with('lesson_menu',true);
    }

    public function create_lesson(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnails' => 'required',
        ]);  

     $check_slug = Lesson::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!')->withInput(); 
        }
       //dd($check_slug);
        $lesson = Lesson::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/lesson/thumbnails/'.$lesson->id.rand().rand(10,100), 'public');
            $image = Lesson::where('id', $lesson->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.lesson_listing')->with('notify_success','News Created Successfuly!!');
    }

    public function edit_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->first();
        return view('admin.lesson-management.edit')->with('title','Lesson News')->with('lesson_menu',true)->with(compact('lesson'));
    }

    public function savelesson(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);  
        
         $check_slug = Lesson::where('slug',$request->slug)->where('id','!=',$request->id)->first();
        if($check_slug)
        {
            return back()->with('notify_error','Unique Slug Is Required!'); 
        }
        //dd($check_slug);
        
        $lesson = Lesson::where('id',$request->id)->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/lesson/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Lesson::updateOrCreate (
                [
                 'id' => $request->id,
                ],
             [

             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Updated Successfuly!!');
    }

    
    public function suspend_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->first();
        if($lesson->is_active == 0)
        {
            $lesson->is_active= 1;
            $lesson->save();
            return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Activated Successfuly!!');
        }
        else{
            $lesson->is_active= 0;
            $lesson->save();
            return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson Suspended Successfuly!!');
        }
    }

    public function delete_lesson($id)
    {
        $lesson = Lesson::where('id',$id)->delete();
        return redirect()->route('admin.lesson_listing')->with('notify_success','Lesson  Deleted Successfuly!!');
       
    }


    public function partner_listing()
    {
        $partner = Partner::get();
        return view('admin.partner-management.list')->with('title','Partner Management')->with('partner_menu',true)->with(compact('partner'));
    }

    public function add_partner()
    {
        // $category = Category::where('is_active',1)->with('sub_categories')->get();
        // $subcategory = Sub_category::where('is_active',1)->with('category')->get();
        return view('admin.partner-management.add')->with('title','Add partner')->with('partner_menu',true);
    }

    public function create_partner(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
           
            'thumbnails' => 'required',
        ]);  
      
        $partner = Partner::create([
            'title' => $request['title'],
         
           
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/partner/thumbnails/'.$partner->id.rand().rand(10,100), 'public');
            $image = Partner::where('id', $partner->id)->update (
             [
             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.partner_listing')->with('notify_success','Partner Created Successfuly!!');
    }

    public function getsubcategory(Request $request)
    {
     

        $subcategory = Sub_category::where('is_active',1)->where('category_id',$request->category_id)->select('id','title')->get()->toArray();
       // dd($subcategory);
       if(!empty($subcategory))
       {
       
        return response()->json( ['status' => 1 , 'data'=>$subcategory]);
        // dd($subcategory);
        }
        else{
            return response()->json( ['status' => 0 ]);
        }

    }

    public function edit_partner($id)
    {
      
        $partner = Partner::where('id',$id)->first();
       
        return view('admin.partner-management.edit')->with('title','Edit partner')->with('partner_menu',true)->with(compact('partner'));
    }

    public function savepartner(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
         
            // 'thumbnails' => 'required',
        ]);  
        
  
        $partner = Partner::where('id',$request->id)->update([
            'title' => $request['title'],
          
        ]);

        if(request()->hasFile('thumbnails')){
            $thumbnail = request()->file('thumbnails')->store('Uploads/partner/thumbnails/'.$request->id.rand().rand(10,100), 'public');
            $image = Partner::where('id',$request->id)->update (
               
             [

             'img_path' => $thumbnail,
         ]);
          }

          return redirect()->route('admin.partner_listing')->with('notify_success','Partner Updated Successfuly!!');
    }

    
    public function suspend_partner($id)
    {
        // dd($id);
        $partner = Partner::where('id',$id)->first();
        if($partner->is_active == 0)
        {
            $partner->is_active= 1;
            $partner->save();
            return redirect()->route('admin.partner_listing')->with('notify_success','Partner Activated Successfuly!!');
        }
        else{
            $partner->is_active= 0;
            $partner->save();
            return redirect()->route('admin.partner_listing')->with('notify_success','Partner Suspended Successfuly!!');
        }
    }

    public function delete_partner($id)
    {
        // dd($id);
        $partner = Partner::where('id',$id)->delete();
        return redirect()->route('admin.partner_listing')->with('notify_success','Partner  Deleted Successfuly!!');
       
    }
    

    public function vendor_listing()
    {
        $vendor = Vendor::get();
        return view('admin.vendor-management.list')->with('title','Vendor Management')->with('vendor_menu',true)->with(compact('vendor'));
    }

    public function add_vendor()
    {
        return view('admin.vendor-management.add')->with('title','Add Vendor')->with('vendor_menu',true);
    }
    
    public function savevendor(Request $request)
    {
    //    dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
        ]);  
                
        $vendor = Vendor::where('id',$request->id)->update([
            'title' => $request['title'],
        
        ]);

        if(request()->hasFile('vendor_image')){
            // dd($request->all());
            $validator = Validator::make($request->all(),[
                'vendor_image' => 'required|mimes:jpeg,jpg,png',
                // 'other_image' =>'required',
                // 'other_image.*' => 'image|mimes:jpeg,png,jpg'
            ]);      
            $main_image = request()->file('vendor_image')->store('Uploads/vendor_image/'.$request->id.rand().rand(10,100), 'public');
            // $delete_img = ShopImage::where('cat_type','products')->where('ref_id',$request->id)->where('img_type',1)->delete();
            $image = Vendor::where('id',$request->id)->update(
                [
                // 'cat_type' => 'products',
                'img_path' => $main_image,
                // 'ref_id' => $request->id,
                // 'img_type' => 1
                
            ]);
            }

          return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Updated Successfuly!!');
    }

    public function create_vendor(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|max:255|unique:vendor',
            'vendor_image' => 'required|mimes:jpeg,jpg,png',
            
        ]);  
 
        $vendor = Vendor::create([
            'title' => $request['title']]);

            if(request()->hasFile('vendor_image')){
                $main_image = request()->file('vendor_image')->store('Uploads/vendor_image/'.$vendor->id.rand().rand(10,100), 'public');
                $image = Vendor::where('id',$vendor->id)->update(
                    [
                    // 'cat_type' => 'products',
                    'img_path' => $main_image,
                    // 'ref_id' => $products->id,
                    // 'img_type' => 1
                    
                ]);
                }

          return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Created Successfuly!!');
    }

    public function edit_vendor($id)
    {

        $vendor = Vendor::where('id',$id)->first();
        return view('admin.vendor-management.edit')->with('title','Edit Vendor')->with('vendor_menu',true)->with(compact('vendor'));
    }
    
    public function suspend_vendor($id)
    {
        $vendor = Vendor::where('id',$id)->first();
        if($vendor->is_active == 0)
        {
            $vendor->is_active= 1;
            $vendor->save();
            return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Activated Successfuly!!');
        }
        else{
            $vendor->is_active= 0;
            $vendor->save();
            return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Suspended Successfuly!!');
        }
    }

    public function delete_vendor($id)
    {
        $vendor = Vendor::where('id',$id)->delete();
        return redirect()->route('admin.vendor_listing')->with('notify_success','Vendor Deleted Successfuly!!');
       
    }

    public function coupon_listing()
    {
        $coupon= Coupon::latest()->get();
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.list')->with('title','Coupon Management')->with('coupon_menu',true)->with(compact('coupon'));
    }

    public function add_coupon()
    {
        // $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.add')->with('title','Add Coupon')->with('coupon_menu',true);
    }

    public function create_coupon(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required',
            'coupon_price' => 'required|numeric',
            // 'type' => 'required',
        ]);  

        $coupon = Coupon::create([
            // 'faq_type_id' => $request['type'],
            'title' => $request['title'],
            'coupon_code' => $request['coupon_code'],
            'coupon_price' => $request['coupon_price'],
           
           
        ]);

       

          return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Created Successfuly!!');
    }

    public function edit_coupon($id)
    {
        $coupon = Coupon::where('id',$id)->first();
        //  $faq_type = FaqType::where('is_active',1)->get();
        return view('admin.coupon-management.edit')->with('title','Edit Coupon')->with('coupon_menu',true)->with(compact('coupon'));
    }

    public function savecoupon(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'title' => 'required',
            'coupon_code' => 'required',
            'coupon_price' => 'required|numeric',
            // 'type' => 'required',
        ]); 

        $coupon = Coupon::where('id',$request->id)->update([
           
            'title' => $request['title'],
            'coupon_code' => $request['coupon_code'],
            'coupon_price' => $request['coupon_price'],
           
           
        ]);

          return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Updated Successfuly!!');
    }

    public function suspend_coupon($id)
    {
        $coupon =Coupon::where('id',$id)->first();
        if($coupon->is_active == 0)
        {
            $coupon->is_active= 1;
            $coupon->save();
            return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Activated Successfuly!!');
        }
        else{
            $coupon->is_active= 0;
            $coupon->save();
            return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Suspended Successfuly!!');
        }
    }

    public function delete_coupon($id)
    {
        $coupon = Coupon::where('id',$id)->delete();
        return redirect()->route('admin.coupon_listing')->with('notify_success','Coupon Deleted Successfuly!!');
       
    }
    public function newsletter_listing()
    {
        $newsletter = Newsletter::get();
        return view('admin.newsletter.list')->with('title','Newsletter Listing')->with('newslettermenu',true)->with(compact('newsletter'));
    }

    public function newsletter_listing_delete($id)
    {
        $inquiry = Newsletter::where('id',$id)->delete();
        return back()->with('notify_success','Newsletter Deleted!');
    }

    
    // 

    public function refund_listing()
    {
        $refund = Orderrequest::where(['request_type' => 2])->get();
        // dd($inquiries);
        return view('admin.refund.list')->with('title','Refund Management')->with('refund_menu',true)->with(compact('refund'));
    }

    public function refund_listing_view($id)
    {
        $refund =  Orderrequest::where('id',$id)->first();
        // if($inquiry)
        // {
        //     $is_read = Inquiry::where('id',$id)->update([
        //         'is_read' => 1
        //     ]);
        // }
      
        return view('admin.refund.view')->with('title','View Refund Request')->with('refund_menu',true)->with(compact('refund'));
    }
    public function refund_listing_delete($id)
    {
        $refund = Orderrequest::where('id',$id)->delete();
        return back()->with('notify_success','Request Deleted!');
    }

    public function refund_status($id)
    {
        // dd($id);
        $refund = Orderrequest::where('id',$id)->first();
        if($refund->is_active == 1)
        {
            $refund->is_active= 0;
            $refund->save();
            return redirect()->route('admin.refund_listing')->with('notify_success','Request Accepted Successfuly!!');
        }
        
    }
    public function return_listing()
    {
        $return = Orderrequest::where(['request_type' => 1])->get();
        // dd($inquiries);
        return view('admin.return.list')->with('title','Return Management')->with('return_menu',true)->with(compact('return'));
    }

    public function return_listing_view($id)
    {
        $return =  Orderrequest::where('id',$id)->first();
    
      
        return view('admin.return.view')->with('title','View Return Request')->with('return_menu',true)->with(compact('return'));
    }

    public function return_status($id)
    {
        // dd($id);
        $return = Orderrequest::where('id',$id)->first();
        if($return->is_active == 1)
        {
            $return->is_active= 0;
            $return->save();
            return redirect()->route('admin.return_listing')->with('notify_success','Request Accepted Successfuly!!');
        }
        
    }

    public function cancelorder_listing()
    {
        $cancelorder = Orderrequest::where(['request_type' => 0])->get();
        // dd($inquiries);
        return view('admin.cancel.list')->with('title','Order Cancel Management')->with('ordercancel_menu',true)->with(compact('cancelorder'));
    }

    public function cancelorder_listing_view($id)
    {
        $cancelorder =  Orderrequest::where('id',$id)->first();
    
      
        return view('admin.cancel.view')->with('title','View Order Cancel Request')->with('ordercancel_menu',true)->with(compact('cancelorder'));
    }

    public function cancelorder_status($id)
    {
        // dd($id);
        $cancelorder = Orderrequest::where('id',$id)->first();
        
        if($cancelorder->is_active == 1)
        {
            $cancelorder->is_active= 0;
            $cancelorder->save();
            return redirect()->route('admin.cancelorder_listing')->with('notify_success','Request Accepted Successfuly!!');
        }
        
    }


}
