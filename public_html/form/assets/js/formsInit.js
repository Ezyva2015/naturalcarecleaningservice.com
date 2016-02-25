var _AddOns = {}
				
function formInit() {    
	"use strict";
	/*wizard scripts start*/

			$('a.btn').click(function(e)
			{
			    // Special stuff to do when this link is clicked...
			
			    // Cancel the default action
			    e.preventDefault();
			});
			$(window).resize(function() {
    			$('#content').height($(window).height() - 46);
			});

				$(window).trigger('resize');
			$('#subbed').click(function() {
				if (parseInt($('#bed').val())>1){
					$('#bed option[value="'+(parseInt($('#bed').val())-1)+'"]').prop('selected',true)
					$('#bed').change();
				}
			})
			$('#addbed').click(function() {
				if (parseInt($('#bed').val())<6){
					$('#bed option[value="'+(parseInt($('#bed').val())+1)+'"]').prop('selected',true)
					$('#bed').change();
				}
			})
			$('#subbath').click(function() {
				if (parseInt($('#bath').val())>1){
					$('#bath option[value="'+(parseInt($('#bath').val())-1)+'"]').prop('selected',true)
					$('#bath').change();
				}
			})
			$('#addbath').click(function() {
				if (parseInt($('#bath').val())<6){
					$('#bath option[value="'+(parseInt($('#bath').val())+1)+'"]').prop('selected',true)
					$('#bath').change();
				}
			})
		
	
			$(document).ready(function() {
				$('#time').change(function() {
					$(this).css("color", "black")
				})
				$("#time option:not(:first-child)").css("color", "black")
			})
		
			$(document).ready(function() {
				$('#refer').change(function() {
					$(this).css("color", "black")
				})
				$("#refer option:not(:first-child)").css("color", "black")
			})
			
			$('.access').click(function(){
				$('#access').val($(this).text())
				$('.access').css({
					color: '#FF8604',
 					'background-color': '#fff',
  					'border-color': '#FF8604',
				})
				$(this).css({
					color: '#ffffff !important', 
					'background-color': '#FF8604 !important',
					'border-color': '#b3b3b3 !important',
				})
			})
			$('.cleantype').click(function(){
				if(($(this).text() == 'Keep It Clean' && $('#repeat').val() != 'One Time') || $(this).text() != 'Keep It Clean')
				{
					$('#cleantype').val($(this).text())
					$('#cleantype').text($(this).text())
					$('.cleantype').css({
						color: '#FF8604',
 						'background-color': '#fff',
  						'border-color': '#FF8604',
					})
					$(this).css({
						color: '#ffffff !important', 
						'background-color': '#FF8604 !important',
						'border-color': '#b3b3b3 !important',
					})
				}
			})
			$('.pets').click(function(){
				$('#pets').val($(this).text())
				if($(this).hasClass('selected')){
					$('#pets').val('');
					$(this).removeClass('selected').addClass('unselected');
				}
				else {
				$('.pets').removeClass('selected').removeClass('unselected');
				$(this).addClass('selected');
				}
			})
			$('.repeat').click(function(){
				$('#repeat').val($(this).text())
				$('#repeat').text($(this).text())
				$('.repeat').css({
					color: '#FF8604',
 					'background-color': '#fff',
  					'border-color': '#FF8604',
				})
				$(this).css({
					color: '#ffffff !important', 
					'background-color': '#FF8604 !important',
					'border-color': '#b3b3b3 !important',
				})
				$('#recur').text($(this).text())
			})
			$('.daytime').click(function(){
				$('#daytime').val($(this).text())
				$('#daytime').text($(this).text())
				$('.daytime').css({
					color: '#333333',
 					'background-color': '#fff',
  					'border-color': '#cccccc',
				})
				$(this).css({
					color: '#ffffff !important', 
					'background-color': '#FF8604 !important',
					'border-color': '#b3b3b3 !important',
				})
				$('#schedule').text($(this).text())
				$('#schedule2').text($(this).text())
				$('#pschedule2').text($(this).text())
			})
			
			/*$('#datepicker').change(function(){
				$('#date2').text($(this).val())
				$('#pdate2').text($(this).val())
			})*/

				

			
			$('#fridge').click(function(e){
				e.preventDefault();
				if($(this).val()==(0)){
					_AddOns.Fridge = 'Fridge'
					$(this).val('Fridge')
					$(this).attr('src', 'assets/img/333.png')
					$('#t-fridge').show()
					$(this).off('mouseenter mouseleave');
				}
				else{
					delete _AddOns.Fridge
					$(this).val('')
					$(this).attr('src', 'assets/img/33.png')
					$('#t-fridge').hide()
					$(this).hover(
						function() {$(this).attr("src","assets/img/3.png");},
			        	function() {$(this).attr("src","assets/img/33.png");
					})
				}
			})
			$(document).ready(function(){
			    $("#fridge").hover(
			        function() {$(this).attr("src","assets/img/3.png");},
			        function() {$(this).attr("src","assets/img/33.png");
			    });
			});
			$('#stove').click(function(e){
				e.preventDefault();
				if($(this).val()==(0)){
					_AddOns.Stove = 'Stove'
					$(this).val('Stove')
					$(this).attr('src', 'assets/img/222.png')
					$('#t-stove').show()
					$(this).off('mouseenter mouseleave');
				}
				else{
					delete _AddOns.Stove
					$(this).val('')
					$(this).attr('src', 'assets/img/22.png')
					$('#t-stove').hide()
					$(this).hover(
						function() {$(this).attr("src","assets/img/2.png");},
			        	function() {$(this).attr("src","assets/img/22.png");
					})
				}
			})
			$(document).ready(function(){
			    $("#stove").hover(
			        function() {$(this).attr("src","assets/img/2.png");},
			        function() {$(this).attr("src","assets/img/22.png");
			    });
			});

			$('#window').click(function(e){
				e.preventDefault();
				if($(this).val()==(0)){
					_AddOns.Windows = 'Windows'
					$(this).val('Windows')
					$(this).attr('src', 'assets/img/444.png')
					$('#t-window').show()
					$(this).off('mouseenter mouseleave');
				}
				else{
					delete _AddOns.Windows
					$(this).val('')
					$(this).attr('src', 'assets/img/44.png')
					$('#t-window').hide()
					$(this).on()
					$(this).hover(
						function() {$(this).attr("src","assets/img/4.png");},
			        	function() {$(this).attr("src","assets/img/44.png");
					})
				}
			})
			$(document).ready(function(){
			    $("#window").hover(
			        function() {$(this).attr("src","assets/img/4.png");},
			        function() {$(this).attr("src","assets/img/44.png");
			    });
			});
			$('#wall').click(function(e){
				e.preventDefault();
				if($(this).val()==(0)){
					_AddOns.BedSteam = 'Bed Steam'
					$(this).val('Bed Steam')
					$(this).attr('src', 'assets/img/555.png')
					$('#t-wall').show()
					$(this).off('mouseenter mouseleave');
				}
				else{
					delete _AddOns.BedSteam
					$(this).val('')
					$(this).attr('src', 'assets/img/55.png')
					$('#t-wall').hide()
					$(this).hover(
						function() {$(this).attr("src","assets/img/5.png");},
			        	function() {$(this).attr("src","assets/img/55.png");
					})
				}
			})
			$(document).ready(function(){
			    $("#wall").hover(
			        function() {$(this).attr("src","assets/img/5.png");},
			        function() {$(this).attr("src","assets/img/55.png");
			    });
			});
			$('#laundry').click(function(e){
				e.preventDefault();
				if($(this).val()==(0)){
					$(this).val('Laundry')
					$(this).attr('src', 'assets/img/111.png')
					$('#t-laundry').show()
					$(this).off('mouseenter mouseleave');
				}
				else{
					$(this).val('')
					$(this).attr('src', 'assets/img/11.png')
					$('#t-laundry').hide()
					$(this).hover(
			        function() {$(this).attr("src","assets/img/1.png");},
			        function() {$(this).attr("src","assets/img/11.png");
			  	  })
				}
			})
			$(document).ready(function(){
			    $("#laundry").hover(
			        function() {$(this).attr("src","assets/img/1.png");},
			        function() {$(this).attr("src","assets/img/11.png");
			    })
			})

			$('.content').removeClass('clearfix')
			
			$('form').submit(function() {
				$.each(_AddOns, function(index,value) {
					$('#addon').val($('#addon').val() + ',' + value) 
				})
			})
			
			
    /*----------- END validate CODE -------------------------*/
		/*end wizard code*/


    $('.with-tooltip').tooltip({
        selector: ".input-tooltip"
    });

    /*----------- BEGIN validVal CODE -------------------------*/
    $('#validVal').validVal();
    /*----------- END validVal CODE -------------------------*/

    

    /*----------- BEGIN datepicker CODE -------------------------
    $('#dp1').datepicker({
        format: 'mm-dd-yyyy'
    });
    
	var nowTemp = new Date();
	

    $('#dp2').datepicker({ 
    	autoclose: true,
    	 });
    $('#dp3').datepicker({ defaultDate: new Date() });
    $('#dp3').datepicker({ defaultDate: new Date() });
    $('#dpYears').datepicker({ defaultDate: new Date() });
    $('#dpMonths').datepicker({ defaultDate: new Date() });

	
    var startDate = new Date(2012, 1, 20);
    var endDate = new Date(2012, 1, 25);
    $('#dp4').datepicker()
            .on('changeDate', function (ev) {
                if (ev.date.valueOf() > endDate.valueOf()) {
                    $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                } else {
                    $('#alert').hide();
                    startDate = new Date(ev.date);
                    $('#startDate').text($('#dp4').data('date'));
                }
                $('#dp4').datepicker('hide');
            });
    $('#dp5').datepicker()
            .on('changeDate', function (ev) {
                if (ev.date.valueOf() < startDate.valueOf()) {
                    $('#alert').show().find('strong').text('The end date can not be less then the start date');
                } else {
                    $('#alert').hide();
                    endDate = new Date(ev.date);
                    $('#endDate').text($('#dp5').data('date'));
                }
                $('#dp5').datepicker('hide');
            });
            $('#date').text($('#dp2').val());
    ----------- END datepicker CODE -------------------------*/

}

