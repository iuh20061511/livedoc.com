<section class="py-0 bg-secondary">
  <div class="bg-holder opacity-25"
    style="background-image:url(public/img/gallery/dot-bg.png);background-position:top left;margin-top:-3.125rem;background-size:auto;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <div class="row py-3">

      <div class="col-12 col-sm-4 col-lg-12 mb-3 order-2 order-sm-1">
        <h5 class="lh-lg  mb-4 text-light font-sans-serif">Thông tin liên hệ</h5>
        <ul class="list-unstyled mb-md-4 mb-lg-0">
          <li class="lh-lg"><a class="footer-link" href="#!">Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, TPHCM</a>
          </li>
          <li class="lh-lg"><a class="footer-link" href="#!">SĐT: 0362449211 - 0328316070</a></li>
          <li class="lh-lg"><a class="footer-link" href="#!">Email: minhhuan190102@gmail.com - ntthanh12a1@gmail.com</a>
          </li>
        </ul>
      </div>


    </div>
  </div>


  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="py-0 bg-primary">

    <div class="container">
      <div class="row justify-content-md-between justify-content-evenly py-4">
        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
          <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company, 2024</p>
        </div>

      </div>
    </div>
    <!-- end of .container-->

  </section>



</section>
</main>

<?php if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == true && $_SESSION['is_login']['id_account'] % 2 == 1) { ?>
  <button id="showChat" style="position: fixed; right: 20px; bottom: 30px;">
    <i class="bi bi-messenger text-success" style="font-size: 60px;"></i></button>
<?php } ?>

<div class="col-lg-3" style="position: fixed; right: 10px; bottom: 0px; display: none; z-index: 100;" id="chatBox">
  <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border shadow">
    <div class="bg-light" style="height: 80px;">
      <div class="au-chat-info shadow-sm" style="position: relative;">
        <div class="avatar-wrap online ">
          <div class="avatar avatar--small" style="width: 40px;">
            <img src="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png" alt="John Smith">
          </div>
        </div>
        <span class="nick">
          <span>Bệnh viên Livedoc</span>
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
          <?php foreach ($message as $mes) {
            if ($mes['id_sender'] % 2 == 0) {
              ?>
              <div class="recei-mess-wrap">
                <div class="recei-mess__inner">
                  <div class="avatar avatar--tiny">
                    <img src="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png" alt="John Smith">
                  </div>
                  <div class="recei-mess-list">
                    <div class="recei-mess rounded-3"><span class="mess-time"><?php echo $mes['content'] ?> </span>
                      <p style="font-size: 10px; text-align: right;">
                        <?php echo date("H:i", strtotime($mes['send_date'])); ?>
                      </p>
                    </div>

                  </div>
                </div>
              </div>

            <?php } else { ?>
              <div class="send-mess-wrap">
                <div class="send-mess__inner">
                  <div class="send-mess-list">
                    <div class="send-mess rounded-3"><span class="mess-time text-light"><?php echo $mes['content'] ?>
                      </span>
                      <p style="font-size: 10px; text-align: left;"><?php echo date("H:i", strtotime($mes['send_date'])); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            <?php }
          } ?>

        </div>
        <div class="rounded-3 text-center m-3" style=" width: 88%; background-color: #ccc;">

          <input class="au-input" type="text" placeholder="Nhập nội dung"
            style="height: 40px; border: none; background-color: #ccc; width: 70%;">

          <button style="margin-right:-10%" type="button" id="sendMes"><i class="bi bi-send-fill m-1 text-primary"
              style="font-size: 16px; "></i></button>


        </div>
      </div>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?php echo _WEB_ROOT; ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?php echo _WEB_ROOT; ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
<script src="<?php echo _WEB_ROOT; ?>/public/js/theme.js"></script>
<link
  href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap"
  rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"> </script>


</body>

</html>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>



  Pusher.logToConsole = true;

  var pusher = new Pusher('c83bb20ad7db10fd6cd6', {
    cluster: 'ap1'
  });
  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function (data) {
    var mess = data.message.content
    var id = data.message.id;
    if (<?php echo $_SESSION['is_login']['id_account'] ?> == id) {
      // alert(JSON.stringify(data));
      var parentElement = document.querySelector('.au-chat__content');
      var newMessage = document.createElement('div');
      newMessage.className = 'recei-mess-wrap';
      newMessage.innerHTML = `
  <div class="recei-mess__inner">
    <div class="avatar avatar--tiny">
      <img src="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png">
    </div>
    <div class="recei-mess-list">
      <div class="recei-mess rounded-3"><span class="mess-time">${mess}</span>
        <p style="font-size: 10px; text-align: right;">${getCurrentTime()}</p>
      </div>
    </div>
  </div>
`;

      parentElement.appendChild(newMessage);
    }
  });
</script>



<!-- CHAT BOX -->
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

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.au-input').addEventListener('keypress', function (event) {
      if (event.keyCode === 13) {
        sendMessage();
      }
    });
  });

  document.querySelector('#sendMes').addEventListener('click', function () {
    sendMessage();

  })

  function sendMessage() {
    var message = document.querySelector('.au-input').value;
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

    var chatContent = document.querySelector('.au-chat__content');
    chatContent.innerHTML += newMessage;
    document.querySelector('.au-input').value = '';


    $.ajax({
      url: "<?php echo _WEB_ROOT ?>/home",
      method: "POST",
      data: {
        content: message,
        id: <?php echo $_SESSION['is_login']['id_account'] ?>,
        fullname: '<?php echo $_SESSION['is_login']['fullname'] ?>',
        image: '<?php echo $_SESSION['is_login']['image'] ?>',

      },
      success: function (data) {
        console.log(data);
      }
    });
  }

  function getCurrentTime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    return hours + ':' + (minutes < 10 ? '0' : '') + minutes;
  }
</script>