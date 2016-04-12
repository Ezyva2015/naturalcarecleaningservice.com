  $(document).ready(function() {  

	    $.fn.selectedButtonCircle = function(selectedId, startTotalId, endTotalId) { 
			for (var i = startTotalId; i <= endTotalId; i++) { 
				if(selectedId == i) {
					//Selected
					$("#circle-design-"+i).removeClass('circle-design-non-clicked'); 
 					$("#circle-design-"+i).addClass('cicle-design-clicked');  
				} else { 
					// Not selected 
					$("#circle-design-"+i).removeClass('cicle-design-clicked'); 
					$("#circle-design-"+i).addClass('circle-design-non-clicked'); 
				}
			};
	    }  
 
	    $.fn.clickAndClick = function(selectedId) {
			if($("#circle-design-"+selectedId).hasClass("cicle-design-clicked")) { 
				// remove class "cicle-design-clicked"	
				// add add "circle-design-non-clicked"   
				$("#circle-design-"+selectedId).removeClass("cicle-design-clicked");
				$("#circle-design-"+selectedId).addClass("circle-design-non-clicked"); 
			} else { 
				// remove "circle-design-non-clicked"	 
				// add class "cicle-design-clicked"	 
				$("#circle-design-"+selectedId).removeClass("circle-design-non-clicked");
				$("#circle-design-"+selectedId).addClass("cicle-design-clicked"); 
			}  
	    }

	    $.fn.styleDisplay = function (selectedId, displayStatus) {
	    	$(selectedId).css('display',displayStatus);
	    }
 	 
	    // Weekly design
 		$('#one-time').click(function(){  
 			$.fn.selectedButtonCircle(1,1,4);  
 			$.fn.styleDisplay('#keepCleanContainer','none');
 		});
 		$('#every-week').click(function(){  
 			 $.fn.selectedButtonCircle(2,1,4);  
 			 $.fn.styleDisplay('#keepCleanContainer','block');
 		 }); 
 		$('#every-2-weeks').click(function(){ 
 			$.fn.selectedButtonCircle(3,1,4);
 			$.fn.styleDisplay('#keepCleanContainer','block');
 		});
 		$('#every-4-weeks').click(function(){ 
 			$.fn.selectedButtonCircle(4,1,4);
 			$.fn.styleDisplay('#keepCleanContainer','block');
 			
 		});   

 		// Level of first clean 
		$('#keep').click(function(){  
 			$.fn.selectedButtonCircle(5,5,8);   
 		});
 		$('#clean').click(function(){  
 			$.fn.selectedButtonCircle(6,5,8);   
 		});
 		$('#deep').click(function(){  
 			$.fn.selectedButtonCircle(7,5,8);   
 		});
 		$('#move').click(function(){  
 			$.fn.selectedButtonCircle(8,5,8);   
 		});
 
 		//add ons for first clean 
		$('#window').click(function() {    
 			  $.fn.clickAndClick(9);
 		});  
		$('#wall').click(function(){   
			$.fn.clickAndClick(10);
 		}); 
		$('#fridge').click(function(){   
 			$.fn.clickAndClick(11);
 		}); 
		$('#stove').click(function(){   
			$.fn.clickAndClick(13);
 		});  
	 
	});