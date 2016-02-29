

bed('#bed');
bath('#bath');



function bed(id) {
    var bed = 1;
    var bath = 1;
    var bedRoomPlural = 's';
    var string = '';
    var maxValue = 6;
    var minValue = 1;
    var itemName = 'bedroom';
    var initValue = '1 bedroom';
    //var fieldCurrentValue = $(id).val();
    //id = '#bed';

    /** */
    $(document).ready(function(){
        $(id).val(initValue);
    });

    /** */
    var i = $(id);

    /** */
    i.TouchSpin({});
    i.on("touchspin.on.startupspin", function () {


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
        //$('#bed-room-stepper').val(str);
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
        //$('#bed-room-stepper').val(str);
    });

    //i.on("touchspin.on.stopspin", function () {
    //
    //    console.log("bed " + fieldCurrentValue + "max value " + maxValue);
    //    if(fieldCurrentValue > maxValue) {
    //        alert("max value");
    //        $(id).val(initValue);
    //    }
    //});
}
function bath(id) {
    var bed = 1;
    var bath = 1;
    var bedRoomPlural = 's';
    var string = '';
    var maxValue = 11;
    var minValue = 1;
    var itemName = 'bathroom';
    var initValue = '1 bathroom';
    //id = '#bed';

    /** */
    $(document).ready(function(){
        $(id).val(initValue);
    });

    /** */
    var i = $(id);

    /** */
    i.TouchSpin({});
    i.on("touchspin.on.startupspin", function () {


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
        //$('#bed-room-stepper').val(str);
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
        //$('#bed-room-stepper').val(str);
    });
    //
    //i.on("touchspin.on.stopspin", function () {
    //    if(bed > maxValue) {
    //
    //        alert("max value");
    //        $(id).val(initValue);
    //
    //
    //    }
    //});

    calculateFirstCleanByKeepItCleanGetCleanMoveInOut();

}


function bathRoomUnit(index) {

    var unit = new Array("", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5.5", "1.5", "6");

    return unit[index];
}
//
//<option value="1">1 bathroom</option>
//<option value="1.5">1.5 bathroom</option>
//
//<option value="2" selected>2 bathrooms</option>
//<option value="2.5">2.5 bathroom</option>
//
//<option value="3">3 bathrooms</option>
//<option value="3.5">3.5 bathroom</option>
//
//<option value="4">4 bathrooms</option>
//<option value="4.5">4.5 bathroom</option>
//
//<option value="5.5">5.5 bathrooms</option>
//<option value="1.5">1.5 bathroom</option>
//
//<option value="6">6 bathrooms</option>
//}