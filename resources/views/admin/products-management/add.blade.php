@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
    <div class="main-sec">
            <div class="main-wrapper">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Add Product</h2>
                        </div>
                    </div>
                   
                </div>
                <div class="user-wrapper">
                    <form id="add-record-form"   class="main-form mc-b-3">
                        @csrf

                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Name*:</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" required class="form-control" placeholder="Enter Product Name">
                                    @if ($errors->has('name'))
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Slug*:</label>
                                    <input type="text" name="slug"  readonly id="slug" value="{{old('slug')}}" required class="form-control" placeholder="Enter Slug">
                                </div>
                            </div>
                            
                            <!--<div class="col-lg-4 col-md-4 col-4">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>Price ($)*:</label>-->
                            <!--        <input type="number" name="price" id="price" value="{{old('price')}}" min="1"  class="form-control" placeholder="Enter Price in $">-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="col-lg-4 col-md-4 col-4 not_req">
                                <div class="form-group">
                                    <label>Concert Date :</label>
                                    <input type="date" name="consert" id="consert" value="{{old('consert')}}" class="form-control" placeholder="Select Concert Date">
                                </div>
                            </div>  

                            <div class="col-lg-4 col-md-4 col-4 not_req">
                                <div class="form-group">
                                    <label>Start Time :</label>
                                    <input type="time" name="start_time" id="start_time" value="{{old('start_time')}}" class="form-control" placeholder="Enter Start Time">
                                </div>
                            </div>  

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>End Time *:</label>
                                    <input type="time" name="end_time" id="end_time" value="{{old('end_time')}}" class="form-control" placeholder="Enter End Time">
                                </div>
                            </div>
                           
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Category:</label>
                                   <select name="category" class="form-control cat-dd" required id="select_cat">
                                   <option selected value="">Select A Category</option>
                                       @foreach($cat as $c)
                                       <option value="{{$c->id}}">{{$c->title}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Select type:</label>
                                    <div class="wrapper checkBoxesWrapper type">
                                        <div class="toggle-next ellipsis count_type">All Types ({{$type->count()}})</div>
                                        <div class="checkboxes " id="type">
                                            <label class="apply-selection">
                                                <input type="checkbox" value="" class="ajax-link" />
                                                &#x2714; apply selection
                                            </label>
        
                                            <div class="inner-wrap" id="type_value">
                                                @foreach($type as $pro)
                                                <label>
                                                    <input type="checkbox" name="type[]" value="{{$pro->slug}}" class="ckkBox val" />
                                                    <span>{{$pro->name}} </span>
                                                </label><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('type'))
                                    <span class="error">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Select Feature:</label>
                                    <div class="wrapper checkBoxesWrapper feature">
                                        <div class="toggle-next ellipsis count_feature">All Feature ({{$feature->count()}})</div>
                                        <div class="checkboxes " id="feature">
                                            <label class="apply-selection">
                                                <input type="checkbox" value="" class="ajax-link" />
                                                &#x2714; apply selection
                                            </label>
        
                                            <div class="inner-wrap" id="feature_value">
                                                @foreach($feature as $pro)
                                                <label>
                                                    <input type="checkbox" name="feature[]" value="{{$pro->slug}}" class="ckkBox val" />
                                                    <span>{{$pro->name}} </span>
                                                </label><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('feature'))
                                    <span class="error">{{ $errors->first('feature') }}</span>
                                    @endif
                                </div>
                            </div> 

                            
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                  <label>Open / Close:</label>
                                  <ul class="list-inline">
                                    <li class="list-inline-item">
                                      <div class="checkbox">
                                        <input type="radio" id="user1" name="status"  value="1">
                                        <label for="user1">Open</label>
                                      </div>
                                    </li>
                                    <li class="list-inline-item">
                                      <div class="checkbox">
                                        <input type="radio" id="user2" name="status" value="0" checked>
                                        <label for="user2">Close</label>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Country *:</label>
                                    <select name="country" class="form-control">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->country }}">{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>State *:</label>
                                    <input type="text" name="state" id="state" value="{{old('state')}}" min="1"  class="form-control" placeholder="Enter State">
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Complete Address *:</label>
                                    <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>  
                            
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>City *:</label>
                                    <input type="text" name="city" id="city" value="{{old('city')}}" min="1"  class="form-control" placeholder="Enter City">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Neighborhood Area:</label>
                                    <select name="area" class="form-control" required id="area">
                                        <option selected value="">Select Area</option>
                                       @foreach($address as $c)
                                       <option value="{{$c->address}}">{{$c->address}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Zip Code *:</label>
                                    <input type="text" name="zip_code" id="zip_code" value="{{old('zip_code')}}" min="1"  class="form-control" placeholder="Enter Zip Code">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Website :</label>
                                    <input type="url" name="live_streaming" id="live_streaming" value="{{old('live_streaming')}}" class="form-control" placeholder="Enter Website">
                                </div>
                            </div> 

                            <div class="col-lg-12 col-md-12 col-12 hours">
                                <div class="form-group">
                                    <label>Opening Hours :</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <label>Monday :</label>
                                            <input type="time" name="monday_from" id="monday_from" value="{{old('monday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="monday_to" id="monday_to" value="{{old('monday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Tuesday :</label>
                                            <input type="time" name="tuesday_from" id="tuesday_from" value="{{old('tuesday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="tuesday_to" id="tuesday_to" value="{{old('tuesday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Wednesday :</label>
                                            <input type="time" name="wednesday_from" id="wednesday_from" value="{{old('wednesday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="wednesday_to" id="wednesday_to" value="{{old('wednesday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Thrusday :</label>
                                            <input type="time" name="thrusday_from" id="thrusday_from" value="{{old('thrusday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="thrusday_to" id="thrusday_to" value="{{old('thrusday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Friday :</label>
                                            <input type="time" name="firday_from" id="firday_from" value="{{old('firday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="firday_to" id="firday_to" value="{{old('firday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Saturday :</label>
                                            <input type="time" name="saturday_from" id="saturday_from" value="{{old('saturday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="saturday_to" id="saturday_to" value="{{old('saturday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                        <div class="col-3">
                                            <label>Sunday :</label>
                                            <input type="time" name="sunday_from" id="sunday_from" value="{{old('sunday_from')}}" class="form-control" placeholder="From">
                                            <input type="time" name="sunday_to" id="sunday_to" value="{{old('sunday_to')}}" class="form-control" placeholder="To">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Short Description*:</label>
                                    <textarea rows="5" class="form-control ckeditor" id="editor1"  placeholder="Enter Short Description">{{old('short_desc')}}</textarea>
                                    <input type="hidden" id="message1"  name="short_desc">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Description*:</label>
                                    <textarea rows="5" class="form-control ckeditor" id="editor2"  placeholder="Enter Long">{{old('long_desc')}}</textarea>
                                    <input type="hidden" id="message2" name="long_desc">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Main Image</h3>
                              <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img main_image" alt="user-img"></figure>
                              <label for="main_image" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file" required onchange="mainimage(this);" name="main_image" id="main_image" class="d-none"  accept="image/jpeg, image/png">
                                <!-- <h5 class="recommend">Recommended Image Size Is: 574 X 603</h5> -->
                                @if ($errors->has('main_image'))
                                    <span class="error">{{ $errors->first('main_image') }}</span>
                                @endif
                            </div>

                            <div class="img-upload-wrapper  mc-b-3">
                              <h3>Other Images (You Can Select Multiple Images)</h3>
                              <figure><img src="{{asset('images/user-details.png')}}" class="thumbnail-img other_image" alt="user-img"></figure>
                              <label for="other_image" class="user-img-btn"><i class="fa fa-camera"></i></label>
                              <input type="file"  onchange="otherimage(this);" name="other_image[]" id="other_image" class="d-none"  accept="image/jpeg, image/png" multiple>
                                <!-- <h5 class="recommend">Recommended Image Size Is: 574 X 603</h5> -->
                                @if ($errors->has('other_image'))
                                    <span class="error">{{ $errors->first('other_image') }}</span>
                                @endif
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
<link rel="stylesheet" href="jquery-ui-multiselect-widget-master/jquery.multiselect.css" />
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
    .recommend{
        color:#D75DB2;
    }
    .form-group .checkBoxesWrapper {
        padding: 15px 20px;
        font-size: 13px;
        color: #666;
        border: 1px solid #666666;
        border-radius: 100px;
        background: #fff;
        cursor: pointer;
    }

    .checkBoxesWrapper .toggle-next {
        border-radius: 0;
    }

    .checkBoxesWrapper label {
        cursor: pointer;
    }

    .checkBoxesWrapper .ellipsis {
        text-overflow: ellipsis;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
    }

    .checkBoxesWrapper .apply-selection {
        display: none;
        width: 100%;
        margin: 0;
        padding: 5px 10px;
        border-bottom: 1px solid #ccc;
    }

    .checkBoxesWrapper .apply-selection .ajax-link {
        display: none;
    }

    .checkBoxesWrapper .checkboxes {
        margin: 0;
        display: none;
        border-top: 0;
        position: absolute;
        left: 1.5rem;
        top: 75%;
        width: 95%;
        background: #fff;
        box-shadow: 0 0 15px 1px #00000020;
        border-radius: 0.25rem;
        padding: 0.5rem;
        z-index: 1;
    }

    .checkBoxesWrapper .checkboxes .inner-wrap {
        padding: 5px 10px;
        max-height: 140px;
        overflow: auto;
    }
    .not_req, .hours{
        display:none;
    }
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="jquery-ui-multiselect-widget-master/src/jquery.multiselect.js" type="text/javascript"></script>
<script type="text/javascript">
    function mainimage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.main_image')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function otherimage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.other_image')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
(()=>{
    
    $("#select_cat").change(function(){
        if($(this).val() == 2 || $(this).val() == 3)
        {
            $(".not_req").show()
        }
        else
        {
            $(".not_req").hide()
        }
        
    })
    

    $('.cat-dd').on('change', function() {
        var cat_id = this.value;
        if(cat_id == 1){
            $('.hours').show()
        }else{
            $('.hours').hide()
        }
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: "get",
            url: "{{route('admin.get_type_feature')}}",
            data: {cat_id: cat_id },
            dataType: "json",
            success: function (msg) {
                if(msg.status == 1)
                {
                    if(msg.type)
                    {   
                        $(".count_type").html("All Types "+msg.type.length)
                        $('#type_value').empty();
                        $(msg.type).each(function(index, element) {
                            $('#type_value').append("<label> <input type='checkbox' name='type[]' value='"+element.slug+"' class='ckkBox val' /> <span>"+element.name+" </span> </label><br>");
                        });
                    }
                    if(msg.feature)
                    {   
                        $(".count_feature").html("All Feature "+msg.feature.length)
                        $('#feature_value').empty();
                        $(msg.feature).each(function(index, element) {
                            $('#feature_value').append("<label> <input type='checkbox' name='feature[]' value='"+element.slug+"' class='ckkBox val' /> <span>"+element.name+" </span> </label><br>");
                        });
                    }
                    
                    if(msg.address)
                    {
                        $('#area').empty();
                        $(msg.address).each(function(index, element) {
                            $('#area').append("<option value='"+element.address+"'> "+element.address+" </option>");
                        });
                    }
                }
            },
            beforeSend: function () {
                    
            }
        });
    
    });

    $('#name').change(function(e) {
        $.get('{{ route('admin.check_slug') }}', 
            { 'title': $(this).val() }, 
            function( data ) {
                $('#slug').val(data.slug);
            }
        );
    });

    $( "#add-record" ).click(function(e) {
        Loader.show();
        console.log(1)
        e.preventDefault();
        var value1 = CKEDITOR.instances['editor1'].getData();
        var val1 = $("#message1").val(value1);
        var value2 = CKEDITOR.instances['editor2'].getData();
        var val2 = $("#message2").val(value2);
        var data = new FormData(document.getElementById("add-record-form"));
        console.log(2)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'{{route('admin.create_products')}}',
            data:data,
            enctype: 'multipart/form-data',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success:function(data) {
                console.log(3)
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
                         window.location.href = "{{route('admin.products_listing')}}";
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


    $(function() {
        setCheckboxSelectLabels();
        $('.toggle-next').click(function() {
            $(this).next('.checkboxes').slideToggle(400);
        });
        $('.ckkBox').change(function() {
            toggleCheckedAll(this);
            setCheckboxSelectLabels(this); 
        });
    });

    function setCheckboxSelectLabels(elem) {
        var type = $('.type');
        var feature = $('.feature');
        
        $.each( type, function( key, type ) {
            var checkboxes = $(type).find('.ckkBox');
            var label = $(type).find('.checkboxes').attr('id');
            var prevText = '';
            $.each( checkboxes, function( i, checkbox ) {
                var button = $(type).find('button');
                if( $(checkbox).prop('checked') == true) {
                    var text = $(checkbox).next().html();
                    var btnText = prevText + text;
                    var numberOfChecked = $(type).find('input.val:checkbox:checked').length;
                    if(numberOfChecked >= 4) {
                        btnText = numberOfChecked +' '+ label + ' selected';
                    }
                    $(button).text(btnText); 
                    $(".count_type").text(btnText); 
                    prevText = btnText + ', ';
                }
            });
        });
        
        $.each( feature, function( key, feature ) {
            var checkboxes = $(feature).find('.ckkBox');
            var label = $(feature).find('.checkboxes').attr('id');
            var prevText = '';
            $.each( checkboxes, function( i, checkbox ) {
                var button = $(feature).find('button');
                if( $(checkbox).prop('checked') == true) {
                    var text = $(checkbox).next().html();
                    var btnText = prevText + text;
                    var numberOfChecked = $(feature).find('input.val:checkbox:checked').length;
                    if(numberOfChecked >= 4) {
                        btnText = numberOfChecked +' '+ label + ' selected';
                    }
                    $(button).text(btnText); 
                    $(".count_feature").text(btnText); 
                    prevText = btnText + ', ';
                }
            });
        });
    }

    function toggleCheckedAll(checkbox) {
        var apply = $(checkbox).closest('.wrapper').find('.apply-selection');
        apply.fadeIn('slow'); 
        var val = $(checkbox).closest('.checkboxes').find('.val');
        var all = $(checkbox).closest('.checkboxes').find('.all');
        var ckkBox = $(checkbox).closest('.checkboxes').find('.ckkBox');

        if(!$(ckkBox).is(':checked')) {
            $(all).prop('checked', true);
            return;
        }

        if( $(checkbox).hasClass('all') ) {
            $(val).prop('checked', false);
        } else {
            $(all).prop('checked', false);
        }
    }
    
    $(".ckeckBox").click(function(){
        if($(this).prop('checked')){
            $(this).prop('checked', true);
        }else{
            $(this).prop('checked', false);
        }
    })
})()
</script>
@endsection