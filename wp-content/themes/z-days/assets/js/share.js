(function ($) {
    $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {

        e.preventDefault();

        intWidth = intWidth || '500';
        intHeight = intHeight || '400';
        strResize = (blnResize ? 'yes' : 'no');

        var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
            strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,
            objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
    }

    /* ================================================== */

    $(document).ready(function ($) {
        $('.customer.share').on("click", function (e) {
            $(this).customerPopup(e);
        });

    });

}(jQuery));