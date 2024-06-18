<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <button id="showChat" style="position: fixed; right: 20px; bottom: 30px;">
        <i class="bi bi-messenger text-success" style="font-size: 60px;"></i></button>


    <div class="col-lg-3" style="position: fixed; right: 10px; bottom: 0px; display: none; z-index: 100;" id="chatBox">
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border shadow">
            <div class="bg-light" style="height: 80px;">
                <div class="au-chat-info shadow-sm" style="position: relative;">
                    <div class="avatar-wrap online ">
                        <div class="avatar avatar--small" style="width: 40px;">
                            <img src="public/img/gallery/leo-mario.png" alt="John Smith">
                        </div>
                    </div>
                    <span class="nick">
                        <a href="#">John Smith</a>
                    </span>
                    <button id="closeChat" class="text-primary" style="position: absolute; right: 10px; bottom: 20%"><i
                            class="bi bi-x" style="font-size: 30px;"></i></button>
                </div>


            </div>
            <div class="au-inbox-wrap">
                <div class="au-chat au-chat--border">
                    <div class="au-chat__title">

                    </div>
                    <div class="au-chat__content au-chat__content2 js-scrollbar5">
                        <div class="recei-mess-wrap">

                            <div class="recei-mess__inner">
                                <div class="avatar avatar--tiny">
                                    <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                </div>
                                <div class="recei-mess-list">
                                    <div class="recei-mess rounded-3"><span class="mess-time">Lorem ipsum dolor sit amet
                                            elit </span>
                                        <p style="font-size: 10px; text-align: right;">12:30</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="send-mess-wrap">
                            <div class="send-mess__inner">
                                <div class="send-mess-list">
                                    <div class="send-mess rounded-3"><span class="mess-time text-light">Lorem ipsum
                                            dolor sit amet elit
                                        </span>
                                        <p style="font-size: 10px; text-align: left;">12:30</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="rounded-3 text-center m-3" style=" width: 88%; background-color: #ccc;">

                        <input class="au-input" id="chatmes" type="text" placeholder="Nhập nội dung"
                            style="height: 40px; border: none; background-color: #ccc; width: 70%;">

                        <button style="margin-right:-10%" type="button" id="sendMes"><i
                                class="bi bi-send-fill m-1 text-primary" style="font-size: 16px; "></i></button>


                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- <script>
    document.getElementById("sendMes").addEventListener('click', function () {
        var message = document.getElementById("chatmes").value;
        alert(message)
    });
</script> -->


<script>
    document.getElementById('showChat').addEventListener('click', function () {
        var chatBox = document.getElementById('chatBox');
        chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'block' : 'none';

        if (chatBox.style.display === 'block') {
            // Cuộn xuống cuối nội dung trò chuyện
            var chatContent = document.querySelector('.au-chat__content');
            chatContent.scrollTop = chatContent.scrollHeight;
        }
    });

    document.getElementById('closeChat').addEventListener('click', function () {
        var chatBox = document.getElementById('chatBox');
        chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'block' : 'none';
    });

</script>



<script>


    // Lắng nghe sự kiện khi nhấn phím Enter
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.au-input').addEventListener('keypress', function (event) {
            if (event.keyCode === 13) {
                sendMessage();
            }
        });
    });

    document.getElementById("sendMes").addEventListener('click', function () {
        sendMessage()
    });

    function sendMessage() {
        // Lấy giá trị từ input
        var message = document.querySelector('.au-input').value;

        // Tạo một element tin nhắn mới
        var newMessage = `
        <div class="send-mess-wrap">
            <div class="send-mess__inner">
                <div class="send-mess-list">
                    <div class="send-mess rounded-3"><span class="mess-time text-light">${message}
                    </span>
                        <p style="font-size: 10px; text-align: left;">${getCurrentTime()}</p>
                    </div>
                </div>
            </div>
        </div>
    `;

        // Thêm tin nhắn mới vào nội dung chat
        var chatContent = document.querySelector('.au-chat__content');
        chatContent.innerHTML += newMessage;

        // Xóa nội dung trong input
        document.querySelector('.au-input').value = '';



    }

    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        return hours + ':' + (minutes < 10 ? '0' : '') + minutes;
    }


</script>




<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c83bb20ad7db10fd6cd6', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        // alert(JSON.stringify(data));

        var content = data.message.content;

        var newMessage = `
        <div class="recei-mess__inner">
            <div class="avatar avatar--tiny">
                <img src="images/icon/avatar-02.jpg" alt="John Smith">
            </div>
            <div class="recei-mess-list">
                <div class="recei-mess rounded-3">
                    <span class="mess-time">${content}</span>
                    <p style="font-size: 10px; text-align: right;">${getCurrentTime()}</p>
                </div>
            </div>
        </div>
    `;

        // Append the new message to the chat content
        var chatContent = document.querySelector('.au-chat__content');
        chatContent.innerHTML += newMessage;

        // Clear the input field
        document.querySelector('.au-input').value = '';


        function getCurrentTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            return hours + ':' + (minutes < 10 ? '0' : '') + minutes;
        }

    });
</script>