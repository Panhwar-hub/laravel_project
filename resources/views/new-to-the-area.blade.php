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

<!-- Article -->
<div class='article bgc-light'>
    <div class='container'>
        <div class='section-content mb-5'>
            <h2 class='heading primary-underline primary-underline--alt'>All Articles</h2>
        </div>
        <div class='row'>
            @foreach($blogs as $blog)
            <div class='col-lg-4'>
                <div class='article-card article-card--box card-hover'>
                    <a href="{{ route('blog-detail', $blog->slug) }}" class='article-card__img card-hover__img'>
                        <img src="{{ asset($blog->blog_img) }}" alt='image' class='imgFluid'>
                    </a>
                    <div class='article-card__details'>
                        
                        <div class="wrapper">
                            <div class="date"><?php echo date_format($blog->created_at, 'F d, Y'); ?> | By {{ $blog->created_by }}</div>
                            
                        </div>
                        <a href="{{ route('blog-detail', $blog->slug) }}" class="heading">{{ $blog->title }}</a>
                        <div class="content">
                        <?php echo html_entity_decode($blog->short_desc);  ?>
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

</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  /*in page css here*/
   
})()
</script>
@endsection
