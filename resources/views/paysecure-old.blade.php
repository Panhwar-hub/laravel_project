@extends('layouts.main')
@section('content')

 
            <?php //App\Helpers\Helper::inlineEditable("span",["class"=>""],' <span>Payment</span>','PAYSECURETXT2');?>

  @if($orders['pay_status'] == 0)  
 <section class="checkout-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">

                <div class="account-wrapper">
                    <div class="accordion" id="accordionExample">


                        <!-- <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span></span>
                                        Pay with credit/debit card
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                      <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div> -->

                                            <div class="card">
                                                            <div class="card-header" id="headingtwo">
                                                                <h5 class="mb-0">
                                                                    <button type="button" data-toggle="collapse"
                                                                        data-target="#collapsetwo" aria-expanded="true"
                                                                        aria-controls="collapsetwo">
                                                                        <span></span>
                                                                      Pay With Stripe
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="collapsetwo" class="collapse fade show in"
                                                                aria-labelledby="headingtwo"
                                                                data-parent="#accordionExample">
                                                                <div class="card-body">
                                                                   

                                                                    <div class="panel-body">

                                                                        @if (Session::has('success'))
                                                                        <div class="alert alert-success text-center">
                                                                            <a href="#" class="close"
                                                                                data-dismiss="alert"
                                                                                aria-label="close">×</a>
                                                                            <p>{{ Session::get('success') }}</p>
                                                                        </div>
                                                                        @endif

                                                         

                                                                        <form role="form"
                                                                            action="{{ route('stripe.post') }}"
                                                                            method="post" class="require-validation"
                                                                            data-cc-on-file="false"
                                                                            data-stripe-publishable-key="pk_test_9sKS97DSc19HHoUj5CKaD7WF"
                                                                            id="payment-form">
                                                                            @csrf
                                                                            <input type="hidden" name="custom"
                                                                                value="{{$custom}}">
                                                                                <div class="pay-strip">
                                                                            <div class="row">
                                                                                <div   class="col-md-6 col-xs-6 form-group required">
                                                                                    <label class='control-label'>Name on
                                                                                        Card</label>
                                                                                         <input class='form-control'      type='text'>
                                                                                </div>
                                                                         
                                                                                <div
                                                                                    class="col-xs-6 form-group card required">
                                                                                    <label class='control-label'>Card  Number</label> <input
                                                                                        autocomplete='off'
                                                                                        class='form-control card-number'
                                                                                        size='20' type='text'>
                                                                                </div>
                                                                            </div>

                                                                            <div class= " row row3zee">
                                                                                <div
                                                                                    class='col-xs-12 col-md-4 form-group cvc required'>
                                                                                    <label
                                                                                        class='control-label'>CVC</label>
                                                                                    <input autocomplete='off'
                                                                                        class='form-control card-cvc'
                                                                                        placeholder='ex. 311' size='4'
                                                                                        type='text'>
                                                                                </div>
                                                                                <div
                                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                    <label
                                                                                        class='control-label'>Expiration
                                                                                        Month</label> <input
                                                                                        class='form-control card-expiry-month'
                                                                                        placeholder='MM' size='2'
                                                                                        type='text'>
                                                                                </div>
                                                                                <div
                                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                    <label
                                                                                        class='control-label'>Expiration
                                                                                        Year</label> <input
                                                                                        class='form-control card-expiry-year'
                                                                                        placeholder='YYYY' size='4'
                                                                                        type='text'>
                                                                                </div>
                                                                            </div>

                                                                            <div class= "row">
                                                                                <div class='col-md-12 error form-group hide'>
                                                                                @if (Session::has('danger'))   
                                                                                <div class='alert-danger alert'>
                                                                                <p>{{ Session::get('danger') }}</p>
                                                                                    </div>
                                                                                    @endif
                                                                       
                                                                       
                                                                                </div>
                                                                            </div>

                                                                            <div class="pay-strp-btn">
                                                                               
                                                                                    <button
                                                                                        class="primary-btn primary-bg"
                                                                                        type="submit">Pay Now
                                                                                        (${{$amount}})</button>
                                                                                
                                                                            </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                   



                                                                </div>




                                                            </div>
                                                        </div>


                    </div>
                </div>
                </div>
                
            
            <div class="col-lg-4">
                <div class="order-summary-section shipping-section">
                  <div class="table-responsive">
                    <table class="table order-summary-table shipping-table">
                        <thead>
                          <tr>
                            <th scope="row" colspan="2">
                              Order Summary
                            </th>
                          </tr>
                        </thead>   
                        <tbody>
                           <tr class="checkout-item-label">
                              <td colspan="2">
                                <a id="checkout-toggle" href="#" onclick="$('#checkout-item-box').slideToggle(500);">1 Item in Cart <i class="fa fa-angle-down float-right" aria-hidden="true"></i></a>
                              </td>
                           </tr> 
                           <tr id="checkout-item-box">
                            
                               @if(!empty($itemsss)) 
                                <?php $total = 0;?>
                                    @foreach($itemsss as $key => $value)
                                
                            
                             <tr class="checkout-item">
                               <td class="checkout-product-image"><img src="{{ asset($value['image'])}}" class="img-responsive lazyload" alt="Product Image"></td>
                               <td colspan="3">
                                 <div class="checkout-item-detail">
                                   <p>{{$value['name']}}</p> 
                                   <span>Qty : {{$value['quantity']}}</span>
                                    <?php
                                // $singleprototal =  $value['price'] *  $value['quantity_selected'];
                                // dd($value);
                                ?>
                                   <span> ${{$value['price']}}</span>
                                 </div>
                                </td>
                             </tr>
                                <?php $total += $value['price'];?>
                              @endforeach
                            @endif
                            </tr>

                 
                           <tr class="order-summary-detail border-top">
                          
                              <td>Subtotal</td>
                              <td>${{$total}}</td>

                              <?php
                   
                   $discoupon = Session::get('discoupon_session');
                   if(!empty($discoupon))
                   {
                    $dis =($discoupon->coupon_price  / 100) * $total ;
                       $t = $total - $dis;
                       $total = $t;
                       $grand_total = $total - $dis;
                   }
                  
                   else
                   {
                       $grand_total = $total;
                   }
               
                   ?>
                           </tr>


                           <?php
                    $shipamount = session::get('shipping');
                    // dd($shipamount);
                    if(isset($shipamount) && !empty($shipamount)){ 
                        $finalamount =$shipamount['shipping_amount'] + $total;
                        $grandtotal = $finalamount;

                    }else{
                        $grandtotal = $total;
                    }
                    ?>
                    
                     @if(isset($shipamount) && !empty($shipamount))
                     <tr class="order-summary-detail border-top">
                          
                          <td> Delivery Method  ({{$shipamount['service_name']}}) </td>
                          <td> Shipping Fee $ {{number_format($shipamount['shipping_amount'] ,2)}}</td>
                       </tr>

                        @else

                        <div class="pro-total-thumbanil">
                            <div class="d-flex align-items-center justify-content-between">
                                <p>Cash on Deliver </p>
                              
                            </div>
                        </div>
                        <tr class="order-summary-detail border-top">
                          
                          <td><p>Delivery Method </p></td>
                          <td><p>Cash on Deliver </p></td>
                        
                       </tr>

                    @endif  

                    
               
                  
                           @if(!empty($discoupon))
                <tr>
                           <td>Discount Price</td>
                           <td>$ {{number_format($dis,2)}}</td>
                           </tr>
                           @endif
                           
                           <tr class="order-total">
                              <td>Total</td>
                              <td class="get_total">${{ number_format($grandtotal,2)}}</td>
                            </tr>
                        </tbody>                
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>
</section>
@else
<section class="checkout-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">

            
                <h1 class="text-center"><i class="far fa-check-circle"></i>We have received your payment</h1>
                
            </div>
         </div>
</section>
            
@endif
<style>

    /*  */
    .checkout-section h1 i {
    color: #28a745;
    margin-right: 20px;
    font-size: 40px;
    
}
    /*  */
         .account-wrapper .card {
	border: 2px solid #ca7c8a!important;
	margin-bottom: 30px
}
.pay-strip input::placeholder {
    font-family: 'Lato';
}
.account-wrapper .card-header {
	padding: 0;
	background: 0 0
}
.account-wrapper .card-header button {
	display: flex;
	align-items: center;
	padding: 15px 50px;
	font-size: 14px;
	font-weight: 600;
	color: #231f20;
	text-transform: uppercase;
	letter-spacing: 1px;
	position: relative;
	width: 100%;
	text-align: left;
	background: 0 0;
	border-bottom: 1px solid #d4d4d4
}
.account-wrapper .card-header button i {
	position: absolute;
	top: 50%;
	right: 20px;
	transform: translateY(-50%);
	font-size: 25px;
	color: #ca7c8a;
	transition: all .5s ease-in-out
}
.account-wrapper .card-header button span {
	display: inline-block;
	width: 20px;
	height: 20px;
	position: absolute;
	top: 50%;
	left: 20px;
	transform: translateY(-50%);
	border: 2px solid #ca7c8a;
	border-radius: 50%
}
.account-wrapper .card-header button span::before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 10px;
	height: 10px;
	background: #ca7c8a;
	border-radius: 50%;
	opacity: 0;
	visibility: hidden
}
.account-wrapper .card-header button[aria-expanded=true] span::before {
	visibility: visible;
	opacity: 1
}
.account-wrapper .card-header button[aria-expanded=true] i {
	transform: translateY(-50%) rotate(180deg)
}

.account-wrapper .card .form-group {
  border: none !important;
}
.row3zee .form-group {
}
.card-body {border: 2px solid #efefef;
            
            padding: 40px 90px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;}
          
          
          
          .card-header button {border: none;background: transparent;}
          
          .card-header button:focus {border: transparent;outline: none;}
          
          .paymenth .btn-primary:hover {background: transparent;color: #000;border: 2px solid #4471c4;}
    
          td.checkout-product-image img {
    width: 40%;
}
.checkout-item-label a#checkout-toggle {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.checkout-product-image {
    width: 65%;
}
    
    </style>
         
        
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!-- Paypal script start -->
<script>


    // paypal.Button.render({
    //     env: 'sandbox', // sandbox | production
    //     style: {
    //         label: 'checkout',
    //         size: 'responsive', // small | medium | large | responsive
    //         shape: 'rect',  // pill | rect
    //         color: 'blue'    // gold | blue | silver | black
    //     },

    //     // PayPal Client IDs - replace with your own
    //     // Create a PayPal app: https://developer.paypal.com/developer/applications/create

    //     client: {
    //         sandbox: 'AUmHB_5SuVcp75BKtDpmELANcg1XmEvFG8SvvuYQa-cngWOXSSmRfXBnt15_TGkcJtpsnFjMBzpxzE6F',
    //         production: 'AUmHB_5SuVcp75BKtDpmELANcg1XmEvFG8SvvuYQa-cngWOXSSmRfXBnt15_TGkcJtpsnFjMBzpxzE6F'
    //     },

    //     payment: function (data, actions) {
    //         return actions.payment.create({
    //             transactions: [{
    //                 amount: {
    //                     total: '{{$amount}}',
    //                     currency: 'USD',
    //                     //currency: 'GBP',
    //                     details: {
    //                         subtotal: '{{$amount}}',
                           
    //                         shipping: '0.00',
    //                         handling_fee: '0.00',
    //                         shipping_discount: '0.00',
    //                         insurance: '0.00'
    //                     }
    //                 },

    //                 description: 'The payment transaction description.',
    //                 custom: '{{$order_id}}',
    //                 //invoice_number: '12345', Insert a unique invoice number

    //                 payment_options: {
    //                     allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
    //                 },

    //                 soft_descriptor: 'Grovecityhockeyllc',
    //                 // item_list: {
    //                 //     items: <?php echo json_encode($itemsss); ?>,
    //                 //     // shipping_address: {
    //                 //     //   recipient_name: '<?=$orders['fname']?>',
    //                 //     //   line1: '',
    //                 //     //   line2: '',
    //                 //     //   city: '',
    //                 //     //   country_code: 'US',
    //                 //     //   postal_code: '',
    //                 //     //   phone: '',
    //                 //     //   state: '',
    //                 //     //   email: '<?=$orders['email']?>'
    //                 //     // }
    //                 // }

    //             }],

    //             note_to_payer: 'Contact us for any questions on your order.'

    //         });

    //     },

    //     onAuthorize: function (data, actions) {
    //         return actions.payment.execute().then(function () {
    //             // AdminToastr.success('Your Payment has been Charged Successfully', 'Payment Success');
               
    //             // console.log(data);
    //             // console.log(actions);

    //             // return false;

    //             var EXECUTE_URL = "{{route('paystatus')}}";

    //             var params = {
    //                 payment_status: 'Completed',
    //                 custom: '{{$custom}}',// ORDER ID,
    //                 paymentID: data.paymentID,
    //                 payerID: data.payerID
    //             };

    //             if (paypal.request.post(EXECUTE_URL, params)) {
    //                 // return false;
    //                 if (params.payment_status == 'Completed') {

    //                     $.toast({
    //                         heading: 'Success!',
    //                         position: 'bottom-right',
    //                         text:  'Your Payment has been Charged Successfully',
    //                         loaderBg: '#ff6849',
    //                         icon: 'success',
    //                         hideAfter: 2000,
    //                         stack: 6
    //                     });
    //                     // console.log(data);
    //                     setInterval(function () {
    //                 
    //                     }, 2000);
    //                 } else {
    //                     // console.log
    //                     $.toast({
    //                         heading: 'Error!',
    //                         position: 'bottom-right',
    //                         text:  'Payment Failed',
    //                         loaderBg: '#ff6849',
    //                         icon: 'error',
    //                         hideAfter: 2000,
    //                         stack: 6
    //                     });

    //                     // AdminToastr.error('Error', 'Payment Failed');
    //                 }
    //             }
    //         }).catch(function (error) {
    //             // console.log(error);
    //             // AdminToastr.error('Error', 'Payment Failed');
             
    //             $.toast({
	// 			heading: 'Error!',
	// 			position: 'bottom-right',
	// 			text:  'Payment Failed',
	// 			loaderBg: '#ff6849',
	// 			icon: 'error',
	// 			hideAfter: 2000,
	// 			stack: 6
	// 		});
    //         });
    //     },

    //     validate: function (actions) {},

    //     onCancel: function (data, actions) {
    //         // AdminToastr.error('Some Error occured', 'Error');
    //         $.toast({
	// 			heading: 'Error!',
	// 			position: 'bottom-right',
	// 			text:  'Some Error occured',
	// 			loaderBg: '#ff6849',
	// 			icon: 'error',
	// 			hideAfter: 2000,
	// 			stack: 6
	// 		});
    //         var EXECUTE_URL = "{{route('paystatus')}}";
    //         var params = {
    //             payment_status: 'Failed',
    //             custom: '<?=$custom; // ORDER ID?>',
    //             paymentID: data.paymentID
    //         };
    //         if (paypal.request.post(EXECUTE_URL, params)) {}
    //     },

    //     onError: function (data) {
    //         // AdminToastr.error('Error', 'Payment Failed');
    //         $.toast({
	// 			heading: 'Error!',
	// 			position: 'bottom-right',
	// 			text:  'Payment Failed',
	// 			loaderBg: '#ff6849',
	// 			icon: 'error',
	// 			hideAfter: 2000,
	// 			stack: 6
	// 		});
    //         // console.debug(data);
    //     }
    // }, '#paypal-button-container');

</script>
<!-- Paypal script end -->
                          
                       

@endsection
@section('css')
<style type="text/css">
 
</style>
@endsection
@section('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
(()=>{

    var $form = $(".require-validation");

$('form.require-validation').bind('submit', function (e) {
    var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
            'input[type=text]', 'input[type=file]',
            'textarea'
        ].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
    $errorMessage.addClass('hide');

    $('.has-error').removeClass('has-error');
    $inputs.each(function (i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
   
    if (!$form.data('cc-on-file')) {
        e.preventDefault();
       
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
    }
   

});

function stripeResponseHandler(status, response) {
    console.log(response);
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);

            $.toast({
                    heading: 'Error!',
                    position: 'bottom-right',
                    text: response.error.message,
                    loaderBg: '#ff6849',
                    icon: 'Error',
                    hideAfter: 2000,
                    stack: 6
                            });
    } else {
        /* token contains id, last4, and card type */
        var token = response['id'];

        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}

})()
</script>
@endsection