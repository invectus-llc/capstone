import './bootstrap';
import 'flowbite';
import { Calendar, formatDate } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import jQuery from 'jquery';
import { Chart, registerables } from 'chart.js';
window.$ = jQuery
Chart.register(...registerables);

$(document).ajaxError(function(event, xhr, settings, thrownError) {
    if (xhr.status === 419) {
        window.location.href = '/login';
    }
});

$(document).ready(function() {
    $("#userid").hide()
    $('#table').hide()
    $("#profile").hide()
    $("#transactionsList").hide()
    $("#updModal").hide()
    $("#initialdate1").hide()
    $("#initialdate2").hide()
    $("#receipt").hide()
    $("#delEvent").hide()
    $("#act-table").hide()

    // const queryString = new URLSearchParams(window.location.search);
    // const uid = queryString.get('user')
    const uid = $("#userid").text()
    display_events();
    if(uid == 1){
        $("#chartDiv").show();
    }else{
        $("#chartDiv").hide()
    }
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
    function chart(response){
        // console.log(response)
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        let ctx = $('#myChart');
        var data = []
        $.each(response, function( i){
            data.push(response[i].count)
        })
        let chart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                fill: true,
                lineTension: '0.3',
                label: '',
                data: data,
                borderWidth: 1,
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
        return chart.render()
    };

    function display_events() {
        var events = new Array();
        var color = new String;
        var data = new $.ajax({
            url: '/api/events',
            method:'get',
            dataType: 'json',
            data:{
                uid: uid
            },
            success: function (response) {
                // console.log(response[1][0].usertype_id)
                if(response[1][0].usertype_id === 1){
                    $.each(response[0], function (i) {
                        switch (response[0][i].status_id) {
                            case 1:
                                color = 'green'
                                break;
                            case 2:
                                color = 'yellow'
                                break;

                            default:
                                break;
                        }
                            events.push({
                            event_id: response[0][i].id,
                            start: response[0][i].eventStart,
                            end: response[0][i].eventEnd,
                            title: response[0][i].eventName,
                            color: color
                        });
                    })

                    var months = []
                    $.each(response[0], function(i){
                        if(response[0][i].status_id==1){
                            var month = response[0][i].eventStart
                            month = month.split('-')
                            months.push(parseInt( month[1]))
                        }
                    })
                    // console.log(months)
                    var dataArray = [{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0},{count:0}];
                    for(var i = 0; i < dataArray.length; i++){
                        for(var j = 0; j < months.length; j++){
                            if(months[j]==i){
                                dataArray[i-1].count+=1
                            }
                        }
                    }
                    //console.log(response[0])
                    chart(dataArray)

                }else{
                    $.each(response[0], function (i) {
                        if(response[0][i].clientId != uid){
                                color = 'red'
                        }
                        else{
                            switch (response[0][i].status_id) {
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
                            event_id: response[0][i].id,
                            start: response[0][i].eventStart,
                            end: response[0][i].eventEnd,
                            display:'background',
                            color: color
                        });
                    })
                }
                calendar(events);//end calendar events data

                if(response[1][0].usertype_id === 1){
                    //console.log(response[0][1].eventStart)

                }//end chart data
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
        if(Chart.getChart("myChart")) {
            Chart.getChart("myChart")?.destroy()
        }
        display_events()
    })
    $('#dashboard').on('click',function(){
        $('#calendar').show()
        $("#table").hide()
        $("#profile").hide()
        $("#act-table").hide()
        $("#chartDiv").show()
        display_events()
        if(Chart.getChart("myChart")) {
            Chart.getChart("myChart")?.destroy()
        }
    })
    $("#user").on('click', function(){
        $("#profileInfo").click()
        $("#profile").show()
        $('#calendar').hide()
        $("#table").hide()
        $("#chartDiv").hide()
        $("#act-table").hide()
        $.ajax({
            url: '/api/users/' + uid,
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
    $("#logs").on('click', function(){
        $("#profileTable tr").remove()
        $.ajax({
            url: '/api/logs/' + uid,
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response){
                //console.log(response)
                    //console.log(response)
                    if(response[1][0].usertype_id === 1){
                        $.each(response[0], function(i){
                            var trow = `<tr><td>
                            <p
                                class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                Client ${response[0][i].firstname} ${response[0][i].lastname}:  ${response[0][i].description.toUpperCase()}
                                <span class="text-gray-500 text-xs">${moment(response[0][i].created_at).format('YYYY-MM-DD')}</span>
                            </p>
                            </td></tr>`
                            $("#profileTable").append(trow)
                        })
                    }else{
                        $.each(response[0], function(i){
                            if(response[0][i].user_id == uid){
                                var trow = `<tr><td>
                                <p
                                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                    ${response[0][i].description.toUpperCase()}
                                    <span class="text-gray-500 text-xs">${moment(response[0][i].created_at).format('YYYY-MM-DD')}</span>
                                </p>
                                </td></tr>`
                                $("#profileTable").append(trow)
                            }
                        })
                    }

            }
        })
        $('#calendar').hide()
        $("#profile").hide()
        $("#table").hide()
        $("#act-table").show()
        $("#chartDiv").hide()
    })
    $('#events').on('click', function(){
        $("#tbody tr").remove()
        $('#calendar').hide()
        $("#profile").hide()
        $("#act-table").hide()
        $("#chartDiv").hide()
        $("#table").show()
        $.ajax({
            url: '/api/events',
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data:{
                uid: uid
            },
            success: function(response){
                // data = response
                //console.log(response)
                if(response[1][0].usertype_id === 1){
                    $.each(response[0], function(i){
                        var tbrow = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${response[0][i].eventName.toUpperCase()}
                            </th>
                            <td class="px-6 py-4">
                                ${response[0][i].eventStart}
                            </td>
                            <td class="px-6 py-4">
                                ${response[0][i].eventEnd}
                            </td>
                            <td class="px-6 py-4">
                                ${response[0][i].status.toUpperCase()}
                            </td>
                            <td class="px-6 py-4 flex justify-center">
                                <div class="flex flex-col justify-between">
                                    <button id="${response[0][i].id}-e" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                        Edit
                                    </button>
                                    <button id="${response[0][i].id}-d" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button">
                                        Delete
                                    </button>
                                </div>
                                <button id="${response[0][i].id}-r" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Receipt
                                </button>
                            </td>
                            </tr>`;
                            $('#tbody').append(tbrow);
                            if(response[0][i].status_id == 1){
                                $("#" + response[0][i].id +"-e").hide()
                                $("#" + response[0][i].id +"-d").hide()
                                $("#" + response[0][i].id +"-r").show()
                            }else{
                                $("#" + response[0][i].id +"-e").show()
                                $("#" + response[0][i].id +"-d").show()
                                $("#" + response[0][i].id +"-r").hide()
                            }
                            $(document).on('click','#' + response[0][i].id + '-e', function(){
                                let date1 = new Date(response[0][i].eventStart)
                                let date2 = new Date(response[0][i].eventEnd)
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
                                $("#modaltitle").text('Status: ' + response[0][i].status.toUpperCase())
                                $("#modaltitle").val(response[0][i].id)

                                $("#updEventName").val(response[0][i].eventName)
                                $("#updStartDate").val(response[0][i].eventStart)
                                $("#updEndDate").val(response[0][i].eventEnd)

                                $("#initialdate1").val(response[0][i].eventStart)
                                $("#initialdate2").val(response[0][i].eventEnd)
                                $("#updEventSubmit").val(response[0][i].id)
                                $("#paybtn").val(response[0][i].transaction_id)

                                if(response[0][i].statusId == 1){
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
                            $(document).on('click', '#' + response[0][i].id + '-r', function(){
                                //console.log('button click')
                                $("#receipt").val(response[0][i].id)
                                $("#receipt").click()
                            })
                            $(document).on('click', '#' + response[0][i].id + '-d', function(){
                                //console.log('button click')
                                $("#delEventId").val(response[0][i].id)
                                $("#delEvent").click()
                            })
                    })
                }
                else{
                    $.each(response[0], function(i){
                        if(response[0][i].clientId == uid){
                            var tbrow = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${response[0][i].eventName.toUpperCase()}
                            </th>
                            <td class="px-6 py-4">
                                ${response[0][i].eventStart}
                            </td>
                            <td class="px-6 py-4">
                                ${response[0][i].eventEnd}
                            </td>
                            <td class="px-6 py-4">
                                ${response[0][i].status.toUpperCase()}
                            </td>
                            <td class="px-6 py-4 flex justify-center">
                                <div class="flex flex-col justify-between">
                                    <button id="${response[0][i].id}-e" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                        Edit
                                    </button>
                                    <button id="${response[0][i].id}-d" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="m-2 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button">
                                        Delete
                                    </button>
                                </div>
                                <button id="${response[0][i].id}-r" data-modal-target="btn-modal" data-modal-toggle="btn-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Receipt
                                </button>
                            </td>
                            </tr>`;
                            $('#tbody').append(tbrow);
                        }
                        if(response[0][i].status_id == 1){
                            $("#" + response[0][i].id +"-e").hide()
                            $("#" + response[0][i].id +"-d").hide()
                            $("#" + response[0][i].id +"-r").show()
                        }else{
                            $("#" + response[0][i].id +"-e").show()
                            $("#" + response[0][i].id +"-d").show()
                            $("#" + response[0][i].id +"-r").hide()
                        }
                        $(document).on('click','#' + response[0][i].id + '-e', function(){
                            let date1 = new Date(response[0][i].eventStart)
                            let date2 = new Date(response[0][i].eventEnd)
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
                            $("#modaltitle").text('Status: ' + response[0][i].status.toUpperCase())
                            $("#modaltitle").val(response[0][i].id)

                            $("#updEventName").val(response[0][i].eventName)
                            $("#updStartDate").val(response[0][i].eventStart)
                            $("#updEndDate").val(response[0][i].eventEnd)

                            $("#initialdate1").val(response[0][i].eventStart)
                            $("#initialdate2").val(response[0][i].eventEnd)
                            $("#updEventSubmit").val(response[0][i].id)
                            $("#paybtn").val(response[0][i].transaction_id)

                            if(response[0][i].statusId == 1){
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
                        $(document).on('click', '#' + response[0][i].id + '-r', function(){
                            //console.log('button click')
                            $("#receipt").val(response[0][i].id)
                            $("#receipt").click()
                        })
                        $(document).on('click', '#' + response[0][i].id + '-d', function(){
                            //console.log('button click')
                            $("#delEventId").val(response[0][i].id)
                            $("#delEvent").click()
                        })

                    })
                }

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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
        // const settings = {
        //     async: true,
        //     crossDomain: true,
        //     url: 'https://api.paymongo.com/v1/checkout_sessions',
        //     method: 'POST',
        //     headers: {
        //       accept: 'application/json',
        //       'Content-Type': 'application/json',
        //       authorization: 'Basic c2tfdGVzdF85ZW1Va0o2TjNHYXhtZ2VQRjY5WVdSaWo6'
        //     },
        //     processData: false,
        //     data:
        //         `{"data":
        //             {"attributes":
        //                 {
        //                     "send_email_receipt": true,
        //                     "show_description":true,
        //                     "show_line_items":true,
        //                     "description":"Function Hall Rental For: ${eventName}, From: ${eventStart}, To: ${eventEnd}",
        //                     "line_items":[{
        //                         "currency":"PHP",
        //                         "amount":8000000,
        //                         "description":"Rental Fee",
        //                         "name":"Days",
        //                         "quantity":${eventDays}
        //                     }],
        //                     "payment_method_types":[
        //                         "qrph",
        //                         "card",
        //                         "dob",
        //                         "paymaya",
        //                         "billease",
        //                         "gcash",
        //                         "grab_pay"
        //                     ],
        //                     "success_url":"http://localhost:8000/api/success/${uid}/${response.data.id}"
        //                 }
        //             }
        //         }`
        //     };

        //   $.ajax(settings).done(function (response) {
        //     window.location.replace(response.data.attributes.checkout_url);
        //     _callback()
        //     // console.log(response.data.id)
        //   });
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response){
                //console.log(response)

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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data:{
                clientId: uid
            },
            success: function(){
                $("#events").click()
            }
        })
    })

    // const settings = {
    //     async: true,
    //     crossDomain: true,
    //     url: 'https://api.paymongo.com/v1/checkout_sessions',
    //     method: 'POST',
    //     headers: {
    //       accept: 'application/json',
    //       'Content-Type': 'application/json',
    //       authorization: 'Basic c2tfdGVzdF85ZW1Va0o2TjNHYXhtZ2VQRjY5WVdSaWo6'
    //     },
    //     processData: false,
    //     data: '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":true}}}'
    //   };

    //   $.ajax(settings).done(function (response) {
    //     console.log(response);
    //   });
}); //end document.ready block

