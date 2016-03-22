function initialize(){

    console.log("initialized : beds " +  memberInputBeds() + " bath " + memberInputBath() + " sqft " + memberInputSqft() );
    console.log("square foot calculation " + Math.round(calculateSqftCalc()));
    console.log("calculate Base Price " +  calculateBasePrice());
    console.log("calculate weekly " +  calculateWeekly());
    console.log("calculate 2 weeks " + calculateEvery2Weeks());
    console.log("calculate 4 weeks " + calculateEvery4Weeks());

    console.log("Get it clean " + calculateGetItClean());
    console.log("Deep clean " + calculateDeepClean());
    console.log("Keep Clean " +  calculateMoveInOut());

}

// User input
function memberInputBeds() { return convertNumber('1'); }

function memberInputBath() { return convertNumber('1'); }

function memberInputSqft() { return convertNumber('2000'); }

// Admin Input
function adminInputBeds() { return convertNumber('6.1'); }

function adminInputBath() { return convertNumber('14'); }

function adminInputSqftBase() { return convertNumber('1000'); }

function adminInputBaseValue() { return convertNumber('99'); }

function adminInputWeekly() { return convertNumber('0.65'); }

function adminInputEvery2Weeks() { return convertNumber('0.7'); }

function adminInputEvery4Weeks() { return convertNumber('0.75'); }

function adminInputGetItClean() { return convertNumber('1.4'); }

function adminInputDeepClean() { return convertNumber('1.5'); }

function adminInputMoveInOut() { return convertNumber('1.75'); }

// Calculation
function calculateSqftCalc() {
    var multiplier1 = 100;
    var multiplier2 = 3;
    var answer = 0;
    if(memberInputSqft() > adminInputSqftBase()) {
        answer = (memberInputSqft() - adminInputSqftBase())/multiplier1*multiplier2;
    }
    return answer;
}

function calculateBasePrice() {

    var totalBedsPrice     = adminInputBeds();
    var totalBathRoOmPrice = adminInputBath();
    var totalBaseValue     = adminInputBaseValue();
    var totalSquareFootCalculation = calculateSqftCalc();
    var totalBathRoom = memberInputBath();
    var totalBeds = memberInputBeds();
    //totalSquareFootCalculation = M3;
    var totalBasePrice = (totalBeds*totalBedsPrice) + (totalBathRoom*totalBathRoOmPrice) + totalBaseValue+totalSquareFootCalculation;
    return convertNumber(totalBasePrice);
}

function calculateWeekly() {
    return convertNumber(calculateBasePrice() * adminInputWeekly());
}

function calculateEvery2Weeks() {
    return  convertNumber(calculateBasePrice() * adminInputEvery2Weeks() );
}

function calculateEvery4Weeks() {
    return convertNumber(calculateBasePrice() * adminInputEvery4Weeks() );
}

function calculateGetItClean() {
    return convertNumber(calculateBasePrice() *  adminInputGetItClean());

}

function calculateDeepClean() {
    return convertNumber(calculateBasePrice() *  adminInputDeepClean());
}

function calculateMoveInOut() {
    return convertNumber(calculateBasePrice() *  adminInputMoveInOut());
}




//function calculateWeekly() { return basePrice() * weeklyPrice(); }
//
//function calculateEvery2weeks() { return basePrice() * every2WeeksPrice(); }
//
//function calculateEvery4weeks() { return basePrice() * every4WeeksPrice(); }
//

//function getItCleanFunc(totalBasePrice, getITcLean)
//{
//    return parseFloat(totalBasePrice * getITcLean);
//}
//
//function deepCleanFunc(totalBasePrice, deepClean)
//{
//    return  parseFloat(totalBasePrice * deepClean);
//}
//
//function moveInOutFunc(totalBasePrice, moveInOut)
//{
//    return  parseFloat(totalBasePrice * moveInOut);
//}








// Helper
function convertNumber(number) { return parseFloat(number) }