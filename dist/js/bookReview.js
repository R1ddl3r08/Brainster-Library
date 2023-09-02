$(function(){

    $(document).on('click', '#reviewBtn', function(){
        $('#reviewModal').removeClass('hidden')
        $('#reviewErrorMessage').addClass('hidden')
    })

    $(document).on('click', '#closeReviewModal', function(){
        $('#reviewModal').addClass('hidden')
    })

    $(document).on('click', '#noteBtn', function(){
        $('#noteModal').removeClass('hidden')
        $('#noteErrorMessage').addClass('hidden')
    })

    $(document).on('click', '#closeNoteModal', function(){
        $('#noteModal').addClass('hidden')
    })

    $('#reviewForm').on('submit', function(e){
        e.preventDefault()

        let hash = location.hash
        let bookId = parseInt(hash.match(/\d+/))

        $.ajax({
            type: 'GET',
            url: './php/checkLoginStatus.php',
            dataType: 'json',
            success: function(response){
                if(response.loggedIn && response.role == 'client'){
                    $('input[name="userId"]').val(response.userId)
                    $('input[name="bookId"]').val(bookId)
                    $.ajax({
                        type: 'POST',
                        url: './php/reviews/addReview.php',
                        data: $('#reviewForm').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if(response.success){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Review Added',
                                    text: 'Your review has been added successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#reviewModal').addClass('hidden')
                            } else {
                                $('#reviewErrorMessage').removeClass('hidden')
                                $('#reviewErrorMessage').text(response.errors)
                            }
                        } 
                    });
                } else {
                    $('#reviewErrorMessage').removeClass('hidden')
                    $('#reviewErrorMessage').text('You must be logged in as a client to leave a review!')
                }
            } 
        })
    })

    $('#noteForm').on('submit', function(e){
        e.preventDefault()

        let hash = location.hash
        let bookId = parseInt(hash.match(/\d+/))

        $.ajax({
            type: 'GET',
            url: './php/checkLoginStatus.php',
            dataType: 'json',
            success: function(response){
                if(response.loggedIn && response.role == 'client'){
                    $('input[name="userId"]').val(response.userId)
                    $('input[name="bookId"]').val(bookId)
                    $.ajax({
                        type: 'POST',
                        url: './php/notes/addNote.php',
                        data: $('#noteForm').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if(response.success){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Note added',
                                    text: 'Your note has been added successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#noteModal').addClass('hidden')
                            } else {
                                $('#noteErrorMessage').removeClass('hidden')
                                $('#noteErrorMessage').text(response.errors)
                            }
                        }
                    });
                } else {
                    $('#noteErrorMessage').removeClass('hidden')
                    $('#noteErrorMessage').text('You must be logged in as a client to leave a note!')
                }
            } 
        })
    })


})