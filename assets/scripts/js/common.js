var imdb = window.imdb || {},
    database = window.database || {};

imdb = {
    connect : function (search) {
        // add loader
        $('.imdb').append('<div id="loader"> </div>');
        $.ajax({
            url : "http://www.imdbapi.com/",
            data : {
                "t" : search
            },
            dataType : "JSONP",
            success: imdb.success,
            timeout : 4000,
            error : database.error
        
        });
    },
    success : function (result) {
        // remove loader when results have returned
        $('#loader').remove();
        // populate the populate database form with retrieved values
        var releaseDate = result.Year,
            certificate = result.Rated,
            rating = result.Rating,
            poster = result.Poster;
            
            $('#certificate').val(certificate);
            $('#release-date').val(releaseDate);
            $('#rating').val(rating);
            $('#poster').val(poster);
    },
    error : function () {
        // remove loader when results have returned
        $('#loader').remove();        
        $('.imdb').append("<p> Request has timed out </p>");
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
        var value = $('#film-search').val();
        imdb.connect(value);
        database.connect(value);
    });
});