$('#js_log_toggle').click(function () {
    if ($(this).hasClass('log_hidden')) {
        $('#js_log').removeClass('hidden');
        $(this).removeClass('log_hidden');
    } else {
        $('#js_log').addClass('hidden');
        $(this).addClass('log_hidden');
    }
});