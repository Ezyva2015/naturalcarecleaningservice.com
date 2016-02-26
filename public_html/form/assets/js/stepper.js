
var bed = 0;
var bath = 0;
var bedRoomPlural = 's';
var string = '';

/** */
$(document).ready(function(){
    $("#bed").val('1 bedroom');
});

/** */
var i = $("#bed");

/** */
i.TouchSpin({});
i.on("touchspin.on.startupspin", function () {


    if(bed < 6) {
        bed++;
        str = bed + ' bedroom';
    } else {
        str = bed + ' bedroom';
    }

    if(bed > 1) {
        str += bedRoomPlural;
    }

    $('#bed').val(str);
});
i.on("touchspin.on.startdownspin", function () {
    if(bed > 1 ) {
        bed--;
        str = bed + ' bedroom';
    } else {

        str = bed + ' bedroom';
    }

    if(bed > 1) {
        str += bedRoomPlural;
    }

    $('#bed').val(str);
});
