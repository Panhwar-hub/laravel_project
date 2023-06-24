<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ isset($title) ? $title : '' }}</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    
        <link rel="icon" type="image/jpg" href="{{ asset(isset($logo) ? $logo->img_path : '') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.links')
        @yield('css')
        
        <!-- CSS Styling -->
        <style>
            .passwordInput{
                margin-top: 5%; 
                text-align :center;
            }
    
            .displayBadge{
                margin-top: 5%; 
                display: none; 
                text-align :center;
            }
            #reg-sub{
                display:none;
            }
        </style>
    </head>
<body>

    <input type="hidden" id="web_base_url" value="{{ url('/') }}" />
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.scripts')
    @yield('js')
    <script type="text/javascript">
    // timeout before a callback is called

    let timeout;

    // traversing the DOM and getting the input and span using their IDs

    let password = document.getElementById('PassEntry')
    let strengthBadge = document.getElementById('StrengthDisp')

    // The strong and weak password Regex pattern checker

    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
    let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')
    
    function StrengthChecker(PasswordParameter){
        // We then change the badge's color and text based on the password strength

        if(strongPassword.test(PasswordParameter)) {
            strengthBadge.style.backgroundColor = "green"
            strengthBadge.textContent = 'Strong'
            document.getElementById("reg-sub").style.display = "block";
        } else if(mediumPassword.test(PasswordParameter)){
            strengthBadge.style.backgroundColor = 'blue'
            strengthBadge.textContent = 'Medium'
            document.getElementById("reg-sub").style.display = "block";
        } else{
            strengthBadge.style.backgroundColor = 'red'
            strengthBadge.textContent = 'Weak'
        }
    }

    // Adding an input event listener when a user types to the  password input 

    password.addEventListener("input", () => {

        //The badge is hidden by default, so we show it

        strengthBadge.style.display= 'block'
        clearTimeout(timeout);

        //We then call the StrengChecker function as a callback then pass the typed password to it

        timeout = setTimeout(() => StrengthChecker(password.value), 500);

        //Incase a user clears the text, the badge is hidden again

        if(password.value.length !== 0){
            strengthBadge.style.display != 'block'
        } else{
            strengthBadge.style.display = 'none'
        }
    });


        (() => {

            @if (session('notify_success'))
                $.toast({
                    heading: 'Success!',
                    position: 'bottom-right',
                    text: '{{ session('notify_success') }}',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 2000,
                    stack: 6
                });
            @elseif (session('notify_error'))
                $.toast({
                    heading: 'Error!',
                    position: 'bottom-right',
                    text: '{{ session('notify_error') }}',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 2000,
                    stack: 6
                });
            @endif
            $(".hidePassword").hide()
            $(".showPassword").click(function(){
                $("#password").attr('type', 'text')
                $(".showPassword").hide()
                $(".hidePassword").show()
            })
            $(".hidePassword").click(function(){
                $("#password").attr('type', 'password')
                $(".hidePassword").hide()
                $(".showPassword").show()
            })
            
            
            $(".rhidePassword").hide()
            $(".rshowPassword").click(function(){
                $(".password").attr('type', 'text')
                $(".rshowPassword").hide()
                $(".rhidePassword").show()
            })
            $(".rhidePassword").click(function(){
                $(".password").attr('type', 'password')
                $(".rhidePassword").hide()
                $(".rshowPassword").show()
            })
            
            
            $("form.filters-single__search > button").click(function(){
                $('form.filters-single__search').attr('action', "{{route('search')}}");
                $('form.filters-single__search > input').attr('name', 'search');
                $("form.filters-single__search").submit();
                e.preventDefault();
            })
            
            $("#select_catC_search_btn").click(function(){
                $('form.filters-single__search').attr('action', "{{route('search')}}");
                $("#get_catC-search").val($("#select_catC-search").val())
                
                $('form.filters-single__search > .ser').attr('name', 'search');
                $("form.filters-single__search").submit();
                e.preventDefault();
            })
        })()
    </script>
    @include('layouts.errorhandler')
    @include('admin.core.editor')
</body>
<div id="preloader" style="display:none;">
    <div class="loading">
        <span>Loading...</span>
    </div>

</html>
