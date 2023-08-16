$(function(){


    $('#registerForm').on('submit', function(e){
        e.preventDefault()
    
        $('.errorMessage').text('')
    
        $.ajax({
            url: "./php/register.php",
            method: "POST",
            data: $("#registerForm").serialize(),
            dataType: "json",
            success: function(response){
                if(response.success){
                    Swal.fire(
                        'You registered succesfully!',
                        'You can now login',
                        'success'
                    )
                    $('input').val('');
                } else {
                    displayErrorMessages(response.messages);
                }
            }
        })
    })
    
    function displayErrorMessages(messages) {
        for (let field in messages) {
            if (messages.hasOwnProperty(field)) {
                $('#' + field + 'Error').text(messages[field]);
            }
        }
    }


})