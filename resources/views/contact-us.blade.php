@extends('layouts.main')
@section('content')


<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <?php echo html_entity_decode($slider->long_desc)?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="contact mt-5 pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6 wow bounceInLeft">
                <div class="contact-content">
                    <div class="section-content mb-4">
                        <div class="heading text-uppercase"> Get in touch with us!</div>
                        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                    </div>
                    <ul class="contact-content__info">
                        <li>
                            <div class="icon"><i class='bx bx-envelope'></i></div>
                            <div class="title">Email</div>
                            <a href="mailto:{{$config['COMPANYEMAIL']}}">{{$config['COMPANYEMAIL']}}</a>
                        </li>
                        <li>
                            <div class="icon"><i class='bx bx-phone-call bx-tada' ></i></div>
                            <div class="title">Phone</div>
                            <a href="tel:{{$config['COMPANYPHONE']}}">{{$config['COMPANYPHONE']}}</a>
                        </li>
                        <li>
                            <div class="icon"><i class='bx bx-map' ></i></div>
                            <div class="title">Office</div>
                            <address>302 JASPER CV, MISSOURI CITY, TX, 77459</address>
                        </li>
                        <li>
                            <div class="icon"><i class='bx bx-grid' ></i></div>
                            <div class="title">Socials</div>
                            <ul class="social-links social-links--transparent">
                                <li>
                                    <a href="{{$config['FACEBOOK']}}"><i class='bx bxl-facebook'></i></a>
                                </li>
                                <li>
                                    <a href="{{$config['TWITTER']}}"><i class='bx bxl-twitter'></i></a>
                                </li>
                                <li>
                                    <a href="{{$config['LINKEDIN']}}"><i class='bx bxl-linkedin'></i></a>
                                </li>
                                <li>
                                    <a href="{{$config['YOUTUBE']}}"><i class='bx bxl-youtube'></i></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6 wow bounceInRight">
                <form action="{{ route('contact-us-submit') }}" method="post" class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-form__fields">
                                <div class="title">Email</div>
                                <input placeholder="info@demolink.com" type="email" name="email"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                                <div class="title">Message</div>
                                <textarea placeholder="Your message..." rows="4" name="message"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="contact-form__fields">
                                <button type="submit" class="themeBtn themeBtn--full">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="contact__map mt-5 pt-4">
        <iframe src="https://maps.google.com/maps?q=%27+<?=$config['COMPANYADDRESS']?>;+'&output=embed" width="100%" height="490" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>

@endsection
@section('css')
<style type="text/css">

</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
   
})()
</script>
@endsection
