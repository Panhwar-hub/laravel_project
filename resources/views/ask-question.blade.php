@extends('layouts.main')
@section('content')


<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <h1 class="banner-content__heading bg-line">Ask Questions</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="contact my-5 py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-12 wow bounceInLeft">
                <div class="contact-content">
                    <div class="section-content mb-4">
                        <div class="heading text-uppercase">Ask the community
                        </div>

                    </div>
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Name</div>
                                    <input placeholder="Your Name" type="text" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Email</div>
                                    <input placeholder="info@demolink.com" type="email" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Question</div>
                                    <textarea placeholder="Your message..." rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <button class="themeBtn themeBtn--full">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-6 wow bounceInRight">

            </div>
        </div>
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
