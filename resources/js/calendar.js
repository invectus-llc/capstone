import './bootstrap';
import 'flowbite';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import jQuery from 'jquery';
window.$ = jQuery


$(document).ready(function() {
	display_events();
    $('#table').hide()

    const queryString = new URLSearchParams(window.location.search);
    const uid = queryString.get('user')

    function calendar(events){
        let calendarEl = document.getElementById('calendar');
        let calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        events:events,
        selectable:true,
        selectOverlap:false,
        selectHelper: true,
        select: function(info) {
                $('#startDate').val(moment(info.startStr).format('YYYY-MM-DD'));
                $('#endDate').val(moment(info.endStr).format('YYYY-MM-DD'));
                $('#add-event').click()
            },
        headerToolbar: {
            right: 'prev,next today'
        }
        });
        return calendar.render();
    };

    function display_events() {
        var events = new Array();
        var color = new String;
        var data = new $.ajax({
            url: '/api/events',
            method:'get',
            dataType: 'json',
            success: function (response) {
                //console.log(response)
                $.each(response, function (i) {
                    if(response[i].clientId != uid){
                        if(response[i].statusId == 2){
                            color = 'white'
                        }else{
                            color = 'red'
                        }
                    }
                    else{
                        switch (response[i].statusId) {
                            case 1:
                                color = 'green'
                                break;
                            case 2:
                                color = 'yellow'
                                break;

                            default:
                                break;
                        }
                    }
                        events.push({
                        event_id: response[i].id,
                        start: response[i].eventStart,
                        end: response[i].eventEnd,
                        display:'background',
                        color: color
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
        var clientId = uid;
        var status = 2;

        $.ajax({
            url:'/api/events',
            method:'post',
            dataType:'json',
            data: {
                eventName: eventName,
                startDate: startDate,
                endDate: endDate,
                clientId: clientId,
                status: status
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
    $('#dashboard').on('click',function(){
        $('#calendar').show()
        $("#table").hide()
        display_events()
    })
    $('#events').on('click', function(){
        $("#tbody tr").remove()
        $('#calendar').hide()
        $("#table").show()
        $.ajax({
            url: '/api/events',
            method: 'get',
            dataType: 'json',
            success: function(response){
                // data = response
                $.each(response, function(i){
                    if(response[i].clientId == uid){
                        var tbrow = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${response[i].eventName.toUpperCase()}
                        </th>
                        <td class="px-6 py-4">
                            ${response[i].eventStart}
                        </td>
                        <td class="px-6 py-4">
                            ${response[i].eventEnd}
                        </td>
                        <td class="px-6 py-4">
                            ${response[i].status.toUpperCase()}
                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            <button id="${response[i].id}" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Edit
                            </button>
                        </td>
                        </tr>`;
                        $('#tbody').append(tbrow);
                    }
                    $('body').on('click','#' + response[i].id, function(){
                        let date1 = new Date(response[i].eventStart)
                        let date2 = new Date(response[i].eventEnd)
                        let Difference_In_Time = date2.getTime() - date1.getTime()
                        let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24));
                        let number = Number(Math.round((Difference_In_Days* 80000) * 100) / 100).toFixed(2)
                        console.log(number.toLocaleString('en'))
                        //number to decimal format
                        $("#updModal").click()
                        $("#modaltitle").text('Event Status: ' + response[i].status.toUpperCase())
                        $("#modaltitle").val(response[i].id)
                        $("#updEventName").val(response[i].eventName)
                        $("#updStartDate").val(response[i].eventStart)
                        $("#updEndDate").val(response[i].eventEnd)
                        $("#updEventSubmit").val(response[i].id)
                        $("#paybtn").val(response[i].id)
                        if(response[i].statusId == 1){
                            $("#paybtn").hide()
                        }else{
                            $("#paybtn").show()
                        }
                    })

                })

            }
        })
    })
    $("#updEventSubmit").on('click', function(){
        //console.log($("#updEventSubmit").val())
        let id = $("#updEventSubmit").val()
        let eventName = $("#updEventName").val()
        let eventStart = $("#updStartDate").val()
        let eventEnd = $("#updEndDate").val()

        $.ajax({
            url: '/api/events',
            method: 'patch',
            dataType: 'json',
            data:{
                id: id,
                eventName: eventName,
                eventStart: eventStart,
                eventEnd: eventEnd
            },
            success: function(response){
                console.log(response)
                $("#updCloseModal").click()
                $("#events").click()
            }
        })
    })
    $("#paybtn").on('click', function(){
        var eventId = $("#paybtn").val()
        console.log(eventId)
        $.ajax({
            url: '/api/pay',
            method: 'post',
            dataType: 'json',
            data:{
                eventId: eventId,
                uid: uid,
            },
            success: function(response){
                var url = response
                //console.log(response)
                window.location.assign(url.attributes.checkout_url)
            }
        })
    })
}); //end document.ready block
