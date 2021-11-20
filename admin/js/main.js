$(document).ready(function(){
	function countMessages() {
        const count_message = 0;
        $.ajax({
            url: "src/countMessages.php",
            method: "POST",
            data: {
                'count_message': count_message,
            },
            success: function(data) {
                $("#message_count").html(data);
            }
        })
    }
    countMessages();

    $(document).on('click', '#messagesDropdown', function(event){
        event.preventDefault();
        const update_message = 1;
        $.ajax({
            url: "src/countMessages.php",
            method: "POST",
            data: {
                'update_message': update_message,
            },
            success: function(data) {
                $("#message_count").html(data);
            }
        })

    });

    function GetMessages() {
        const GetMessages = "GetMessages";
        $.ajax({
            url: "src/countMessages.php",
            method: "POST",
            data: {
                'GetMessages': GetMessages,
            },
            success: function(data) {
                $("#message_list").html(data);
            }
        })
    }
    GetMessages();
});