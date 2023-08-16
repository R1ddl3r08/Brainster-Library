$(function(){

    $.ajax({
        url: "./php/checkLoginStatus.php",
        method: "GET",
        dataType: "json",
        success: function(response) {
            handleLoginResponse(response)
        }
    })

    $('#loginForm').on('submit', function(e){
        e.preventDefault()

        $('.errorMessage').text('')

        $.ajax({
            url: "./php/login.php",
            method: "POST",
            data: $("#loginForm").serialize(),
            dataType: "json",
            success: function(response){
                console.log(response.role)
                if(response.loggedIn){
                    Swal.fire(
                        `Successfully logged in as ${response.role}`,
                        '',
                        'success'
                    )
                    $('input').val('');
                    handleLoginResponse(response)
                    $('#loginModal').addClass('hidden')
                } else {
                    displayErrorMessages(response.messages)
                }
            }
        })
    })

    $('#logoutForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "./php/logout.php",
            method: "POST",
            dataType: "json",
            success: function(response) {
                handleLoginResponse(response)
                $('#logoutModal').addClass('hidden')
            }
        });
    });

    function displayErrorMessages(messages) {
        for (let field in messages) {
            if (messages.hasOwnProperty(field)) {
                $('#' + field + 'Error').text(messages[field])
            }
        }
    }

    function handleLoginResponse(response) {
        if (response.loggedIn) {
            if(response.role == 'admin'){
                $('#dashboardBtn').show()
                $('#loginBtn').hide()
                $('#logoutBtn').show()
            } else {
                $('#dashboardBtn').hide()
                $('#loginBtn').hide()
                $('#logoutBtn').show()
            }
        } else {
            $('#loginBtn').show()
            $('#dashboardBtn').hide()
            $('#logoutBtn').hide()
        }
    }
})