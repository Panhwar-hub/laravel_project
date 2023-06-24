@extends('layouts.main')
@section('content')
    <!-- MAIN-SLIDER START -->

    <section class="query">
        <div class="auth py-5">
            <div class="container">
                <div class="login-item">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <div class="login-form">
                                <div class="query-title text-center mb-4">
                                    <h3>Reset Password</h3>
                                </div>
                                <form id="contact-form" class="login__contentForm"
                                    action="{{ route('reset.password.post') }}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <input name="password" required type="password" class="form-control"
                                                    placeholder="Your New Password">
                                                @if ($errors->has('password'))
                                                    <span class="error">{{ $errors->first('password') }}</span>
                                                @endif
                                                <input name="email" value="{{ $reset_email->email }}" required
                                                    type="hidden" class="form-control">
                                                <input name="token" value="{{ $token }}" required type="hidden"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="sign-in-btn">Continue</button>
                                        </div>


                                    </div>
                                </form>
                                <p class="text-center">Already have an Account ? <a href="{{ route('sign-in') }}"
                                    class="signIn">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT-PAGE END -->
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
        .sign-in-btn {
            background-color: #ca7c8a;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            width: 100%;
            left: -42%;
            transform: translate(0px, -50%);
        }

        .banner-content h2 {
            font-weight: 600;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bolder;
            font-size: 7rem;
            font-family: var(--primary-font);
            text-transform: uppercase;
            line-height: 1;
            background-image: linear-gradient(#10577f, #3098d0);
        }

        section.banner-section {
            position: relative;
        }

        section.banner-section .banner-img img {
            width: 100%;
        }

        .contact__form {
            padding: 51px 0px;
        }

        input#email {}

        .contact__form input {
            padding: 5px;
            margin: 10px 60px;
            width: 80%;
            height: 50px;
            border: none;
            background-color: #e8f0fe;
            /* color: black; */
        }

        .login__links.text-center {}

        button.sign-in-btn {
            width: 30%;
            height: 60px;
            margin: 30px 0px 20px 0px;
            border: none;
            border-radius: 50px;
            color: white;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            /*in page css here*/
        })()
    </script>
@endsection
