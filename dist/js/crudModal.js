$(function(){

    // Add book
    $('#addBookBtn').on('click', function(){
        $('#booksCrudModal').removeClass('hidden')
        $('#addBookForm').removeClass('hidden')
        $('#editBookForm').addClass('hidden')
        $('#booksModalTitle').text('Add book')
    })

    $('#addBookForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "./php/crud/books/addBook.php",
            method: "POST",
            data: $("#addBookForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Book added`,
                        '',
                        'success'
                    )
                    $('#booksCrudModal').addClass('hidden')
                } else {
                    $('#addBookErrorMessage').show()
                }
            }
        });
    })

    // Edit book
    $('.editBookBtn').on('click', function(){
        const bookId = $(this).data('book-id');
        
        $.ajax({
            type: 'GET',
            url: './php/getBook.php',
            data: { id: bookId },
            dataType: 'json',
            success: function(response) {
                if(response.exists){
                    const book = response.book

                    $('#booksCrudModal').removeClass('hidden')
                    $('#editBookForm').removeClass('hidden')
                    $('#booksModalTitle').text('Edit book')
                    $('#addBookForm').addClass('hidden')
            
                    console.log('input[name="bookId"]')
                    $('input[name="bookId"]').val(book.id)
                    $('input[name="title"]').val(book.title)
                    $('select[name="author"]').val(book.author_id)
                    $('input[name="publicationYear"]').val(book.publication_year)
                    $('input[name="numberOfPages"]').val(book.number_of_pages)
                    $('input[name="image"]').val(book.image)
                    $('select[name="category"]').val(book.category_id)
                }
            } 
        });
    })

    $('#editBookForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: "./php/crud/books/editBook.php",
            method: "POST",
            data: $("#editBookForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Book updated`,
                        '',
                        'success'
                    )
                    $('#booksCrudModal').addClass('hidden')
                } else {
                    $('#editBookErrorMessage').show()
                }
            }
        });
    })

    // Delete book
    $('.deleteBookBtn').on('click', function(){
        const bookId = $(this).data('book-id')

        Swal.fire({
            title: 'Are you sure?',
            text: 'All comments public and private notes will be deleted with the book!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./php/crud/books/deleteBook.php",
                    method: "POST",
                    data: { bookId: bookId },
                    dataType: "json",
                    success: function(response) {
                        if(response.success){
                            $(`.deleteBookBtn[data-book-id='${bookId}']`).closest('tr').remove();
                            Swal.fire('Deleted!', 'The book has been deleted.', 'success');
                            $('#booksCrudModal').addClass('hidden')
                        }
                    }
                });
            }
        });
    });

    // Add author
    $('#addAuthorBtn').on('click', function(){
        $('#authorsCrudModal').removeClass('hidden')
        $('#addAuthorForm').removeClass('hidden')
        $('#editAuthorForm').addClass('hidden')
        $('#authorsCrudModalTitle').text('Add author')
        $("#addAuthorForm")[0].reset()
    })

    $('#addAuthorForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "./php/crud/authors/addAuthor.php",
            method: "POST",
            data: $("#addAuthorForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Author added`,
                        '',
                        'success'
                    )
                    $('#authorsCrudModal').addClass('hidden')
                } else {
                    $('#addAuthorErrorMessage').show()
                }
            }
        });
    })

    // Edit author
    $('.editAuthorBtn').on('click', function(){
        const authorId = $(this).data('author-id');
        
        $.ajax({
            type: 'GET',
            url: './php/crud/authors/getAuthor.php',
            data: { id: authorId },
            dataType: 'json',
            success: function(response) {
                if(response.exists){
                    const author = response.author

                    $('#authorsCrudModal').removeClass('hidden')
                    $('#editAuthorForm').removeClass('hidden')
                    $('#authorsCrudModalTitle').text('Edit author')
                    $('#addAuthorForm').addClass('hidden')
            
                    $('input[name="authorId"]').val(author.id)
                    $('input[name="firstName"]').val(author.first_name)
                    $('input[name="lastName"]').val(author.last_name)
                    $('textarea[name="shortBio"]').val(author.short_bio)
                }
            } 
        });
    })

    $('#editAuthorForm').on('submit', function(e){
        e.preventDefault()
        console.log('submitted')
        $.ajax({
            url: "./php/crud/authors/editAuthor.php",
            method: "POST",
            data: $("#editAuthorForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Author updated`,
                        '',
                        'success'
                    )
                    $('#authorsCrudModal').addClass('hidden')
                } else {
                    $('#editAuthorErrorMessage').show()
                }
            }
        });
    })

    // Delete author
    $('.deleteAuthorBtn').on('click', function(){
        const authorId = $(this).data('author-id')

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
                    url: "./php/crud/authors/deleteAuthor.php",
                    method: "POST",
                    data: { authorId: authorId },
                    dataType: "json",
                    success: function(response) {
                        if(response.success){
                            $(`.deleteAuthorBtn[data-author-id='${authorId}']`).closest('tr').remove();
                            Swal.fire('Deleted!', 'The author has been deleted.', 'success');
                            $('#authorsCrudModal').addClass('hidden')
                        }
                    }
                });
            }
        });
    });

    // Add category
    $('#addCategoryBtn').on('click', function(){
        $('#categoriesCrudModal').removeClass('hidden')
        $('#addCategoryForm').removeClass('hidden')
        $('#editCategoryForm').addClass('hidden')
        $('#categoriesModalTitle').text('Add category')
    })

    $('#addCategoryForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "./php/crud/categories/addCategory.php",
            method: "POST",
            data: $("#addCategoryForm").serialize(),
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire(
                        `Category added`,
                        '',
                        'success'
                    )
                    $('#categoriesCrudModal').addClass('hidden')
                } else {
                    $('#addCategoriesErrorMessage').show()
                }
            }
        });
    })

    // Edit category
    $('.editCategoryBtn').on('click', function(){
        const categoryId = $(this).data('category-id');
        
        $.ajax({
            type: 'GET',
            url: './php/crud/categories/getCategory.php',
            data: { id: categoryId },
            dataType: 'json',
            success: function(response) {
                if(response.exists){
                    const category = response.category

                    $('#categoriesCrudModal').removeClass('hidden')
                    $('#editCategoryForm').removeClass('hidden')
                    $('#categoriesModalTitle').text('Edit book')
                    $('#addCategoryForm').addClass('hidden')
            
                    $('input[name="categoryId"]').val(category.id)
                    $('input[name="category"]').val(category.category)
                }
            } 
        });
    })

    $('#editCategoryForm').on('submit', function(e){
        e.preventDefault();
        console.log('submitted')
        $.ajax({
            url: "./php/crud/categories/editCategory.php",
            method: "POST",
            data: $("#editCategoryForm").serialize(),
            dataType: "json",
            success: function(response) {
                console.log("success")
                if(response.success){
                    Swal.fire(
                        `Category updated`,
                        '',
                        'success'
                    )
                    $('#categoriesCrudModal').addClass('hidden')
                } else {
                    $('#editCategoriesErrorMessage').show()
                }
            }
        });
    })

    // Delete category
    $('.deleteCategoryBtn').on('click', function(){
        const categoryId = $(this).data('category-id')

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
                    url: "./php/crud/categories/deleteCategory.php",
                    method: "POST",
                    data: { categoryId: categoryId },
                    dataType: "json",
                    success: function(response) {
                        if(response.success){
                            $(`.deleteCategoryBtn[data-category-id='${categoryId}']`).closest('tr').remove();
                            Swal.fire('Deleted!', 'The category has been deleted.', 'success');
                            $('#categoriesCrudModal').addClass('hidden')
                        }
                    }
                });
            }
        });
    });
    



    $('.closeBooksCrudModal').on('click', function(){
        $('#booksCrudModal').addClass('hidden')
    })

    $('.closeCategoriesCrudModal').on('click', function(){
        $('#categoriesCrudModal').addClass('hidden')
    })

    $('.closeAuthorsCrudModal').on('click', function(){
        $('#authorsCrudModal').addClass('hidden')
    })
})