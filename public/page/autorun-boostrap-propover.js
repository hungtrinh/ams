/*!
 * auto run propover on element markup attribute data-toogle="popover"
 * auto hide when focus out of element
 * 
 * Popovers for Bootstrap v1.5.1 (https://github.com/eternicode/bootstrap-datepicker)
 */
(function($){
    
    $(readyToRunPopoverFeature);    

    function readyToRunPopoverFeature() {
        var popoverSelector = '[data-toggle="popover"]';
        var $document = $(document);
        var $popover = $(popoverSelector);

        $popover.popover({"placement": "auto"});
        $document.on('blur', popoverSelector, hidePopoverOnOutFocus);

        function hidePopoverOnOutFocus() {
            $(this).popover('hide');
        }
    }

})(window.jQuery);