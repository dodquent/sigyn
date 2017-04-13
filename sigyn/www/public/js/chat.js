var receiver = null;

$("ul#patients li").click(function () {
    receiver = $(this).attr('value');
});

conn.addEventListener('message', function(e) {
    addMessage(e.data);
});

function helloWorldPing() {
    conn.send('Hello World!');
}

function addMessage(message) {
    var messageTag = document.createElement('div');
    messageTag.innerHTML = message;

    console.log(message);
    document.getElementById('messages').appendChild(messageTag);
}

$(function () {
    $("form").submit(function (e) { 
        e.preventDefault();
        var url = $(this).attr("action");
        var msg = $("#message").val();
        $.ajax({
            type: "post",
            url: url,
            data: {"message": msg},
            dataType: "json",
            success: function (response) {
                $("messages").append('<li class="list-group-item">' + msg + '</li>')
            }
        });
    });
});