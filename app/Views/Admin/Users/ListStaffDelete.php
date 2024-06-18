<?php
require './app/Views/inc/HeaderAdmin.php';

?>
<div class="section__content section__content--p30">

    <h4 class="text-center">
        <?php echo $title; ?>
    </h4>

    <div class="container-fluid">

        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="card-body" style="background-color: #fff; padding: 20px;">
                    <a class="btn btn-primary" href="<?php echo _WEB_ROOT ?>/admin/listUsersStaff">Danh sách nhân
                        viên</a>

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
                                $i = 0;
                                $data_index = 0;
                                foreach ($listStaffDelete as $index => $staff) {

                                    ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td>
                                            <?php echo $staff['full_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $staff['email'] ?>
                                        </td>
                                        <td>
                                            <?php echo $staff['name_role'] ?>
                                        </td>

                                        <td>

                                            </button>

                                            <button class="btn btn-danger btn-delete-staff"
                                                data-staff-id="<?php echo $staff['id_staff'] ?>">
                                                Xóa vĩnh viễn
                                            </button>
                                            <a href="<?php echo _WEB_ROOT ?>/admin/restoreStaff/<?php echo $staff['id_staff'] ?>"
                                                class="btn btn-primary">Khôi phục</a>



                                            <button type="button" class="btn btn-success"
                                                data-bs-target="#inforuser<?php echo $staff['id_staff'] ?>"
                                                data-bs-toggle="modal"><i class="bi bi-eye"></i></button>

                                            <div class="modal" id="inforuser<?php echo $staff['id_staff'] ?>" tabindex="-1">
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
                                                                        <td>Bộ phận</td>
                                                                        <td>Phòng ban</td>
                                                                        <td>Email</td>
                                                                        <td>Số điện thoại</td>
                                                                        <td>Ngày sinh</td>
                                                                        <td>Giới tính</td>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr class="text-center">

                                                                    <tr>
                                                                        <th>
                                                                            <?php echo ++$index; ?>
                                                                        </th>
                                                                        <th><img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $staff['image']; ?>"
                                                                                width="50px" alt=""></th>
                                                                        <th>
                                                                            <?php echo $staff['full_name']; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $staff['name_role']; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $staff['department_name']; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $staff['email']; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $staff['phone']; ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $ngay_dau_ra = date("d/m/Y", strtotime($staff['birthday'])); ?>
                                                                        </th>
                                                                        <th>
                                                                            <?php echo $staff['gender']; ?>
                                                                        </th>
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
        $(".btn-delete-staff").on('click', function () {
            var id_staff = $(this).data('staff-id');
            var rowToDelete = $(this).closest('tr[data-index]'); // Tìm hàng chứa nút xóa
            confirmDelete(id_staff, rowToDelete);
        });
    });

    function confirmDelete(id_staff, rowToDelete) {
        if (confirm('Bạn chắc chắn muốn xóa vĩnh viễn chứ!')) {
            $.ajax({
                url: "<?php echo _WEB_ROOT ?>/admin/DeleteStaffPermanent",
                method: "POST",
                data: { id_staff: id_staff },
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