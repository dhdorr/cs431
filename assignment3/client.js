var pollServer = function() {
    $.get('chat.php', function(result) {
        
        if(!result.success) {
            console.log("Error polling server for new messages!");
            return;
        }
        
        $.each(result.messages, function(idx) {
            
            var chatBubble;
            
            if(this.sent_by == 'self') {
                //add color to background
                chatBubble = $('<div class="row bubble-sent pull-right" style="background-color:'+this.color+'; border-color:'+this.color+'">' + 
                               'Me:'+this.message + 
                               '</div><div class="clearfix"></div>');
            } else {
                chatBubble = $('<div class="row bubble-recv" style="background-color:'+this.color+' ; border-color:'+this.color+'">' + 
                               this.nickname+":" +this.message + 
                               '</div><div class="clearfix"></div>');
            }
            
            $('#chatPanel').append(chatBubble);
        });
        
        setTimeout(pollServer, 5000);
    });
}

$(document).on('ready', function() {
    pollServer();
    
    $('button').click(function() {
        $(this).toggleClass('active');
    });
});
//function to get passing var from url
$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}

$('#sendMessageBtn').on('click', function(event) {
    event.preventDefault();
    
    var message = $('#chatMessage').val();
    //post nickname to chat server
    var nickname = $.urlParam('nickname');
    $.post('chat.php', {
        'message' : message,
        'nickname' :  nickname
    }, function(result) {
        
        $('#sendMessageBtn').toggleClass('active');
        
        
        if(!result.success) {
            alert("There was an error sending your message");
        } else {
            console.log("Message sent!");
            $('#chatMessage').val('');
        }
    });
    
});

