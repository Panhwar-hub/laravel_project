@extends('layouts.main')
@section('content')
    <!-- Pagetitle -->

    <!-- BACKGROUND BORDER SECTION END -->
    <!-- BANNER SECTION START -->

    <div class="banner">
        <img alt="image" class="imgFluid banner__bg" src="{{ asset($slider->img_path ?? 'images/banner-bg.png') }}" />
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="banner-content text-center">
                        <h1 class="banner-content__heading bg-line">Search Bar</h1>
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

    <!-- BANNER SECTION END -->

    <div class="products">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class='col-lg-8'>
                    <div class="sponsore-content">
                        <div class="sponsore-content__header">
                            
                        <ul class="sponsore-content-list">
                            
                            @forelse ($products as $item)
                                <li class="sponsore-content-list__single">
                                    <div class="sponsore-img">
                                        <a href="{{ route('product-detail', $item->slug) }}">
                                            <img src="{{ asset($item->img_path) }}"alt='image' class='imgFluid'
                                                loading='lazy'>
                                        </a>
                                    </div>
                                    <div class="sponsore-details">
                                         <a href="{{ route('product-detail', $item->slug) }}">
                                            <div class="title">{{ $item->name }} </div>
                                        </a>
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
                                                @if ($total != 0)
                                                    <?php
                                                    $to = round($rating / $total);
                                                    ?>
                                                @endif
                                                <li>
                                                    @if ($to > $i)
                                                        <img src="{{ asset('images/star-img.png') }}" alt='image'
                                                            class='imgFluid four-star-detail' loading='lazy'>
                                                    @else
                                                        <img src="{{ asset('images/star-img.png') }}" alt='image'
                                                            class='imgFluid' loading='lazy'>
                                                    @endif
                                                </li>
                                            @endfor

                                        </ul>
                                        <ul class="flavours">
                                            <li><a href="javascript:void(0)">italian</a></li>
                                            <li><a href="javascript:void(0)">Pizza</a></li>
                                            <li>Mission Bay </li>
                                        </ul>
                                        <div class="close-time"><span
                                                class="color-primary">{{ $item->status == 1 ? 'Opend' : 'Closed' }}</span> until
                                            {{ $item->end_time }} </div>
                                        <ul class="perks">
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('images/perks-img-1.png') }}"alt='image'
                                                        class='imgFluid' loading='lazy'>
                                                    Catering service
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="{{ asset('images/perks-img-2.png') }}"alt='image'
                                                        class='imgFluid' loading='lazy'>
                                                    Large group friendly
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="suggestion">“<?php
                                        echo html_entity_decode($item->short_desc);
                                        ?>”</div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <ul class="actions">
                                                <li><a href="#" class={{ $item->outdoor == 0 ? 'red' : '' }}><i
                                                            class='bx {{ $item->outdoor == 0 ? 'bx-x' : 'bx-check' }}'></i>Outdoor
                                                        seating</a></li>
                                                <li><a href="#" class={{ $item->delivery == 0 ? 'red' : '' }}><i
                                                            class='bx {{ $item->delivery == 0 ? 'bx-x' : 'bx-check' }}'></i>Delivery</a>
                                                </li>
                                                <li><a href="#" class={{ $item->takeout == 0 ? 'red' : '' }}><i
                                                            class='bx {{ $item->takeout == 0 ? 'bx-x' : 'bx-check' }}'></i>Takeout</a>
                                                </li>
                                            </ul>
                                            <a href="{{ route('product-detail', $item->slug) }}" class="themeBtn">View
                                                Detail</a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                            <li>
                                <h2>No Results Found</h2>
                            </li>
                                
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
