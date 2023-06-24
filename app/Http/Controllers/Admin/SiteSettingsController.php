<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Keywords;
use App\Models\Imagetable;
use App\Models\Config;
use App\Models\Content;
use Auth;
use Illuminate\Support\Facades\Validator;

class SiteSettingsController extends Controller
{
    public function __construct()
    {
         $logo = Imagetable::where('table_name','logo')->latest()->first();
         View()->share('logo',$logo);
         View()->share('config',$this->getConfig());
    }

    public function showLogo()
    {
        return view('admin.logo-management')->with('title','Logo Management');
    }

    public function saveLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            
        ]);  

        $logo = request()->file('logo')->store('Uploads/Logo/'.auth('admin')->user()->id.rand().rand(10,100), 'public');

        $save_logo = Imagetable::create([
            'table_name' => 'logo',
            'img_path' => $logo,
        ]);
        return back()->with('notify_success','Logo Updated!');
    }

    public function socialInfo()
    {
        return view('admin.contact-social');
    }

    public function saveSocialInfo(Request $request)
    {
        // $validator =  $request->validate([
        //     'FACEBOOK' => 'required',
        //     'INSTAGRAM' => 'required',
        //     'PINTEREST' => 'required',
        //     'LINKEDIN' => 'required',
        //     'TWITTER' => 'required',
        //     'COMPANYEMAIL' => 'required',
        //     'COMPANYPHONE' => 'required',
        //     'COMPANYADDRESS' => 'required',
        //     'EXTERNALEMAIL' => 'required'
        // ]);
        // dd($validator);
        

        $config =  $request->except(['_token']);

        foreach($config as $k => $v )
        {
            $conf = Config::updateOrCreate (
                [
                 'flag_type' => $k
                ],
             [
             'flag_type' => $k,
             'flag_value' => $v,
             'flag_additionalText' => $v,
         ]);
        }
        return redirect()->route('admin.dashboard')->with('notify_success','Settings Updated!');
    }

    public function homeSlider()
    {
        $home_slider = Imagetable::where('type',3)->get();
        return view('admin.home-slider.list')->with('title','Banner Management')->with(compact('home_slider'));
    }

    public function deletehomeSlider($id)
    {
        $img = Imagetable::where('id',$id)->delete();
        return redirect()->route('admin.homeSlider')->with('notify_success','Banner Deleted Successfuly!!');
       
    }

    public function addhomeSlider()
    {
        return view('admin.home-slider.add')->with('title','Add Banner');
    }

    public function createhomeSlider(Request $request)
    {
        $request->validate([
            'homeslider' => 'required',
        ]);
    

        if(request()->hasFile('homeslider')){
            $homeslider = request()->file('homeslider')->store('Uploads/homeslider/'.rand().rand(10,100), 'public');
            $image = Imagetable::create (
             [
             'table_name' => $request->table_name,
             'img_path' => $homeslider,
             'type' => 3,
             'is_active_img'=>1,
             'long_desc' => $request->long_desc
         ]);
          }
          return redirect()->route('admin.homeSlider')->with('notify_success','Slider Uploaded!');
    }

    public function edithomeSlider($id)
    {
        $home_slider = Imagetable::where('id',$id)->first();
        
        return view('admin.home-slider.edit')->with('title','Edit Banner')->with(compact('home_slider'));
    }

    public function updatehomeSlider(Request $request)
    {

        if(request()->hasFile('homeslider')){
            $homeslider = request()->file('homeslider')->store('Uploads/banners/'.$request->id.rand().rand(10,100), 'public');
            $image = imagetable::where('id', $request->id)->update (
            [
                'img_path' => $homeslider,
                'long_desc' => $request->long_desc,
                'headings' => $request->headings
            ]);
        }
        else
        {
            $headings = Imagetable::where('id',$request->id)->update([
                'long_desc' => $request->long_desc,
                'headings' => $request->headings,
            ]);
            return redirect()->route('admin.homeSlider')->with('notify_success','Heading Updated Successfuly!!');
        } 
        return redirect()->route('admin.homeSlider')->with('notify_success','Banner Updated Successfuly!!');
    }

    public function suspendhomeSlider($id)
    {
        $img = Imagetable::where('type',2)->where('id',$id)->first();
        if($img->is_active_img == 0)
        {
            $img->is_active_img= 1;
            $img->save();
            return redirect()->route('admin.homeSlider')->with('notify_success','Banner Activated Successfuly!!');
        }
        else{
            $img->is_active_img= 0;
            $img->save();
            return redirect()->route('admin.homeSlider')->with('notify_success','Banner Suspended Successfuly!!');
        }
    }

    public function welcomeSlider()
    {
        $welcome_slider = Imagetable::where('type',4)->get();
        return view('admin.welcome-slider.list')->with('title','Welcome Slider Management')->with(compact('welcome_slider'));
    }

    public function deletewelcomeSlider($id)
    {
        $img = Imagetable::where('id',$id)->delete();
        return redirect()->route('admin.welcomeSlider')->with('notify_success','Slider Deleted Successfuly!!');
       
    }

    public function addwelcomeSlider()
    {
        return view('admin.welcome-slider.add')->with('title','Welcome Slider Add');
    }

    public function createwelcomeSlider(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'posted_by' => 'required',
            // 'date' => 'required',
            'long_desc' => 'required',
            // 'welcomeslider' => 'required',
        ]);     

        if ($validator->passes()) {
            $image = Imagetable::create (
            [
                'headings' => $request['posted_by'],
                'table_name' => "Welcome Slider",
                'long_desc' => $request['long_desc'],
                'type' => 4,
                
            ]);
            if(request()->hasFile('welcomeslider')){
                $homeslider = request()->file('welcomeslider')->store('Uploads/welcomeslider/'.rand().rand(10,100), 'public');
                $image = Imagetable::where('id', $image->id)->update(
                [
                    'img_path' => $homeslider,
                    'is_active_img'=>1,
                ]);
                
          }

          return response()->json(['msg' => $request['table_name'].' Home Slider Created Successfully!', 'status' => 1]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
    }

    public function editwelcomeSlider($id)
    {
        $welcome_slider = Imagetable::where('is_active_img',1)->where('id',$id)->first();
        return view('admin.welcome-slider.edit')->with('title','Edit Slider')->with(compact('welcome_slider'));
    }

    public function updatewelcomeSlider(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'id' => 'required',
            'posted_by' => 'required',
            'long_desc' => 'required',
            // 'welcomeslider' => 'required',
        ]);     

        if ($validator->passes()) {
           $image = Imagetable::where('id', $request->id)->update(
            [
                'headings' => $request['posted_by'],
                'table_name' => "Welcome Slider",
                'long_desc' => $request['long_desc'],
                'type' => 4,
                
            ]);
            if(request()->hasFile('welcomeslider')){
                $homeslider = request()->file('welcomeslider')->store('Uploads/welcomeslider/'.rand().rand(10,100), 'public');
                $image = Imagetable::where('id', $request->id)->update(
                [
                    'img_path' => $homeslider,
                    'is_active_img'=>1,
                ]);
                
            }

            return response()->json(['msg' => ' Slider Updated Successfully!', 'status' => 1]);  
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all(),'status' => 2]);
        }
        
    }

    public function suspendwelcomeSlider($id)
    {
        $img = Imagetable::where('id',$id)->first();
        if($img->is_active_img == 0)
        {
            $img->is_active_img= 1;
            $img->save();
            return redirect()->route('admin.welcomeSlider')->with('notify_success','Slider Activated Successfuly!!');
        }
        else{
            $img->is_active_img= 0;
            $img->save();
            return redirect()->route('admin.welcomeSlider')->with('notify_success','Slider Suspended Successfuly!!');
        }
    }

    public function cms()
    {
        $contents = Content::get();
        return view('admin.cms.list')->with(compact('contents'));
    }

    public function edit_cms($id)
    {
        $contents = Content::where('id',$id)->first();
        if($contents)
        {
            return view('admin.cms.edit')->with(compact('contents'));
        }
        else
        {
            return redirect()->route('admin.cms')->with('notify_error','No Record Found!');
        }

    }

    public function update_cms(Request $request)
    {

        // dd($request->all());
        $contents = Content::where('id',$request->id)->update([
            'page_heading' => $request->page_heading,
            'content1' => $request->content1,
            'content2' => $request->content2,
            'content3' => $request->content3,
            'content4' => $request->content4,
            'content5' => $request->content5,
            'content6' => $request->content6,
            'content7' => $request->content7,
        ]);

        if(request()->hasFile('img1')){
            $img1 = request()->file('img1')->store('Uploads/cms_images/'.$request->id.rand().rand(10,100), 'public');
            $image1 = Content::where('id',$request->id)->update (
             [
             'img1' => $img1,
             
             ]);

          }

          if(request()->hasFile('img2')){
            $img2 = request()->file('img2')->store('Uploads/cms_images/'.$request->id.rand().rand(10,100), 'public');
            $image2 = Content::where('id',$request->id)->update (
             [
             'img2' => $img2,
             
             ]);

          }

            return redirect()->route('admin.cms')->with('notify_success','Content Updated!');
    }



    
}
