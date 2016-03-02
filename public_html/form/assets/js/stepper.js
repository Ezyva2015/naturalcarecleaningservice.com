

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

        calculateFirstCleanByKeepItCleanGetCleanMoveInOut();
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

        calculateFirstCleanByKeepItCleanGetCleanMoveInOut();
    });


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


    });

}

function bathRoomUnit(index) {
    var unit = new Array("", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5.5", "1.5", "6");
    return unit[index];
}


function calculateFirstCleanByKeepItCleanGetCleanMoveInOut()
{
    var tabClass = '.cleantype';
    var firstCleanId = '#visit1';
    var totalBathRooms = parseFloat($('#bath').val());
    var totalBedRooms = parseInt($('#bed').val());
    getclean  = parseFloat("1.25");
    deepclean = parseFloat("1.5");
    moveinout = parseFloat("1.75");
    var SQFTInput = parseInt($('#footage').val());
    var totalBasePrice = getTotalBasePrice(calculate_sqrtFt(SQFTInput), totalBedRooms, totalBathRooms);

    if ($(tabClass).text() == 'Keep It Clean')
    {
        firstclean = 1;
    }
    else if ($(tabClass).text() == 'Get it Clean')
    {
        firstclean = getItCleanFunc(totalBasePrice, getclean);
    }
    else if ($(tabClass).text() == 'Deep Clean')
    {
        firstclean = deepCleanFunc(totalBasePrice, deepclean);
    }
    else if ($(tabClass).text() == 'Move In/Out')
    {
        firstclean = moveInOutFunc(totalBasePrice, moveinout);
    }

    firstclean = Math.round(firstclean);

    console.log( " SQFTInput " + SQFTInput + " totalBasePrice " + totalBasePrice + " firstclean " + firstclean + " total bath room " + totalBathRooms + " total bed rooms " + totalBedRooms );

    $(firstCleanId).text(firstclean);

}
function squareFootage() {
    var ret = isNaN(parseInt($('#footage').val())) ? 0 : parseInt($('#footage').val());
    return ret;
}

function getItCleanFunc(totalBasePrice, getITcLean)
{
    return parseFloat(totalBasePrice * getITcLean);
}

function deepCleanFunc(totalBasePrice, deepClean)
{
    return  parseFloat(totalBasePrice * deepClean);
}

function moveInOutFunc(totalBasePrice, moveInOut)
{
    return  parseFloat(totalBasePrice * moveInOut);
}
function getTotalBasePrice(totalSquareFootCalculation, totalBeds, totalBathRoom)
{

    var totalBedsPrice     = parseInt("6");
    var totalBathRoOmPrice = parseInt("14");
    var totalBaseValue     = parseInt("99");
    //totalSquareFootCalculation = M3;
    var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;

    return parseInt(totalBasePrice);
}

function calculate_sqrtFt(SQFTInput)
{
    var SQFTBase = 1000;
    var multiplier1 = 100;
    var multiplier2 = 3;
    var answer = 0;
    if(SQFTInput > SQFTBase) {
        answer = (SQFTInput - SQFTBase)/multiplier1*multiplier2;
    }
    return answer;
}

