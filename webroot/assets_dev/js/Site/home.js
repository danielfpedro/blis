$(function(){

    var documentHeight = $(window).height();
    var loading = false;
    var $loader = $('.load-more');
    var allLoaded = false;

    var $loaderMoreSmall = $('.load-more-small');
    var smallAllLoaded = false;

    var totalImages = $('.card-image-async').length;

    $('.grid').masonry({
        itemSelector : '.grid-item',
        percentPosition: true
    });

    loadMoreInit();
    carregaImagensPlaceholders($('.card-image-async:not(.img-loaded)'), 0, function() {
        $('.grid').masonry('layout');
        carregaImagens(function() {
            // $('.grid').masonry('layout');
            console.log('Chamando load more');
        });
    });
    function carregaImagensPlaceholders($objects, current, callback) {
        var total = $objects.length;

        var $obj = $objects.first();

        var baseUrl = $obj.data('base-url');

        var $downloadingImage = $("<img/>").attr('src', baseUrl + 'img/main_post_placeholder.png');

        $downloadingImage.on('load', function(){
            var $this = $(this);

            var $wrap = $obj.parent('.card-image-async-wrap');

            $obj
                .attr("src", $this.attr("src"))
                .css('height', 'auto');
            $wrap
                .css({
                    'height': $obj.height() + 'px',
                });
        });

        if (current < (total - 1)) {
            carregaImagensPlaceholders($objects, (current + 1), callback);
        } else {
            callback.call();
        }
        
    }
    function carregaImagens(callback) {

        var $obj = $('.card-image-async:not(.img-loaded)').first();

        if ($obj.length < 1) {
            callback.call();
            return;
        }

        $obj.addClass('img-loaded');

        var $downloadingImage = $("<img/>").attr('src', $obj.data('original-src'));

        $downloadingImage.on('load', function(){
            var $this = $(this);

            var $wrap = $obj.parent('.card-image-async-wrap');

            $obj.hide();
                     
            $obj
                .attr("src", $this.attr("src"))
                .fadeIn(500, function() {
                    $(this).addClass('img-loaded');
                    $wrap
                        .css({
                            'height': 'auto',
                        });
                });
        });
        window.setTimeout(function(){
            carregaImagens(callback);
        }, 0);
    }

    function getDistance($loader, offset) {
        var scrollTop = $(window).scrollTop();
        var elementOffset = $loader.offset().top;
        var distance = (elementOffset - scrollTop);    
        var distanceFromBottom = distance - documentHeight;

        return distanceFromBottom - offset;
        // console.log('distanceFromBottom', distanceFromBottom);
        // console.log('Factor', factor);
    }

    function loadMoreInit(){
        window.setInterval(function(){
            /**
             * Carrega principal
             */
            if (!loading && !allLoaded && getDistance($loader, 700) <= 0) {
                console.log('Carregando mais.');
                loading = true;

                var page = parseInt($loader.data('page'));
                var notIn = ($loader.data('not-in')) ? parseInt($loader.data('not-in')) : null;
                var category = $loader.data('category');

                $.get($loader.data('base-url'), {page: page, not_in: notIn, category: category}, function(data){
                    if (data.trim()) {
                        
                        $loader.data('page', parseInt(page + 1));

                        var tey = $(data);
                        $('.grid').append(tey).masonry('appended', tey );
                        $('.grid').masonry('layout');
                        carregaImagens($('.card-image-async:not(.img-loaded)'), 0, function() {
                            // $('.grid').masonry('layout');
                            console.log('Chamando load more');
                        });
                    } else {
                        allLoaded = true;
                    }

                    loading = false;
                })
            }

            if (!loading && !smallAllLoaded && getDistance($loaderMoreSmall, 0) <= 0) {
                
                console.log('Carregando mais Small.');
                loading = true;

                var page = parseInt($loaderMoreSmall.data('page'));
                var notIn = ($loaderMoreSmall.data('not-in')) ? parseInt($loaderMoreSmall.data('not-in')) : null;
                var category = $loader.data('category');

                $.get($loaderMoreSmall.data('base-url'), {page: page, not_in: notIn, category: category}, function(data){
                    
                    if (data.trim()) {
                        $loaderMoreSmall.data('page', parseInt(page + 1));
                        $('#load-more-small-container').append(data);

                        carregaImagens($('.card-image-async:not(.img-loaded)'), 0, function() {
                        });    
                    } else {
                        console.log('Carregou tudo.');
                        smallAllLoaded = true;
                    }
                    

                    loading = false;
                })
            }
        }, 1000);
    }
});