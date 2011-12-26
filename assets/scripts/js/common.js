var api = window.api || {},
    database = window.database || {};

api = {
    connect : function (search) {
        // add loader
        $('.imdb').append('<div id="loader"> </div>');
        $.ajax({
            url : "http://api.rottentomatoes.com/api/public/v1.0/movies.json?",
            data : {
                "apikey" : "wje47anurr2v5f4kv9e3ppjy",
                "q" : search
            },
            dataType : "JSONP",
            success: api.success,
            timeout : 4000,
            error : api.error
        
        });
    },
    success : function (result) {
        // remove loader when results have returned
        $('#loader').remove();

        if ($('#film-update').length){
            api.updateFilm(result);
        }
        //if ($('#genre-update').length) {
        //    imdb.updateGenre(result);
        //}
    
    },
    error : function () {
        // remove loader when results have returned
        $('#loader').remove();        
        $('.imdb').append("<p> Request has timed out </p>");
    },
    updateFilm : function (result) {
        console.log(result.movies);
        var htmlString = '<ul class="film-search-results">';
        // populate the populate database form with retrieved values
        for (var i = 0; i < result.movies.length; i = i + 1){
            htmlString = htmlString +  '<li><a href="#">'
            + '<p class="title">' + result.movies[i].title  + '</p>'
            + '<img src="' + result.movies[i].posters.thumbnail + '">'
            + '<p class="year">' + result.movies[i].year + '</p>'
            + '</a></li>'
        }
        htmlString = htmlString + "</ul>";
        $('#film-update').after(htmlString);
    },
    updateGenre : function (result) {
        console.log(result);
        var genres = result.Genres;
        
        $('#genres').val(genres);
    }
};

database = {
    connect : function (search) {
        $.ajax({
            url : "/assets/scripts/php/retrieveId.php",
            data : {
                "t" : search
            },
            dataType : "text",
            type: "POST",
            success : database.success,
            error : database.error,
            timeout: 4000
        });
    },
    success : function (result) {
        $('#id').val(result);
    },
    error : function () {
        // remove loader when results have returned
        $('#loader').remove();        
        $('.imdb').append("<p> Request has timed out </p>");
    }
};

$(document).ready(function () {
    $('a').click(function (e) {
        e.preventDefault();
        // value of search parameter
        $('#film-search').val($(this).text());
    });
    
    $('.imdb').submit(function (e) {
        e.preventDefault();
        var value = encodeURI($('#film-search').val());
        api.connect(value);
        database.connect(value);
    });
});