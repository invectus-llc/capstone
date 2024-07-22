import './bootstrap';
import 'flowbite';

function calendar(events){
    var calendar = new $('#calendar').fullCalendar({
        defaultView: 'month',
        timeZone: 'local',
        selectable: true,
        events: events,
        selectHelper: true,
        select: function(start, end) {
				$('#startDate').val(moment(start).format('YYYY-MM-DD'));
				$('#endDate').val(moment(end).format('YYYY-MM-DD'));
				$('#add-event').click()
			},
    });
    return calendar;
};


$(document).ready(function() {
	display_events();
}); //end document.ready block

function display_events() {
	var events = new Array();
    var data = new $.ajax({
        url: '/api/events/',
        method:'get',
        dataType: 'json',
        success: function (response) {
            var result=response;
            $.each(result, function (i, item) {
                events.push({
                    event_id: result[i].id,
                    title: result[i].eventName,
                    start: result[i].eventStart,
                    end: result[i].eventEnd,
                    rendering:'background',
                    color: 'red'
                });
            })
            calendar(events);
        },//end success block
        error: function (xhr, status) {
        alert(response.msg);
        }
	});
    return data//end ajax block
}

$('#eventSubmit').on('click', function () {
    var eventName = $('#eventName').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    var clientId = 1

    $.ajax({
        url:'/api/events',
        method:'post',
        dataType:'json',
        data: {
            eventName: eventName,
            startDate: startDate,
            endDate: endDate,
            clientId: clientId
        },
        success: function(response){
            if (response){
                $('#eventName').val('')
                $('#startDate').val('')
                $('#endDate').val('')
                $('#closeModal').click()
            }
            else{
                alert(response.status)
            }
        }
    })

    display_events()
})
