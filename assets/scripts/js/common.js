var api = window.api || {},
    database = window.database || {};

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
                
                if ($('#film-update').length){
                api.updateFilm(result);
                }
                //if ($('#genre-update').length) {
                //    imdb.updateGenre(result);
                //}
            },
            timeout : 4000,
            error : function () {
                // remove loader when results have returned
                $('#loader').remove();        
                $('.imdb').append("<p> Request has timed out </p>");
            }
        });
    },
    filmDetails : function (id) {
        $.ajax({
            url : "http://api.rottentomatoes.com/api/public/v1.0/movies/"+ id +".json?",
            data : {
                "apikey" : "wje47anurr2v5f4kv9e3ppjy"
            },
            dataType : "JSONP",
            success: function (result){
                console.log(result);
                var certificate = result.mpaa_rating,
                    date = result.year,
                    rating = result.ratings.audience_score,
                    poster = result.posters.original;
                
                $('#certificate').val(certificate);
                $('#release-date').val(date);
                $('#rating').val(rating);
                $('#poster').val(poster);
            }
        });
    },
    updateFilm : function (result) {
        // remove previous results
        if ($('.film-search-results').length === true){
            $('.film-search-results').remove();
            $('.error').remove();
        }
        var htmlString = '<form action="#" method="post" class="film-search-results"><ul>';
        // populate the populate database form with retrieved values
        for (var i = 0; i < result.movies.length; i = i + 1){
            htmlString = htmlString +  '<li><a href="#">'
            + '<p class="id hidden">' + result.movies[i].id + '</p>'
            + '<p class="title">' + result.movies[i].title  + '</p>'
            + '<img src="' + result.movies[i].posters.thumbnail + '">'
            + '<p class="year">' + result.movies[i].year + '</p>'
            + '</a></li>'
        }
        htmlString = htmlString + '</ul><input type="submit" name="submit" value="populate form"></form>';
        $('#film-update').after(htmlString);
        api.ui.selectFilm();
        api.ui.populateForm(); 
    },
    updateGenre : function (result) {
        console.log(result);
        var genres = result.Genres;
        
        $('#genres').val(genres);
    },
    ui : {
        selectFilm : function () {
            $('.film-search-results a').click(function (e) {
                e.preventDefault();
                $('.film-search-results a').removeClass('selected');
                $(this).addClass('selected');
                $('.error').remove();
            });
        },
        populateForm : function () {
            $('.film-search-results').submit(function (e) {
                e.preventDefault();
                // first error checking
                if ($('.selected', '.film-search-results').length === 0){
                    $('#film-update').append('<p class="error">Nothing was selected</p>');
                } else{
                    var id = $('.selected .id', this).text();
                    api.filmDetails(id);
                }
            
            });
        }
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
        api.searchFilms(value);
        database.connect(value);
    });
});