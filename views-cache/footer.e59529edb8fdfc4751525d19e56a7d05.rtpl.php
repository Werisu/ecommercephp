<?php if(!class_exists('Rain\Tpl')){exit;}?><script type="text/javascript">
    var socket = io('http://localhost:3000');

    function renderMessage(message){
        $('.messages').append('<div class="message"><strong>'+message.author+'</strong>: '+message.message+'</div>')
    }

    socket.on('previousMessage', function(messages){
        for(message of messages){
            //renderMessage(message);
        }
    })

    socket.on('receivedMessage', function(message){
        //renderMessage(message);
    });

    $('#chat').submit(function(event){
        event.preventDefault();

        var author = $('input[name=username]').val();
        var message = $('input[name=message]').val();

        if(author.length && message.length){
            var messageObject = {
                author: author,
                message:message,
            };

            //renderMessage(messageObject);

            socket.emit('sendMessage', messageObject);
        }
    });
</script>

</body>
</html>