$(document).ready(function () {
    $('a').click(function (e) {
        e.preventDefault();
        // value of search parameter
        $('#film-search').val($(this).text());
    });
    
    $('#imdb').submit(function (e) {
        e.preventDefault();
        var value = encodeURI($('#film-search').val());
        imdb.connect(value);
    });
    
    var imdb = window.imdb || {};
    imdb = {
        connect : function (search) {
            $.ajax({
                url : "http://www.imdbapi.com/",
                data : {
                    "t" : search
                },
                dataType : "JSONP",
                success: imdb.success,
                timeout : 4000 
            
            });
        },
        success : function (result) {
            // populate the populate database form with retrieved values
            var releaseDate = result.Year,
                certificate = result.Rated,
                rating = result.Rating;
                
                $('#certificate').val(certificate);
                $('#release-date').val(releaseDate);
                $('#rating').val(rating);
        },
        error : function () {
            console.log('timed out');
        }
    };
});