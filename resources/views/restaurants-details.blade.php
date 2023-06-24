@extends('layouts.main')
@section('content')

<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <h1 class="banner-content__heading bg-line">{{ $category->title }} Details</h1>
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
    <div class='container'>
        <div class="row">
            <div class="col-md-8">
                <div class="restaurant-details-btns">
                    <a href="javascript:;" class="btn btn1" data-toggle="modal" data-target="#reviewmodal"><i class='bx bx-star'></i> Write a Review</a>
                    <div class="share-wraper">
                         <a href="javascript:;"  class="btn"><i class="far fa-upload"></i> Share</a>
                        <ul class="social-links social-links--sm">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/product-detail/'.$product->slug)}}" target="_blank"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{url('/product-detail/'.$product->slug)}}&text=" target="_blank"><i class="bx bxl-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{url('/product-detail/'.$product->slug)}}" target="_blank"><i class="bx bxl-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sponsore-content">
                    <div class="sponsore-content-list sponsore-content-list--single">
                        <div class='row align-items-center'>
                            
                            <div class='col-lg-4'>
                                <div class="sponsore-img bg-boxes bg-boxes--alt">
                                    <img src="{{ asset($product->img_path) }}" alt='image' class='imgFluid' loading='lazy'>
                                </div>
                            </div>
                            <div class='col-lg-8'>
                                <div class="sponsore-details">
                                    <div class="title"> {{ $product->name }}</div>
                                    <div class="article-card__details">
                                        <div class="wrapper">
                                            
                                            <div class="date">{{ $product->created_at->format('F m, Y') }} | By Admin</div>
                                            <ul class="rating rating--sm">
                                                <?php 
                                                    $rating = 0;
                                                    $total = 0;
                                                 ?>
                                                @foreach ($product->productHasReviews as $rate)
                                                    @if($rate->is_active == 1)
                                                        <?php 
                                                            $rating += $rate->rating; 
                                                            $total++; 
                                                        ?>
                                                    @endif
                                                @endforeach
                                                @for ($i = 0; $i < 5; $i++)
                                                    <?php
                                                        $to = 0;
                                                    ?>
                                                    @if($total!=0)
                                                    <?php
                                                        $to = round($rating/$total);
                                                    ?>
                                                    @endif
                                                    <li>
                                                        @if ($to > $i)
                                                        <img src="{{ asset('images/star-img.png') }}" alt='image' class='imgFluid four-star-detail' loading='lazy'> 
                                                        @else
                                                        <img src="{{ asset('images/star-img.png') }}" alt='image' class='imgFluid' loading='lazy'>
                                                        @endif
                                                    </li>
                                                @endfor
                                               
                                            </ul>
                                        </div>
                                    </div>

                                    
                                    <div class="d-flex align-items-center justify-content-between">
                                        <ul class="flavours">
                                            <li><a href="javascript:void(0)">italian</a></li>
                                            <li><a href="javascript:void(0)">Pizza</a></li>
                                            <li>Mission Bay</li>
                                        </ul>
                                        <ul class="actions">
                                            <li><a href="#" class={{ ($product->outdoor==0)?'red':'' }} ><i class='bx {{ ($product->outdoor==0)?'bx-x':'bx-check' }}'></i>Outdoor seating</a></li>
                                            <li><a href="#" class={{ ($product->delivery==0)?'red':'' }}><i class='bx {{ ($product->delivery==0)?'bx-x':'bx-check' }}'></i>Delivery</a></li>
                                            <li><a href="#" class={{ ($product->takeout==0)?'red':'' }}><i class='bx {{ ($product->takeout==0)?'bx-x':'bx-check' }}'></i>Takeout</a></li>
                                        </ul>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <ul class="perks">
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('images/perks-img-1.png') }}" alt='image' class='imgFluid'
                                                        loading='lazy'>
                                                    Catering service
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('images/perks-img-2.png') }}" alt='image' class='imgFluid'
                                                        loading='lazy'>
                                                    Large group friendly
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="close-time"><span class="color-primary">{{ $product->status==1?'Opened':'Closed' }}</span>{{ $product->start_time }} until {{ $product->end_time }} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="restaurant-contact-detail">
                    @if($category->slug == 'music' || $category->slug == 'events' || $product->live_streaming != null)
                        <div class="restaurant-contact-detail-item">
                            <span>
                                <a href="{{ $product->live_streaming }}" target="_blank">Live Streaming</a>
                            </span>
                            <i class='bx bx-globe'></i>
                        </div>
                    @endif
                    @if($product->address)
                    <div class="restaurant-contact-detail-item">
                        <span>{{ $product->address }}</span>
                        <i class='bx bxs-map'></i>
                    </div>
                    @endif
                </div>
            </div>
                            
            <div class='col-lg-12 mt-4'>
                <div class="sponsore-details">
                    <hr>
                    <div class="title my-4">Services Offered <span class="verification">Verified by
                            Business <i class="far fa-check-circle"></i></span>
                    </div>
                    <div class="services-offered">
                        <ul>
                            @if($product->feature)
                                @foreach(unserialize($product->feature) as $key => $service)
                                    <?php 
                                        $feature = App\Models\Feature::where('slug', $service)->first();
                                    ?>
                                <li><a href="javascript:;">{{ $feature->name??'' }}</a> </li>
                                @endforeach
                            @endif

                        </ul>

                    </div>
                    
                     <?php

                        $address = $product->country.", ".$product->state.", ".$product->city.", ".$product->area;
                     ?>
                    @if($product->productBelongsToCategory->slug == 'restaurants')
                    <hr>
                    <div class="title my-4">Location & Hours
                    </div>
                    <div class="reslocation-box">
                        <div class="row align-items-center">
                            <div class="col-md-6 ">
                                <div>
                                    <iframe class="product-detail-ifame" src="https://maps.google.com/maps?q=%27+<?=$product->address?>;+'&output=embed" width="100%" height="490" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <p><a href="#"><b> {{ $product->area }} </b></a> <br> <b>{{ $product->country }} {{ $product->state }}</b> <br> {{ $product->city }}    
                                            {{ $product->area }}</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="#" class="btn">Get Direction</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php 
                                    $mon = unserialize($product->Monday);
                                    $tue = unserialize($product->Tuesday);
                                    $wed = unserialize($product->Wednesday);
                                    $thr = unserialize($product->Thrusday);
                                    $fri = unserialize($product->Friday);
                                    $sat = unserialize($product->Saturday);
                                    $sun = unserialize($product->Sunday);
                                   
                                ?>
                                <ul>
                                    <li><span>Mon</span>@if($mon) {{  $mon[0]!=null || $mon[1]!=null?$mon[0]." - ". $mon[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Tue</span>@if($tue) {{  $tue[0]!=null || $tue[1]!=null?$tue[0]." - ". $tue[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Wed</span>@if($wed) {{  $wed[0]!=null || $wed[1]!=null?$wed[0]." - ". $wed[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Thu</span>@if($thr) {{  $thr[0]!=null || $thr[1]!=null?$thr[0]." - ". $thr[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Fri</span>@if($fri) {{  $fri[0]!=null || $fri[1]!=null?$fri[0]." - ". $fri[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Sat</span>@if($sat) {{  $sat[0]!=null || $sat[1]!=null?$sat[0]." - ". $sat[1]:'Closed' }}  @else Closed @endif</li>
                                    <li><span>Sun</span>@if($sun) {{  $sun[0]!=null || $sun[1]!=null?$sun[0]." - ". $sun[1]:'Closed' }}  @else Closed @endif</li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <ul class="current-date">
                                    <li class="text-danger">
                                        @if(date('D') == 'Mon') <b> Mon </b> - @if($mon) {{  $mon[0]!=null || $mon[1]!=null?$mon[0]." - ". $mon[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Tue') <b> Tue </b> - @if($tue) {{  $tue[0]!=null || $tue[1]!=null?$tue[0]." - ". $tue[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Wed') <b> Wed </b> - @if($wed) {{  $wed[0]!=null || $wed[1]!=null?$wed[0]." - ". $wed[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Thu') <b> Thu </b> - @if($thr) {{  $thr[0]!=null || $thr[1]!=null?$thr[0]." - ". $thr[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Fri') <b> Fri </b> - @if($fri) {{  $fri[0]!=null || $fri[1]!=null?$fri[0]." - ". $fri[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Sat') <b> Sat </b> - @if($sat) {{  $sat[0]!=null || $sat[1]!=null?$sat[0]." - ". $sat[1]:'Closed' }}   @else Closed @endif   @endif
                                        @if(date('D') == 'Sun') <b> Sun </b> - @if($sun) {{  $sun[0]!=null || $sun[1]!=null?$sun[0]." - ". $sun[1]:'Closed' }}   @else Closed @endif   @endif
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    <hr>
                    <div class="title-link-box">
                        <div class="title my-4">Ask the Community
                        </div>
                        <a href="javascript:;" data-toggle="modal" data-target="#askquest" id="click_for_faq">Ask
                            a question <i class="far fa-plus"></i></a>
                    </div>

                    <div class="question-answer-boxes">
                        @foreach ($product->productHasFaqs as $faq)
                        <div class="qustion-answer-item">
                            <div class="qa-question">
                                <p> <span>Q: </span> <b>{{ $faq->question }}?</b></p>
                            </div>
                            <div class="qa-answer">
                                <p> <span>A: </span> <?php
                                    echo html_entity_decode($faq->answer);
                                    ?></p>
                            </div>
                            <div class="qa-author-det">
                                <h5>{{ $faq->name }} </h5>
                                {{-- <h6>28 days ago</h6> --}}
                                <h6>{{ $faq->created_at }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="title-link-box">
                        <div class="title my-4">Recommended Reviews
                        </div>
                        <a href="javascript:;">View All
                            Reviews</a>
                    </div>
                    <div class="review-view-box">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="review-user-profile-details">
                                    <img src="{{ asset('images/user-profile.png') }}" alt="">
                                    <div>
                                        <h3>Username</h3>
                                        <h5>Locartion</h5>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="review-stars-box">
                                    <span class="rating">
                                        <input type="radio" class="rating-input" id="5_star"
                                            name="rating-input" value="5 Stars"><label for="5_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="4_star"
                                            name="rating-input" value="4 Stars"><label for="4_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="3_star"
                                            name="rating-input" value="3 Stars"><label for="3_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="2_star"
                                            name="rating-input" value="2 Stars"><label for="2_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="1_star"
                                            name="rating-input" value="1 Star"><label for="1_star"
                                            class="rating-star"></label>
                                    </span>
                                </div>
                                <div class="review-modal-triger">
                                    <a href="javascript:;" data-toggle="modal"
                                        data-target="#reviewmodal" class="btn-link">Start your review of
                                        <b>
                                            Kothai
                                            Republic</b>.</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overall-rating-box my-5">
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="overall-rating-stars">
                                    <h4>Overall rating</h4>
                                    <span class="rating">
                                        
                                        <?php 
                                            $rating = 0;
                                            $total = 0;
                                            $l_1 = 0;
                                            $l_2 = 0;
                                            $l_3 = 0;
                                            $l_4 = 0;
                                            $l_5 = 0;
                                         ?>
                                        @foreach ($product->productHasReviews as $rate)
                                            @if($rate->is_active == 1)
                                                <?php 
                                                    $rating += $rate->rating; 
                                                    $total++; 
                                                    
                                                    if($rate->rating == 1)
                                                    {
                                                        $l_1++;
                                                    }
                                                    elseif($rate->rating == 2)
                                                    {
                                                        $l_2++;
                                                    }
                                                    elseif($rate->rating == 3)
                                                    {
                                                        $l_3++;
                                                    }
                                                    elseif($rate->rating == 4)
                                                    {
                                                        $l_4++;
                                                    }
                                                    elseif($rate->rating == 5)
                                                    {
                                                        $l_5++;
                                                    }
                                                ?>
                                                
                                                
                                            @endif
                                        @endforeach
                                        @for ($i = 0; $i < 5; $i++)
                                            <?php
                                                $to = 0;
                                            ?>
                                            @if($total!=0)
                                            <?php
                                                
                                                $to = round($rating/$total);
                                            ?>
                                            @endif
                                            
                                                @if ($to > $i)
                                                <i class="fas fa-star"></i>
                                                @else
                                                <i class="fas fa-star empty"></i>
                                                @endif
                                            
                                        @endfor
                                
                                    </span>
                                    <h5>{{ $total }} reviews

                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-bars">
                                    <div class="rating-bar">
                                        <label>5 stars </label>
                                        <div class="progress" role="progressbar"
                                        
                                            aria-label="Basic example" aria-valuenow="{{ $l_5==0?'0':($l_5/$total*100) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ $l_5==0?'0':($l_5/$total*100) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rating-bar">
                                        <label>4 stars </label>
                                        <div class="progress" role="progressbar"
                                            aria-label="Basic example" aria-valuenow="{{ $l_4==0?'0':($l_4/$total*100) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ $l_4==0?'0':($l_4/$total*100) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rating-bar">
                                        <label>3 stars </label>
                                        <div class="progress" role="progressbar"
                                            aria-label="Basic example" aria-valuenow="{{ $l_3==0?'0':($l_3/$total*100) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ $l_3==0?'0':($l_3/$total*100) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rating-bar">
                                        <label>2 stars </label>
                                        <div class="progress" role="progressbar"
                                            aria-label="Basic example" aria-valuenow="{{ $l_2==0?'0':($l_2/$total*100) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ $l_2==0?'0':($l_2/$total*100) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="rating-bar">
                                        <label>1 stars </label>
                                        <div class="progress" role="progressbar"
                                            aria-label="Basic example" aria-valuenow="{{ $l_1==0?'0':($l_1/$total*100) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{ $l_1==0?'0':($l_1/$total*100) }}%"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    @foreach ($reviews as $item)
                    <div class="reviews py-0">
                        <div class="review">
                            <div class="review-user-profile-details">
                                <img src="{{ asset('images/user-profile.png') }}" alt="">
                                <div>
                                    <h3>{{ $item->name }}</h3>
                                    <h5>{{ $item->address }}</h5>
                                </div>
                            </div>
                            <div class="review-rating d-flex align-items-center">
                                <span class="rating flex-row justify-content-start">
                                    @for ($i = 0; $i < 5; $i++)
                                    @if ($item->rating > $i)
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="fas fa-star empty"></i>
                                    @endif
                                        
                                    @endfor
                                </span>
                                <h5>
                                   {{ $item->created_at->format('Y-m-d') }}
                                </h5>
                            </div>
                            
                            <div class="review-content">
                                <p>{{ $item->review }}
                                </p>
                            </div>
                          
                        </div>
                    </div>
                    <hr>
                    @endforeach



                    {{-- <div class="content">“Works for me. Definitely a step below Marcello's and Slice
                        House, but
                        at least on par with, & probably a bit better than, Arinell in the Mission. I
                        haven't
                        tried anything on the…”</div>
                    <div class="content">Lorem Ipsum is simply dummy text of the printing and
                        typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                        1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type
                        specimen
                        book. It has survived not only five centuries, but also the leap into electronic
                        typesetting, remaining essentially unchanged It was popularised in the 1960s
                        with the
                        release of Letraset sheets containing Lorem Ipsum passages, and more recently
                        with
                        desktop publishing software like Aldus PageMaker including versions of Lorem
                        Ipsum Lorem
                        Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum
                        has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took.
                    </div>
                    <div class="content">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum
                        has been the industry's standard dummy text ever since the 1500s, when an
                        unknown
                        printer took a galley of type and scrambled it to make a type specimen book. It
                        has
                        survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the
                        release of
                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                        publishing software like Aldus PageMaker including versions of Lorem Ipsum Lorem
                        Ipsum
                        is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the
                        industry's standard dummy text ever since the 1500s, when an unknown printer
                        took.
                    </div>
                    <div class="content">
                        A galley of type and scrambled it to make a type specimen book. It has survived
                        not only
                        five centuries, but also the leap into electronic typesetting, remaining
                        essentially
                        unchanged. It was popularised in the 1960s with the release of Letraset sheets
                        containing Lorem Ipsum passages, and more recently with desktop publishing
                        software like
                        Aldus PageMaker including versions of Lorem Ipsum Lorem Ipsum is simply dummy
                        text of
                        the printing and typesetting industry. Lorem Ipsum has been the industry's
                        standard
                        dummy text ever since the 1500s, when an unknown printer took a galley of type
                        and
                        scrambled it to make a type specimen book. It has survived not only five
                        centuries, but
                        also the leap into electronic typesetting, remaining essentially unchanged. It
                        was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem
                        Ipsum
                        passages, and more recently with desktop publishing software like Aldus
                        PageMaker
                        including versions of Lorem Ipsum.


                    </div> --}}
                </div>
            </div>
            
        </div>
    </div>
</div>


<!-- Article -->
<div class='article bgc-light'>
    <div class='container'>
        <div class='section-content mb-3 d-flex align-items-center justify-content-between'>
            <h2 class='heading primary-underline primary-underline--alt'>All Articles</h2>
            <div class="sliderArrowsWrapper">
                <div class="sliderArrows">
                    <a href="#" class="prevSlider"><i class="bx bx-chevron-left"></i></a>
                    <a href="#" class="nextSlider"><i class="bx bx-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="articleCardSlider">
            <div class="row">
                <div class="col-lg-6">
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                    <div class='article-card article-card--list card-hover'>
                        <a href="#" class='article-card__img card-hover__img'>
                            <img src="{{ asset('images/article-img-1.png') }}" alt='image' class='imgFluid'>
                        </a>
                        <div class='article-card__details'>
                            <div class="wrapper">
                                <div class="date">Feb 14, 2023 | By Steven Devadanam</div>
                                <div class="themeBtn tag">New To The Area?</div>
                            </div>
                            <a href="#" class="heading">Familiar Allen Parkway-area apartments refresh and reboot with
                                social design.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="reviewmodal" tabindex="-1" aria-labelledby="reviewmodal" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading ">Write Review of <a href="javascript:;"> <b> Kothai
                                Republic</b></a>
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="contact-content review-write-sec">
                    <div class="section-content ">

                    </div>
                    <form action="{{ route('add-reviews') }}" class="contact-form" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="product_id" >
                        <input type="hidden" value="{{ $product->slug }}" name="product-detail" >
                        <div class="row">
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Star Rating</div>
                                    <span class="rating">
                                        <input type="radio" class="rating-input" id="5_star2" name="rating-input2" value="5"><label for="5_star2" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="4_star2" name="rating-input2" value="4"><label for="4_star2" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="3_star2" name="rating-input2" value="3"><label for="3_star2" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="2_star2" name="rating-input2" value="2"><label for="2_star2" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="1_star2" name="rating-input2" value="1"><label for="1_star2" class="rating-star"></label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Name</div>
                                    <input placeholder="Your Name" type="text" name="name"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-form__fields">
                                    <div class="title">Email</div>
                                    <input placeholder="info@demolink.com" type="email" name="email"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <div class="title">Your Review</div>
                                    <textarea name="review"
                                        placeholder="Doesn’t look like much when you walk past, but I was practically dying of ..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-form__fields">
                                    <button type="submit" class="themeBtn themeBtn--full">Post Review</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection
@section('css')
<style type="text/css">
.contact-form__fields .rating {
    flex-direction: row-reverse;
    justify-content: start;
}
.share-wraper {
    position: relative;
}

.share-wraper .social-links {
    position: absolute;
    width: max-content;
    background: #fff;
    box-shadow: -1px 1px 15px -10px;
    padding: 14px 17px;
    left: 0px;
    top: -61px;
    display:none;
}

.restaurant-details-btns {
    display: flex;
    align-items: self-start;
    gap: 20px;
}
.share-wraper .social-links.active {
    display: flex;
}
.current-date{
    padding-left: 0rem;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
  $("#click_for_faq").click(function(){
    $('#faq_product_id').val({{ $product->id }})
  })
  $('.share-wraper a.btn, .share-wraper ul li a').click(function(){
      $('.share-wraper ul.social-links').toggleClass('active');
  })
   
})()
</script>
@endsection
