// A $( document ).ready() block.
$( document ).ready(function() {


        var message = '<li class="flash-message-custom alert-success">Notification read.</li>'
        $('.flash-messages-custom').append(message);
        $('.flash-message-custom').delay(2000).fadeOut(1000);


});