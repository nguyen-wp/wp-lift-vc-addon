
function liftMakeID(length) {
    var result           = [];
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result.push(characters.charAt(Math.floor(Math.random() *  charactersLength)));
   }
   return result.join('');
}

window.addEventListener('load', function () {
    if (document.getElementById("nectar-metabox-fullscreen-rows")) {
        var liftAdminCss = '.wpb-content-layouts-container .wpb-content-layouts li:hover[data-element*=lift-] .icon-lift-adminicon { filter: invert(1) brightness(100); opacity: 1; } .wpb-content-layouts-container .wpb-content-layouts li:hover[data-element*=lift-]:after { filter: invert(1) brightness(100); }';
        var liftAdminhead = document.head || document.getElementsByTagName('head')[0];
        var liftAdminstyle = document.createElement('style');
        liftAdminhead.appendChild(liftAdminstyle);
        if (liftAdminstyle.styleSheet) {
            liftAdminstyle.styleSheet.cssText = liftAdminCss;
        } else {
            liftAdminstyle.appendChild(document.createTextNode(liftAdminCss));
        }
    }
})
jQuery( document ).ready(function() {
    var value = jQuery('.lift_admin_autogen_id input');
    if(value.length && value.val().length < 1){
        value.val(liftMakeID(10))
    }
});
jQuery(function() {
    var value = jQuery('.lift_admin_autogen_id input');
    if(value.length && value.val().length < 1){
        value.val(liftMakeID(10))
    }
});

jQuery('#vc_ui-panel-edit-element').bind('DOMSubtreeModified', function(e) {
    var value = jQuery('.lift_admin_autogen_id input');
    if(value.length && value.val().length < 1){
        value.val(liftMakeID(10))
    }
});