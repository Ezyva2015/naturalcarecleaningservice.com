/*====================================
 Free To Use For Personal And Commercial Usage
Author: http://binarytheme.com
 License: Open source - MIT
 Please visit http://opensource.org/licenses/MIT for more Full Deatils of license.
 Share Us if You Like our work 
 Enjoy Our Codes For Free always.
======================================*/
//horizontal wizrd code section
$(function () {
    $("#wizard").steps({
    	onStepChanging: function(e,i,j){
    		
    		$("#step1").validate().settings.ignore=':disabled,:hidden'
			return $("#step1").valid()||j<i

    	},

    });
});
//vertical wizrd  code section
$(function () {
    $("#wizardV").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    });
});