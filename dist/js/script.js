$(function(){

    $('#loginBtn').on('click', function(e){
        $('#loginModal').removeClass('hidden')
    })

    $('#closeModal').on('click', function(e){
        $('#loginModal').addClass('hidden')
    })

    $('#closeLogoutModal').on('click', function(e){
        $('#logoutModal').addClass('hidden')
    })

    $('#logoutBtn').on('click', function(e){
        $('#logoutModal').removeClass('hidden')
    })

    
})