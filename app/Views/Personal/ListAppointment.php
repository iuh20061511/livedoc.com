<?php
require './app/Views/inc/HeaderPersonal.php';
?>
<main id="main" class="main">

    <div class="container-fluid px-4 calendar">
        <div class="table-responsive p-3">
            <a href="<?php echo _WEB_ROOT ?>/Personal/listAppointment"><button class="btn-primary">Tất cả</button></a>
            <a href="<?php echo _WEB_ROOT ?>/Personal/listAppointment/0"><button class="btn-danger">Chưa
                    khám</button></a>
            <a href="<?php echo _WEB_ROOT ?>/Personal/listAppointment/1"><button class="btn-success">Đã
                    khám</button></a>


            <table class="table table table-striped table-hover table-bordered" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th><span>Thời gian khám</span></th>
                        <th>Lịch khám
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($appointment as $item) { ?>
                        <tr>
                            <td>
                                <span style="text-align: center;">
                                    <?php echo date("d/m/Y", strtotime($item['appointmentDate'])); ?>
                                </span>
                            </td>
                            <td>
                                <div class="container p-2 bg-body shadow-lg p-3 mb-5 bg-body rounded">
                                    <div class="border-bottom">
                                        <?php if ($item['check'] == 1) { ?>
                                            <span class="badge bg-success mb-3 p-1" style="font-size: 10px;">
                                                <i class="bi bi-check-circle m-1"></i>Đã khám</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger mb-3 p-1" style="font-size: 10px;">
                                                <i class="bi bi-exclamation-circle m-1"></i>Chưa khám</span>
                                        <?php } ?>
                                        <?php if ($item['check'] == 0) { ?>
                                            <button type="button" data-bs-toggle="modal" class="btn-danger rounded-1 float-end"
                                                data-bs-target="#Modal<?php echo $item['id_appointment'] ?>">
                                                <i class="bi bi-trash"></i> Hủy lịch
                                            </button>
                                        <?php } ?>

                                        <div class="modal fade" id="Modal<?php echo $item['id_appointment'] ?>"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <b>Bạn chắn chắn hủy lịch khám vào ngày
                                                            <?php echo date("d/m/Y", strtotime($item['appointmentDate'])); ?></b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-danger"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <a
                                                            href="<?php echo _WEB_ROOT ?>/Personal/deleteAppointment/<?php echo $item['id_appointment'] ?>"><button
                                                                type="button" class="btn-success">Xác
                                                                nhận</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Bác sĩ</th>
                                                <th>Khoa</th>
                                                <th>giờ khám</th>
                                                <th>Tòa nhà</th>
                                                <th>Phòng khám</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-info">
                                                <td>
                                                    <?php echo $item['staffFullname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $item['department_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo date("H:i", strtotime($item['hour'])) ?>
                                                </td>
                                                <td>A4</td>
                                                <td>A4.5</td>
                                                <td>
                                                    <?php if ($item['check'] == 0) { ?>
                                                        <button type="button" data-bs-toggle="modal"
                                                            class="btn-warning rounded-1"
                                                            data-bs-target="#appointment<?php echo $item['id_appointment'] ?>">
                                                            Xem
                                                        </button>
                                                    <?php } else {
                                                        foreach ($medical_bill as $bill) {
                                                            if ($bill['id_appointment'] == $item['id_appointment']) {

                                                                ?>
                                                                <a href="<?php echo _WEB_ROOT ?>/Personal/medicalBillPDF/<?php echo $bill['id_record'] ?>"
                                                                    type="button" class="p-1 btn-primary rounded-1">Phiếu
                                                                    khám</a>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </td>

                                                <div class="modal fade"
                                                    id="appointment<?php echo $item['id_appointment'] ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="width: 900px; ">

                                                            <div class="modal-body text-center text-dark">
                                                                <div class="row">
                                                                    <div class="col-6 text-start">
                                                                        <span class="text-primary"><b>Bệnh viện đa khoa
                                                                                LIVEDOC</b> </span>
                                                                        <p>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp,
                                                                            TPHCM</p>

                                                                    </div>
                                                                    <div class="col-6">
                                                                        <span>Cộng hòa xã hội chủ nghĩa Việt
                                                                            Nam</span> <br>
                                                                        <span class="border-bottom"> Độc lập - Tự do -
                                                                            Hạnh phúc</span>
                                                                    </div>
                                                                    <div class="text-end ">
                                                                        <a href="<?php echo _WEB_ROOT ?>/Personal/listAppointmentPDF/<?php echo $item['id_appointment'] ?>"
                                                                            class="text-danger">
                                                                            <i class="bi bi-download"></i>
                                                                            <span>Tải phiếu </span>
                                                                        </a>

                                                                    </div>



                                                                </div>
                                                                <hr>
                                                                <h3 class="m-3">GIẤY KHÁM BỆNH</h3>
                                                                <p style="font-size: 10px; margin-top: -20px">(Tòa A Phòng
                                                                    A4.<?php echo $item['id_staff'] ?>)</p>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <img style="width: 160px;"
                                                                            src="<?php echo _WEB_ROOT ?>/public/img/users/<?php echo $item['patientImage'] ?>"
                                                                            alt="ảnh">
                                                                    </div>
                                                                    <div class="text-start col-9">
                                                                        <span>Họ và tên:
                                                                            <?php echo $item['fullNamePatient'] ?>
                                                                        </span><br>
                                                                        <span>giới tính:
                                                                            <?php echo $item['genderPatient'] ?>
                                                                        </span><br>
                                                                        <span>Năm sinh:
                                                                            <?php echo date("d/m/Y", strtotime($item['patientBirthday'])); ?>
                                                                        </span><br>
                                                                        <span>Chỗ ở: </span><br>
                                                                        <span>Triệu chứng:
                                                                            <?php echo $item['describe_problem'] ?>
                                                                        </span><br>

                                                                    </div>
                                                                    <h5>TIỀN SỬ CỦA ĐỐI TƯỢNG KHÁM SỨC KHỎE</h5>
                                                                    <p class="text-start"><b>1. Tiền sử gia đình</b></p>
                                                                    <span class="text-start">Có ai trong gia đình ông
                                                                        (bà) mắc một trong các bệnh: truyền nhiễm,
                                                                        tim mạch, đái tháo đường, ung thư,
                                                                        động kinh, rối loạn tâm thần:
                                                                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &#9744; Có
                                                                        &emsp;&emsp;&emsp; &#9744; Không
                                                                        &emsp;&emsp;&emsp; &#9744; Nếu có đề nghi ghi cụ
                                                                        thể tên
                                                                        bệnh.................................................
                                                                        ...........................................................................................................................................................................................................
                                                                    </span>

                                                                    <p class="text-start"><b>2. Tiền sử bản thân</b></p>
                                                                    <span class="text-start">Ông (bà) có đã đang mắc
                                                                        một trong các bệnh: truyền nhiễm, tim mạch,
                                                                        đái tháo đường, ung thư,
                                                                        động kinh, rối loạn tâm thần:
                                                                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &#9744; Có
                                                                        &emsp;&emsp;&emsp; &#9744; Không
                                                                        &emsp;&emsp;&emsp; &#9744; Nếu có đề nghi ghi cụ
                                                                        thể tên
                                                                        bệnh.........................................................
                                                                        ...........................................................................................................................................................................................................
                                                                    </span>

                                                                    <p class="text-start"><b>3. Câu hỏi khác (nếu
                                                                            có)</b></p>
                                                                    <span class="text-start">Ông (bà) có đang điều trị
                                                                        bệnh gì không. Nếu có hãy liệt kê các thuốc
                                                                        và liều lượng đang dùng:
                                                                        ...........................................................................................................................................................................................................
                                                                        ...........................................................................................................................................................................................................
                                                                    </span>

                                                                    <div class="col-4">
                                                                        <p class="text-start">Tôi xin cam đoan những điều
                                                                            khai trên đây,
                                                                            hoàn toàn đúng với sự thật theo hiểu
                                                                            biết của tôi</p>
                                                                    </div>
                                                                    <div class="col-2">

                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>..........Ngày.........tháng.........Năm.........
                                                                        </p>
                                                                        <h6>Đề nghị khám sức khỏe</h6>
                                                                        <span>(Ký rõ họ và tên)</span>
                                                                    </div>
                                                                    <div style="height: 100px;">

                                                                    </div>
                                                                    <span class="text-start" style="font-size: 10px;">* Vui
                                                                        lòng in phiếu trước khi đến khám bệnh</span>
                                                                    <hr>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>
        <div>





        </div>

        </li>
    </div>
</main>
<?php

require './app/Views/inc/FooterPersonal.php';

?>