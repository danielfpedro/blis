$(function(){
    var documentHeight = $(window).height();
    var loading = false;
    var $loader = $('.load-more');

    var $loaderMoreSmall = $('.load-more-small');
    var loadingSmall = false;

    $('.grid').masonry({
        itemSelector : '.grid-item',
        percentPosition: true
    });

    $(window).scroll(function(){

        if (!loading && getDistance($loader, 700) <= 0) {
            console.log('Carregando mais.');
            loading = true;
            $.get($loader.data('base-url'), function(data){
                var tey = $(data);
                $('.grid').append(tey).masonry('appended', tey );

                loading = false;
            })
        }

        if (!loading && getDistance($loaderMoreSmall, 0) <= 0) {
            console.log('Carregando mais Small.');
            loading = true;
            $.get($loaderMoreSmall.data('base-url'), function(data){

                $('#load-more-small-container').append(data);

                loading = false;
            })
        }
    });

    function getDistance($loader, offset) {
        var scrollTop = $(window).scrollTop();
        var elementOffset = $loader.offset().top;
        var distance = (elementOffset - scrollTop);    
        var distanceFromBottom = distance - documentHeight;

        return distanceFromBottom - offset;
        // console.log('distanceFromBottom', distanceFromBottom);
        // console.log('Factor', factor);
    }
});