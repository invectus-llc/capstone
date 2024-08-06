import './bootstrap';
import 'flowbite';
import 'leaflet/dist/leaflet.css';
import jQuery from 'jquery';
window.$ = jQuery

const signUpButton = document.getElementById("signUp");
    const signInButton = document.getElementById("signIn");
    const container = document.getElementById("container");

    signUpButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
    });

    signInButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});

$('#signup').on('click', function () {
    var username = $('#suUsername').val();
    var password = $('#suPassword').val();
    var email = $('#suEmail').val();
    var firstname = $('#suFirstname').val();
    var lastname = $('#suLastname').val();
    var contact = $("#suContact").val()

    if($.isNumeric(contact)){
        $.ajax({
            url: '/api/register',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data:{
                username: username,
                password: password,
            },
            success: function(response){
                var login_id = response.id
                if (response){
                    //console.log(response)
                    $.ajax({
                        url: '/api/users',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        data:{
                            email: email,
                            firstname: firstname,
                            contact: contact,
                            lastname: lastname,
                            login_id: login_id
                        },
                        success: function(response){
                            $('#suUsername').val('')
                            $('#suPassword').val('')
                            $('#suEmail').val('')
                            $('#suFirstname').val('')
                            $('#suLastname').val('')
                            $('#suContact').val('')
                            $('#signIn').click()
                        }
                    })
                }

            },error: function (xhr, status) {
                console.log(xhr, status);
            }
        })
    } else{
        alert('Invalid Input')
    }
})
// $('#signin').on('click', function(){
//     var username = $('#siUsername').val()
//     var password = $('#siPassword').val()
//     $.ajax({
//         url: '/api/login',
//         method: 'get',
//         dataType: 'json',
//         data: {
//             username: username
//         },
//         success: function(response){
//             // if(username == response.username){
//             //     if(password == response.password){
//             //         window.location = '/dashboard';

//             //     }
//             // }
//             console.log(response.id)
//         }
//     })
// })
