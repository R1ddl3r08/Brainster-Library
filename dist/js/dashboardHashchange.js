$(function() {
    function handleHashChange() {
        let currentHash = location.hash
        const dashboard = $('#dashboard')
        const pendingReviewsContainer = $('#pendingReviewsContainer')
        const rejectedReviewsContainer = $('#rejectedReviewsContainer')
        const booksCrudContainer = $('#booksCrudContainer')
        const authorsCrudContainer = $('#authorsCrudContainer')
        const categoriesCrudContainer = $('#categoriesCrudContainer')

        if(currentHash == '' || currentHash == '#') {
            dashboard.removeClass('hidden')
            pendingReviewsContainer.addClass('hidden')
            rejectedReviewsContainer.addClass('hidden')
            booksCrudContainer.addClass('hidden')
            authorsCrudContainer.addClass('hidden')
            categoriesCrudContainer.addClass('hidden')
        } else if(currentHash == '#dashboard=pendingReivews'){
            dashboard.addClass('hidden')
            pendingReviewsContainer.removeClass('hidden')
            rejectedReviewsContainer.addClass('hidden')
            booksCrudContainer.addClass('hidden')
            authorsCrudContainer.addClass('hidden')
            categoriesCrudContainer.addClass('hidden')
        } else if(currentHash == '#dashboard=rejectedReviews'){
            dashboard.addClass('hidden')
            pendingReviewsContainer.addClass('hidden')
            rejectedReviewsContainer.removeClass('hidden')
            booksCrudContainer.addClass('hidden')
            authorsCrudContainer.addClass('hidden')
            categoriesCrudContainer.addClass('hidden')
        } else if(currentHash == '#dashboard=books') {
            dashboard.addClass('hidden')
            pendingReviewsContainer.addClass('hidden')
            rejectedReviewsContainer.addClass('hidden')
            booksCrudContainer.removeClass('hidden')
            authorsCrudContainer.addClass('hidden')
            categoriesCrudContainer.addClass('hidden')
        } else if(currentHash == '#dashboard=authors') {
            dashboard.addClass('hidden')
            pendingReviewsContainer.addClass('hidden')
            rejectedReviewsContainer.addClass('hidden')
            booksCrudContainer.addClass('hidden')
            authorsCrudContainer.removeClass('hidden')
            categoriesCrudContainer.addClass('hidden')
        } else if(currentHash == '#dashboard=categories') {
            dashboard.addClass('hidden')
            pendingReviewsContainer.addClass('hidden')
            rejectedReviewsContainer.addClass('hidden')
            booksCrudContainer.addClass('hidden')
            authorsCrudContainer.addClass('hidden')
            categoriesCrudContainer.removeClass('hidden')
        }
    }

    $(window).on('hashchange', handleHashChange)

    handleHashChange()

    $('.goBackBtn').on('click', function(){
        location.hash = ''
    })

    $('#openPendingReviewsBtn').on('click', function(){
        location.hash = 'dashboard=pendingReivews'
    })

    $('#openRejectedReviewsBtn').on('click', function(){
        location.hash = 'dashboard=rejectedReviews'
    })

    $('#openBooksBtn').on('click', function() {
        location.hash = 'dashboard=books'
    })

    $('#openAuthorsBtn').on('click', function() {
        location.hash = 'dashboard=authors'
    })

    $('#openCategoriesBtn').on('click', function() {
        location.hash = 'dashboard=categories'
    })
})
