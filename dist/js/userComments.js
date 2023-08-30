$.ajax({
    type: 'GET',
    url: './php/checkLoginStatus.php',
    dataType: 'json',
    success: function(response) {
        if (!response.loggedIn || response.role !== 'client') {
            document.body.innerHTML = '<h1>Access Denied: You must be logged in to access this page.</h1>';
        }
    },
});

$(function(){

    // User Reviews
    $.ajax({
        type: 'GET',
        url: './php/checkLoginStatus.php',
        dataType: 'json',
        success: function(response) {
            if(response.loggedIn){
                let userId = response.userId;
                $.ajax({
                    type: 'GET',
                    url: './php/reviews/getReviewsByUser.php',
                    data: { userId: userId },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        response.forEach(function(review){
                            const tr = document.createElement('tr')
                            tr.classList.add('border-t')
                            tr.classList.add('border-gray-500')
                            let status
                            let statusColor
                            if(review.is_approved == 0){
                                status = 'Rejected'
                                statusColor = 'text-red-600'
                            } else if(review.is_approved == 1){
                                status = 'Approved'
                                statusColor = 'text-green-500'
                            } else {
                                status = 'Pending'
                                statusColor = 'text-yellow-600'
                            }

                            tr.innerHTML = `
                                <td class="px-6 py-4">${review.title}</td>
                                <td class="px-6 py-4">${review.comment}</td>
                                <td class="px-6 py-4 ${statusColor} font-bold">${status}</td>
                                <td class="px-6 py-4">
                                    <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-600 deleteReviewBtn" data-review-id="${review.id}">Delete</button>
                                </td>
                            `
                            document.getElementById('userReviews').appendChild(tr)
                        })
                    } 
                });
            }
        } 
    });

    $(document).on('click', '.deleteReviewBtn', function(){
        let reviewId = $(this).data('review-id')

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./php/reviews/deleteReview.php",
                    method: "POST",
                    data: { reviewId: reviewId },
                    dataType: "json",
                    success: function(response) {
                        if(response.success){
                            $(`.deleteReviewBtn[data-review-id='${reviewId}']`).closest('tr').remove();
                            Swal.fire('Deleted!', 'The review has been deleted.', 'success');
                        }
                    }
                });
            }
        });
    })

    // User Notes
    $.ajax({
        type: 'GET',
        url: './php/checkLoginStatus.php',
        dataType: 'json',
        success: function(response) {
            if(response.loggedIn){
                let userId = response.userId;
                $.ajax({
                    type: 'GET',
                    url: './php/notes/getNotesByUser.php',
                    data: { userId: userId },
                    dataType: 'json',
                    success: function(response) {
                        response.forEach(function(note){
                            const tr = document.createElement('tr')
                            tr.classList.add('border-t')
                            tr.classList.add('border-gray-500')

                            tr.innerHTML = `
                                <td class="px-6 py-4">${note.title}</td>
                                <td class="px-6 py-4">${note.note}</td>
                                <td class="px-6 py-4">
                                    <button class="bg-yellow-600 rounded text-white font-bold py-2 px-4 hover:bg-yellow-700 editNoteBtn" data-note-id="${note.id}">Edit</button>
                                    <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-600 deleteNoteBtn" data-note-id="${note.id}">Delete</button>
                                </td>
                            `
                            document.getElementById('userNotes').appendChild(tr)
                        })
                    } 
                });
            }
        } 
    });

    $(document).on('click', '.deleteNoteBtn', function(){
        let noteId = $(this).data('note-id')

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./php/notes/deleteNote.php",
                    method: "POST",
                    data: { noteId: noteId },
                    dataType: "json",
                    success: function(response) {
                        if(response.success){
                            $(`.deleteNoteBtn[data-note-id='${noteId}']`).closest('tr').remove();
                            Swal.fire('Deleted!', 'The note has been deleted.', 'success');
                        }
                    }
                });
            }
        });
    })

    $(document).on('click', '.editNoteBtn', function(){
        $('#editNoteModal').removeClass('hidden')
        $('#noteErrorMessage').addClass('hidden')

        let noteId = $(this).data('note-id')
        let noteText = $(this).closest('tr').find('td:eq(1)').text()
        
        $('textarea[name="note"]').val(noteText)
        $('input[name="noteId"]').val(noteId)
    })

    $(document).on('click', '#closeNoteModal', function(){
        $('#editNoteModal').addClass('hidden')
    })

    $('#editNoteForm').on('submit', function(e){
        e.preventDefault()

        $.ajax({
            url: "./php/notes/editNote.php",
            method: "POST",
            data: $("#editNoteForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Note updated`,
                        '',
                        'success'
                    )
                    $('#editNoteModal').addClass('hidden')
                }
            }
        });
    })

})