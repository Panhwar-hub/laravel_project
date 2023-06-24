@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
            <div class="main-wrapper">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Add Welcome Slider</h2>
                        </div>
                    </div>
                   
                </div>
                <div class="user-wrapper">
                    <form id="add-record-form" method="POST" class="main-form mc-b-3">

                        @csrf
                        <div class="row align-items-end">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label> Posted By:</label>
                                    <input type="text" required name="posted_by" class="form-control" placeorder="POSTED BY">
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="row align-items-end">-->
                        <!--    <div class="col-lg-12 col-md-12 col-12">-->
                        <!--        <div class="form-group">-->
                        <!--            <label> Date:</label>-->
                        <!--            <input type="date" required name="date" class="form-control" placeorder="Date">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="row align-items-end">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label> Description:</label>
                                    <textarea rows="5" class="form-control ckeditor" id="editor2"
                                        placeholder="Enter Long Description">{{old('long_desc')}}</textarea>
                                    <input type="hidden" id="message2" name="long_desc">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Slider Image</h3>
                              <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img" alt="user-img"></figure>
                              <label for="thumbnail-img" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file"  onchange="thumb(this);" name="welcomeslider" id="thumbnail-img" class="d-none"  accept="image/jpeg, image/png">
                            </div>
                        </div>
                           
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="text-center">
                          
                            <button id="add-record" type="button" class="primary-btn primary-bg">Create</button>
                        </div>
                    </div>
                    </form>

                </div>
                
            </div>
        </div>
    </section>

@endsection
@section('css')
<style type="text/css">
    /*in page css here*/
  .thumbnail-img {
    max-width: 288px;
    height: 113px;
   
}
.picture {
    max-width: 288px;
    height: 113px;
   
}
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
function thumb(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.thumbnail-img')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
(()=>{

    $( "#add-record" ).click(function(e) {
        Loader.show();
        e.preventDefault();
        var value2 = CKEDITOR.instances['editor2'].getData();
        var val2 = $("#message2").val(value2);
        var data = new FormData(document.getElementById("add-record-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                type:'POST',
                url:'{{route('admin.createwelcomeSlider')}}',
                data:data,
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success:function(data) {
                    Loader.hide();
                if(data.status == 1){
                        $.toast({
                        heading: 'Success!',
                        position: 'top-right',
                        text:  data.msg,
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2500,
                        stack: 6
                    });
                    $('#add-record-form')[0].reset();
                    setInterval(() => {
                         window.location.href = "{{route('admin.welcomeSlider')}}";
                    }, 2500);
                }
                if(data.status == 2){
                    $.toast({
                        heading: 'Error!',
                        position: 'bottom-right',
                        text:  data.error,
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                }
            }
        });
    });
    
})()
</script>
@endsection