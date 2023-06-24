@extends('layouts.main')
@section('content')


<div class="banner">

    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider[0]->img_path)}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="bannerContentSlider">
                    @foreach($slider as $slide)
                        <div class="banner-content text-center">
                            <div class='themeBtn themeBtn--center tag'>Restaurant</div>
                            <?php echo html_entity_decode($slide->long_desc)?>
                            
                            <ul class='banner-content__details'>
                                <li>
                                    <i class='bx bxs-user'></i>
                                    <div class='title'> posted by : {{$slide->headings}}</div>
                                </li>
                                <li>
                                    <i class='bx bxs-calendar-exclamation'></i>
                                    <div class='title'> Date : <span class="DateHeighlite">{{ date_format($slide->created_at, 'd m Y') }}</span></div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                   
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="filtersWrapper">
                    <a href="{{ route('home') }}" class="web-logo">
                        <img src="{{ asset($logo->img_path) }}"alt='image' class='imgFluid' loading='lazy'>
                    </a>
                    <ul class="filters">
                        <li class="filters-single">
                            <form action="#" class="filters-single__search">
                                <input type="search" placeholder="What are you looking for?" class="ser">
                                <input type="hidden" name="cat_id" id="get_catC-search" >
                                <button><i class='bx bx-search'></i></button>
                            </form>
                        </li>
                        <li class="filters-single">
                            <select id="select_catC-search">
                                <option value="">All Categories</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id}}">{{ $cat->title}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="filters-single">
                            <button class="themeBtn" id="select_catC_search_btn">Search</button>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- About -->
<div class="about mar-y pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about__img bg-boxes">
                    <img alt="image" class="imgFluid" src="{{asset('images/about-img-1.png')}}" />
                </div>
            </div>
            <div class="col-lg-6">
                <?php App\Helpers\Helper::inlineEditable("div",["class"=>"about__content section-content mt-lg-0 mt-4"],"<h3 class='subHeading'> </h3>
                <h4 class='heading'>Welcome to This Week in  <span> Ft Bend!</span></h4>
                <p>We're your go-to source for all the latest happenings in Ft Bend County! Are you tired of going to the same old places every weekend? Do you want to support local businesses and discover new and exciting spots to dine, catch a concert or comedy show, or peruse an art gallery or museum? Look no further!</p>
                <p>Our page is filled with energetic recommendations and insider tips on the best local spots to explore. From trendy new restaurants and hidden gem art galleries to upcoming theater performances and live music events, we've got you covered.</p>
                <p>Join our community of like-minded individuals who are passionate about supporting small businesses and discovering all that Ft Bend has to offer. We can't wait to share our love for the local scene with you!</p>
                <p>So come along for the ride, and let's explore all the exciting opportunities that This Week in Ft Bend has in store!</p>
                ",'Welcome-head-1');?>
                {{-- <div class="about__content section-content">
                    <h3 class='subHeading'><span>About thisweekinftbend</span> </h3>
                    <h4 class='heading'>this week information bend
                        Take Your <span> Business to the
                            Next Level?</span></h4>
                    <b>these might be a few reasons why...</b>
                    <ul class='details'>
                        <li>Neque porro quisquam est qui dolorem ipsum quia</li>
                        <li>Neque porro quisquam est qui dolorem ipsum quia dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</li>
                        <li>Neque porro quisquam est qui dolorem ipsum quia</li>
                        <li>Neque porro quisquam est qui dolorem ipsum quia</li>
                        <li>Neque porro quisquam est qui dolorem ipsum quia dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</li>
                        <li>Neque porro quisquam est qui dolorem ipsum quia</li>
                    </ul>

                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Reviews -->
<div class='reviews reviews-bg'>
    <img src="{{ asset('images/quote-img.png') }}"alt='image' class='imgFluid reviews__quote' loading='lazy'>
    <div class='container'>
        <div class='row justify-content-center mb-5'>
            <div class='col-12 col-lg-8'>
                <div class='section-content text-center'>
                    <h5 class='heading'>Our Clients Latest Reviews</h5>
                    <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>-->
                </div>
            </div>
        </div>
        <div class='row reviewsSlider'>
            @foreach($reviews as $rate)
            
            <div class='col-lg-4'>
                <div class='reviews-card'>
                    <ul class="rating five-star">
                        <?php
                            $rating = $rate->rating;
                        ?>
                        @for ($i = 0; $i < 5; $i++)
                            @if ($rating > $i)
                                <li >
                                    <img src="{{ asset('images/star-img.png') }}" alt='image'
                                        class='imgFluid' loading='lazy'>
                                </li>
                            @else
                                <li class="four-star-detail">
                                    <img src="{{ asset('images/star-img.png') }}" alt='image'
                                        class='imgFluid' loading='lazy'>
                                </li>
                            @endif
                        @endfor

                    </ul>
                    <!--<div class="reviews-card__title">“Neque porro quisquam est qui dolorem ipsum quia dolor sit amet”</div>-->
                    <div class="reviews-card__content">{{ $rate->review }} </div>
                    <div class="reviews-card__user">
                        <div class="user-img">
                            <img src="{{ asset('images/person-img-1.png') }}"alt='image' class='imgFluid' loading='lazy'>
                        </div>
                        <div class="user-details">
                            <div class="name">{{ $rate->name }}</div>
                            <div class="date"> <?php echo date_format($rate->created_at, 'd D Y')?></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
@section('css')
<style type="text/css">
    .reviews-card ul.five-star li.four-star-detail{
        background-color:grey;
    }
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
   
})()
</script>
@endsection
