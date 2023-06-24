@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
      <div class="main-wrapper">
        <div class="row align-items-center mc-b-3">
          <div class="col-lg-6 col-12">
            <div class="primary-heading color-dark">
              <h2>Edit Category</h2>
            </div>
          </div>
         
        </div>
        <form action="{{route('admin.savecategory')}}" method="POST" enctype="multipart/form-data" class="main-form create_user_form">
            @csrf
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label> Category title*:</label>
                <input type="text" name="title" id="name"  value="{{$category->title}}" class="form-control" placeholder="Enter Title">
                <input type="hidden" name="id" value="{{$category->id}}">
              </div>
                  @if ($errors->has('title'))
            <span class="error">{{ $errors->first('title') }}</span>
            @endif
           </div>

           {{-- <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-group">
                      <label>Slug*:</label>
                      <input type="text" name="slug" id="slug" required value="{{$category->slug}}" class="form-control" placeholder="Enter Slug">
                      @if ($errors->has('slug'))
                      <span class="error">{{ $errors->first('slug') }}</span>
                      @endif
                  </div>
              </div> --}}
                            
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Show in Menu:</label>
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <div class="checkbox">
                      <input type="radio" id="user1" name="is_menu" {{$category->is_menu == 1 ? 'Checked' : ''}}   value="1">
                      <label for="user1">Yes</label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="checkbox">
                      <input type="radio" id="user2" name="is_menu" {{$category->is_menu == 0 ? 'Checked' : ''}}  value="0" >
                      <label for="user2">No</label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-12 col-12">
              <div class="text-center">
                <button type="submit" class="primary-btn primary-bg add-user">Update</button>
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

.recommend{
    color:#D75DB2;
}

</style>
@endsection
@section('js')
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
$('#name').change(function(e) {
    $.get('{{ route('admin.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
(()=>{
  
  /*in page css here*/
})()
</script>
@endsection