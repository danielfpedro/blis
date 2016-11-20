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

    var i = 1;
    $('.card-image-async').each(function(){
        var $image = $(this);
        var $downloadingImage = $("<img/>").attr('src', $image.data('original-src'));
        console.log($downloadingImage);

        console.log('Carregando imagem.');

        $downloadingImage.on('load', function(){
            var $this = $(this);
            window.setTimeout(function(){
                $image.attr("src", $this.attr("src"));  
            }, 2000);

            $('.grid').masonry('layout');
            
            i++;
        });
    });
    var intervalLoadAllImages = window.setInterval(function(){
        if (i >= totalImages) {
            window.clearInterval(intervalLoadAllImages);
            loadMoreInit();
        }
    }, 500);

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