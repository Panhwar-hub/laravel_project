@extends('layouts.main')
@section('content')


<section class="query">
    <div class="auth py-5">
        <div class="container">
            <div class="login-item">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="login-form">
                            <div class="query-title text-center mb-4">
                                <h3>LOG IN</h3>
                            </div>
                            <form  id="contact-form" class="login__contentForm" action="{{route('forget.password.submit')}}" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="inputField">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" required name="email" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-btn">
                                        <button type="submit" class="btn"><span class="w-100">Continue</span></button>
                                    </div>
                                </div>
                                <a href="{{route('sign-up')}}" class="mc-t-2 text-center d-block color-primary a-link">Don't have an Account ? Sign Up</a>
                            </form>
                            <p class="text-center">Already have an Account ? <a href="{{route('sign-in')}}" class="signIn">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- LOGIN-SEC END -->



@endsection
@section('css')
<style type="text/css">
	/*in page css here*/
    /* .sign-in-btn {
    background-color: #ca7c8a;
} */
    .banner-content {position: absolute;top: 50%;width: 42%;left: 0%;transform: translate(0px, -50%);}

.banner-content h2 {font-weight: 600;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bolder;
    font-size: 7rem;
    font-family: var(--primary-font);
    text-transform: uppercase;
    line-height: 1;
    background-image: linear-gradient(#10577f, #3098d0);}

section.banner-section {position: relative;}

section.banner-section .banner-img img {width: 100%;}
.login__Content {padding: 51px 0px;}
.login__links img{
    position: relative;
    top:90px;
}
input#email {}

.login__Content input {
    padding: 5px;
    margin: 10px 60px;
    width: 80%;
    height: 50px;
    border: none;
    background: #f3f3f3;
}
.login__links.text-center {}

button.sign-in-btn {width: 30%;height: 60px;margin: 30px 0px 20px 0px;border: none;border-radius: 50px;color: white;}
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
})()
</script>
@endsection
