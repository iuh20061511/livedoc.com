<?php
require './app/Views/inc/HeaderAdmin.php';

?>

<div class="section__content section__content--p30">
    <h4 class="text-center">
        <?php echo $title; ?>
    </h4>




    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="card-body" style="background-color: #fff; padding: 20px;">
                <a href="<?php echo _WEB_ROOT; ?>/admin/addMedicine" class="btn btn-primary">Thêm thuốc mới</a>

                <div class="table-responsive p-3">
                    <table class="table table table-striped table-hover" id="dataTable">

                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thuốc</th>
                                <th>Loại thuốc</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>

                        <tbody class="main">

                            <?php

                            $i = 0;
                            foreach ($listMedicine as $medicine) {

                                ?>


                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        <?php echo $medicine['name_medicine']; ?>
                                    </td>
                                    <td>
                                        <?php echo $medicine['name_type_medicine']; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo _WEB_ROOT ?>/admin/updatemedicine/<?php echo $medicine['id_medicine']; ?>"
                                            class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                        </button>

                                        <button class="btn btn-danger btn-delete-medicine"
                                            data-medicine-id="<?php echo $medicine['id_medicine']; ?>">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#MedicineDetail<?php echo $medicine['id_medicine']; ?>"><i
                                                class="bi bi-eye"></i></button>

                                        <div class="modal fade" id="MedicineDetail<?php echo $medicine['id_medicine']; ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true" style="margin-top: 100px;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="width: 600px">

                                                    <div class="modal-body">
                                                        <table class="table table bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td>Tên thuốc</td>
                                                                    <td>Ngày sản xuất</td>
                                                                    <td>Hạn sử dụng</td>
                                                                    <td>Đơn vị</td>
                                                                    <td>Giá</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th>
                                                                        <?php echo $medicine['name_medicine']; ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php echo $medicine['date_manufacture']; ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php echo $medicine['expiry']; ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php echo $medicine['unit']; ?>
                                                                    </th>
                                                                    <th>
                                                                        <?php echo $medicine['medicine_price']; ?>
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                    </div>
                    </tr>




                    <?php

                            }
                            ?>




                </tbody>
                </table>
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
        $(".btn-delete-medicine").on('click', function () {
            var id_medicine = $(this).data('medicine-id');
            var rowToDelete = $(this).closest('tr[data-index]'); // Tìm hàng chứa nút xóa
            confirmDelete(id_medicine, rowToDelete);
        });
    });

    function confirmDelete(id_medicine, rowToDelete) {
        if (confirm('Bạn chắc chắn muốn xóa vĩnh viễn chứ!')) {
            $.ajax({
                url: "<?php echo _WEB_ROOT ?>/admin/deletemedicine",
                method: "POST",
                data: { id_medicine: id_medicine },
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