@extends('layouts.main')
@section('content')
<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{ asset('mages/banner-bg.png') }}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <h1 class="banner-content__heading bg-line">Sign UP</h1>
                    <ul class="filters filters--sm">
                        <li class="filters-single">
                            <form action="#" class="filters-single__search">
                                <input type="search" placeholder="Search by keywords...">
                                <button><i class='bx bx-search'></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="filtersWrapper">
                    <a href="{{ route('home') }}" class="web-logo">
                        <img src='{{ asset($logo->img_path) }}' alt='image' class='imgFluid' loading='lazy'>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='sponsore mar-y'>
    <div class='container-fluid px-5'>
        <div class='row'>
            <div class='col-lg-2'>
                <ul class='sponsore-options'>
                    <li>
                        <div class="title primary-underline">filters</div>
                        <ul class="amout-list">
                            <li>$</li>
                            <li>$$</li>
                            <li>$$$</li>
                            <li>$$$$</li>
                        </ul>
                    </li>
                    <li>
                        <div class="title primary-underline">Suggested</div>
                        <div class="radio-fields">
                            <input type="radio" id="1-radio" name="suggested">
                            <label class="details" for="1-radio">Open At:3:15 PM (now)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="2-radio" name="suggested">
                            <label class="details" for="2-radio">Offers Delivery</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="3-radio" name="suggested">
                            <label class="details" for="3-radio">Offers Takeout</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="4-radio" name="suggested">
                            <label class="details" for="4-radio">Reservations</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="5-radio" name="suggested">
                            <label class="details" for="5-radio">Breakfast & Brunch</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="6-radio" name="suggested">
                            <label class="details" for="6-radio">Italian</label>
                        </div>
                    </li>
                    <li>
                        <div class="title primary-underline">Features</div>
                        <div class="radio-fields">
                            <input type="radio" id="7-radio" name="features">
                            <label class="details" for="7-radio">Good for Kids</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="8-radio" name="features">
                            <label class="details" for="8-radio">Has TV</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="20-radio" name="features">
                            <label class="details" for="20-radio">Outdoor Seating</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="9-radio" name="features">
                            <label class="details" for="9-radio">Gender-neutral </label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="10-radio" name="features">
                            <label class="details" for="10-radio">Restrooms</label>
                        </div>
                    </li>
                    <li>
                        <div class="title primary-underline">Neighborhoods</div>
                        <div class="radio-fields">
                            <input type="radio" id="11-radio" name="neighborhoods">
                            <label class="details" for="11-radio">Alamo Square</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="12-radio" name="neighborhoods">
                            <label class="details" for="12-radio">Anza Vista</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="13-radio" name="neighborhoods">
                            <label class="details" for="13-radio">Ashbury Heights</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="14-radio" name="neighborhoods">
                            <label class="details" for="14-radio">Balboa Terrace</label>
                        </div>
                    </li>
                    <li>
                        <div class="title primary-underline">Distance</div>
                        <div class="radio-fields">
                            <input type="radio" id="15-radio" name="distance">
                            <label class="details" for="15-radio">Bird's-eye View</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="16-radio" name="distance">
                            <label class="details" for="16-radio">Driving (5 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="17-radio" name="distance">
                            <label class="details" for="17-radio">Biking (2 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="18-radio" name="distance">
                            <label class="details" for="18-radio">Walking (1 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="19-radio" name="distance">
                            <label class="details" for="19-radio">Within 4 blocks</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class='col-lg-8'>
                <div class="sponsore-content">
                    <div class="login-form">
                        <div class="title">
                            <h3>Sign Up</h3>
                        </div>
            <div class="col-12 col-lg-12 wow bounceInRight">
                <form method="POST" action="{{route('sign-up-submit')}}" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-form__fields">
                               <div class="title">Full Name</div>
                                <input type="text" name="fullname" value="{{old('fullname')}}" required placeholder="Johndeo">
                                @if ($errors->has('fullname'))
                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                               <div class="title">Email</div>
                                <input type="email" name="email" value="{{old('email')}}" required placeholder="Johndoe@gmail.com">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                               <div class="title">Password</div>
                                <input type="password" id="password" name="password" required placeholder="***********">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <div class="pass-show-hide-btn">
                                    <span class="icon showPassword"><i class="far fa-eye"></i></span>
                                    <span class="icon hidePassword"><i class="fas fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                               <div class="title">Confirm Password</div>
                                <input type="password" id="confirmpassword" name="password_confirmation" required placeholder="***********">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-btn">
                                
                                <p>Have an account? <a href="{{route('sign-in')}}">Login</a> </p>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                                <button type="submit" class="themeBtn themeBtn--full">Signup</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class='col-lg-2'>
                <div class="location-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2798864718!2d-74.25986673512958!3d40.69767006847737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1678143091027!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN-SEC END -->

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
    $(".showPassword").click(function(){
        $("#password").attr('type', 'text')
    })
    $(".hidePassword").click(function(){
        $("#password").attr('type', 'password')
    })
    
})()
</script>
@endsection
                        