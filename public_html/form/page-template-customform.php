<?php
/*
Template Name: Custom Form
*/

 ?>
 
<?php get_header(); ?>

    <head>
        <meta charset="UTF-8" />
        <title>Book Now</title>
        <link rel="icon"
        type="image/png"
        href="assets/img/NC_logo.png">
        <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- GLOBAL STYLES -->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <!--END GLOBAL STYLES -->

        <!-- PAGE LEVEL STYLES -->
        <link href="assets/css/booknow.css" rel="stylesheet" />
        <link href="assets/css/jquery-ui.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
        <!-- END PAGE LEVEL  STYLES -->

        <!-- GLOBAL SCRIPTS -->
        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <script src="assets/js/formsInit.js"></script>
        <script src="assets/js/validationInit.js"></script>
        <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
        <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.js"></script>
        <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
        <script src="assets/js/jquery-scrolltofixed.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <!--END PAGE LEVEL SCRIPTS -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#summary').scrollToFixed({
                    marginTop : 0
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#phonetotal').scrollToFixed({
                    marginTop : 0
                });
            });
        </script>
        <script type="text/javascript">
            //Formula used to check if credit card numbers are valid
            function checkLuhn(input) {
                var sum = 0;
                var numdigits = input.length;
                var parity = numdigits % 2;
                for (var i = 0; i < numdigits; i++) {
                    var digit = parseInt(input.charAt(i))
                    if (i % 2 == parity)
                        digit *= 2;
                    if (digit > 9)
                        digit -= 9;
                    sum += digit;
                }
                return (sum % 10) == 0;
            }
        </script>

        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function() {

                $('.datepicker').datepicker({
                    daysOfWeekDisabled : "0,6",

                });
                $('#dp2').on('change', function() {
                    $('.datepicker').hide();
                });

            });
        </script>
        <script>
            //Google Analytics Script
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] ||
                function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-5358845-3', 'auto');
            ga('send', 'pageview');

        </script>
        <script>
            function anytime() {
                document.getElementById('anytime').style.display = "block";
                document.getElementById('morning').style.display = "none";
                document.getElementById('afternoon').style.display = "none";
            }

            function morning() {
                document.getElementById('morning').style.display = "block";
                document.getElementById('anytime').style.display = "none";
                document.getElementById('afternoon').style.display = "none";
            }

            function afternoon() {
                document.getElementById('afternoon').style.display = "block";
                document.getElementById('morning').style.display = "none";
                document.getElementById('anytime').style.display = "none";
            }

            function onetime() {
                document.getElementById('disctime').style.display = "none";
                document.getElementById('multvisit').style.display = "none";
                document.getElementById('pmultvisit').style.display = "none";

                //document.getElementById('psub').style.display = "none";
                document.getElementById('monthdisc').style.display = "none";
                document.getElementById('bidisc').style.display = "none";
                document.getElementById('weekdisc').style.display = "none";
                //document.getElementById('pmonthdisc').style.display = "none";
                //document.getElementById('pbidisc').style.display = "none";
                //document.getElementById('pweekdisc').style.display = "none";
            }

            function weekly() {
                document.getElementById('disctime').style.display = "block";
                document.getElementById('multvisit').style.display = "block";
                document.getElementById('pmultvisit').style.display = "block";
                document.getElementById('sub').style.display = "block";
                document.getElementById('monthdisc').style.display = "none";
                document.getElementById('bidisc').style.display = "none";
                document.getElementById('weekdisc').style.display = "block";
                document.getElementById('fourwk').style.display = "none";
                document.getElementById('twowk').style.display = "none";
                document.getElementById('onewk').style.display = "block";
                //document.getElementById('psub').style.display = "block";
                //document.getElementById('pmonthdisc').style.display = "none";
                //document.getElementById('pbidisc').style.display = "none";
                //document.getElementById('pweekdisc').style.display = "block";
                document.getElementById('pfourwk').style.display = "none";
                document.getElementById('ptwowk').style.display = "none";
                document.getElementById('ponewk').style.display = "block";

            }

            function biweekly() {
                document.getElementById('disctime').style.display = "block";
                document.getElementById('multvisit').style.display = "block";
                document.getElementById('pmultvisit').style.display = "block";
                document.getElementById('sub').style.display = "block";
                document.getElementById('monthdisc').style.display = "none";
                document.getElementById('bidisc').style.display = "block";
                document.getElementById('weekdisc').style.display = "none";
                document.getElementById('fourwk').style.display = "none";
                document.getElementById('twowk').style.display = "block";
                document.getElementById('onewk').style.display = "none";
                /*document.getElementById('psub').style.display = "block";
                 document.getElementById('pmonthdisc').style.display = "none";
                 document.getElementById('pbidisc').style.display = "block";
                 document.getElementById('pweekdisc').style.display = "none";*/
                document.getElementById('pfourwk').style.display = "none";
                document.getElementById('ptwowk').style.display = "block";
                document.getElementById('ponewk').style.display = "none";
            }

            function monthly() {
                document.getElementById('disctime').style.display = "block";
                document.getElementById('multvisit').style.display = "block";
                document.getElementById('pmultvisit').style.display = "block";
                document.getElementById('sub').style.display = "block";
                document.getElementById('monthdisc').style.display = "block";
                document.getElementById('bidisc').style.display = "none";
                document.getElementById('weekdisc').style.display = "none";
                document.getElementById('fourwk').style.display = "block";
                document.getElementById('twowk').style.display = "none";
                document.getElementById('onewk').style.display = "none";
                /*document.getElementById('psub').style.display = "block";
                 document.getElementById('pmonthdisc').style.display = "block";
                 document.getElementById('pbidisc').style.display = "none";
                 document.getElementById('pweekdisc').style.display = "none";*/
                document.getElementById('pfourwk').style.display = "block";
                document.getElementById('ptwowk').style.display = "none";
                document.getElementById('ponewk').style.display = "none";
            }

            function getclean() {
                document.getElementById('getclean').style.display = "block";
                document.getElementById('deepclean').style.display = "none";
                document.getElementById('moveinout').style.display = "none";
                document.getElementById('t-getclean').style.display = "table-cell";
                document.getElementById('t-deepclean').style.display = "none";
                document.getElementById('t-move').style.display = "none";
            }

            function deepclean() {
                document.getElementById('getclean').style.display = "none";
                document.getElementById('deepclean').style.display = "block";
                document.getElementById('moveinout').style.display = "none";
                document.getElementById('t-getclean').style.display = "none";
                document.getElementById('t-deepclean').style.display = "table-cell";
                document.getElementById('t-move').style.display = "none";
                document.getElementById('sub').style.display = "block";
                //document.getElementById('psub').style.display = "block";
            }

            function moveinout() {
                document.getElementById('getclean').style.display = "none";
                document.getElementById('deepclean').style.display = "none";
                document.getElementById('moveinout').style.display = "block";
                document.getElementById('t-getclean').style.display = "none";
                document.getElementById('t-deepclean').style.display = "none";
                document.getElementById('t-move').style.display = "table-cell";
                document.getElementById('sub').style.display = "block";
                //document.getElementById('psub').style.display = "block";
            }

        </script>

        <script>
            Stripe.setPublishableKey('pk_test_Kd3bmaphUVShmURo2ruSYaAd');

            $(function() {
                $('form').submit(function(e) {
                    Stripe.card.createToken({
                        number : $('#creditcard').val(),
                        cvc : $('#cvc').val(),
                        exp_month : $('#expmonth').val(),
                        exp_year : $('#expyear').val()

                    }, function(status, response) {
                        $form = $('form');
                        if (response.error) {
                            // Show the errors on the form
                            $form.find('.payment-errors').text(response.error.message);
                            return false
                        } else {
                            // response contains id and card, which contains additional card details
                            var token = response.id;
                            // Insert the token into the form so it gets submitted to the server
                            $('#stripetoken').val(token)
                            // and submit

                            $form.get(0).submit();
                        }
                    });
                });
            });
        </script>

        <script>
            $(function() {
                formInit();
            });
        </script>
        <script>
            $(function() {
                formValidation();
            });
        </script>

        <script type="text/javascript" language="javascript">
            $(function(){
var base = 99
var deepclean = 1.4
var moveinout = 1.6
var addon = 35
var beds = 10
var baths = 18.5
var sqft = 1800
var week = .65
var biweek = .70
var month = .75
var rate = 43

var subtotal=(base)+((<?= $_SESSION['_Beds']?>)*beds)+((<?= $_SESSION['_baths']?>)*baths)+
((<?= $_SESSION['_SquareFootagesize']?>-sqft>0?<?= $_SESSION['_SquareFootagesize']?>
    -sqft:0)/100)*3;

    base = subtotal;

    var adjustment = subtotal;
    var recurringPrice = base;
    var recurringDiscount = 0;
    var firstclean = adjustment;
    var promodiscount = 0;
    var hours = adjustment / rate;

    var total = (subtotal - ($('.addon:not([value=""]').length * (addon)))
    $('#visit1').text('$' + firstclean.toFixed(2))
    $('#Ivisit1').val((firstclean * 100).toFixed(0))
    $('#Ivisit2').val((total * 100).toFixed(0))
    $('#pvisit1').text('$' + firstclean.toFixed(2))
    $('#visit2').text('$' + total.toFixed(2))
    $('#pvisit2').text('$' + total.toFixed(2))
    $('#subtotal').text('$' + subtotal.toFixed(2))
    $('#psubtotal').text('$' + subtotal.toFixed(2))
    $('#onetimeadjust').text('$' + subtotal.toFixed(2))
    $('#hour').text(hours.toFixed(1) + ' hours')
    var oldcleantype = null;
    $('.cleantype').click(function() {
        $('.cleantype').css({
            color : '#333333',
            'background-color' : '#fff',
            'border-color' : '#cccccc',
        })
        $(this).css({
            color : '#ffffff !important',
            'background-color' : '#FF8604 !important',
            'border-color' : '#b3b3b3 !important',
        });

        total += recurringDiscount;

        if (recurringDiscount == 0)
            recurringDiscount = .00001;

        recurringDiscount *= 1 / adjustment;
        if (oldcleantype == 'Deep Clean') {
            subtotal *= 1 / deepclean;
            adjustment *= 1 / deepclean;
            total *= 1 / deepclean;
            total -= recurringDiscount;
        } else if (oldcleantype == 'Move In/Out') {
            subtotal *= 1 / moveinout;
            adjustment *= 1 / moveinout;
            total *= 1 / moveinout;
            total -= recurringDiscount;
        }

        if ($(this).text() == 'Deep Clean') {
            adjustment *= deepclean;
            recurringDiscount *= adjustment;
            subtotal *= deepclean;
            total *= deepclean;
            total -= recurringDiscount;
        } else if ($(this).text() == 'Move In/Out') {
            adjustment *= moveinout;
            recurringDiscount *= adjustment;
            subtotal *= moveinout;
            total *= deepclean;
            total -= recurringDiscount;
        } else {
            recurringDiscount *= adjustment;
            total -= recurringDiscount;
        }
        if (recurringDiscount == .00001)
            recurringDiscount = 0;
        firstclean = adjustment - recurringDiscount - promodiscount;
        hours = adjustment / rate;

        $('#cleantype').val($(this).text())
        $('#hour').text(hours.toFixed(1) + ' hours')
        $('#visit1').text('$' + firstclean.toFixed(2))
        $('#pvisit1').text('$' + firstclean.toFixed(2))
        $('#visit2').text('$' + recurringPrice.toFixed(2))
        $('#pvisit2').text('$' + recurringPrice.toFixed(2))
        $('#Ivisit1').val((firstclean * 100).toFixed(0))
        $('#Ivisit2').val((total * 100).toFixed(0))
        $('#IdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#subtotal').text('$' + adjustment.toFixed(2))
        $('#psubtotal').text('$' + adjustment.toFixed(2))
        $('#discountR').text('-$' + recurringDiscount.toFixed(2))
        $('#pdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#onetimeadjust').text('$' + adjustment.toFixed(2))
        oldcleantype = $('#cleantype').val()
    })

    $('.addon').click(function() {
        recurringDiscount *= 1 / adjustment;
        if ($(this).val() == 0) {
            adjustment -= addon;
            subtotal -= addon;
            total -= addon;

        } else {
            adjustment += addon;
            subtotal += addon;
            total += addon;
        }

        recurringDiscount *= adjustment;

        firstclean = adjustment - recurringDiscount - promodiscount;
        hours = adjustment / rate;
        $('#hour').text(hours.toFixed(1) + ' hours')
        $('#visit2').text('$' + recurringPrice.toFixed(2))
        $('#pvisit2').text('$' + recurringPrice.toFixed(2))
        $('#visit1').text('$' + firstclean.toFixed(2))
        $('#pvisit1').text('$' + firstclean.toFixed(2))
        $('#Ivisit1').val((firstclean * 100).toFixed(0))
        $('#Ivisit2').val((total * 100).toFixed(0))
        $('#IdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#discountR').text('-$' + recurringDiscount.toFixed(2))
        $('#pdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#onetimeadjust').text('$' + adjustment.toFixed(2))
        $('#subtotal').text('$' + adjustment.toFixed(2))
        $('#psubtotal').text('$' + adjustment.toFixed(2))
    })
    $('.repeat').click(function() {

        if ($('#repeat').val() == '1 time service') {
            recurringDiscount = 0
        } else if ($('#repeat').val() == 'Every week') {
            recurringDiscount = (1 - week) * adjustment;
            recurringPrice = base * week;
        } else if ($('#repeat').val() == 'Every 2 weeks') {
            recurringDiscount = (1 - biweek) * adjustment;
            recurringPrice = base * biweek;
        } else if ($('#repeat').val() == 'Every month') {
            recurringPrice = base * month;
            recurringDiscount = (1 - month) * adjustment;
        }

        firstclean = adjustment - recurringDiscount - promodiscount;
        hours = adjustment / rate;

        $('#hour').text(hours.toFixed(1) + ' hours')
        $('#visit1').text('$' + firstclean.toFixed(2))
        $('#visit2').text('$' + recurringPrice.toFixed(2))
        $('#pvisit2').text('$' + recurringPrice.toFixed(2))
        $('#Ivisit1').val((firstclean * 100).toFixed(0))
        $('#Ivisit2').val((total * 100).toFixed(0))
        $('#IdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#discountR').text('-$' + recurringDiscount.toFixed(2))
        $('#pdiscountR').text('-$' + recurringDiscount.toFixed(2))
        $('#onetimeadjust').text('$' + adjustment.toFixed(2))
    })

    $('#applyPromoBtn').click(function(e) {
        e.preventDefault();

        $.ajax({
            url : 'get_coupon.php?code=' + $('#promo').val().trim(),
            type : 'get',
            dataType : 'json',
            success : function(data) {
                if (data) {
                    if (data.percent_off) {
                        promodiscount = (data.percent_off / 100) * adjustment;
                        firstclean = adjustment - recurringDiscount - promodiscount;
                    } else if (data.amount_off) {
                        promodiscount = data.amount_off / 100;
                        firstclean = adjustment - recurringDiscount - promodiscount;
                    }

                    firstclean = adjustment - recurringDiscount - promodiscount;

                    $('#discountP').text('-$' + promodiscount.toFixed(2)).parent().show();
                    $('#pdiscountP').text('-$' + promodiscount.toFixed(2)).parent().show();
                    document.getElementById('sub').style.display = "block";
                    $('#visit1').text('$' + firstclean.toFixed(2));
                    $('#pvisit1').text('$' + firstclean.toFixed(2));

                } else {
                    alert("Invalid promo code");
                }
            },
            error : function(xhr) {
                xhr = JSON.parse(xhr.responseText);
                alert(xhr.Message);
            }
        })
    });

    });
        </script>
    </head>
    <!-- END HEAD -->
    <!-- MAIN WRAPPER -->
        <div class="container-fluid" id="wrap" style="padding: 0px">

            <!--PAGE CONTENT -->

            <div id="form" class="col-xs-12 container-fluid" style="min-height:0px; padding:0px"></div>
            <div style="padding:0px" class="panel panel-default" >

                <div class="panel-body container-fluid" style="padding:0px; background: #daeef3">
                    <form action="#" method="post" id="step1" role="form">
                        <span class="payment-errors"></span>
                        <div class="container-fluid" style="padding:0px">
                            <section class="col-xs-12" style="padding:0px">

                                <div id="phonetotal" class="summary col-xs-12 hidden-sm hidden-md hidden-lg">

                                    <div class="summary col-xs-12">
                                        <!--<div class="summary col-xs-12">
                                        <div id="psub" style="display:none" class="tablerow col-xs-12">
                                        <span class="col-xs-10">Subtotal:</span>
                                        <span class="col-xs-2" style="text-align: right" id="psubtotal" name="subtotal"></span>
                                        </div><div class="clearfix"></div>
                                        <div class="tablerow col-xs-12" id="disctime" style="display:none">
                                        <span id="pweekdisc" class="col-xs-10" style="display:none">35% Recurring Discount</span>
                                        <span id="pbidisc" class="col-xs-10" style="display:none">30% Recurring Discount</span>
                                        <span id="pmonthdisc" class="col-xs-10" style="display:none">25% Recurring Discount</span>
                                        <span id="pdiscountR" class="col-xs-2"></span>
                                        </div><div class="clearfix"></div>
                                        <div id="pprodisc" class="tablerow col-xs-12" style="display:none">
                                        <span class="col-xs-10">Promo Discount</span>
                                        <span style="white-space: nowrap" class="col-xs-2" id="pdiscountP"></span>
                                        </div><div class="clearfix"></div>
                                        </div><div class="clearfix"></div>-->

                                        <div class="psummary col-xs-12">
                                            <div class="col-md-5" style="float:left">
                                                <span id="pdate2"> </span>
                                                <br>
                                                <span id="pschedule2"> </span>
                                            </div>
                                            <div class="ptablerow col-xs-5" style="float:right">
                                                <span class="col-xs-8" style="vertical-align: middle">First Clean:</span>
                                                <b><span style="font-size: 20px; color: #3dafdc" class="col-xs-4" id="pvisit1"></span></b>
                                            </div><div class="clearfix"></div>
                                            <div id="pmultvisit" class="ptablerow col-xs-5" style="display:none; float:right">
                                                <span class="col-xs-8" id="ponewk" style="display:none; vertical-align: middle">Every Week</span>
                                                <span class="col-xs-8" id="ptwowk" style="display:none; vertical-align: middle">Every 2 Weeks</span>
                                                <span class="col-xs-8" id="pfourwk" style="display:none; vertical-align: middle">Every Month</span>
                                                <b><span style="color:#3dafdc; font-size: 20px" class="col-xs-4" id="pvisit2"></span></b>
                                            </div>
                                        </div>
                                    </div>
                                </div><div class="clearfix"></div>

                                <div class="col-xs-12 col-lg-4 col-lg-offset-3 col-md-6 col-md-offset-2 col-sm-8" style="background:white; padding-left:0%; padding-bottom:25px; padding-top: 1%">

                                    <p style="font-size: 23px; color:#3c3c3c">
                                        Cleaning Details:
                                    </p>
                                    <p>
                                        We will match you to one of our trusted cleaning professionals.
                                        <br class="hidden-xs">
                                        With our flexible scheduling you can cancel or reschedule anytime.
                                    </p>
                                    <div style="padding-left:25px" class="form-group; container-fluid">
                                        <input type="hidden" value="" id="repeat" name="_Frequency" />
                                        <a href="#" onclick="onetime()" style="margin:0px" class="btn btn-default btn-lg btn-line repeat col-xs-5 col-sm-3">1 time service</a><div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
                                        <a href="#" onclick="weekly()" style="margin:0px" class="btn btn-default btn-lg btn-line repeat col-xs-5 col-sm-3">Every week</a>
                                        <a href="#" onclick="biweekly()" style="margin:0px" class="btn btn-default btn-lg btn-line repeat col-xs-5 col-sm-3">Every 2 weeks</a><div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
                                        <a href="#" onclick="monthly()" style="margin:0px" class="btn btn-default btn-lg btn-line repeat col-xs-5 col-sm-3">Every month</a>
                                    </div><div class="clearfix"></div>
                                    <br>

                                    <p>
                                        Please select the level of cleaning your house needs.
                                    </p>
                                    <div style="padding-left:25px" class="form-group; container-fluid">
                                        <input type="hidden" value="" id="cleantype" name="_InitialCleanType" />
                                        <a href="#" id="clean" onclick="getclean()" class="clean btn btn-default btn-lg btn-line cleantype col-xs-4 col-sm-3">Get it Clean</a><div class="col-sm-1"></div>
                                        <a href="#" id="deep" onclick="deepclean()" class="deep btn btn-default btn-lg btn-line cleantype col-xs-4 col-sm-3">Deep Clean</a><div class="col-sm-1"></div>
                                        <a href="#" id="move" onclick="moveinout()" class="move btn btn-default btn-lg btn-line cleantype col-xs-4 col-sm-3">Move In/Out</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div style="padding-left:0px; height: 56px">
                                        <p style="display:none" id="getclean" class="getclean">
                                            A maintenance clean recommended for returning clients or homes that have been cleaned and maintained within the last 30 to 60 days.
                                        </p>
                                        <p style="display:none" id="deepclean" class="deepclean">
                                            Recommended for extremely thorough cleaning where everything is hand wiped from the ceiling fans down to the baseboards. Ex: Yearly Spring Clean
                                        </p>
                                        <p style="display:none" id="moveinout" class="moveinout">
                                            An extremely thorough cleaning where everything is hand wiped from the ceiling fans down to the baseboards. Also includes cleaning inside empty cabinets and drawers.
                                        </p>
                                    </div>
                                    <hr>
                                    <p style="font-size: 23px; color:#3c3c3c">
                                        Select Your Addons
                                    </p>
                                    <p>
                                        Add these little extras to really complement your first cleaning!
                                    </p>
                                    <div class="row-fluid">
                                        <div style="padding: 0px !important" class="form-group" value="">
                                            <input type="hidden" name="_AddOns" id="addon" value="" />
                                            <div  style="left: -20px" class="col-xs-3 col-md-3" align="center">
                                                <input name="Fridge" id="fridge" value="" class="addon" type="image" src="assets/img/33.png"</input>

                                                </div>
                                                <div  style="left: -20px" class="col-xs-3 col-md-3" align="center">
                                                <input name="Stove" id="stove" value="" class="addon" type="image" src="assets/img/22.png"</input>

                                                </div>

                                                <div  style="left: -20px" class="col-xs-3 col-md-3" align="center">
                                                <input name="Window" id="window" value="" class="addon" type="image" src="assets/img/44.png"</input>

                                                </div>

                                                <div  style="left: -20px" class="col-xs-3 col-md-3" align="center">
                                                <input name="BedSteam" id="wall" value="" class="addon" type="image" src="assets/img/55.png"</input>

                                                </div>

                                                <!--<div class="col-xs-6 col-md-4" align="center">
                                                <input name="Laundry" id="laundry" value="" class="addon" type="image" src="assets/img/11.png"</input>
                                                <p style="text-align:center">Load of laundry</p>
                                                </div>-->

                                                </div>
                                                </div>
                                                <div class="clearfix"></div><br>

                                                <hr>
                                                <p style="font-size: 23px; color:#3c3c3c">Appointment</p>
                                                <p>Pick your cleaning date and choose an arrival window.</p>
                                                <div class="form-group">
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-3">
                                                <input style="text-align: center" type="text" placeholder="mm/dd/yyyy" class="form-control datepicker" name="_SelectYourDate" data-date-format="mm/dd/yyyy" id="dp2" />
                                                </div>
                                                <input type="hidden" value="" id="daytime" name="_ArrivalWindow" /><div class="hidden-md hidden-lg"><br></div>
                                                <a href="#" id="any" onclick="anytime()" style="bottom:4px; margin-left:35px"class="btn btn-lg btn-default btn-line daytime col-xs-4 col-sm-3 col-md-2">Anytime</a>
                                                <a href="#" id="morn" onclick="morning()" style="bottom:4px; margin-left:35px" class="btn btn-lg btn-default btn-line daytime col-xs-4 col-sm-3 col-md-2">Morning</a>
                                                <a href="#" id="after" onclick="afternoon()" style="bottom:4px; margin-left:35px" class="btn btn-lg btn-default btn-line daytime col-xs-4 col-sm-3 col-md-2">Afternoon</a>
                                                </div><div class="clearfix"></div>
                                                <div style="height: 40px; padding-left: 0px">
                                                <p style="display:none" id="anytime" >We will arrive between 8:30 am and 4:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
                                                <p style="display:none" id="morning" >We will arrive between 8:30 am and 12:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
                                                <p style="display:none" id="afternoon" >We will arrive between 12:00 pm and 4:00 pm. Exact arrival time cannot be guaranteed, but you can opt in for a 30 minute call ahead.</p>
                                                </div>

                                                <div class="clearfix"></div>

                                                <hr>
                                                <p style="font-size: 23px; color:#3c3c3c">Contact Information</p>
                                                <p>
                                                We will use this to send you information about your cleanings.
                                                </p>
                                                <div class="form-group">
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="firstname" name="FirstName" value="<?= isset($_SESSION['FirstName'])?$_SESSION['FirstName']:'' ?>" class="form-control" placeholder="First Name" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="lastname" name="LastName" value="<?= isset($_SESSION['LastName'])?$_SESSION['LastName']:'' ?>"  class="form-control" placeholder="Last Name" />
                                                </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="email2" name="Email" value="<?= isset($_SESSION['Email'])?$_SESSION['Email']:'' ?>"  class="form-control" placeholder="Email" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="number" name="Phone1" value="<?= isset($_SESSION['Phone1'])?$_SESSION['Phone1']:'' ?>" class="form-control" data-mask="(999) 999-9999" placeholder="Phone" />
                                                </div>
                                                </div><div class="clearfix"></div><br>
                                                <hr>
                                                <p style="font-size: 23px; color:#3c3c3c">Service Address</p>
                                                <p>
                                                Hope we are not being too forward, but we do need to know where to go!
                                                </p>
                                                <div class="form-group">
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="street_address" name="StreetAddress1" value="<?= isset($_SESSION['StreetAddress1'])?$_SESSION['StreetAddress1']:'' ?>" class="form-control" placeholder="Street Address" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-6">
                                                <input id="address_2" name="StreetAddress2" value="<?= isset($_SESSION['StreetAddress2'])?$_SESSION['StreetAddress2']:'' ?>" class="form-control" placeholder="Apt # (optional)" />
                                                </div>
                                                <div class="clearfix"></div><br>

                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-4">
                                                <input id="city" name="City" value="<?= isset($_SESSION['City'])?$_SESSION['City']:'' ?>" class="form-control" placeholder="City" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-4">
                                                <select id="state" class="form-control" name="State" style="background:white; border:1px solid #ccc">
                                                <option value="AL" <?= $_SESSION['State'] == 'AL' ? 'selected' : '' ?>>Alabama</option>
                                                <option value="AK" <?= $_SESSION['State'] == 'AK' ? 'selected' : '' ?>>Alaska</option>
                                                <option value="AZ" <?= $_SESSION['State'] == 'AZ' ? 'selected' : '' ?>>Arizona</option>
                                                <option value="AR" <?= $_SESSION['State'] == 'AR' ? 'selected' : '' ?>>Arkansas</option>
                                                <option value="CA" <?= $_SESSION['State'] == 'CA' ? 'selected' : '' ?>>California</option>
                                                <option value="CO" <?= $_SESSION['State'] == 'CO' ? 'selected' : '' ?>>Colorado</option>
                                                <option value="CT" <?= $_SESSION['State'] == 'CT' ? 'selected' : '' ?>>Connecticut</option>
                                                <option value="DE" <?= $_SESSION['State'] == 'DE' ? 'selected' : '' ?>>Delaware</option>
                                                <option value="DC" <?= $_SESSION['State'] == 'DC' ? 'selected' : '' ?>>District Of Columbia</option>
                                                <option value="FL" <?= $_SESSION['State'] == 'FL' ? 'selected' : '' ?>>Florida</option>
                                                <option value="GA" <?= $_SESSION['State'] == 'GA' ? 'selected' : '' ?>>Georgia</option>
                                                <option value="HI" <?= $_SESSION['State'] == 'HI' ? 'selected' : '' ?>>Hawaii</option>
                                                <option value="ID" <?= $_SESSION['State'] == 'ID' ? 'selected' : '' ?>>Idaho</option>
                                                <option value="IL" <?= $_SESSION['State'] == 'IL' ? 'selected' : '' ?>>Illinois</option>
                                                <option value="IN" <?= $_SESSION['State'] == 'IN' ? 'selected' : '' ?>>Indiana</option>
                                                <option value="IA" <?= $_SESSION['State'] == 'IA' ? 'selected' : '' ?>>Iowa</option>
                                                <option value="KS" <?= $_SESSION['State'] == 'KS' ? 'selected' : '' ?>>Kansas</option>
                                                <option value="KY" <?= $_SESSION['State'] == 'KY' ? 'selected' : '' ?>>Kentucky</option>
                                                <option value="LA" <?= $_SESSION['State'] == 'LA' ? 'selected' : '' ?>>Louisiana</option>
                                                <option value="ME" <?= $_SESSION['State'] == 'ME' ? 'selected' : '' ?>>Maine</option>
                                                <option value="MD" <?= $_SESSION['State'] == 'MD' ? 'selected' : '' ?>>Maryland</option>
                                                <option value="MA" <?= $_SESSION['State'] == 'MA' ? 'selected' : '' ?>>Massachusetts</option>
                                                <option value="MI" <?= $_SESSION['State'] == 'MI' ? 'selected' : '' ?>>Michigan</option>
                                                <option value="MN" <?= $_SESSION['State'] == 'MN' ? 'selected' : '' ?>>Minnesota</option>
                                                <option value="MS" <?= $_SESSION['State'] == 'MS' ? 'selected' : '' ?>>Mississippi</option>
                                                <option value="MO" <?= $_SESSION['State'] == 'MO' ? 'selected' : '' ?>>Missouri</option>
                                                <option value="MT" <?= $_SESSION['State'] == 'MT' ? 'selected' : '' ?>>Montana</option>
                                                <option value="NE" <?= $_SESSION['State'] == 'NE' ? 'selected' : '' ?>>Nebraska</option>
                                                <option value="NV" <?= $_SESSION['State'] == 'NV' ? 'selected' : '' ?>>Nevada</option>
                                                <option value="NH" <?= $_SESSION['State'] == 'NH' ? 'selected' : '' ?>>New Hampshire</option>
                                                <option value="NJ" <?= $_SESSION['State'] == 'NJ' ? 'selected' : '' ?>>New Jersey</option>
                                                <option value="NM" <?= $_SESSION['State'] == 'NM' ? 'selected' : '' ?>>New Mexico</option>
                                                <option value="NY" <?= $_SESSION['State'] == 'NY' ? 'selected' : '' ?>>New York</option>
                                                <option value="NC" <?= $_SESSION['State'] == 'NC' ? 'selected' : '' ?>>North Carolina</option>
                                                <option value="ND" <?= $_SESSION['State'] == 'ND' ? 'selected' : '' ?>>North Dakota</option>
                                                <option value="OH" <?= $_SESSION['State'] == 'OH' ? 'selected' : '' ?>>Ohio</option>
                                                <option value="OK" <?= $_SESSION['State'] == 'OK' ? 'selected' : '' ?>>Oklahoma</option>
                                                <option value="OR" <?= $_SESSION['State'] == 'OR' ? 'selected' : '' ?>>Oregon</option>
                                                <option value="PA" <?= $_SESSION['State'] == 'PA' ? 'selected' : '' ?>>Pennsylvania</option>
                                                <option value="RI" <?= $_SESSION['State'] == 'RI' ? 'selected' : '' ?>>Rhode Island</option>
                                                <option value="SC" <?= $_SESSION['State'] == 'SC' ? 'selected' : '' ?>>South Carolina</option>
                                                <option value="SD" <?= $_SESSION['State'] == 'SD' ? 'selected' : '' ?>>South Dakota</option>
                                                <option value="TN" <?= $_SESSION['State'] == 'TN' ? 'selected' : '' ?>>Tennessee</option>
                                                <option value="TX" <?= $_SESSION['State'] == 'TX' ? 'selected' : '' ?>>Texas</option>
                                                <option value="UT" <?= $_SESSION['State'] == 'UT' ? 'selected' : '' ?>>Utah</option>
                                                <option value="VT" <?= $_SESSION['State'] == 'VT' ? 'selected' : '' ?>>Vermont</option>
                                                <option value="VA" <?= $_SESSION['State'] == 'VA' ? 'selected' : '' ?>>Virginia</option>
                                                <option value="WA" <?= $_SESSION['State'] == 'WA' ? 'selected' : '' ?>>Washington</option>
                                                <option value="WV" <?= $_SESSION['State'] == 'WV' ? 'selected' : '' ?>>West Virginia</option>
                                                <option value="WI" <?= $_SESSION['State'] == 'WI' ? 'selected' : '' ?>>Wisconsin</option>
                                                <option value="WY" <?= $_SESSION['State'] == 'WY' ? 'selected' : '' ?>>Wyoming</option>
                                                </select>
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-4">
                                                <input id="zip" class="form-control" value="<?= isset($_SESSION['PostalCode'])?$_SESSION['PostalCode']:'' ?>" placeholder="Zipcode" name="PostalCode" />
                                                </div>

                                                </div><div class="clearfix"></div><br>
                                                <hr>
                                                <p style="font-size: 23px; color:#3c3c3c">Payment details</p>
                                                <p>
                                                Enter your card information below.
                                                <br>
                                                You will be charged after service has been rendered.
                                                </p>
                                                <div class="form-group">
                                                <div style="padding-left:0px" class="col-xs-8 col-md-5">
                                                <input id="promo" value="<?= isset($_SESSION['_Promo_Code'])?$_SESSION['_Promo_Code']:'' ?>" name="_Promo_Code" class="form-control" placeholder="Promo code (optional)" />
                                                </div>
                                                <a href="#" style="bottom:5px; padding-top:9px" class="btn btn-lg btn-warning btn-grad col-xs-3 col-md-2" id="applyPromoBtn">Apply</a>
                                                <div class="clearfix"></div><br>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-5 input-group">
                                                <input style="border-right:none" value="<?= isset($_SESSION['creditcard'])?$_SESSION['creditcard']:''?>" autocomplete="off" data-stripe="number" id="creditcard" name="credit_card" data-mask="9999-9999-9999-9999" class="form-control" placeholder="Credit Card Number"
                                                onblur="creditcard_saved = this.value;
                                                this.value = this.value.replace(/[^\d]/g, '');
                                                if(!checkLuhn(this.value)) {
                                                alert('Sorry, that is not a valid number - please try again!');
                                                this.value = '';
                                                }"
                                                onfocus="
                                                if(this.value != cc_number_saved) this.value = cc_number_saved;"/>
                                                <span class="input-group-addon">
                                                <i class="icon-lock"></i>
                                                </span>
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-12 col-md-2">
                                                <input id="cvc" value="<?= isset($_SESSION['cvc'])?$_SESSION['cvc']:''?>" name="cvc" data-stripe="cvc" data-mask="999" class="form-control" placeholder="CVC" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-6 col-md-2">
                                                <input id="expmonth" value="<?= isset($_SESSION['expmonth'])?$_SESSION['expmonth']:''?>" name="expmonth" data-stripe="exp-month" class="form-control" data-mask="99" placeholder="MM" />
                                                </div>
                                                <div style="padding-left:0px" class="phone col-xs-6 col-md-3">
                                                <input id="expyear" value="<?= isset($_SESSION['expyear']) ? $_SESSION['expyear'] : '' ?>" name="expyear" data-stripe="exp-year" class="form-control" data-mask="9999" placeholder="YYYY" />
                                            </div>
                                            <div class="clearfix"></div>
                                            <div style="left:-16px" class="col-xs-4">
                                            <img id="ccimage" style="width:240px" src="assets/img/cc_logo.png">
                                            </div>
                                            </div><div class="clearfix"></div><br><hr>
                                            <div >
                                            <p style="padding: 0px">
                                            By clicking "Book My Cleaning", you are agreeing to our <a href="https://naturalcarecleaningservice.com/terms-conditions/">Terms of Service</a>.
                                            </p>
                                            </div>
                                            <div>
                                            <div style="display:none">
                                            <input name="_promodiscount" id="promodisc5" />
                                            <input name="_YourFirstClean" id="Ivisit1" />
                                            <input name="_YourRecurringPrice" id="Ivisit2" />
                                            <input name="_RecurringDiscount" id="IdiscountR" />
                                            <input name="_OneTimeAdjustment" id="onetimeadjust" />
                                            <input name="stripeToken" id="stripetoken" />
                                            </div>
                                            <button style="height: 52px; background: #89C050; font-size: 24px; color: white;" type="submit" id="continue2" name="continue2" class="btn btn-grad col-xs-12">Book My Cleaning</button>
                                            </div>
                                            </div>

                                            <div id="summary" class="summary col-sm-3 col-lg-2 hidden-xs">
                                            <div class="summary">
                                            <div class="summary col-sm-12">
                                            <div class="col-sm-3">
                                            <img style="height: 24px" src="assets/img/House.png" />
                                        </div>
                                        <div class="col-sm-9">
                                        <span id="t-getclean" style="display:none">Get it Clean<br></span>
                                        <span id="t-deepclean" style="display:none">Deep Clean<br></span>
                                        <span id="t-move" style="display:none">Move In/Out<br></span>
                                        <span id="t-fridge" style="display:none">+ Inside the Fridge<br></span>
                                        <span id="t-stove" style="display:none">+ Inside the Oven<br></span>
                                        <span id="t-window" style="display:none">+ Inside Windows<br></span>
                                        <span id="t-wall" style="display:none">+ Bed Steaming<br></span>
                                        </div>
                                        </div><div class="clearfix"></div><br>
                                        <div class="summary col-sm-12">
                                        <div class="col-sm-3">
                                        <img style="height: 24px" src="assets/img/Calendar.png" />
                                        </div>
                                        <div class="col-sm-9">
                                        <span id="date2"></span><br>
                                        <span id="schedule2"></span>
                                        </div>
                                        </div><div class="clearfix"></div><br>
                                        <div class="summary col-sm-12">
                                        <div class="col-sm-3">
                                        <img style="height: 24px" src="assets/img/Clock.png" />
                                    </div>
                                    <div class="col-sm-9">
                                        <span id="hour"></span>
                                    </div>
                                </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="summary col-sm-12" style="border-top:2px solid #DAEEF3">
                            <div class="summary col-sm-12">
                                <div id="sub" style="display:none" class="tablerow col-sm-12">
                                    <span class="col-sm-10">Subtotal:</span>
                                    <span class="col-sm-2" style="text-align: right" id="subtotal" name="subtotal"></span>
                                </div><div class="clearfix"></div>
                                <div class="tablerow col-sm-12" id="disctime" style="display:none">
                                    <span id="weekdisc" class="col-sm-10" style="display:none">35% Recurring Discount:</span>
                                    <span id="bidisc" class="col-sm-10" style="display:none">30% Recurring Discount:</span>
                                    <span id="monthdisc" class="col-sm-10" style="display:none">25% Recurring Discount:</span>
                                    <span id="discountR" class="col-sm-2"></span>
                                </div><div class="clearfix"></div>
                                <div id="prodisc" class="tablerow col-sm-12" style="display:none">
                                    <span class="col-sm-10">Promo Discount:</span>
                                    <span style="white-space: nowrap" class="col-sm-2" id="discountP"></span>
                                </div><div class="clearfix"></div>
                            </div><div class="clearfix"></div>
                            <br>
                            <div class="summary col-sm-12">
                                <div class="tablerow col-sm-12">
                                    <span class="col-sm-10">First Clean:</span>
                                    <b><span style="font-size: 20px; color: #3dafdc" class="col-sm-2" id="visit1"></span></b>
                                    <sub style="float:right; right:-50px">+tax</sub>
                                </div><div class="clearfix"></div>
                                <br>
                                <div id="multvisit" class="tablerow col-sm-12" style="display:none; margin-bottom: 40px">
                                    <span class="col-sm-10" id="onewk" style="display:none">Every Week:</span>
                                    <span class="col-sm-10" id="twowk" style="display:none">Every 2 Weeks:</span>
                                    <span class="col-sm-10" id="fourwk" style="display:none">Every Month:</span>
                                    <b><span style="color:#3dafdc; font-size: 20px" class="col-sm-2" id="visit2"></span></b>
                                    <sub style="float:right; right:-50px">+tax</sub>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

            </section>
        </div>

        </div>
        </div>
        </form>
        </div>
        </div>

        </div>
        </div>
        <!--END PAGE CONTENT -->
        </div>

        <!--END MAIN WRAPPER -->

<?php get_footer(); ?>