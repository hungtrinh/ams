/*!
 * Override some default option of datepicker plugin
 * Datepicker for Bootstrap v1.5.1 (https://github.com/eternicode/bootstrap-datepicker)
 */
;(function($, $datepicker){
    $(setupAmsDatePickerDefault);

    function setupAmsDatePickerDefault()
    {   
        var amsDatePickerDefault = {
            todayHighlight:true,
            autoclose:true, 
            format:'yyyy-mm-dd'
        };
        $.extend($datepicker.defaults, amsDatePickerDefault);
    } //setupAmsDatePickerDefault
})(window.jQuery, window.jQuery.fn.datepicker);