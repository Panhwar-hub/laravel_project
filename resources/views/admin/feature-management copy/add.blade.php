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
                            
                            
                            <div class="col-lg-4 col-md-4 col-4">
                                <div class="form-group">
                                    <label>Category:</label>
                                   <select name="category_id" class="form-control cat-dd" required>
                                   <option selected value="">Select A Category</option>
                                       @foreach($cat as $c)
                                       <option value="{{$c->id}}">{{$c->title}}</option>
                                       @endforeach
                                   </select>
                                </div>
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
</style>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="jquery-ui-multiselect-widget-master/src/jquery.multiselect.js" type="text/javascript"></script>
<script type="text/javascript">
   
(()=>{

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
        e.preventDefault();
        var data = new FormData(document.getElementById("add-record-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'{{route('admin.create_feature')}}',
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
                         window.location.href = "{{route('admin.feature_listing')}}";
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
            setCheckboxSelectLabels(); 
        });
    });

    function setCheckboxSelectLabels(elem) {
        var wrappers = $('.wrapper'); 
        $.each( wrappers, function( key, wrapper ) {
            var checkboxes = $(wrapper).find('.ckkBox');
            var label = $(wrapper).find('.checkboxes').attr('id');
            var prevText = '';
            $.each( checkboxes, function( i, checkbox ) {
                var button = $(wrapper).find('button');
                if( $(checkbox).prop('checked') == true) {
                    var text = $(checkbox).next().html();
                    var btnText = prevText + text;
                    var numberOfChecked = $(wrapper).find('input.val:checkbox:checked').length;
                    if(numberOfChecked >= 4) {
                        btnText = numberOfChecked +' '+ label + ' selected';
                    }
                    $(button).text(btnText); 
                    $(".ellipsis").text(btnText); 
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