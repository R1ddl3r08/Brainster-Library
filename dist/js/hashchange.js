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
                        `)
                        console.log(response)
                    }

                    console.log(response)
                } 
            });
        }
    }

    handleHashChange();

    $(window).on('hashchange', handleHashChange);

})