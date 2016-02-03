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
            maxSibling            = 0 + $('[data-max-sublings]').data('max-sublings') || 1,
            siblingTemplate       = $('[data-template]').data('template'),
            $siblings             = $('.siblings'),
            $body                 = $('body');
        
        $body.on(EVENT_ADD_SIBLING_DOM, addSiblingInput);
        $body.on('keydown', '.sibling-work', triggerEventAddSiblingDom);
        
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
            var isLimitedSibling = maxSibling === $('.sibling-work').size();
            if (isLimitedSibling) { 
                return;
            }
            $siblings.append(siblingTemplate);
        } //addSiblingInput

    }; //profileFormReady
})(window.jQuery);