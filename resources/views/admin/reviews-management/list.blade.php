@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
      <div class="main-wrapper">
        <div class="chart-wrapper">
         
        <div class="user-wrapper">
          <div class="row align-items-center mc-b-3">
            <div class="col-lg-6 col-12">
              <div class="primary-heading color-dark">
                <h2>Reviews Management</h2>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="user-table" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Rating</th>
                  <th>Review</th>
                  <th>Item Name</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ;?>
                @foreach($reviews as $review)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$review->name}}</td>
                  <td>{{$review->email}}</td>
                  <td>{{$review->rating.' '. 'Stars'}}</td>
                  <td>{{$review->review}}</td>
                  <td>{{$review->reviewBelongsToProducts['name']}}</td>
                  <td>{{$review->type == 1 ? 'Product' : 'Merchandise' }}</td>
                  
                  <td>{{$review->is_active == 1 ? 'Active' : 'Non-Active'}}</td>
                   
                  <td>
                    <div class="dropdown show action-dropdown">
                      <a class=" dropdown-toggle" href="#" role="button" id="action-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="action-dropdown">
        
                        @if(Auth::guard('admin')->user()->type == 1)
                        <a class="dropdown-item" href="{{route('admin.delete_reviews',$review->id)}}"><i class="fa fa-trash"
                            aria-hidden="true"></i>
                          Delete</a>
                        @endif
                        
                        @if($review->is_active == 1)
                            @if(Auth::guard('admin')->user()->type == 1)
                            <a class="dropdown-item" href="{{route('admin.suspend_reviews',$review->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> In Active</a>
                            @elseif(Auth::guard('admin')->user()->type == 2)
                            <a href="#" class="dropdown-item feedback" data-review_id="{{ $review->id }}" data-toggle="modal" data-target="#review"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> FeedBack</a>
                            @endif
                        @else
                            @if(Auth::guard('admin')->user()->type == 1)
                            <a class="dropdown-item" href="{{route('admin.suspend_reviews',$review->id)}}"><i class="fa fa-ban" aria-hidden="true"></i> Activate</a>
                            @endif
                        @endif
                      </div>
                    </div>
                  </td>

                </tr>
                <?php $i++;?>
               @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </section>

  <div class="modal fade" id="review" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="heading text-uppercase">FeedBack
                    </div>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                        class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="contact-content">
                    <!--<div class="section-content mb-4">-->

                    <!--</div>-->
                    <div class="newsletter-content">
                        <form action="{{ route('admin.review-feedback') }}" method="POST" class="newsletter-content__form">
                            @csrf
                            <div class="row">
                              <div class="col-12">
                                  <div class="contact-form__fields ">
                                     <div class="title">Subject</div>
                                      <input type="hidden" name="review_id" id="review_id">
                                      <input type="text" name="subject"  class="form-control" required placeholder="Subject">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="contact-form__fields mt-4">
                                     <div class="title">Message</div>
                                     <textarea name="message" class="form-control" row="5" placeholder="Enter Your Message"></textarea>

                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="contact-form__fields mt-4">
                                      <button type="submit" class="btn btn-primary w-100">Submit</button>
                                  </div>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>

@endsection
@section('css')
<style type="text/css">
	/*in page css here*/
	.far{
    	font: normal normal normal 14px/1 FontAwesome;
        font-size: revert;
	}
	textarea.form-control {
    min-height: 130px;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
(()=>{
  $(".feedback").click(function(){
    $("#review_id").val($(this).data('review_id'))
  })
  /*in page css here*/
})()
</script>
@endsection