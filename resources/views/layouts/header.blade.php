
<div class="sideBar " id="sideBar">
        <a href="javascript:void(0)" class="sideBar__close" onclick="closeSideBar()">×</a>
        <a href="https://premiumwebstop.com/" class="sideBar__logo">
            <img loading="lazy" data-src="images/logo.png" alt="Logo" class="imgFluid lazy loaded" src="{{ asset($logo->img_path) }}" data-was-processed="true">
        </a>
        <ul class="sideBar__nav">
           <li><a href="{{ route('home') }}" class="<?= isset($homemenu) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-1.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Home
                        </span>
                    </a></li>
                <li><a href="{{ route('restaurants') }}" class="<?= isset($restaurant) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-2.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Restaurants
                        </span>
                    </a></li>
                <li><a href="{{ route('music') }}" class="<?= isset($music) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-3.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Music
                        </span>
                    </a></li>
                <li><a href="{{ route('art-and-museums') }}" class="<?= isset($art_and_museums) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-4.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">    
                            Art & Museums
                        </span>
                    </a></li>
                <li><a href="{{ route('events') }}" class="<?= isset($events) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-5.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Events
                        </span>
                    </a></li>
                <li><a href="{{ route('lifestyle') }}" class="<?= isset($lifestyle) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-6.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Lifestyle
                        </span>
                    </a></li>
                <li><a href="{{ route('new-to-the-area') }}" class="<?= isset($new_to_the_area) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-7.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            New to the Area?
                        </span>
                    </a></li>
                <li><a href="{{ route('contact-us') }}" class="<?= isset($contact_us) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-8.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Contact Us
                        </span>
                    </a></li>
            <li><a href="#" class="themeBtn"><i class="bx bxs-phone"></i>877-377-6450</a></li>
            
        </ul>
        <div class="d-flex gap-3">
             <a href="#" class="themeBtn themeBtn--outline my-3" data-toggle="modal" data-target="#newsletter-popup">subscribe</a>
                @if(Auth::check())
                        <a href="{{ route('dashboard.myProfile') }}"  class="themeBtn my-3">Dashboard</a>                      
                @else
                <a href="#" class="themeBtn my-3" data-toggle="modal" data-target="#sign-in">Login</a>
                @endif
        </div>
               
                
                <ul class="social-links social-links--sm">
                    <li>
                        <a href="{{$config['FACEBOOK']}}" target="_blank"><i class='bx bxl-facebook'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['INSTAGRAM']}}" target="_blank"><i class='bx bxl-instagram'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['TWITTER']}}" target="_blank"><i class='bx bxl-twitter'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['YOUTUBE']}}" target="_blank"><i class='bx bxl-youtube'></i></a>
                    </li>
                </ul>
    </div>
    
    
<header class="header">
    <div class="container">
        <div class="header-main">
             <ul class="header-main__nav d-flex d-lg-none">
                <li><a href="{{ route('home') }}" class="<?= isset($homemenu) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-1.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Home
                        </span>
                    </a></li>
            </ul>        
            <ul class="header-main__nav d-none d-lg-flex">
                <li><a href="{{ route('home') }}" class="<?= isset($homemenu) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-1.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Home
                        </span>
                    </a></li>
                <li><a href="{{ route('restaurants') }}" class="<?= isset($restaurant) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-2.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Restaurants
                        </span>
                    </a></li>
                <li><a href="{{ route('music') }}" class="<?= isset($music) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-3.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Music
                        </span>
                    </a></li>
                <li><a href="{{ route('art-and-museums') }}" class="<?= isset($art_and_museums) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-4.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">    
                            Art & Museums
                        </span>
                    </a></li>
                <li><a href="{{ route('events') }}" class="<?= isset($events) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-5.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Events
                        </span>
                    </a></li>
                <li><a href="{{ route('lifestyle') }}" class="<?= isset($lifestyle) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-6.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Lifestyle
                        </span>
                    </a></li>
                <li><a href="{{ route('new-to-the-area') }}" class="<?= isset($new_to_the_area) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-7.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            New to the Area?
                        </span>
                    </a></li>
                <li><a href="{{ route('contact-us') }}" class="<?= isset($contact_us) ? 'active' : '' ?>">
                        <img src="{{ asset('images/nav-img-8.png') }}" alt='image' class='imgFluid' loading='lazy'>
                        <span class="title">
                            Contact Us
                        </span>
                    </a></li>
            </ul>
            <div class="header-main__actions d-none d-lg-flex">
                <a href="#" class="themeBtn themeBtn--outline" data-toggle="modal" data-target="#newsletter-popup">subscribe</a>
                @if(Auth::check())
                        <a href="{{ route('dashboard.myProfile') }}"  class="themeBtn ">Dashboard</a>                      
                @else
                <a href="#" class="themeBtn " data-toggle="modal" data-target="#sign-in">Login</a>
                @endif
                <ul class="social-links social-links--sm">
                    <li>
                        <a href="{{$config['FACEBOOK']}}" target="_blank"><i class='bx bxl-facebook'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['INSTAGRAM']}}" target="_blank"><i class='bx bxl-instagram'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['TWITTER']}}" target="_blank"><i class='bx bxl-twitter'></i></a>
                    </li>
                    <li>
                        <a href="{{$config['YOUTUBE']}}" target="_blank"><i class='bx bxl-youtube'></i></a>
                    </li>
                </ul>
                

            </div>
            <div class="header-main__menu d-block d-lg-none">
                    <a href="javascript:viod(0)" onclick="openSideBar()" class="header-menu-btn"><i class="bx bx-menu"></i></a>
                </div>
        </div>
    </div>
</header>