<?php
require './app/Views/inc/HeaderAdmin.php';

?>
<div class="section__content section__content--p30">

<h4 class="text-center"><?php   echo $title; ?></h4>

    <div class="container-fluid">

        <div class="modal fade" id="DeleteMedicine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <h3>Bạn có chắc chắn muốn xóa ?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="MedicineDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <table class="table table bordered">
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                
                <div class="card-body" style="background-color: #fff; padding: 20px;">
                    <a href="" class="btn btn-primary">Thêm nhân viên</a>

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
                                <tr>
                                    <td>1</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>Bác sĩ</td>

                                    <td>
                                        <a href="" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteMedicine">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MedicineDetail"><i class="bi bi-eye"></i></button>
                                    </td>

                                    
                                </tr>
                                


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