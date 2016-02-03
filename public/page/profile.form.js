(function($){
    $(profileFormReady);

    function profileFormReady(){
        var maxSibling = 0 + $('[data-max-sublings]').data('max-sublings') || 1,
            siblingTemplate = $('[data-template]').data('template'),
            EVENT_ADD_SIBLING_DOM = 'sibling:add:dom',
            $siblings = $('.siblings'),
            $body = $('body');
        
        $body.on(EVENT_ADD_SIBLING_DOM, addSiblingInput);
        $body.on('keydown', '.sibling-work', triggerEventAddSiblingDom);
        
        function triggerEventAddSiblingDom(e)
        {
            var keyCode = e.keyCode || e.which; 
            var noPressTabKey = keyCode != 9;
            if (noPressTabKey) {
                return;
            }
            $body.trigger(EVENT_ADD_SIBLING_DOM);
        }

        function addSiblingInput(e) {
            var isLimitedSibling = maxSibling === $('.sibling-work').size();
            if (isLimitedSibling) { 
                return;
            }
            $siblings.append(siblingTemplate);
        }
    }; //profileFormReady
})(window.jQuery);