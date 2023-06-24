@extends('layouts.main')
@section('content')


<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <?php echo html_entity_decode($slider->long_desc)?>
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
                        <img src="{{ asset($logo->img_path) }}" alt='image' class='imgFluid' loading='lazy'>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Sponsore -->
<div class='sponsore mar-y'>
    <div class='container-fluid px-5'>
        <div class='row'>
            <div class='col-lg-12'>
                <?php App\Helpers\Helper::inlineEditable("div",["class"=>""],"
                <ol>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Information We Collect We collect information about you in a variety of ways, including:</span></span></span></span></li>
                </ol>
                
                <ul>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Information you provide: We collect the information you provide to us when you create an account, update your profile, post reviews or other content, participate in surveys, or interact with other users on the site. This may include your name, email address, phone number, location, and other personal information.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Information we collect automatically: We also collect information automatically when you use our site or services, such as your IP address, device type, browser type, operating system, and other technical information. We may also collect information about your use of our site or services, including the pages you visit, the features you use, and the content you view.</span></span></span></span></li>
                </ul>
                
                <ol start='2'>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>How We Use Your Information We use the information we collect to provide and improve our services, personalize your experience, and communicate with you. This includes:</span></span></span></span></li>
                </ol>
                
                <ul>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Providing and improving our services: We use your information to provide our services to you, including personalized recommendations, search results, and advertising.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Personalizing your experience: We use your information to personalize your experience on our site, such as by displaying reviews and content that are relevant to your interests.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Communicating with you: We may use your information to communicate with you about our services, promotions, and other news. We may also use your information to respond to your inquiries or requests.</span></span></span></span></li>
                </ul>
                
                <ol start='3'>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Sharing Your Information We may share your information with third parties in the following circumstances:</span></span></span></span></li>
                </ol>
                
                <ul>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>With your consent: We may share your information with third parties if you have given us your consent to do so.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>With service providers: We may share your information with service providers who perform services on our behalf, such as hosting, payment processing, and analytics.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>For legal reasons: We may disclose your information if we believe it is necessary to comply with applicable laws, regulations, or legal process, or to protect our rights or the rights of others.</span></span></span></span></li>
                </ul>
                
                <ol start='4'>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Your Choices You have choices about the information you provide to us and how it is used. You can:</span></span></span></span></li>
                </ol>
                
                <ul>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Opt-out of marketing communications: You can choose to opt-out of receiving marketing communications from us by following the instructions in the communication.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Control your settings: You can control your privacy settings on our site to limit the information that is visible to other users.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Delete your account: You can delete your account at any time by contacting us.</span></span></span></span></li>
                </ul>
                
                <ol start='5'>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Data Security We take reasonable measures to protect the security of your personal information, including using encryption and secure servers to protect your data. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</span></span></span></span></li>
                	<li style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='tab-stops:list .5in'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>Changes to this Privacy Policy We may update this Privacy Policy from time to time to reflect changes in our practices or applicable laws. We will notify you of any material changes by posting the updated policy on our site or by email.</span></span></span></span></li>
                </ol>
                
                <p style='margin:0in 0in 8pt'><span style='font-size:11pt'><span style='line-height:107%'><span style='font-family:Calibri,&quot;sans-serif&quot;'>If you have any questions or concerns about our Privacy Policy, please contact us at <a href='mailto:privacy@twifb.com' style='color:#0563c1; text-decoration:underline' target='_new'>privacy@twifb.com</a>.</span></span></span></p>
                ",'Welcome-head-1');?>
            </div>

        </div>
    </div>
</div>

@endsection
@section('css')
<style type='text/css'>

</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
    $(".suggested").click(function() {
        window.location.href = "{{ route('events') }}/suggestion/"+$(this).val();
    })

    $(".features").click(function() {
        window.location.href = "{{ route('events') }}/feature/"+$(this).val();
    })

    $(".address").click(function() {
        window.location.href = "{{ route('events') }}/address/"+$(this).val();
    })
})()
</script>
@endsection
