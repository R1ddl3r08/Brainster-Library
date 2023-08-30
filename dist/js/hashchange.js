$(function(){

    function handleHashChange() {
        if (location.hash === '' || location.hash === '#') {
            $('#index').removeClass('hidden')
            $('#book').addClass('hidden')
        } else if (location.hash.includes('id=')) {
            const idString = location.hash.split('=')[1]
            const idNumber = parseInt(idString, 10)

            $.ajax({
                type: 'GET',
                url: './php/getBook.php',
                data: { id: idNumber },
                dataType: 'json',
                success: function(response) {
                    if(response.exists){
                        const bookDetails = response.book

                        $('#index').addClass('hidden')
                        $('#book').removeClass('hidden')
                        $('#imageCont').html(`
                            <img src="${bookDetails.image}">
                        `)
                        $('#infoCont').html(`
                            <h2 class="text-2xl font-bold mb-5">${bookDetails.title}</h2>
                            <h3 class="text-xl">Author: <span class="font-semibold">${bookDetails.first_name} ${bookDetails.last_name}</span></h3>
                            <p class="mb-5">${bookDetails.short_bio}</p>
                            <p>Category: <span class="font-semibold">${bookDetails.category}</span></p>
                            <p>Number of pages: <span class="font-semibold">${bookDetails.number_of_pages}</span></p>
                            <p class="mb-5">Publication year: <span class="font-semibold">${bookDetails.publication_year}</span></p>
                            <button class="btn" id="reviewBtn">Leave a review</button>
                            <button class="btn" id="noteBtn">Note</button>
                        `)
                    }
                } 
            });

            $.ajax({
                type: 'GET',
                url: './php/reviews/getReviewsByBook.php',
                data: { bookId: idNumber },
                dataType: 'json',
                success: function(response) {
                    let commentsCont = document.getElementById('commentsCont')
                    commentsCont.innerHTML = ''
                    if (response.length > 0) {
                        response.forEach(function(review) {
                            const div = document.createElement('div')
                            div.className = 'bg-gray-600 p-4 rounded mb-4'
                            div.innerHTML = `
                                <h3 class="text-yellow-400 text-xl font-bold mb-2">${review.username}:</h3>
                                <p class="text-white">${review.comment}</p>
                            `
                            commentsCont.appendChild(div)
                        })
                    } else {
                        const messageDiv = document.createElement('div')
                        messageDiv.className = 'bg-gray-600 p-4 rounded text-white'
                        messageDiv.textContent = 'No reviews yet.'
                        commentsCont.appendChild(messageDiv)
                    }
                }
            })      
            
            $.ajax({
                type: 'GET',
                url: './php/checkLoginStatus.php',
                dataType: 'json',
                success: function(response){
                    if(response.loggedIn && response.role == 'client'){
                        $('#notesDiv').removeClass('hidden')
                        $.ajax({
                            type: 'GET',
                            url: './php/notes/getNotesByUserAndBook.php',
                            data: { bookId: idNumber, userId: response.userId },
                            dataType: 'json',
                            success: function(response) {
                                let notesCont = document.getElementById('notesCont')
                                notesCont.innerHTML = ''
                                if (response.length > 0) {
                                    response.forEach(function(note) {
                                        const div = document.createElement('div')
                                        div.className = 'bg-gray-400 p-4 rounded mb-4'
                                        div.innerHTML = `
                                            <p class="text-white">${note.note}</p>
                                        `
                                        notesCont.appendChild(div)
                                    })
                                } else {
                                    const messageDiv = document.createElement('div')
                                    messageDiv.className = 'bg-gray-400 p-4 rounded text-white'
                                    messageDiv.textContent = 'You have no notes for this book.'
                                    notesCont.appendChild(messageDiv)
                                }
                            }
                        })      
                    } else {
                        $('#notesDiv').addClass('hidden')
                    }
                }
            })
        }
    }

    handleHashChange();

    $(window).on('hashchange', handleHashChange);

})