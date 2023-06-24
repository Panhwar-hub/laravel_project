@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="primary-heading color-dark">
                        <h2>Edit Neighborhood Address</h2>
                    </div>
                </div>

            </div>
            <div class="user-wrapper">
                <form id="add-record-form" class="main-form mc-b-3">

                    @csrf
                    <div class="row align-items-end">
                        <div class="col-lg-4 col-md-4 col-4">
                            <div class="form-group">
                                <label>Address*:</label>
                                <input type="text" name="address" id="address" value="{{ $address->address }}" required
                                    class="form-control" placeholder="Enter Address">
                                @if ($errors->has('address'))
                                    <span class="error">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $address->id }}">

                        <div class="col-lg-4 col-md-4 col-4">
                            <div class="form-group">
                                <label>Slug*:</label>
                                <input type="text" name="slug" id="slug" value="{{ $address->slug }}" required
                                    class="form-control" placeholder="Enter Slug">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-4">
                            <div class="form-group">
                                <label>Category:</label>
                                <select name="category_id" class="form-control cat-dd" required>
                                    <option selected value="">Select A Category</option>
                                    @foreach ($cat as $c)
                                        <option {{ $address->category_id == $c->id ? 'selected' : '' }}
                                            value="{{ $c->id }}">{{ $c->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="text-center">
                            <button id="add-record" type="button" class="primary-btn primary-bg">Update</button>
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
        .downimg {
            width: auto;
            height: 100px;
            object-fit: cover;
        }

        .delimg {
            width: auto;
            height: 30px;
            object-fit: cover;
        }

        .thumbnail-img {
            max-width: 288px;
            height: 113px;

        }

        .picture {
            max-width: 288px;
            height: 113px;

        }

        .recommend {
            color: #D75DB2;
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

        (() => {
            $('#name').change(function(e) {
                $.get('{{ route('admin.check_slug') }}', {
                        'title': $(this).val()
                    },
                    function(data) {
                        $('#slug').val(data.slug);
                    }
                );
            });

            $("#add-record").click(function(e) {
                e.preventDefault();
                var data = new FormData(document.getElementById("add-record-form"));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.saveaddress') }}',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function(data) {
                        if (data.status == 1) {
                            $.toast({
                                heading: 'Success!',
                                position: 'top-right',
                                text: data.msg,
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 2500,
                                stack: 6
                            });
                            $('#add-record-form')[0].reset();
                            setInterval(() => {
                                window.location.href =
                                    "{{ route('admin.address_listing') }}";
                            }, 2500);
                        }
                        if (data.status == 2) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: data.error,
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
