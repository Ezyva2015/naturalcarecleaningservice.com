function formValidation() {
	"use strict";
	/*----------- BEGIN validationEngine CODE -------------------------*/
	$('#popup-validation').validationEngine();
	/*----------- END validationEngine CODE -------------------------*/
	$('#continue').on('click', function() {
    $("#start").valid();
	})
	/*----------- BEGIN validate CODE -------------------------*/
	$('#start').validate({
		rules: {
			Address : {
				required : true,
			},
			PostalCode : {
				required : true,
			},
			
			Email : {
				required : true,
				email : true
			},
		},
		messages: {
			Address : {
				required : "Your address is required"
			},
			PostalCode : {
				required : "Your postal code is required"
			},
			Email : {
				required : "Email address is required",
				email : "Your email must be in the format: name@domain.com"
			},
			
		},
		errorClass : 'has-error',
		errorElement : 'span',
		highlight : function(element, errorClass, validClass) {
			$(element).removeClass('has-success').addClass('has-error');
			
		},

		unhighlight : function(element, errorClass, validClass) {
			$(element).removeClass('has-error').addClass('has-success');
			
		},
		
	
	})
	
	$('#step1').validate({
		ignore: [],
		rules : {
			_Frequency : {
				required: true,
			},
			_InitialCleanType : {
				required : true,
			},
			_ArrivalWindow : {
				required : true,
			},
			StreetAddress1 : {
				required : true,
			},
			City : {
				required : true,
			},
			State : {
				required : true,
			},
			PostalCode : {
				required : true,
			},
			FirstName : {
				required : true,
			},
			LastName : {
				required : true,
			},
			_SelectYourDate : {
				required: true,
			},
			
			
			
			Email : {
				required : true,
				email : true
			},
			Phone1: {
				required : true,
			},
			credit_card : {
				required : true,
			},
			cvc : {
				required : true,
			},
			expmonth : {
				required : true,
			},
			expyear : {
				required : true,
			},

		},
		messages : {
			_Frequency : {
				required: "Please select the frequency of your cleaning"
			},
			_SelectYourDate : {
				required: "Please select a date for your cleaning"
			},
			_InitialCleanType: {
				required: "Please select the type of cleaning you desire"
			},
			_ArrivalWindow: {
				required: "Please select the time of day for us to clean"
			},
			StreetAddress1: {
				required: "Your street address is required"
			},
			Phone1: {
				required: "Your phone number is required"
			},
			City: {
				required: "Your city is required"
			},
			State: {
				required: "Your state is required"
			},
			PostalCode: {
				required: "Your postal code is required"
			},
			cvc: {
				required: "Your cvc code is required"
			},
			expmonth: {
				required: "Your expiration month is required"
			},
			expyear: {
				required: "Your expiration year is required"
			},
			FirstName : {
				required : "Your first name is required"
			},
			LastName : {
				required : "Your last name is required"
			},
			
			Email : {
				required : "Your email address is required",
				email : "Your email must be in the format: name@domain.com"
			},
			credit_card : {
				required : "Your credit card number is required"
			},
		},
		errorClass : 'has-error',
		errorElement : 'span',
		highlight : function(element, errorClass, validClass) {
			$(element).removeClass('has-success').addClass('has-error');
		},
		unhighlight : function(element, errorClass, validClass) {
			$(element).removeClass('has-error').addClass('has-success');
		}
	})
};
