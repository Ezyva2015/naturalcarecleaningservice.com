 
console.log("stepper.js loaded"); 

$(function(){ 
    console.log( "This is $(function() { " + localStorage.getItem('lastname')); 
});
 
$(document).ready(function(){
    console.log( "This is from document ready" + localStorage.getItem('lastname'));
})

 

//Initialized beds value 
  
$(window).load(function(){   
    setTimeout(function(){  
        $('#bed').val('1 Bedroom'); 
        $('#bath').val('1 Bathroom');
    }, 2000);
    
});


$(window).load(function(){  

    var o = new Object();
    o.base        = localStorage.getItem('base');
    o.keepclean   = localStorage.getItem('keepclean');
    o.getclean    = localStorage.getItem('getclean');
    o.deepclean   = localStorage.getItem('deepclean');
    o.moveinout   = localStorage.getItem('moveinout');
    o.addon       = localStorage.getItem('addon');
    o.beds        = localStorage.getItem('beds');
    o.baths       = localStorage.getItem('baths');
    o.sqft        = localStorage.getItem('sqft');
    o.week        = localStorage.getItem('week');
    o.biweek      = localStorage.getItem('biweek');
    o.month       = localStorage.getItem('month');
    o.rate        = localStorage.getItem('rate');
    o.useDiscount = localStorage.getItem('useDiscount');
    o.discount    = localStorage.getItem('discount'); 

 
     
    bed('#bed');
    bath('#bath'); 
    // whne mouse out of the button text should be added for 2 beedrooms 
    $( '#bed' )
        .focusout(function() { 
        })
        .blur(function() { 
        var current_value = $(this).val();
        if(current_value == 1) {
            $(this).val(current_value + " Bedroom");     
        } else {
            $(this).val(current_value + " Bedrooms"); 
        } 
    }); 
    // whne mouse out of the button text should be added for 2 bathrooms 
    $( '#bath' )
        .focusout(function() { 
    }) 
    .blur(function() { 
         var current_value = $(this).val();
         if(current_value == 1) {
            $(this).val(current_value + " Bathroom");     
         } else {
             $(this).val(current_value + " Bathrooms"); 
         } 
    }); 

    //functions 



    function bed(id) {
        var bed = 1;
        var bath = 1;
        var bedRoomPlural = 's';
        var string = '';
        var maxValue = 6;
        var minValue = 1;
        var itemName = 'Bedroom'; 
        //var fieldCurrentValue = $(id).val();
        //id = '#bed';

    
        

        /** */
        var i = $(id);

        /** */
        i.TouchSpin({}); 
        i.on("touchspin.on.startupspin", function () {  
            // alert( o.base);
            if(bed < maxValue) {
                bed++;
                str = bed + ' ' + itemName;
            } else {
                str = bed + ' ' + itemName;
            }

            if(bed > 1) {
                str += bedRoomPlural;
            }

            $(id).val(str); 

            plusAndMinusButtonClickedAutoCalculate();
 
        }); 
        i.on("touchspin.on.startdownspin", function () {
            if(bed > minValue ) {
                bed--;
                str = bed + ' ' + itemName;
            } else {

                str = bed + ' ' + itemName;
            }

            if(bed > 1) {
                str += bedRoomPlural;
            }
            $(id).val(str); 

            plusAndMinusButtonClickedAutoCalculate();

             
        }); 
    }


    function bath(id) {
        var bed = 1;
        var bath = 1;
        var bedRoomPlural = 's';
        var string = '';
        var maxValue = 10;
        var minValue = 1;
        var itemName = 'Bathroom'; 
        //id = '#bed';
 
        /** */
        var i = $(id);

        /** */
        i.TouchSpin({});
        i.on("touchspin.on.startupspin", function () {


            console.log("bath up"); 
            $.fn.initialize();

            if(bed < maxValue) {
                bed++;
                str =  bathRoomUnit(bed) + ' ' + itemName;
            } else {
                str =  bathRoomUnit(bed) + ' ' + itemName;
            }

            if(bed > 1) {
                str += bedRoomPlural;
            }

            $(id).val(str); 

            plusAndMinusButtonClickedAutoCalculate(); 
     
        }); 
        i.on("touchspin.on.startdownspin", function () {
            if(bed > minValue ) {
                bed--;
                str = bathRoomUnit(bed) + ' ' + itemName;
            } else {
                str = bathRoomUnit(bed) + ' ' + itemName;
            }

            if(bed > 1) {
                str += bedRoomPlural;
            }
            $(id).val(str); 


            plusAndMinusButtonClickedAutoCalculate(); 
        }); 
    } 



    function bathRoomUnit(index) {
        var unit = new Array("", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5.5", "6");
        return unit[index];
    }  
 
    function plusAndMinusButtonClickedAutoCalculate() {
        //$('#field-bath').val(bathRoomUnit(bed)); 
        var cleanType = $('#cleantype').val().toLowerCase();  
        var firstclean = $.fn.calculateFirstCleanByKeepItCleanGetCleanMoveInOut(cleanType); 
        $('#visit1').text( '$' + Math.round(firstclean));
        $('#pvisit1').text( '$' + Math.round(firstclean)); 

        /**
        * Repeat
        */  
        var repeatText = $('#repeat').val().toLowerCase();  
        var weeklyVal = $.fn.getWeeklyPrice(repeatText);  
        $('#visit2').text('$' +weeklyVal);
        $('#pvisit2').text('$' + weeklyVal);  
    } 
 

});
