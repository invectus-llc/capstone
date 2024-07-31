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
    $("#profile").hide()
    $("#transactionsList").hide()
    $("#updModal").hide()
    $("#initialdate1").hide()
    $("#initialdate2").hide()
    $("#receipt").hide()
    $("#delEvent").hide()

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
        $("#profile").hide()
        display_events()
    })
    $("#user").on('click', function(){
        $("#profileTable tr").remove()
        $("#profileInfo").click()
        $("#profile").show()
        $('#calendar').hide()
        $("#table").hide()
        $.ajax({
            url: '/api/users/' + uid,
            method: 'get',
            dataType: 'json',
            success: function(response){
                //console.log(response)
                $('#profileName').text(response[0].firstname + ' ' + response[0].lastname)
                $('#profileEmail').text(response[0].email)
                $("#profile_email").val(response[0].email)
                $("#profile_password").val(response[0].password)
                $("#profile_first_name").val(response[0].firstname)
                $("#profile_last_name").val(response[0].lastname)
                $("#profile_phone").val(response[0].contact_no)
            }
        })
        $.ajax({
            url: '/api/logs/' + uid,
            method: 'get',
            dataType: 'json',
            success: function(response){
                //console.log(response)
                $.each(response, function(i){
                    var trow = `<tr><td>
                    <p
                        class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                        ${response[i].description.toUpperCase()}
                        <span class="text-gray-500 text-xs">${moment(response[i].created_at).format('YYYY-MM-DD')}</span>
                    </p>
                    </td></tr>`
                    $("#profileTable").append(trow)
                })
            }
        })
    })
    $("#profileUpdate").on('click', function(){
        let email = $("#profile_email").val()
        let pw = $("#profile_password").val()
        let fname = $("#profile_first_name").val()
        let lname = $("#profile_last_name").val()
        let contact = $("#profile_phone").val()

        $.ajax({
            url: '/api/users/' + uid,
            method: 'patch',
            dataType: 'json',
            data: {
                email: email,
                pw: pw,
                fname: fname,
                lname: lname,
                contact: contact
            },
            success: function(){
                alert("Profile Updated!")
                $("#user").click()
            }
        })
    })
    $("#profileInfo").on('click', function(){
        $("#transactionsList").hide()
        $("#info").show()
    })
    $("#profileTrans").on('click', function(){
        $("#transactionsList").show()
        $("#info").hide()
    })
    $('#events').on('click', function(){
        $("#tbody tr").remove()
        $('#calendar').hide()
        $("#profile").hide()
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
                            <div class="flex flex-col justify-between">
                                <button id="${response[i].id}-e" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Edit
                                </button>
                                <button id="${response[i].id}-d" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button">
                                    Delete
                                </button>
                            </div>
                            <button id="${response[i].id}-r" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Receipt
                            </button>
                        </td>
                        </tr>`;
                        $('#tbody').append(tbrow);
                    }
                    if(response[i].status_id == 1){
                        $("#" + response[i].id +"-e").hide()
                        $("#" + response[i].id +"-d").hide()
                        $("#" + response[i].id +"-r").show()
                    }else{
                        $("#" + response[i].id +"-e").show()
                        $("#" + response[i].id +"-d").show()
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
                        $("#receipt").val(response[i].id)
                        $("#receipt").click()
                    })
                    $(document).on('click', '#' + response[i].id + '-d', function(){
                        //console.log('button click')
                        $("#delEventId").val(response[i].id)
                        $("#delEvent").click()
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
        if (eventStart >= eventEnd) {
            alert('Starting Date should NOT be less than Ending Date!')
        }
        else{
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
                    initialdate2: initialdate2,
                    clientId: uid
                },
                success: function(response){
                    //console.log(response)
                    alert(response)
                    $("#updCloseModal").click()
                    $("#events").click()
                }
            })
        }
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
        let eventId = $('#receipt').val()
        let res = new Array()
        $.ajax({
            url: '/api/events/' + eventId,
            method:'get',
            dataType: 'json',
            success: function(response){
                console.log(response)

                let date1 = new Date(response[0].eventStart)
                let date2 = new Date(response[0].eventEnd)
                let Difference_In_Time = date2.getTime() - date1.getTime()
                let Difference_In_Days = Math.round(Difference_In_Time / (1000 * 3600 * 24));

                let number = Number(Math.round((Difference_In_Days* 80000) * 100) / 100)
                const options = {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                    };
                const formatted = Number(number).toLocaleString('en', options);

                $("#pDate").text("Date: " + moment(response[0].updated_at).format('YYYY-MM-DD'))
                $("#pTransId").text('Transaction Id: ' + response[0].transaction_id)
                $("#pName").text(response[0].firstname + ' ' + response[0].lastname)
                $("#pEmail").text(response[0].email)
                $("#pDescrip").text(Difference_In_Days)
                $("#pTotal").text('PHP ' + formatted)
            }
        })
    })
    $("#delEventAgree").on('click', function(){
        let id = $("#delEventId").val()
        $.ajax({
            url:'/api/events/' + id,
            method: 'delete',
            dataType: 'json',
            data:{
                clientId: uid
            },
            success: function(){
                $("#events").click()
            }
        })
    })
}); //end document.ready block

//notify
//admin side
