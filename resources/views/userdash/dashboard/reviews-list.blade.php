@extends('userdash.layouts.dashboard.main')
@section('content')
    <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-booking-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Your Reviews</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="text-lg-right text-md-right">
                           
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm dashboard-table">
                  <table class="table" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Review</th>
                        <th>Rating Star</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Actions</th> 
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $k => $review)
                        
                      <tr>
                        <td>{{ $k }}</td>
                        <td>{{$review->name}}</td>
                        <td>{{$review->email}}</td>
                        <td>{{$review->review}}</td>
                        <td>{{$review->rating}} Star</td>
                        <td>{{$review->reviewBelongsToProducts->name}}</td>
                        <td>{{$review->is_active == 1 ? 'Active' : 'Non-Active'}}</td>
                        
                        <td>
                          <div class="dropdown show action-dropdown">
                            <?php $decrypt = Crypt::encryptString($review->id);?>
                            <a href="{{route('dashboard.edit_reviews',$decrypt)}}" class="edit-testinomial">
                              <i class='bx bxs-pencil'></i>
                            </a>
                          </div>
                        </td>
                       
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>

        </div>
        
    </section>

@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
  .ui-state-active {
    background: #212529 !important;
    color: #f8f9fa !important;
  }
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">

(()=>{

})()
</script>
@endsection