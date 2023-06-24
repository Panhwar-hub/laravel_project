@extends('layouts.main')
@section('content')


<div class="banner">
    <img alt="image" class="imgFluid banner__bg" src="{{asset($slider->img_path??'images/banner-bg.png')}}" />

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="banner-content text-center">
                    <?php echo html_entity_decode($slider->long_desc)?>
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

<div class='area mar-y'>
    <div class='container'>
        <div class="row">
            <div class="col-lg-7">
                <div class='article-card card-hover'>
                    <a href="#" class='article-card__img card-hover__img'>
                        <img src="{{ asset($blog->blog_img) }}" alt='image' class='imgFluid'>
                    </a>
                    <div class='article-card__details'>
                        <div class="wrapper">
                            <div class="date">Feb 14, 2023 | By {{ $blog->created_by }}</div>
                        </div>
                        <a href="#" class="heading">{{ $blog->title }}</a>
                        <div class="content"><?php echo html_entity_decode($blog->short_desc);  ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                @foreach($blogs as $val)
                <div class='article-card article-card--list card-hover'>
                    <a href="{{ route('blog-detail', $val->slug) }}" class='article-card__img card-hover__img'>
                        <img src="{{ asset($val->blog_img) }}" alt='image' class='imgFluid'>
                    </a>
                    <div class='article-card__details'>
                        <div class="wrapper">
                            <div class="date">Feb 14, 2023 | By {{ $val->created_at }}</div>
                            <div class="themeBtn tag">New To The Area?</div>
                        </div>
                        <a href="{{ route('blog-detail', $val->slug) }}" class="heading">{{ $val->title }}</a>
                    </div>
                </div>
                @endforeach
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
   
})()
</script>
@endsection
