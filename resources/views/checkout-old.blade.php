@extends('layouts.main')
@section('content')
    <section class="breadcumb" style="background-image: url(assets/images/pg-banner.png);">
        <div class="container">
            <div class="breadcumb-con">
                <?php App\Helpers\Helper::inlineEditable('h2', ['class' => ''], 'CHECKOUT', 'CHECKOUTTXT1'); ?>
            </div>
        </div>
    </section>
    <div class="checkout-sec my-5">
        <div class="container">
            <form id="add-record-form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout-form ">

                            <h3 class="mc-b-2">Shipping detail</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group my-1">
                                        <label for="">First Name <span> *</span></label>
                                        <input type="text" name="fname" class="form-control">
                                        @if ($errors->has('fname'))
                                            <span class="text-danger">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group my-1">
                                        <label for="">Last Name <span> *</span></label>
                                        <input type="text" name="lname" class="form-control">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-1">
                                        <label for="">Address <span> *</span></label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Street Address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-1">
                                        <label for="">Town/City <span> *</span></label>
                                        <input type="text" name="town" class="form-control">
                                        @if ($errors->has('town'))
                                            <span class="text-danger">{{ $errors->first('town') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group my-1">
                                        <label for="">Postcode/Zip <span> *</span></label>
                                        <input type="text" name="zip" class="form-control">
                                        @if ($errors->has('zip'))
                                            <span class="text-danger">{{ $errors->first('zip') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group my-1">
                                        <label for="">Phone <span> *</span></label>
                                        <input type="text" name="phone" class="form-control">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group my-1">
                                        <label for="">Email <span> *</span></label>
                                        <input type="email" name="email" class="form-control">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group my-1">
                                        <label for="">Order Notes <span> *</span></label>
                                        <input type="text" name="note" class="form-control"
                                            placeholder="Note about your order, e.g, special noe for delivery">
                                    </div>
                                </div>
                            </div>
                            <?php $ser = serialize($cart_data);
                            Session::put('ser', $ser); ?>
                        </div>
                    </div>
                    <?php $num = 01;
                    $total = 0;
                    $sub_total = 0; ?>
                    @foreach ($cart_data as $key => $value)
                        <?php
                        $total += $value['sub_total'];
                        $sub_total += $value['sub_total'];
                        $num++; ?>
                    @endforeach
                    <?php if(isset($shipping['total_amount'])){
                        $total = $shipping['total_amount'];
                    }?>
                    <div class="col-md-4">
                        <div class="checkout__orderOverview">
                            <h4>Order Overview</h4>
                            <?php
                                $cart = Session::get('cart');
                            ?>
                            <div>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>
                                            <div class="text-right">
                                                Subtotal
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $k => $v)
                                        <tr>
                                            <td>{{ ucfirst($v['name']) }} x {{ $v['quantity_selected'] }}</td>
                                            <td>
                                                <div class="varition-btn d-flex">
                                                    <a href="javascript:void(0)" style="background-color: {{ $v['code'] }}"></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    ${{ number_format($v['sub_total'],2) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                 
                                   
                                </tbody>
                            </table>
                            </div>
                            <!--<div>-->
                            <!--    <span>Sub Total</span>-->
                            <!--    <span>${{ number_format($sub_total, 2) }}</span>-->
                            <!--</div>-->
                            <!--<div>-->
                            <!--    <span>Color</span>-->
                            <!--    <span>-->
                            <!--        <div class="varition-btn d-flex">-->
                            <!--            <a href="javascript:void(0)" style="background-color: {{ $value['code'] }}"></a>-->
                            <!--        </div>-->
                            <!--    </span>-->
                            <!--</div>-->
                            @if(isset($shipping))
                            <div class="checkout__orderOverviewTotal">
                                <span>Sub Total</span>
                                <span>${{ number_format($sub_total, 2) }}</span>
                            </div>
                            <div class="checkout__orderOverviewTotal">
                                <span>Shipping Rating</span>
                                <span>${{ number_format($shipping['shipping_value'], 2) }}</span>
                            </div>
                            <input type="hidden" name="shipping_fee" value="{{ $shipping['shipping_value'] }}">
                            @endisset
                            <div class="checkout__orderOverviewTotal">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <input type="hidden" name="total_amount" value="{{ $total }}">
                            <input type="hidden" name="sub_amount" value="{{ $sub_total }}">
                            <button type="button" id="checkout-btn" class="btn w-100 mt-3   ">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
        .checkout__orderOverview {
            border: 1px solid #00000020;
            box-shadow: 0px 0px 10px 1px #00000020;
            padding: 1.5rem;
            margin-top: 1.5rem;
            color: #000;
            background: #fff;
        }

        .text-right {
            text-align: right;
        }

        .checkout__orderOverview>h4 {
            margin-bottom: 1rem;
        }

        .checkout__orderOverview>div {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1rem 0px;
        }

        .checkout__orderOverview>div:not(.checkout__orderOverviewTotal)>span {
            font-size: 16px;
        }

        .checkout__orderOverviewTotal {
            font-size: 20px;
            font-weight: 700;
            border-top: 1px solid #00000020;
            padding: 1rem 0px 0px;
        }


        .varition-btn {
            margin-left: 0px;
            padding-left: 0px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            var Loader = function() {
                return {
                    show: function() {
                        jQuery("#preloader").show();
                    },
                    hide: function() {
                        jQuery("#preloader").hide();
                    }
                };
            }();

            $("#checkout-btn").click(function(e) {
                e.preventDefault();
                Loader.show();
                var data = new FormData(document.getElementById("add-record-form"));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('placeorder') }}',
                    data: data,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType

                    success: function(data) {
                        Loader.hide();
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

                                window.location = "{{ route('paysecure') }}";;
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

                        if (data.status == 4) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: "Coupon is Expired",
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });

                        }

                        if (data.status == 0) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: data.msg,
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });

                        }

                        if (data.status == 3) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: data.msg,
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });
                            setInterval(() => {

                                window.location = "{{ route('sign-in') }}";
                            }, 5000);
                        }

                        if (data.status == 4) {
                            $.toast({
                                heading: 'Error!',
                                position: 'bottom-right',
                                text: data.msg,
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 5000,
                                stack: 6
                            });
                        }
                    }
                });
            });

            // $(".statet").hide();

            // $(".country").change(function() {
            //     var countryid = $(this).find(':selected').attr('data-countid');
            //     if (countryid != 223) {
            //         $(".state").hide();
            //         $(".statet").show();
            //         $(".state").empty();
            //     } else {
            //         $(".state").show();
            //         $(".statet").hide();
            //     }
            // });
        })()
    </script>
@endsection
