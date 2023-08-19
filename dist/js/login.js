
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
                window.location.href = 'index.html';
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
                $('#yourCommentsBtn').hide()
            } else {
                $('#dashboardBtn').hide()
                $('#loginBtn').hide()
                $('#logoutBtn').show()
                $('#yourCommentsBtn').show()
            }
        } else {
            $('#loginBtn').show()
            $('#dashboardBtn').hide()
            $('#logoutBtn').hide()
            $('#yourCommentsBtn').hide()
        }
    }
})