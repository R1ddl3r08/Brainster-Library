$(function(){


    $('.approveReviewBtn').on('click', function(){
        let reviewId = $(this).data('review-id') 
        $.ajax({
            url: "./php/reviews/changeReviewStatus.php",
            method: "POST",
            data: { reviewId: reviewId, status: 1 },
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Review Approved',
                        text: 'The review has been approved successfully!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    })

    $('.rejectReviewBtn').on('click', function(){
        let reviewId = $(this).data('review-id') 
        $.ajax({
            url: "./php/reviews/changeReviewStatus.php",
            method: "POST",
            data: { reviewId: reviewId, status: 0 },
            dataType: "json",
            success: function(response) {
                if(response.success){
                    Swal.fire({
                        icon: 'error',
                        title: 'Review Rejected',
                        text: 'The review has been rejected.',
                        timer: 1500, 
                        showConfirmButton: false
                    });
                }
            }
        });
    })


})