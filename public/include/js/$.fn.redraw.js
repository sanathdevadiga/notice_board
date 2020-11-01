(function($){
    $.fn.redraw = function(){
        return $(this).each(function(){
            var n = document.createTextNode(' ');
            $(this).append(n);
            setTimeout(function(){n.parentNode.removeChild(n)}, 0);
        });
    }
})(jQuery)