import './bootstrap';
import 'flowbite';

$(document).ready(function() {
	display_events();
}); //end document.ready block

function display_events() {
	var events = new Array();
$.ajax({
    url: '/api/events/',
    dataType: 'json',
    success: function (response) {
        console.log(response)

    var result=response;
    $.each(result, function (i, item) {
    	events.push({
            event_id: result[i].id,
            title: result[i].eventName,
            start: result[i].eventStart,
            end: result[i].eventEnd,
        });
    })
	var calendar = $('#calendar').fullCalendar({
	    defaultView: 'month',
		 timeZone: 'local',
        selectable: true,
		selectHelper: true,
        events: events,
		}); //end fullCalendar block
	  },//end success block
	  error: function (xhr, status) {
	  alert(response.msg);
	  }
	});//end ajax block
}
