@extends('layouts.main')
@section('content')




<!-- BANNER SECTION START -->

<section class="banner-sec">
    <div class="container">
        <div class="banner-img"></div>
        <div class="banner-content2">

            <?php App\Helpers\Helper::inlineEditable("h3",["class"=>""],'Contact <span>Us</span>','CONTACTTXT2');?>
        </div>
    </div>
</section>

<!-- BANNER SECTION END -->



<section class="contact-us pdy-60">
    <div class="container">
        <div class="about__content section-Content primary-heading color-dark">

            <?php App\Helpers\Helper::inlineEditable("h4",["class"=>""],'Connect with <span> Us</span>','CONTACTTXT3');?>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="google-iframe-map pdy-40">
                    <iframe
                        src="https://maps.google.com/maps?q=%27+<?php echo $config['COMPANYADDRESS']?>+'&output=embed"
                        width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                            href="https://www.gps.ie/wearable-gps/">Kids wearables</a></iframe>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="connect-from">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-form">
                            <form action="{{route('contact-us-submit')}}" method="post">
                            @csrf
                                    <div class="form-group">
                                        <input type="text" name="fname" id="" placeholder="your first Name"
                                            class="form-control">
                                            @if ($errors->has('fname'))
                                <span class="text-danger">{{ $errors->first('fname') }}</span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lname" id="" placeholder="your last Name"
                                            class="form-control">
                                            @if ($errors->has('lname'))
                                <span class="text-danger">{{ $errors->first('lname') }}</span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="" placeholder="your email address"
                                            class="form-control">
                                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="phone" id="" placeholder="your phone"
                                            class="form-control">
                                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="7" name="message"
                                            placeholder="Write a message...... "></textarea>
                                        @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                        @endif
                                    </div>
                                </form>
                            </div>



                            <div class="form-group shop-form-btn">
                                <button type="submit" class="primary-btn primary-bg form-control">Submit</button>

                            </div>
                        </div>
                    </div>
                </div>


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
