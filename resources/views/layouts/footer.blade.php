
<footer class="footer">
    <img src='images/footer-bg.jpg' alt='image' class='imgFluid footer__bg' loading='lazy'>
    <div class="newsletter">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section-content">
                        <div class="heading">Subscribe To Our Newsletter</div>
                        <p>SubScribe to Our Weekly Newsletter to Stay Informed on the Latest News!</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="newsletter-content">
                        <form action="{{ route('newsletterstore') }}" method="POST" class="newsletter-content__form">
                            @csrf
                            <i class='bx bx-envelope'></i>
                            <input placeholder="Enter your email" type="email" name="email" required/>
                            <button type="submit" class="themeBtn">Subscribe Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="footerWrapper">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer__quickLinks">
                        <div class="title">office location</div>
                        <ul>
                            <li>
                                <address>302 JASPER CV MISSOURI CITY TX 77459</address>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6  col-sm-6">
                    <div class="footer__quickLinks">
                        <div class="title">contact</div>
                        <ul>
                            <li>24/7 Support :<a href="tel:{{$config['COMPANYPHONE']}}">{{$config['COMPANYPHONE']}}</a></li>
                            <li><a href="mailto:{{$config['COMPANYEMAIL']}}">{{$config['COMPANYEMAIL']}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-sm-6">
                    <div class="footer__quickLinks">
                        <div class="title">navigate</div>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('restaurants') }}">Restaurants</a></li>
                            <li><a href="{{ route('music') }}">Music</a></li>
                            <li><a href="{{ route('art-and-museums') }}">Art & Museums</a></li>
                            <li><a href="{{ route('events') }}">Events</a></li>
                            <li><a href="{{ route('lifestyle') }}">Lifestyle</a></li>
                            <li><a href="{{ route('new-to-the-area') }}">New to the Area?</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer__newletter">
                        <div class="title">Social media</div>
                        <ul class="social-links">
                            <li>
                                <a href="{{$config['FACEBOOK']}}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li>
                            <li>
                                <a href="{{$config['TWITTER']}}" target="_blank"><i class='bx bxl-twitter'></i></a>
                            </li>
                            <li>
                                <a href="{{$config['INSTAGRAM']}}" target="_blank"><i class='bx bxl-instagram'></i></a>
                            </li>
                            <li>
                                <a href="{{$config['YOUTUBE']}}" target="_blank"><i class='bx bxl-youtube'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <p>Copyright &copy; 2023 www.thisweekinftbend.com. All Rights Reserved.</p>
    </div>
</footer>

<div class="modal fade" id="askquest" tabindex="-1" aria-labelledby="askquestLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading text-uppercase">Ask the community
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="contact-content">
                    <div class="section-content mb-4">

                    </div>
                    <form action="{{ route('create-faq') }}" method="POST" class="contact-form">
                        @csrf
                        <input type="hidden" name="product_id" id="faq_product_id">
                        <div class="row">
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Name</div>
                                    <input placeholder="Your Name" name="name" type="text" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Email</div>
                                    <input placeholder="info@demolink.com" name="email" type="email" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Question</div>
                                    <textarea placeholder="Your message..." name="question" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <button type="submit" class="themeBtn themeBtn--full">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

<!--<div class="modal fade" id="subscribe" tabindex="-1" aria-labelledby="subscribeLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog  modal-dialog-centered modal-lg">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="exampleModalLabel">-->
<!--                    <div class="heading text-uppercase">Subscribe-->
<!--                    </div>-->
<!--                </h5>-->
<!--                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i-->
<!--                        class="far fa-times"></i></button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <div class="contact-content">-->
<!--                    <div class="section-content mb-4">-->

<!--                    </div>-->
<!--                    <div class="newsletter-content">-->
<!--                        <form action="{{ route('newsletterstore') }}" method="POST" class="newsletter-content__form">-->
<!--                            @csrf-->
<!--                            <div class="contact-form__fields">-->
<!--                            <i class='bx bx-envelope'></i>-->
<!--                            <input placeholder="Enter your email" type="email" name="email" class="form-control"/>-->
<!--                            </div>-->
<!--                            <button type="submit" class="themeBtn">Subscribe Now</button>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
           
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="modal fade" id="newsletter-popup">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="row no-gutters">
                    <div class="col-12 col-lg-5">
                        <div class="newsletter-popup__img">
                            <img src="{{asset('images/about-img-1.png')}}" alt="image">
                        </div>  
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="newsletter-popup__content">
                            <span class="close" data-dismiss="modal"><i class="bx bx-x bx-sm"></i></span>
                            <div class="title">Subscribe NOW</div>
                            <form action="{{ route('newsletterstore') }}" method="POST" class="auth-form mt-3">
                                @csrf
                                
                                <div class="input-field">
                                    <label>Email Address</label>
                                    <input type="email" placeholder="Email Address" name="email">
                                </div>
                                <button type="submit" class="themeBtn themeBtn--full mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="sign-inLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading text-uppercase">Login
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-content">
                    <div class="section-content mb-4">

                    </div>
                    <form action="{{route('sign-in-submit')}}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Email</div>
                                    <input placeholder="info@demolink.com" name="email" type="email" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Password</div>
                                    <input type="password" id="password" required name="password" placeholder="**********">
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
                                <a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#forget_password">Reset Password</a>
                                
                                <p>Don’t have an account? <a href="#"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sign-up">Register Here</a> </p>
                                <div class="contact-form__fields">
                                    <button type="submit" class="themeBtn themeBtn--full">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="sign-up" tabindex="-1" aria-labelledby="sign-upLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading text-uppercase">Registration
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-content">
                    <div class="section-content mb-4">

                    </div>
                    <form method="POST" action="{{route('sign-up-submit')}}" class="contact-form" id="register-form-up">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="contact-form__fields">
                                   <div class="title">First Name</div>
                                    <input type="text" name="fname" value="{{old('fname')}}" required placeholder="John">
                                    @if ($errors->has('fname'))
                                        <span class="text-danger">{{ $errors->first('fname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                   <div class="title">Last Name</div>
                                    <input type="text" name="lname" value="{{old('lname')}}" required placeholder="Deo">
                                    @if ($errors->has('lname'))
                                        <span class="text-danger">{{ $errors->first('lname') }}</span>
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
                            <div class="col-6">
                                <div class="contact-form__fields">
                                   <div class="title">Password</div>
                                    <input type="password" id="PassEntry" class="password passwordInput" name="password" required placeholder="***********">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <div class="pass-show-hide-btn">
                                        <span class="icon rshowPassword"><i class="far fa-eye"></i></span>
                                        <span class="icon rhidePassword" style="diaplay:none;"><i class="fas fa-eye-slash"></i></span>
                                    </div>
                                     
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-form__fields">
                                   <div class="title">Confirm Password</div>
                                    <input type="password" id="confirmpassword" class="password passwordInput" name="password_confirmation" required placeholder="***********">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                    <div class="pass-show-hide-btn">
                                        <span class="icon rshowPassword"><i class="far fa-eye"></i></span>
                                        <span class="icon rhidePassword" style="diaplay:none;"><i class="fas fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12">
                                <span id="StrengthDisp" class="badge displayBadge">Weak</span>
                            </div>
                            <div class="col-12">
                                <div class="form-btn">
                                    
                                    <p>Have an account? <a href="#"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sign-in">LogIN</a> </p>
                                </div>
    
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <button type="submit" class="themeBtn themeBtn--full" id="reg-sub">Signup</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="forget_password" tabindex="-1" aria-labelledby="forget_passwordLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading text-uppercase">Login
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="contact-content">
                    <div class="section-content mb-4">

                    </div>
                    <form action="{{route('forget.password.submit')}}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Email</div>
                                    <input placeholder="info@demolink.com" name="email" type="email" />
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <p>Don’t have an account? <a href="#"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#sign-up">Register Here</a> </p>
                                <div class="contact-form__fields">
                                    <button type="submit" class="themeBtn themeBtn--full">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>

</div>


 