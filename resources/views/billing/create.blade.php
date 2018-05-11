@extends('layouts.app')
@section('content')
    <script src="https://checkout.stripe.com/checkout.js">
    </script>


    <!-- It is better to have the below script as separate file.-->
    <script type="text/javascript">
        // Setting the error class and error element for form validation.
        jQuery.validator.setDefaults({
            errorClass: "text-danger",
            errorElement: "small"
        });

        function showProcessing() {
            $('.subscribe-process').show();
        }
        function hideProcessing() {
            $('.subscribe-process').hide();
        }

        // Handling and displaying error during form submit.
        function subscribeErrorHandler(jqXHR, textStatus, errorThrown) {
            try{
                var resp = JSON.parse(jqXHR.responseText);
                if ('error_param' in resp) {
                    var errorMap = {};
                    var errParam = resp.error_param;
                    var errMsg = resp.error_msg;
                    errorMap[errParam] = errMsg;
                    $("#subscribe-form").validate().showErrors(errorMap);
                } else {
                    var errMsg = resp.error_msg;
                    $(".alert-danger").show().text(errMsg);
                }
            } catch(err) {
                $(".alert-danger").show().text("Error while processing your request");
            }
        }

        // Forward to thank you page after receiving success response.
        function subscribeResponseHandler(responseJSON) {
            window.location.replace(responseJSON.forward);
        }

        function handleStripeToken(token, args) {
            form = $("#subscribe-form");
            $("input[name='stripeToken']").val(token.id );
            var options = {
                beforeSend: showProcessing,
                // post-submit callback when error returns
                error: subscribeErrorHandler,
                // post-submit callback when success returns
                success: subscribeResponseHandler,
                complete: hideProcessing,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'json'
            };
            // Doing AJAX form submit to your server.
            form.ajaxSubmit(options);
            return false;
        }


        $(document).ready(function() {
            $("#subscribe-form").validate({
                rules: {
                    zip_code: {number: true},
                    phone: {number: true}
                }
            });


            // Creating Stripe Checkout handler object and also
            // configuring Stripe publishable key and setting the options in Stripe Js.
            var handler = StripeCheckout.configure({
                //Replace it with your stripe publishable key
                key: 'pk_test_acfVSJh9Oo9QIGTAQpUvG5Ig',
                image: '/assets/images/favicon.png',
                allowRememberMe: false,
                token: handleStripeToken
            });


            // Calling Stripe Js to display pop up on button click event
            $("#submit-btn").on('click', function(e) {
                var form = $("#subscribe-form");
                if(!$(form).valid()) {
                    return false;
                }
                handler.open({
                    name: 'Honey Comics',
                    description: $('#plan-desc').val() ,
                    amount: $('#plan-price').val() ,
                    email: $('#email').val() ,
                });
                return false;
            });


        });
    </script>
</head>
<body>
<div class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <div class="h1"></div>
        </div>
    </div>
</div>
<div id="container" class="checkout container">
    <div class="row">
        <div class="col-sm-4 pull-right hidden-xs" id="order_summary">
            <br><br><br><br>
            <img src="/assets/images/secure.png" alt="secure server"/>
            <br><br>
            <div class="using">
                <img src="/assets/images/guarantee.jpg">
                <br>
                <hr class="dashed">
                <h5>Powered by</h5>
                <img src="/assets/images/powered.png">
            </div>
        </div>
        <div class="col-sm-7" id="checkout_info">
            <!-- Add the needed fields in the form-->

            <form action="/stripe-popup-js/checkout" method="post" id="subscribe-form">
                <h3 class="page-header">Tell us about yourself</h3>
                <input type="hidden" id="plan-desc" name="plan-desc" value="Plan Basic ($6.00)" />
                <input type="hidden" id="plan-price" name="plan-price" value="600" />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customer[first_name]">First Name</label>
                            <input type="text" class="form-control" name="customer[first_name]"
                                   maxlength=50 required data-msg-required="cannot be blank">
                            <small for="customer[first_name]" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customer[last_name]">Last Name</label>
                            <input type="text" class="form-control" name="customer[last_name]"
                                   maxlength=50 required data-msg-required="cannot be blank">
                            <small for="customer[last_name]" class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customer[email]">Email</label>
                            <input id="email" type="text" class="form-control" name="customer[email]" maxlength=50
                                   data-rule-required="true" data-rule-email="true"
                                   data-msg-required="Please enter your email address"
                                   data-msg-email="Please enter a valid email address">
                            <small for="customer[email]" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customer[phone]">Phone</label>
                            <input id="phone" type="text" maxlength="10" class="form-control" name="customer[phone]"
                                   maxlength=50 required data-msg-required="cannot be blank">
                            <small for="customer[phone]" class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <h3 class="page-header">Where would you like us to deliver
                    <small>(Only shipped within USA)</small>
                </h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping_address[line1]">Address</label>
                            <input type="text" class="form-control" name="shipping_address[line1]"
                                   maxlength=50 required data-msg-required="cannot be blank">
                            <small for="shipping_address[line1]" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping_address[line2]">Address2</label>
                            <input type="text" class="form-control" name="shipping_address[line2]" maxlength=50>
                            <small for="shipping_address[line2]" class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping_address[city]">City</label>
                            <input type="text" class="form-control" name="shipping_address[city]" maxlength=50
                                   required data-msg-required="cannot be blank">
                            <small for="shipping_address[city]" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping_address[state]">State</label>
                            <input type="text" class="form-control" name="shipping_address[state]" maxlength=20
                                   required data-msg-required="cannot be blank">
                            <small for="shipping_address[state]" class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping_address[zip_code]">Zip Code</label>
                            <input id="zip_code" type="text" class="form-control" name="shipping_address[zip_code]"
                                   maxlength=10 required number data-msg-required="cannot be blank">
                            <small for="shipping_address[zip_code]" class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="stripeToken" value="" />
                <hr>
                <p><small class="text-danger" style="display:none;">There were errors while submitting</small></p>
                <p><input id="submit-btn" type="submit" class="btn btn-success btn-lg pull-left" value="Proceed to Payment">&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="subscribe-process process" style="display:none;">Processing&hellip;</span>
                    <small class="alert-danger text-danger"></small>
                </p>
            </form>

        </div>
    </div>
</div>
<br><br>
<div class="footer text-center">
    <span class="text-muted">&copy; Honey Comics. All Rights Reserved.</span>
</div>

    @endsection