<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap TouchSpin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A mobile and touch friendly input spinner component for Bootstrap 3.">
    <meta name="author" content="István Ujj-Mészáros">


    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.css" rel="stylesheet" type="text/css" media="all">
    <link href="../src/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" media="all">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.js"></script>

    <script src="../src/jquery.bootstrap-touchspin.js"></script>


</head>

<body>
<div class="container">


    <div class="row">
        <div class="col-md-3">
            <input
                class="form-control has-success"
                id="bed"
                name="_Beds"
                required=""
                type="text"
            >
        </div>

        <script>
            var bed = 0;
            var bath = 0;

            /** */
            $(document).ready(function(){
                $("#bed").val('1 bedrooms');
            });

            /** */
            var i = $("#bed");

            /** */
            i.TouchSpin({});
            i.on("touchspin.on.startupspin", function () {
                if(bed < 6) {
                    bed++;
                    $('#bed').val(bed + ' bedrooms');
                } else {
                    $('#bed').val(bed + ' bedrooms');
                }
            });
            i.on("touchspin.on.startdownspin", function () {
                if(bed > 1 ) {
                    bed--;
                    $('#bed').val(bed + ' bedrooms');
                } else {
                    $('#bed').val(bed + ' bedrooms');
                }
            });

        </script>






    </div>


</div>

<script>
    prettyPrint();
</script>
