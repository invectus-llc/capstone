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
    $("#updModal").hide()
    $("#initialdate1").hide()
    $("#initialdate2").hide()

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
                            color = 'red'
                    }
                    else{
                        switch (response[i].status_id) {
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
                //console.log(response)
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
                            <button id="${response[i].id}-e" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Edit
                            </button>
                            <button id="${response[i].id}-r" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Receipt
                            </button>
                        </td>
                        </tr>`;
                        $('#tbody').append(tbrow);
                    }
                    if(response[i].status_id == 1){
                        $("#" + response[i].id +"-e").hide()
                        $("#" + response[i].id +"-r").show()
                    }else{
                        $("#" + response[i].id +"-e").show()
                        $("#" + response[i].id +"-r").hide()
                    }
                    $(document).on('click','#' + response[i].id + '-e', function(){
                        let date1 = new Date(response[i].eventStart)
                        let date2 = new Date(response[i].eventEnd)
                        let Difference_In_Time = date2.getTime() - date1.getTime()
                        let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24));

                        let number = Number(Math.round((Difference_In_Days* 80000) * 100) / 100)
                        const options = {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                          };
                        const formatted = Number(number).toLocaleString('en', options);

                        $("#eventDays").text("x" + Difference_In_Days)
                        $("#eventDays").val(Difference_In_Days)
                        $("#total").text('PHP ' + formatted)
                        $("#total").val(number)

                        $("#updModal").click()
                        $("#modaltitle").text('Status: ' + response[i].status.toUpperCase())
                        $("#modaltitle").val(response[i].id)

                        $("#updEventName").val(response[i].eventName)
                        $("#updStartDate").val(response[i].eventStart)
                        $("#updEndDate").val(response[i].eventEnd)

                        $("#initialdate1").val(response[i].eventStart)
                        $("#initialdate2").val(response[i].eventEnd)
                        $("#updEventSubmit").val(response[i].id)
                        $("#paybtn").val(response[i].transaction_id)

                        if(response[i].statusId == 1){
                            $("#paybtn").hide()
                            $("#updEventSubmit").hide()
                            $("#updStartDate").attr('disabled', true)
                            $("#updEndDate").attr('disabled', true)
                            $("#updEventName").attr('disabled', true)
                        }else{
                            $("#paybtn").show()
                            $("#updEventSubmit").show()
                            $("#updStartDate").attr('disabled', false)
                            $("#updEndDate").attr('disabled', false)
                            $("#updEventName").attr('disabled', false)
                        }
                    })
                    $(document).on('click', '#' + response[i].id + '-r', function(){
                        //console.log('button click')
                        $("#receipt").click()
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
        let initialdate1 = $("#initialdate1").val()
        let initialdate2 = $("#initialdate2").val()
        $.ajax({
            url: '/api/events',
            method: 'patch',
            dataType: 'json',
            data:{
                id: id,
                eventName: eventName,
                eventStart: eventStart,
                eventEnd: eventEnd,
                initialdate1: initialdate1,
                initialdate2: initialdate2
            },
            success: function(response){
                //console.log(response)
                alert(response)
                $("#updCloseModal").click()
                $("#events").click()
            }
        })
    })
    $("#paybtn").on('click', function(){
        let transId = $("#paybtn").val()
        let eventName = $("#updEventName").val()
        let eventStart = $("#updStartDate").val()
        let eventEnd = $("#updEndDate").val()
        let eventDays = $("#eventDays").val()
        let total = $("#total").val()
        //console.log(total)
        $.ajax({
            url: '/api/pay',
            method: 'post',
            dataType: 'json',
            data:{
                transId: transId,
                uid: uid,
                eventName: eventName,
                eventStart: eventStart,
                eventEnd: eventEnd,
                total: total,
                eventDays: eventDays

            },
            success: function(response){
                var url = response
                //console.log(response)
                window.location.assign(url.attributes.checkout_url)
            }
        })
    })
    $("#updStartDate, #updEndDate").on('change', function(){
        //console.log($("#total").val())
        let date1 = new Date($("#updStartDate").val())
        let date2 = new Date($("#updEndDate").val())
        let Difference_In_Time = date2.getTime() - date1.getTime()
        let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24));

        let number = Number(Math.round((Difference_In_Days* 80000) * 100) / 100)
        const options = {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
            };
        const formatted = Number(number).toLocaleString('en', options);

        $("#eventDays").text("x" + Difference_In_Days)
        $("#eventDays").val(Difference_In_Days)
        $("#total").text('PHP ' + formatted)
        $("#total").val(number)
    })
    $("#receipt").on('click', function(){
        $("#pTitle")
        $("#pName")
        $("#pEmail")
        $("#pDescrip")
        $("#pCost")
        $("#pTotal")
    })
    $("#print").on('click',function(){
        $("#printArea").printThis({})

    })
}); //end document.ready block
//print function
//delete event
//profile
//notify
//admin side
