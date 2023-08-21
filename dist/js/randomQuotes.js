$(function(){


    $.ajax({
        url: "http://api.quotable.io/random",
        method: "GET",
        dataType: "json",
        success: function(response){
            let footers = document.getElementsByClassName('quote')
            Array.from(footers).forEach(function(footer){
                footer.innerText = `"${response.content}" - ${response.author}`;
            });
        }
    })


})