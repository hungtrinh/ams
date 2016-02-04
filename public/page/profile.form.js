/**
 * Student profile form features
 * 
 * @param  jQuery $
 * @return void
 */
;(function($){
    $(profileFormReady);

    /**
     * Page ready 
     * @return void
     */
    function profileFormReady() {
        var EVENT_ADD_SIBLING_DOM = 'sibling:add:dom',
            inputSiblingJob       = '.sibling-work',
            maxSibling            = 0 + $('[data-max-sublings]').data('max-sublings') || 1,
            siblingTemplate       = $('[data-template]').data('template'),
            $siblingList          = $('.siblings'),
            $body                 = $('body');
        
        $body.on(EVENT_ADD_SIBLING_DOM, addSiblingInput);
        $body.on('keydown', inputSiblingJob, triggerEventAddSiblingDom);
        
        /**
         * Trigger event add sibling dom 
         * 
         * @param  jQuery.Event e 
         * @return void
         */
        function triggerEventAddSiblingDom(e) {
            var keyCode       = e.keyCode || e.which; 
            var noPressTabKey = keyCode != 9;
            if (noPressTabKey) {
                return;
            }
            $body.trigger(EVENT_ADD_SIBLING_DOM);
        } //triggerEventAddSiblingDom

        /**
         * Do add sibling to list sibling
         * 
         * @param  jQuery.Event e 
         * @return void
         */
        function addSiblingInput(e) {
            var numberSibling   = $(inputSiblingJob).size(),
                isEnoughSibling = maxSibling === numberSibling,
                siblingFieldset = '';
            if (isEnoughSibling) { 
                return;
            }
            siblingFieldset = siblingTemplate.replace(/__index__/g, numberSibling)
            $siblingList.append(siblingFieldset);
        } //addSiblingInput

    }; //profileFormReady
})(window.jQuery);