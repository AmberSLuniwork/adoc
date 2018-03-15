(function($) {
    /**
     * The confirmForm jQuery plugin provides confirmation support for form
     * elements. If a data-confirm attribute is present on the form, then
     * the user has to confirm the action. The data-confirm attribute should
     * look like this:
     * 
     * {"title": "Title string", "msg": "Main message string", "cancel":
     * {"label": "Cancel button label string", "class": "CSS classes"}, "ok":
     * {"label": "Ok button label string", "class": "CSS classes"}}
     */
    var methods = {
        init : function(options) {
            return this.each(function() {
                var component = $(this);
                component.on('submit', function(ev) {
                    var frm = $(this);
                    if(!frm.data('confirmed')) {
                        var confirm = component.data('confirm');
                        if (confirm) {
                            ev.preventDefault();
                            var html = '<div class="reveal-modal" data-reveal="">'
                                    + '<h2>' + (confirm.title || 'Please confirm')
                                    + '</h2>' + '<p>' + confirm.msg + '</p>'
                                    + '<div class="text-right">';
                            if (confirm.cancel) {
                                html = html + '<a href="#" class="button cancel '
                                        + (confirm.cancel.class_ || '') + '">'
                                        + (confirm.cancel.label || 'Cancel')
                                        + '</a>&nbsp;';
                            }
                            if (confirm.ok) {
                                html = html + '<a href="#" class="button ok '
                                        + (confirm.ok.class_ || '') + '">'
                                        + (confirm.ok.label || 'Ok') + '</a>';
                            }
                            html = html + '</div>' + '</div>';
                            var dlg = $(html);
                            $('body').append(dlg);
                            dlg.find('a.cancel').on('click', function(ev) {
                                ev.preventDefault();
                                dlg.foundation().foundation('reveal', 'close');
                            });
                            dlg.find('a.ok').on('click', function(ev) {
                                ev.preventDefault();
                                frm.data('confirmed', true);
                                frm.submit();
                            });
                            dlg.foundation().foundation('reveal', 'open');
                            $(document).on('closed.fndtn.reveal', '[data-reveal]', function() {
                                dlg.remove();
                            });
                        }
                    }
                });
            });
        }
    };

    $.fn.confirmForm = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.confirmForm');
        }
    };
}(jQuery));
