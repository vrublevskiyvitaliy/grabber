(function($) {
    $.fn.videoPreview = function(options) {
        return this.each(function() {
            var elm = $(this);
            var frames = parseFloat(elm.data('frames'));

            var img = $('<img/>', { 'src': elm.data('source') }).hide().css({
                'position': 'absolute',
                'cursor': 'pointer'
            }).appendTo(elm);

            var slider = $('<div/>').hide().css({
                'width': '3px',
                'height': '100%',
                'background': '#ddd',
                'position': 'absolute',
                'z-index': '1',
                'top': '0',
                'opacity': 1,
                'cursor': 'pointer'
            }).appendTo(elm);

            var width;

            function defaultPos() {
                img.css('left', -width * frames / 4);
            }

            img.load(function() {
                $(this).show();
                width = this.width / frames;
                elm.css('width', width);
                defaultPos();
            });
            elm.mousemove(function(e) {
                var left = e.clientX - elm.position().left;
                slider.show().css('left', left - 1); // -1 because it's 2px width
                img.css('left', -Math.floor((left / width) * frames) * width);
            }).mouseout(function(e) {
                slider.hide();
                defaultPos();
            });

        });
    };
})(jQuery);

$('.video-preview').videoPreview();