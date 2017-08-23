$(function () {
    /* wire header buttons */
    $('.ctl-btn').click(function ( e) {
        var page = $(e.currentTarget).attr('data-target');
        $('#main').load("partial/" + page + ".phtml");
    });
    
    /* load batches as default */
    $('#main').load("partial/batches.phtml");
});