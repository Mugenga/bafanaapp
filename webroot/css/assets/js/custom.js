$(document).ready(function() {
    
    // CounterUp Plugin
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
	
	/* 
	----------------------------------
	INITIALIZE PLUGINS 
	---------------------------------- */
	
	if($('#example').length ) {
		$('#example').dataTable();
	}
	
	if($('.date-picker').length ) {
		$('.date-picker').datepicker({
			orientation: "top auto",
			autoclose: true
		});
	}
	
	if($('#timepicker1').length ) {
 		$('#timepicker1').timepicker();
	}
	
	/*
	----------------------------------------------------------------
	MAIN MENU HOVER TOGGLER  
	---------------------------------------------------------------- */
	$('.main-navbar .navbar-left li').find("a").each(function(){
		if($(this).siblings(".dropdown-menu").length > 0){
			$(this).parent('li').addClass("drop-parent");
			$(this).append("<span class='mmenu-indicator'></span>");
		}
	});	
	
	$('.drop-parent').on('mouseenter mouseleave click tap', function() {
		$(this).toggleClass("open");
	});
	
	/*
	----------------------------------------------------------------
	FULL CALENDAR
	---------------------------------------------------------------- */
	if($('#calendar').length ) {	
		var drag =  function() {
			$('.calendar-event').each(function() {
	
			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});
	
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 1111999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
		};
		
		var removeEvent =  function() {
			$('.remove-calendar-event').click(function() {
			$(this).closest('.calendar-event').fadeOut();
			return false;
		});
		};
		
		$(".add-event").keypress(function (e) {
			if ((e.which == 13)&&(!$(this).val().length == 0)) {
				$('<div class="calendar-event"><p>' + $(this).val() + '</p><a href="javascript:void(0);" class="remove-calendar-event"><i class="fa fa-remove"></i></a></div>').insertBefore(".add-event");
				$(this).val('');
			} else if(e.which == 13) {
				alert('Please enter event name');
			}
			drag();
			removeEvent();
		});
		
		
		drag();
		removeEvent();
		
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var year = date.getFullYear();
		
		$('#calendar').fullCalendar({
		   
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: true,
				droppable: true, // this allows things to be dropped onto the calendar
				eventLimit: true, // allow "more" link when too many events
				events: [
					{
						title: 'Nigeria vs Ghana',
						start: new Date(year, month, day-20)
					},
					{
						title: 'Kenya vs Cape Verde',
						start: new Date(year, month, day-20)
					},
					{
						title: 'France vs Russia',
						start: new Date(year, month, day-20)
					},
					{
						title: 'Rwanda vs Zambia',
						start: new Date(year, month, day-18)
					},					
					{
						title: 'Uganda vs Burkina Faso',
						start: new Date(year, month, day-15)
					},
					{
						id: 999,
						title: 'KCC vs Simba',
						start: new Date(year, month, day)
					},
					{
						id: 999,
						title: 'Arsenal vs Crystal Palace',
						start: new Date(year, month, day+7)
					},
					{
						title: 'Chad vs Senegal',
						start: new Date(year, month, day+3),
						end: new Date(year, month, day+6)
					},
					{
						title: 'Djubouti vs Cameroon',
						start: new Date(year, month, day+5)
					},
					{
						title: 'Congo vs Morocco',
						start: new Date(year, month, day+7)
					},
					{
						title: 'Nigeria vs Tanzania',
						start: new Date(year, month, day+10)
					},
					{
						title: 'Brazil vs Korea',
						start: new Date(year, month, day+10)
					},
					{
						title: 'Mexico vs Argentina',
						start: new Date(year, month, day+13)
					},
					{
						title: 'Peru vs Turkey',
						start: new Date(year, month, day+15)
					},
					{
						title: 'Iran vs Saudi Arabia',
						url: 'http://google.com/',
						start: new Date(year, month, day+18)
					}
				],
				displayEventTime: false
			});	
	}
	
	/*
	----------------------------------------------------------------
	LINE GRAPH ON INDEX PAGE
	---------------------------------------------------------------- */	
	if($('#chart1').length ) {	
		var ctx1 = document.getElementById("chart1").getContext("2d");
		var data1 = {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [
				{
					label: "My First dataset",
					fillColor: "rgba(0,197,220,0.4)",
					strokeColor: "rgba(0,197,220,1)",
					pointColor: "rgba(0,197,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(0,197,220,1)",
					data: [65, 59, 80, 81, 56, 55, 40]
				},
				{
					label: "My Second dataset",
					fillColor: "rgba(255,188,2,0.4)",
					strokeColor: "rgba(255,188,2,1)",
					pointColor: "rgba(255,188,2,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(255,188,2,1)",
					data: [28, 48, 40, 19, 86, 27, 90]
				}
			]
		};
		
		var chart1 = new Chart(ctx1).Line(data1, {
			scaleShowGridLines : true,
			scaleGridLineColor : "rgba(0,0,0,.05)",
			scaleGridLineWidth : 1,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			bezierCurve : true,
			bezierCurveTension : 0.4,
			pointDot : true,
			pointDotRadius : 4,
			pointDotStrokeWidth : 1,
			pointHitDetectionRadius : 20,
			datasetStroke : true,
			datasetStrokeWidth : 2,
			datasetFill : true,
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			responsive: true
		});
	}
	
	$(".live-tile").liveTile();
    
});