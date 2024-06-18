<?php
require './app/Views/inc/HeaderAdmin.php';

?>
<div class="section__content section__content--p30">

    <h4 class="text-center"><?php echo $title; ?></h4>

    <div class="container-fluid">



        <div class="section__content section__content--p30">
            <div class="container-fluid  p-3">

                <div class="card-body" style="background-color: #fff; padding: 20px;">
                    <a class="btn btn-primary" href="<?php echo _WEB_ROOT ?>/admin/listUsersPatient">Danh sách bệnh
                        nhân</a>


                    <div class="table-responsive p-3">
                        <table class="table  table table-striped table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Chức vụ</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $data_index = 0;
                                foreach ($listPatientDelete as $index => $patient) { ?>
                                    <tr>
                                        <td id="row<?php echo $staff['id_patient']; ?>"></td>

                                        <td><?php echo $patient['full_name'] ?></td>
                                        <td><?php echo $patient['email'] ?></td>
                                        <td><?php echo $patient['name_role'] ?></td>

                                        <td>

                                            </button>
                                            <button class="btn btn-danger btn-delete-patient"
                                                data-patient-id="<?php echo $patient['id_patient'] ?>">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>

                                            <a class="btn btn-primary"
                                                href="<?php echo _WEB_ROOT ?>/admin/restorePatient/<?php echo $patient['id_patient'] ?>">Khôi
                                                phục</a>


                                            <button type="button" class="btn btn-success"
                                                data-bs-target="#inforuser<?php echo $patient['id_patient'] ?>"
                                                data-bs-toggle="modal"><i class="bi bi-eye"></i></button>

                                            <div class="modal" id="inforuser<?php echo $patient['id_patient'] ?>"
                                                tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content" style="width: 1000px">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Chi tiết đơn đặt</h5>
                                                            <button type="button" class="btn-close btn-danger"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                    <tr>
                                                                        <td>STT</td>
                                                                        <td>Ảnh</td>
                                                                        <td>Họ tên</td>
                                                                        <td>Email</td>
                                                                        <td>Số điện thoại</td>
                                                                        <td>Địa chỉ</td>
                                                                        <td>Ngày sinh</td>
                                                                        <td>Giới tính</td>
                                                                        <td>Nhóm máu</td>
                                                                        <td>Cân nặng</td>
                                                                        <td>Chiều cao</td>
                                                                        <td>Chỉ số BMI</td>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr class="text-center">

                                                                    <tr>
                                                                        <th><?php echo ++$index; ?></th>
                                                                        <th><img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $patient['image']; ?>"
                                                                                width="50px" alt=""></th>
                                                                        <th><?php echo $patient['full_name']; ?></th>
                                                                        <th><?php echo $patient['email']; ?></th>
                                                                        <th><?php echo $patient['phone']; ?></th>
                                                                        <th><?php echo $patient['address']; ?></th>
                                                                        <th><?php echo $ngay_dau_ra = date("d/m/Y", strtotime($patient['birthday'])); ?>
                                                                        </th>
                                                                        <th><?php echo $patient['gender']; ?></th>
                                                                        <th><?php echo $patient['blood_group']; ?></th>
                                                                        <th><?php echo $patient['weight']; ?></th>
                                                                        <th><?php echo $patient['height']; ?></th>
                                                                        <th><?php echo $patient['BMI']; ?></th>







                                                                    </tr>





                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>


                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<?php
require './app/Views/inc/FooterAdmin.php';

?>

<script>
    $(document).ready(function () {

        <?php foreach ($listPatientDelete as $index => $patient) { ?>
            var confirmDelete<?php echo $patient['id_patient']; ?> = "#confirmDelete<?php echo $patient['id_patient']; ?>";

        <?php } ?>

        <?php foreach ($listPatientDelete as $patient) { ?>
            $(confirmDelete<?php echo $patient['id_patient']; ?>).on('click', function () {
                var id_patient = <?php echo $patient['id_patient']; ?>

                $.ajax({
                    url: "<?php echo _WEB_ROOT ?>/admin/deleteUserPatient",
                    method: "POST",
                    data: {
                        id_patient: id_patient
                    },
                    success: function (data) {
                        console.log(data);
                        alert('xóa bệnh nhân thành công');

                    }
                })
            });
        <?php } ?>
    });
</script>


<script>
    $(document).ready(function () {
        $(".btn-delete-patient").on('click', function () {
            var id_patient = $(this).data('patient-id');
            var rowToDelete = $(this).closest('tr[data-index]'); // Tìm hàng chứa nút xóa
            confirmDelete(id_patient, rowToDelete);
        });
    });

    function confirmDelete(id_patient, rowToDelete) {
        if (confirm('Bạn chắc chắn muốn xóa vĩnh viễn chứ!')) {
            $.ajax({
                url: "<?php echo _WEB_ROOT ?>/admin/DeletePatientPermanent",
                method: "POST",
                data: { id_patient: id_patient },
                success: function (data) {
                    console.log(data);
                    rowToDelete.hide(); // Ẩn hàng khi xóa thành công
                    alert('Xóa nhân viên thành công');
                },
                error: function (xhr, status, error) {
                    console.error('Có lỗi xảy ra:', error);
                    alert('Xóa nhân viên thất bại, vui lòng thử lại.');
                }
            });
        }
    }
</script>