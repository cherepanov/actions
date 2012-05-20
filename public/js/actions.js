$(function(){

    var clientBindings = {
        beacon: function(icon, data) {
            showMessage(icon.attr('title'));
        },
        clock: function(icon, data) {
            addStar(icon);
        }
    };

    var serverBindings = {
        addStar: addStar
    };

    function showMessage(text) {
        var popup = $('#popup')
        ,   message = popup.children('.message')
        ,   button  = popup.children('.dismiss');

        message.html(text);
        button.one('click', function(){
            popup.removeClass('visible');
        });
        popup.addClass('visible');
    }

    function addStar(icon, data) {
        if (icon.children('.star').length === 0) {
            icon.append('<em class="star"></em>');
        }
    }

    function removeStar(icon) {
        icon.children('.star').remove();
    }

    function doAction(icon, data) {
        var id = icon.attr('id');

        $.ajax({
            type: 'post',
            url: '/backend',
            data: $.extend({}, data, {'id': id}),
        }).success(function(jqXHR, textStatus) {
                var clientCallback = clientBindings[id]
                ,   clientAction = serverBindings[jqXHR.action];

                if (clientCallback) {
                    clientCallback(icon, data);
                }

                if (clientAction) {
                    clientAction(icon, data);
                }
        }).complete(function(jqXHR, textStatus) {
            $('body').append('<p>server response "' + textStatus + '": ' + jqXHR.responseText + '</p>');
        });
    }

    function onClick(event){
        var     icon = $(event.currentTarget)
            ,   iconTimer = icon.parent().children('em')
            ,   data = icon.data()
            ,   timeout = data.timeout
            ,   isVip = data.vip
            ,   timer = null;

        if (isVip && Application.user.type !== 'vip') {
            showMessage('Members only!');
            return;
        }

        icon.off('click');
        icon.addClass('inactive');

        doAction(icon, data);

        timer = setInterval(function() {
            timeout -= 1;
            iconTimer.html(secondsToHuman(timeout));
        }, 1000);

        setTimeout(function(){
            clearInterval(timer);
            icon.removeClass('inactive');
            iconTimer.html('');
            icon.click(onClick)
        }, timeout * 1000);
    }

    $('.action-icon').click(onClick);
});