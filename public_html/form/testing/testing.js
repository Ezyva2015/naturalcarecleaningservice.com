/**
 * Created by JESUS on 2/25/2016.
 */


/**
 * beds = 2
 * bath = 2
 * sqft = 1000
 */





function getItCleanFunc(totalBasePrice, getITcLean)
{
    return totalBasePrice * getITcLean;
}

function deepCleanFunc(totalBasePrice, deepClean)
{
    return totalBasePrice * deepClean;
}
function moveInOutFunc(totalBasePrice, moveInOut)
{
    return totalBasePrice * moveInOut;
}

function getTotalBasePrice(totalSquareFootCalculation)
{
    var J7 = parseInt("2");
    var C3 = parseInt("6");
    var J8 = parseInt("2");
    var D3 = parseInt("14");
    var F3 = parseInt("99");
   //var M3 = parseInt("0");

    var totalBeds = J7;
    var totalBedsPrice = C3;
    var totalBathRoom = J8;
    var totalBathRoOmPrice = D3;
    var totalBaseValue = F3;
    //totalSquareFootCalculation = M3;
    var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;

    return totalBasePrice;
}

function calculate() {

    var getItClean = parseFloat("1.25");
    var deepClean = parseFloat("1.5");
    var moveInOut = parseFloat("1.75");

    var totalBasePrice = getTotalBasePrice(0);
    alert("totalBasePrice = " + totalBasePrice + " " + getItCleanFunc(totalBasePrice, getItClean) + " " + deepCleanFunc(totalBasePrice, deepClean) + " "  +  moveInOutFunc(totalBasePrice, moveInOut));

}