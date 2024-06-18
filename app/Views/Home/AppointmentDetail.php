<?php
require './app/Views/inc/Header.php';




?>

<style>

</style>

<section class="py-7" style="margin-bottom: 200px;">
  <h1 class="text-center">CHỌN THỜI GIAN KHÁM</h1>
  <div class="container">
    <div class="row">

      <div class="col-lg-6 z-index-2">
        <?php require 'Calendar.php'; ?>
      </div>
      <div class="col-lg-6 z-index-2" style="margin-top:70px;">
        <form class="row g-3" action="<?php echo _WEB_ROOT ?>/home/appointmentDetail" method="POST">


          <input type="hidden" name="department" value="<?php echo $_SESSION['appointment']['department'] ?>">
          <input type="hidden" name="doctor" value="<?php echo $_SESSION['appointment']['doctor'] ?>">
          <input type="hidden" name="date" value="<?php if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
            echo "{$_GET['year']}-{$_GET['month']}-{$_GET['day']}";
          } ?>">
          <div class="col-md-12 bg-primary p-2 rounded">
            <p class="text-center text-light display-5">
              <?php
              if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {
                $year = $_GET['year'];
                $month = $_GET['month'];
                $day = $_GET['day'];

                echo "Ngày $day/$month/$year";
              } elseif (isset($_GET['month']) && isset($_GET['year'])) {
                $month = $_GET['month'];
                $year = $_GET['year'];
                echo "Tháng $month/$year";

              } else {
                echo "Ngày " . date("d/m/Y");
              }
              ?>
            </p>
          </div>

          <div class="col-md-5">

            <div class="col-md-12 row ">
              <?php if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {

                ?>
                <table class="table">

                  <tr>
                  <tr>
                    <?php
                    $hours = array(
                      '7h30' => '07:30:00',
                      '8h' => '08:00:00',
                      '8h30' => '08:30:00',
                      '9h' => '09:00:00',
                      '9h30' => '09:30:00',
                      '10h' => '10:00:00',
                      '10h30' => '10:30:00',
                      '11h' => '11:00:00',
                      '13h30' => '13:30:00',
                      '14h' => '14:00:00',
                      '14h30' => '14:30:00',
                      '15h' => '15:00:00',
                      '15h30' => '15:30:00',
                      '16h' => '16:00:00',
                      '16h30' => '16:30:00',
                      '17h' => '17:00:00'
                    );
                    $count = 0; // Đếm số lượng cột đã hiển thị
                    foreach ($hours as $index => $hour) {
                      $disabled = 'cursor: pointer;';
                      $class = 'border border-primary rounded p-1';
                      $strike = '';

                      if (!empty($appointment)) {
                        foreach ($appointment as $item) {
                          if ($item['hour'] == $hour) {
                            $disabled = 'pointer-events: none;';
                            $class = 'border rounded p-1';
                            $strike = 'text-decoration-line-through text-light ';
                            break;
                          }
                        }
                      }
                      ?>
                      <td>
                        <div id="appointtime<?php echo $index; ?>" class="border <?php echo $class; ?>"
                          style="<?php echo $disabled; ?>">
                          <input id="hour<?php echo $index; ?>" class="form-check-input" type="radio" name="hour"
                            value="<?php echo $hour; ?>" style="<?php echo $disabled; ?>">
                          <span id="time<?php echo $index; ?>" class="fw-bold <?php echo $strike; ?>">
                            <?php echo date('H:i', strtotime($hour)); ?>
                          </span>
                        </div>
                      </td>
                      <?php
                      $count++;
                      if ($count == 2) {
                        echo '</tr><tr>'; // Đóng hàng hiện tại và mở hàng mới sau khi hiển thị hai cột
                        $count = 0; // Reset số lượng cột
                      }
                    }
                    ?>
                  </tr>

                  </tr>



                </table>
              <?php } ?>
            </div>
          </div>
          <?php if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) { ?>

            <div class="col-sm-12 col-md-7 text-center">

              <textarea id="" cols="45" class="rounded border" rows="3" name="describe_problem"
                placeholder=" Nhập vấn đề hiện tại của bạn..."></textarea>

              <div class="" style="margin-top: 5%; ">
                <input type="submit" value="Đặt lịch" class="btn btn-primary rounded-pill" name="appointmentDetail">

              </div>
            </div>
          <?php } ?>



        </form>


      </div>
    </div>
  </div>
</section>


<?php
require './app/Views/inc/Footer.php';

?>




<script>


  Pusher.logToConsole = true;

  var pusher = new Pusher('be39c21145a308bb822e', {
    cluster: 'ap1'
  });
  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function (data) {
    // alert(JSON.stringify(data));
    var hour = data["hour"];
    var date = data["date"];
    var doctor = data["doctor"];

    var year = <?php echo $_GET['year'] ?>;
    var month = <?php echo $_GET['month'] ?>;
    var day = <?php echo $_GET['day'] ?>;
    var bsi = <?php echo $_SESSION['appointment']['doctor'] ?>;





    var YearMonthDay = year + '-' + month + '-' + day;



    if (date == YearMonthDay && doctor == bsi) {

      var timeSlots = [
        { hour: '07:30:00', appoint: '#appointtime7h30', time: '#time7h30', hourSelector: '#hour7h30' },
        { hour: '08:00:00', appoint: '#appointtime8h', time: '#time8h', hourSelector: '#hour8h' },
        { hour: '08:30:00', appoint: '#appointtime8h30', time: '#time8h30', hourSelector: '#hour8h30' },
        { hour: '09:00:00', appoint: '#appointtime9h', time: '#time9h', hourSelector: '#hour9h' },
        { hour: '09:30:00', appoint: '#appointtime9h30', time: '#time9h30', hourSelector: '#hour9h30' },
        { hour: '10:00:00', appoint: '#appointtime10h', time: '#time10h', hourSelector: '#hour10h' },
        { hour: '10:30:00', appoint: '#appointtime10h30', time: '#time10h30', hourSelector: '#hour10h30' },
        { hour: '11:00:00', appoint: '#appointtime11h', time: '#time11h', hourSelector: '#hour11h' },
        { hour: '13:30:00', appoint: '#appointtime13h30', time: '#time13h30', hourSelector: '#hour13h30' },
        { hour: '14:00:00', appoint: '#appointtime14h', time: '#time14h', hourSelector: '#hour14h' },
        { hour: '14:30:00', appoint: '#appointtime14h30', time: '#time14h30', hourSelector: '#hour14h30' },
        { hour: '15:00:00', appoint: '#appointtime15h', time: '#time15h', hourSelector: '#hour15h' },
        { hour: '15:30:00', appoint: '#appointtime15h30', time: '#time15h30', hourSelector: '#hour15h30' },
        { hour: '16:00:00', appoint: '#appointtime16h', time: '#time16h', hourSelector: '#hour16h' },
        { hour: '16:30:00', appoint: '#appointtime16h30', time: '#time16h30', hourSelector: '#hour16h30' },
        { hour: '17:00:00', appoint: '#appointtime17h', time: '#time17h', hourSelector: '#hour17h' }
      ];

      for (var i = 0; i < timeSlots.length; i++) {
        if (hour == timeSlots[i].hour) {
          $(timeSlots[i].appoint).removeClass("border-primary");
          $(timeSlots[i].time).addClass("text-decoration-line-through text-light");
          $(timeSlots[i].hourSelector).css('pointer-events', 'none');
          break;
        }
      }


    }

  });
</script>