$.ajax({
    url: "./php/categories.php",
    method: "GET",
    dataType: "json",
    success: function(response) {
        response.forEach(function(category){
            const div = document.createElement('div')
            div.innerHTML = `
            <label class="flex items-center p-3">
                <input type="checkbox" id="${category.id}" class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="ml-2 text-gray-700">${category.category}</span>
            </label>
            `
            document.getElementById('categoriesCont').appendChild(div)
        });
    }
});

$.ajax({
    url: "./php/books.php",
    method: "GET",
    dataType: "json",
    success: function(response) {
        console.log(response)
        displayBooks(response)
    }
})

$(document).on('change', '.form-checkbox', function() {
    const selectedCategories = []

    $('.form-checkbox:checked').each(function() {
        const categoryId = $(this).attr('id')
        selectedCategories.push(parseInt(categoryId))
    })

    $.ajax({
        url: "./php/books.php",
        method: "GET",
        dataType: "json",
        success: function(response) {
            let filteredBooks = response

            if(selectedCategories.length > 0){
                filteredBooks = response.filter(book => {
                    return selectedCategories.includes(book.category_id)
                });
            }

            displayBooks(filteredBooks)
        }
    });
});

function displayBooks(response){
    $('#booksCont').html('')
    response.forEach(function(book){
        const div = document.createElement('div')
        div.classList.add('w-1/4', 'flex', 'flex-col', "mb-8", 'transition', 'transform', 'hover:scale-105', 'hover:-translate-y-2')
        div.innerHTML = `
        <a href="#id=${book.id}" class="flex-grow mx-4 shadow-lg">
            <div class="h-80">
                <img src="${book.image}" class="h-full w-full object-cover">
            </div>
            <div class="p-5 flex-grow">
                <div>
                    <h3 class="font-bold text-lg">${book.title}</h3>
                    <p class="text-base">${book.first_name} ${book.last_name}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold">${book.category}</p>
                </div>
            </div>
        </a>
        `

        document.getElementById('booksCont').appendChild(div)
    })
}