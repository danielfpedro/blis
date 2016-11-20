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

    // var counterCarregaPlaceholder = 1;
    // $('.card-image-async').each(function(){


    //         counterCarregaPlaceholder++;
    //     });
    // });

    // var intervalLoadAllPlaceholderImages = window.setInterval(function(){
    //     if (counterCarregaPlaceholder >= totalImages) {
    //         $('.grid').masonry('layout');
    //         window.clearInterval(intervalLoadAllPlaceholderImages);
    //         console.log('Carregou tudo.');
    //     }
    // }, 500);

    carregaImagensPlaceholders($('.card-image-async'), 0, totalImages, function() {
        $('.grid').masonry('layout');
        carregaImagens($('.card-image-async'), 0, totalImages, function() {
            $('.grid').masonry('layout');
        });
    });
    function carregaImagensPlaceholders(objects, current, total, callback) {
        console.log(total);
        var $obj = $(objects[current]);

        var baseUrl = $obj.data('base-url');
        // console.log('baseUrl', baseUrl);

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
            if (current < (total - 1)) {
                carregaImagensPlaceholders(objects, (current + 1), total, callback);        
            } else {
                callback.call();
            }
        });
    }
    function carregaImagens(objects, current, total, callback) {
        var $obj = $(objects[current]);
        
        var $downloadingImage = $("<img/>").attr('src', $obj.data('original-src'));
        console.log($downloadingImage);
        $downloadingImage.on('load', function(){
            var $this = $(this);

            var $wrap = $obj.parent('.card-image-async-wrap');

            $obj.hide();
            $obj
                .attr("src", $this.attr("src"))
                .fadeIn(500);

            $wrap
                .css({
                    'height': 'auto',
                });

            if (current <= total) {
                window.setTimeout(function(){
                    carregaImagens(objects, (current + 1), total, callback);
                }, 0);
            } else {
                callback.call()
            }
        });
    }

    // var i = 1;
    // $('.card-image-async').each(function(){
    //     var $image = $(this);
    //     var $downloadingImage = $("<img/>").attr('src', $image.data('original-src'));

    //     $downloadingImage.on('load', function(){
    //         var $this = $(this);

    //         var $wrap = $image.parent('.card-image-async-wrap');

    //         $image.hide();
    //         $image
    //             .attr("src", $this.attr("src"))
    //             .fadeIn(1000);

    //         $wrap
    //             .css({
    //                 'height': 'auto',
    //             });
            
    //         i++;
    //     });
    // });
    // var intervalLoadAllImages = window.setInterval(function(){
    //     if (i >= totalImages) {
    //         $('.grid').masonry('layout');
    //         loadMoreInit();
    //         window.clearInterval(intervalLoadAllImages);
    //     }
    // }, 500);

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

            if (!loading && !allLoaded && getDistance($loader, 700) <= 0) {
                console.log('Carregando mais.');
                loading = true;

                var page = parseInt($loader.data('page'));
                var notIn = ($loader.data('not-in')) ? parseInt($loader.data('not-in')) : null;

                $.get($loader.data('base-url'), {page: page, not_in: notIn}, function(data){
                    if (data.trim()) {
                        
                        $loader.data('page', parseInt(page + 1));

                        var tey = $(data);
                        $('.grid').append(tey).masonry('appended', tey );
                        $('.grid').masonry('reloadItems');
                    } else {
                        console.log('Carregou tudo');
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

                $.get($loaderMoreSmall.data('base-url'), {page: page, not_in: notIn}, function(data){
                    
                    if (data.trim()) {
                        $loaderMoreSmall.data('page', parseInt(page + 1));
                        $('#load-more-small-container').append(data);    
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