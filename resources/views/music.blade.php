@extends('layouts.main')
@section('content')

<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <?php echo html_entity_decode($slider->long_desc); ?>
                    {{-- <h1 class="banner-content__heading bg-line">Music</h1> --}}
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
            <div class='col-lg-2 col-md-3'>
                <ul class='sponsore-options'>
                    <li>
                        <div class="title primary-underline">filters</div>
                        <ul class="amout-list">
                            <li>$</li>
                            <li>$$</li>
                            <li>$$$</li>
                            <li>$$$$</li>
                        </ul>
                    </li>
                    @if($types->count() )
                    <li>
                        <div class="title primary-underline">Suggested</div>
                       
                        @forelse ($types as $items)
                        <div class="radio-fields">
                            <input type="radio" id="{{ $items->slug }}" value="{{ $items->slug }}" name="suggested" class="suggested">
                            <label class="details" for="delivery">{{ $items->name }}</label>
                        </div>
                        @empty
                        @endforelse
                    </li>
                    @endif
                    @if($feature->count() )
                    <li>
                        <div class="title primary-underline">Features</div>
                        @forelse ($feature as $items)
                        <div class="radio-fields">
                            <input type="radio" id="{{ $items->slug }}" value="{{ $items->slug }}" name="features" class="features">
                            <label class="details" for="delivery">{{ $items->name }}</label>
                        </div>
                        @empty
                        @endforelse
                    </li>
                    @endif
                    @if($address->count() )
                    <li>
                        <div class="title primary-underline">Neighborhoods</div>
                        
                        @foreach($address as $val)
                        <div class="radio-fields">
                            <input type="radio" id="{{ $val->slug }}" value="{{ $val->slug }}" name="address" class="address">
                            <label class="details" for="{{ $val->slug }}">{{ $val->address }}</label>
                        </div>
                        @endforeach
                        
                    </li>
                    @endif
                    <li>
                        <div class="title primary-underline">Distance</div>
                        <div class="radio-fields">
                            <input type="radio" id="15-radio" name="distance">
                            <label class="details" for="15-radio">Bird's-eye View</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="16-radio" name="distance">
                            <label class="details" for="16-radio">Driving (5 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="17-radio" name="distance">
                            <label class="details" for="17-radio">Biking (2 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="18-radio" name="distance">
                            <label class="details" for="18-radio">Walking (1 mi.)</label>
                        </div>
                        <div class="radio-fields">
                            <input type="radio" id="19-radio" name="distance">
                            <label class="details" for="19-radio">Within 4 blocks</label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class='col-lg-8 col-md-9'>
                <div class="sponsore-content">
                    <div class="sponsore-content__header">
                        <div>
                            <ul class="breadcrumbs">
                                
                                <li><a href="{{ route($category->slug) }}" class="prev-link">{{ $category->title }}</a></li>
                                    
                                @if (isset($features) && $features)
                                <li class="content"><i class='bx bx-chevron-right'></i></li>
                                <li class="content">{{ $features }}</li>
                                @endif

                                @if (isset($type) && $type)
                                <li class="content"><i class='bx bx-chevron-right'></i></li>
                                <li class="content">{{ $type }}</li>
                                @endif
                                
                            </ul>
                            <div class="heading">
                                <?php echo html_entity_decode($slider->headings); ?>
                                </div>
                            {{-- <div class="subHeading">Sponsored Results</div> --}}
                        </div>
                            {{--
                        <div class="sort-by">
                            <span class="title">Sort :</span>
                            <select>
                                <option value="Recommended">Recommended</option>
                            </select>
                        </div>
                            --}}
                    </div>
                    <ul class="sponsore-content-list">
                        
                        @foreach ($products as $item)
                        <li class="sponsore-content-list__single">
                            <a href="{{ route('product-detail', $item->slug) }}">
                                <div class="sponsore-img">
                                    <img src="{{ asset($item->img_path) }}"alt='image' class='imgFluid' loading='lazy'>
                                </div>
                            </a>
                            <div class="sponsore-details">
                                <div class="title"><a href="{{ route('product-detail', $item->slug) }}">{{ $item->name }} </a></div>
                                <ul class="rating rating--sm">
                                    <?php 
                                        $rating = 0;
                                        $total = 0;
                                     ?>
                                    @foreach ($item->productHasReviews as $rate)
                                        <?php 
                                            $rating += $rate->rating; 
                                            $total++; 
                                        ?>
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
                                <ul class="flavours">
                                    {{--
                                    <li><a href="javascript:void(0)">italian</a></li>
                                    <li><a href="javascript:void(0)">Pizza</a></li>
                                    <li>Mission Bay </li>
                                    --}}
                                </ul>
                                <div class="close-time">
                                    <?php
                                       $date = explode("-", $item->consert);
                                    ?>
                                    @if(date('Y-m-d') >= $item->consert)
                                       
                                    <span class="color-primary">
                                    Scasual On </span>{{ date('d', $date[2]) }} {{ date('M', $date[1]) }} Start From {{ $item->start_time }} to {{ $item->end_time }}
                                        
                                    @else
                                    <span class="color-primary">
                                    Closed On 
                                    </span>{{ date('d', $date[2]) }} {{ date('M', $date[1]) }} 
                                    @endif
                                </div>  
                                <ul class="perks">
                                    {{--
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/perks-img-1.png') }}"alt='image' class='imgFluid' loading='lazy'>
                                            Catering service
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/perks-img-2.png') }}"alt='image' class='imgFluid' loading='lazy'>
                                            Large group friendly
                                        </a>
                                    </li>
                                    --}}
                                </ul>
                                <div class="suggestion">“<?php
                                    echo html_entity_decode($item->short_desc);
                                ?>”</div>
                                <div class="d-flex align-items-center justify-content-between  flex-sm-row flex-column">
                                    <ul class="actions">
                                        <li><a href="#" class={{ ($item->outdoor==0)?'red':'' }} ><i class='bx {{ ($item->outdoor==0)?'bx-x':'bx-check' }}'></i>Outdoor seating</a></li>
                                        <li><a href="#" class={{ ($item->delivery==0)?'red':'' }}><i class='bx {{ ($item->delivery==0)?'bx-x':'bx-check' }}'></i>Delivery</a></li>
                                        <li><a href="#" class={{ ($item->takeout==0)?'red':'' }}><i class='bx {{ ($item->takeout==0)?'bx-x':'bx-check' }}'></i>Takeout</a></li>
                                    </ul>
                                    <a href="{{ route('product-detail', $item->slug) }}" class="themeBtn  m-sm-0 mt-3">View Detail</a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class='col-lg-2'>
                <div class="location-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2798864718!2d-74.25986673512958!3d40.69767006847737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1678143091027!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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
    $(".suggested").click(function() {
        window.location.href = "{{ route('music') }}/suggestion/"+$(this).val();
    })

    $(".features").click(function() {
        window.location.href = "{{ route('music') }}/feature/"+$(this).val();
    })
    
    $(".address").click(function() {
        window.location.href = "{{ route('music') }}/address/"+$(this).val();
    })
})()
</script>
@endsection
