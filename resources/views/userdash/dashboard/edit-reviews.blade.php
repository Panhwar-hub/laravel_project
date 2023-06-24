@extends('userdash.layouts.dashboard.main')

@section('content')
   <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-form-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Edit Review</h2>
                        </div>
                    </div>
                </div>
                <form action="{{route('dashboard.savereviews')}}" method="POST" enctype="multipart/form-data" class="main-form pet-form" id="pet-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name" value="{{$reviews->name}}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{$reviews->email}}" required class="form-control">
                                <?php $decrypt = Crypt::encryptString($reviews->id);?>
                                <input type="hidden" name="id" value="{{$decrypt}}" >
                            </div>
                        </div>
                       
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Review</label>
                                <input type="text"  name="review" value="{{$reviews->review}}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Rating </label>
                                <span class="rating">
                                    @for($a = 1; $a <= 5; $a++)
                                    <div class="checkbox">
                                        <input type="radio" name="rating" value="{{$a}}" {{$reviews->rating == $a ?'checked':'' }} id="sex-radio-{{$a}}">
                                        <label for="sex-radio-{{$a}}"><span></span>{{ $a }} Star</label>
                                    </div>
                                    @endfor 
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-lg-right text-md-right">
                        <button type="submit" class="primary-btn primary-bg" >Update Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">

(()=>{
  /*in page css here*/
  
})()
</script>
@endsection
