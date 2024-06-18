<?php
require './app/Views/inc/HeaderAdmin.php';

?>

<body>
    <main class="content">
        <div class="container p-0">

            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right chatmess">

                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                </div>

                            </div>
                        </div>
                        <?php foreach ($message as $item) { ?>
                            <a href="<?php echo _WEB_ROOT; ?>/admin/message/<?php echo $item['id_patient'] ?>"
                                class="list-group-item list-group-item-action border-0">
                                <?php $url = basename($_GET['url']);
                                if ($url != $item['id_patient']) { ?>
                                    <div class="badge bg-success float-right">
                                        <?php echo $item['message_count'] ?>
                                    </div>
                                <?php } ?>
                                <div class="d-flex align-items-start">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $item['image'] ?>"
                                        class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                    <div class="flex-grow-1 ml-3">
                                        <?php echo $item['full_name'] ?>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>



                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <?php if (isset($patient[0])) { ?>
                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                <div class="d-flex align-items-center py-1">
                                    <div class="position-relative">
                                        <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $patient[0]['image'] ?>"
                                            class="rounded-circle mr-1" alt="" width="40" height="40">
                                    </div>
                                    <div class="flex-grow-1 pl-3">
                                        <strong><?php echo $patient[0]['full_name'] ?></strong>
                                    </div>
                                    <div>
                                        <a href="tel:<?php echo $patient[0]['phone'] ?>"
                                            style="text-decoration: none; margin-right:20px;"><i
                                                class="bi bi-telephone-fill text-primary"></i></a>
                                        <a href="" style="text-decoration: none;"><i
                                                class="bi bi-info-circle text-primary"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative">
                                <div class="chat-messages p-4" id="chatMessages"
                                    style="height: 450px;  overflow-y: scroll;">
                                    <?php foreach ($messagePatient as $mes) {
                                        if ($mes['id_sender'] % 2 == 0) {
                                            ?>

                                            <div class="chat-message-right mb-1">
                                                <div>
                                                    <img src="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png"
                                                        class="rounded-circle mr-1" alt="" width="40" height="40">

                                                </div>
                                                <div class="flex-shrink-1 bg-primary rounded py-2 px-3 mr-3 mt-1 shadow-lg">
                                                    <span><?php echo $mes['content'] ?></span>
                                                    <div class="text-light  small text-nowrap mt-2 text-end">
                                                        <?php echo date("H:i", strtotime($mes['send_date'])); ?>


                                                    </div>
                                                </div>
                                            </div><br>

                                        <?php } else { ?>
                                            <div class="chat-message-left pb-1">
                                                <div class="float-end">
                                                    <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $mes['image'] ?>"
                                                        class="rounded-circle mr-1" alt="" width="40" height="40">
                                                </div><br><br>
                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3 shadow-lg">
                                                    <span><?php echo $mes['content'] ?></span>
                                                    <div class="text-dark small text-nowrap mt-2">
                                                        <?php echo date("H:i", strtotime($mes['send_date'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>

                                </div>
                            </div>

                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="input-group">
                                    <input id="messageInput" type="text" class="form-control"
                                        placeholder="Type your message">
                                    <button id="sendMessageBtn" class="btn btn-primary submit">Gửi</button>

                                </div>
                            </div>

                        <?php } else {
                            echo "<h3 class='text-center mt-3'>Chọn người dùng để chat<h3>";
                        } ?>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>

</html>
<?php
require './app/Views/inc/FooterAdmin.php';

?>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Function to send message
    function sendMessage() {
        var message = document.getElementById("messageInput").value;
        var messageElement = document.createElement("div");
        messageElement.classList.add("chat-message-right", "pb-4");
        messageElement.innerHTML = `
        <div class="float-end">
            <img src="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png"
                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
        </div><br><br>
        <div class="flex-shrink-1 bg-primary rounded py-2 px-3 ml-3 mr-3 shadow-lg">
            ${message}
            <div class="text-light small text-nowrap mt-2">${getCurrentTime()}</div>
        </div>
    `;
        var chatMessages = document.getElementById("chatMessages");
        if (chatMessages) {
            chatMessages.appendChild(messageElement);
            document.getElementById("messageInput").value = "";
            chatMessages.scrollTop = chatMessages.scrollHeight;
        } else {
            console.error("Element with id 'chatMessages' not found.");
        }

        // Return the message to use in AJAX call
        return message;
    }

    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var timeString = hours + ':' + minutes;
        return timeString;
    }

    document.addEventListener("DOMContentLoaded", function () {
        function sendMessageAndPost() {
            var message = sendMessage(); // Get the message here
            $.ajax({
                url: "<?php echo _WEB_ROOT ?>/admin/Postmessage/<?php echo $id_patient ?>",
                method: "POST",
                data: {
                    content: message,
                    id: <?php echo $id_patient ?>
                },
                success: function (data) {
                    console.log(data);
                }
            });
        }

        document.getElementById("messageInput").addEventListener("keydown", function (event) {
            // Check if the pressed key is "Enter"
            if (event.key === "Enter") {
                event.preventDefault();
                sendMessageAndPost();
            }
        });

        document.getElementById("sendMessageBtn").addEventListener("click", sendMessageAndPost);
    });

</script>

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('ba446993eba998736b81', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        var mesPatient = data.message.content;
        var id = data.message.id;
        if (<?php echo $id_patient ?> == id) {

            var parentElement = document.querySelector('.chat-messages');
            var newMessage = document.createElement('div');
            newMessage.innerHTML = `
                                <div class="chat-message-left pb-1">
                                    <div class="float-end">
                                        <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $item['image'] ?>"
                                            class="rounded-circle mr-1" alt="" width="40" height="40">
                                    </div><br><br>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3  shadow-lg">
                                        <span>${mesPatient}</span>
                                        <div class="text-dark small text-nowrap mt-2">
                                            ${getCurrentTime()}
                                        </div>
                                    </div>
                                </div>
                            `;
            parentElement.appendChild(newMessage);

        }

    });


    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        return hours + ':' + (minutes < 10 ? '0' : '') + minutes;
    }
</script>