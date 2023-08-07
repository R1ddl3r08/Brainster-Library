$(function(){


    $('#loginBtn').on('click', function(e){
        $('#loginModal').removeClass('hidden')
    })

    $('#closeModal').on('click', function(e){
        $('#loginModal').addClass('hidden')
    })


})