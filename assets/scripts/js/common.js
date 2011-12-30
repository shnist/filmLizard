var api = window.api || {},
    common = window.common || {},
    jquery = window.jquery || {};

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

/* All functions that are common throughout the site */
common = {
    init : function (){
        this.placeHolder();
    },
    /* add placeholder support */
    placeHolder : function (){
        if(!$.support.placeholder) {
            var active = document.activeElement;
            $(':text').focus(function () {
                    if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
                            $(this).val('').removeClass('hasPlaceholder');
                    }
            }).blur(function () {
                    if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
                            $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
                    }
            });
            $(':text').blur();
            $(active).focus();
            $('form').submit(function () {
                    $(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
            });
        }
    }
}

/* Functions that augment the jquery object */
jquery = {
    init : function(){
        this.placeHolder();
    },
    placeHolder : function (){
        jQuery.support.placeholder = false;
	var test = document.createElement('input');
	if('placeholder' in test){
            jQuery.support.placeholder = true;
        } 
    }
}

$(document).ready(function () {
    jquery.init();
    common.init();

});