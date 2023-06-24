@extends('userdash.layouts.dashboard.main')

@section('content')
 <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-form-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="primary-heading color-dark">
                            <h2>My Profile</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="text-md-right">
                            <a href="{{route('dashboard.editProfile')}}" class="primary-btn primary-bg mc-r-2"><i class="fa fa-pencil"></i> Edit Profile</a>
                       
                        </div>
                    </div>
                </div>
                <form   class="main-form">
                	@csrf	
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="profile-img">
                                
                                @if(null !== $user->img_path && !empty($user->img_path))
                                <figure><img src="{{asset($user->img_path)}}" id="logo_img_my" alt="user-img"></figure>
                                @else
                                 <figure><img src="{{asset('images/user-details.png')}}" id="logo_img_my" alt="user-img"></figure>
                                @endif
                                 <input type="file" id="profile-user-img" name="avatar" class="d-none"  onchange="readURL(this);" accept="image/jpeg, image/png">
                           
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-user"></i> Full Name <span>*</span></label>
                               <input type="text" name="fname" required class="form-control" value="{{$user->fullname}}" >
                            </div>
                        </div>
                       
                            
                            <input type="hidden" name="id"  class="form-control" value="{{$user->id}}" >
                             <input type="hidden" name="email"  class="form-control" value="{{$user->email}}" >
                          
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-phone"></i> Phone <span>*</span></label>
                               <input type="tel" name="phone" required class="form-control" value="{{$user->phone}}" >
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-home"></i> Address <span>*</span></label>
                                <input type="text" name="address" required class="form-control" value="{{$user->address}}" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-@if($user->gender=='Male')male @elseif($user->gender=='Female')female @else id-badge @endif"></i> Gender <span>*</span></label>
                                <input type="text" name="gender" required class="form-control" value="{{$user->gender}}" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-building"></i> City <span>*</span></label>
                               <input type="text" name="city" required class="form-control" value="{{$user->city}}" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label><i class="fa fa-map"></i> Country <span>*</span></label>
                                   <input type="text" required name="country" class="form-control" value="{{$user->country}}" >
                            </div>
                        </div>
                       
                    </div>

                </form>
                <div class="text-md-right">
                    <?php $decrypt = Crypt::encryptString($user->id);?>
                    <a href="{{route('dashboard.deleteProfile',$decrypt)}}" class="primary-btn primary-bg mc-r-2"><i class="fa fa-pencil"></i> Delete Profile</a>
                </div>
            </div>
        </div>
    </section>

    <!-- DASHBOARD END -->
@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
})()
</script>
@endsection
