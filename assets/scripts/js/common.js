var api = window.api || {};

api = {
    searchFilms : function (search) {
        // add loader
        $('.imdb').append('<div id="loader"> </div>');
        $.ajax({
            url : "http://api.rottentomatoes.com/api/public/v1.0/movies.json?",
            data : {
                "apikey" : "wje47anurr2v5f4kv9e3ppjy",
                "q" : search
            },
            dataType : "JSONP",
            success: function (result) {
                // remove loader when results have returned
                $('#loader').remove();
                console.log(result)
            },
            timeout : 4000,
            error : function () {
                console.log('error');
            }
        });
    }
};


$(document).ready(function () {


});