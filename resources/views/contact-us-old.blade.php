@extends('layouts.main')
@section('content')
    @extends('layouts.main')
@section('content')
    <section class="breadcumb" style="background-image: url(assets/images/pg-banner.png);">
        <div class="container">
            <div class="breadcumb-con">
                <?php App\Helpers\Helper::inlineEditable('h2', ['class' => ''], 'Contact Us', 'CONTACTTXT2'); ?>
            </div>
        </div>
    </section>
    <!-- BANNER SECTION START -->

    <section class="contact-sec">
        <div class="container">
            <div class="form-inner-item">
                <div class="contact-form">
                    <form action="{{ route('contact-us-submit') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-img">
                                    <img src="{{ asset('images/contact-img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h2>Contact Information</h2>
                                        <h5>Say something to start a live chat!</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-item">
                                            <input type="text" name="fname" placeholder="First Name">
                                            @if ($errors->has('fname'))
                                                <span class="text-danger">{{ $errors->first('fname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-item">
                                            <input type="text" name="lname" placeholder="Last Name">
                                            @if ($errors->has('lname'))
                                                <span class="text-danger">{{ $errors->first('lname') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-item">
                                            <input type="text" name="email" placeholder="Email">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-item">
    
                                            <input type="text" name="phone" placeholder="Phone Number">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-lg-12">
                                            <div class="form-item">
                                                <textarea placeholder="Message" name="message" ></textarea>
                                                @if ($errors->has('message'))
                                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-btn ">
                                                <button type="submit" class="btn">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="contact-item text-center">
                                            <i class="fas fa-phone-alt"></i>
                                            <h6><a href="tel:{{ $config['COMPANYPHONE'] }}">{{ $config['COMPANYPHONE'] }}</a></h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="contact-item text-center">
                                            <i class="fas fa-envelope"></i>
                                            <h6><a href="mailto:{{ $config['EXTERNALEMAIL'] }}">{{ $config['EXTERNALEMAIL'] }}</a></h6>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="contact-item text-center">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <h6><a href="{{ $config['COMPANYADDRESS'] }}">132 Demo Address</a></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
        #demo {
            text-align: center;
            font-size: 60px;
            margin-top: 0px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {

        })()
    </script>
@endsection


@endsection
@section('css')
<style type="text/css">
    /*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">
    (() => {
        /*in page css here*/
    })()
</script>
@endsection
