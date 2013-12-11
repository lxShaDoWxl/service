var loaderSymbols = ['0', '1', '2', '3', '4', '5', '6', '7'], loaderRate = 100, loaderIndex = 0;
function loader (item) {
    t = setTimeout(function () {
        item.html(loaderSymbols[loaderIndex]);
        loaderIndex = loaderIndex < loaderSymbols.length - 1 ? loaderIndex + 1 : 0;
        loader(item);
    }, loaderRate)
}
function loader_end (item, html_old){
    item.toggleClass('loader');
    item.html(html_old);
    clearTimeout(t);
}
$(document).ready(function() {
    $('.commentl_box').on('click', '.answer_comment', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#answer_comment-'+id).fadeIn();
    });
    $('.commentl_box').on('click', '.js-close', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#answer_comment-'+id).fadeOut();
    });
    $('.expert').click(function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var ob=$('#answer-expert-'+id);

        if(ob.hasClass('active')){
            ob.toggleClass('active');
            ob.fadeOut();
            $(this).text('Ответ эксперта');
        } else{
            ob.fadeIn();
            ob.toggleClass('active');
            $(this).text('Свернуть ответ');
        }

    });
//    $('.btn-buy').click(function(){
//        var img =$('.item-box .image').children('img');
//        var coords = $('.cart').offset();
//        var cor = img.offset();
//        var cl = img.clone().css({'position' : 'absolute', 'z-index' : '100', left:cor.left, top:cor.top}).addClass('fly');
//        $('body').before(cl);
//        var fly = $('.fly');
//
//        fly.animate({
//            left : coords.left,
//            top  : coords.top,
//            opacity: 0.5,
//            width: 50,
//            heght:50
//        },300, function(){$(this).fadeOut(200); $(this).remove()})
//    });

//    $('.header_media_horizontal').click(function(e){
//        jQuery.ajax({
//            'type':'GET',
//            'data':{'id':1},
//            'success':function(){
//            },
//            'url':'/site/Banner','cache':false
//            });
//    });
});