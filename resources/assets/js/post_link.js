(function($) {
    /**
     * The postLink jQuery plugin provides automatic submission of a standard
     * link via a POST request. If a data-wte-confirm attribute is present on
     * the link, then the user has to confirm the action. The data-wte-confirm
     * attribute should look like this:
     * 
     * {"title": "Title string", "msg": "Main message string", "cancel":
     * {"label": "Cancel button label string", "class": "CSS classes"}, "ok":
     * {"label": "Ok button label string", "class": "CSS classes"}}
     */
    var methods = {
        init : function(options) {
            return this.each(function() {
                var component = $(this);
                component.on('click', function(ev) {
                    ev.preventDefault();
                    var form_html = '<form action="'
                                    + component.attr('href')
                                    + '" method="post"><input type="hidden" name="_token" value="' + component.data('token') + '"/>';
                    if(component.data('method')) {
                        form_html = form_html + '<input type="hidden" name="_method" value="' + component.data('method') + '"/>';
                    }
                    form_html = form_html + '</form>';
                    var confirm = component.data('confirm');
                    if (confirm) {
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
                            var frm = $(form_html);
                            $('body').append(frm);
                            frm.submit();
                        });
                        dlg.foundation().foundation('reveal', 'open');
                        $(document).on('closed.fndtn.reveal', '[data-reveal]', function() {
                            dlg.remove();
                        });
                    } else {
                        var frm = $(form_html);
                        $('body').append(frm);
                        frm.submit();
                    }
                });
            });
        }
    };

    $.fn.postLink = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.postLink');
        }
    };
}(jQuery));
