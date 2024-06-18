<?php


require './app/Views/inc/HeaderAdmin.php';

?>
<div class="container mt-5">
    <form action="<?php echo _WEB_ROOT; ?>/admin/addPostsInsert" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">


                <!-- Post title-->
                <h1 class="fw-bolder mb-1"><input type="text" name="title" id="" placeholder="Nhập tiêu đề bài viết..." style="border: none; width: 100%; font-weight: 700;"></h1>
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-2">LIVEDOC, <?php echo $ngayThangNam = date("\\n\g\à\y d/m/Y"); ?></div>




                <section class="mb-5" id="contents">





                </section>



            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">

                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li id="addContent" class="text-center">
                                        <h4><i class="bi bi-type-italic text-primary"></i></h4>
                                        <p>Nội dung</p>
                                    </li>
                                    <li id="addImage" class="text-center">
                                        <h4><i class="bi bi-image text-danger"></h4></i>
                                        <p>Hình ảnh</p>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li id="addTitle" class="text-center">
                                        <h4><i class=" bi bi-fonts text-dark"></i></h4>
                                        <p>Tiêu đề</p>
                                    </li>
                                    <li id="addFile" class="text-center">
                                        <h4><i class="bi bi-file-earmark-arrow-up-fill text-success"></i></h4>
                                        <p>Upload file</p>
                                    </li>

                                </ul>
                            </div>
                            <input type="submit" value="Thêm bài viết" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>

<script>
    // Khai báo biến đếm ban đầu
    var contentCounter = 1;

    document.getElementById("addContent").addEventListener('click', function() {
        var tableBody = document.querySelector('#contents');
        var newRow = document.createElement("div");

        newRow.innerHTML = `
            <p class="fs-5 mb-4">  
               
              <i class="bi bi-trash trashContent text-danger"  style="cursor: pointer;"></i>
              <textarea class="dynamicTextarea col-12" cols="30" rows="1" name="addContent${contentCounter}"  placeholder="Nhập nội dung..." style="border: none;"></textarea>
            </p>`;
        tableBody.appendChild(newRow);

        var newTextarea = newRow.querySelector('.dynamicTextarea');
        newTextarea.addEventListener("input", function() {
            var lines = this.value.split('\n').length;
            if (lines > 1) {
                this.rows = lines;
            } else {
                this.rows = 1;
            }
        });

        newTextarea.addEventListener("input", function() {
            var scrollHeight = this.scrollHeight;
            this.rows = Math.ceil(scrollHeight / 32);
        });

        // Add event listener to the trash icon of the newly created row
        var trashIcon = newRow.querySelector('.trashContent');
        trashIcon.addEventListener('click', function() {
            newRow.remove(); // Remove the entire row when trash icon is clicked
        });

        // Tăng giá trị của biến đếm sau khi thêm một nội dung mới
        contentCounter++;
    });
</script>


<script>
    var imageCounter = 1;

    document.getElementById("addImage").addEventListener("click", function() {
        var tableBody = document.querySelector('#contents');
        var newRow = document.createElement("div");
        newRow.innerHTML = `
            <p class="fs-5 mb-4"> 
                <i class="bi bi-trash trashImage text-danger"   style="cursor: pointer;"></i>
                <input type="file" class="form-control fileInput" id="fileInput" name="addImgae${imageCounter}"  aria-describedby="fileHelp">
                <img class="previewImage" src="#" alt="Preview" style="width: 100%;">
            </p>`;

        tableBody.appendChild(newRow);

        // Gắn sự kiện cho input type="file" trong div mới
        var fileInput = newRow.querySelector('.fileInput');
        var previewImage = newRow.querySelector('.previewImage');

        fileInput.addEventListener('change', function(event) {
            var file = event.target.files[0]; // Lấy file được chọn

            // Kiểm tra xem file có phải là file ảnh hay không
            if (file.type.match('image.*')) {
                var reader = new FileReader(); // Tạo đối tượng FileReader

                reader.onload = function(event) {
                    previewImage.src = event.target.result; // Hiển thị hình ảnh trên thẻ <img>
                };

                reader.readAsDataURL(file); // Đọc file như là một URL dữ liệu
            } else {
                // Nếu file không phải là ảnh, thông báo cho người dùng
                alert("Vui lòng chọn một file ảnh.");
                // Đặt giá trị của trường input file về null để xóa file không phải là ảnh
                fileInput.value = null;
                // Xóa hình ảnh trên thẻ <img> nếu có
                previewImage.src = "";
            }
        });

        imageCounter++;
        var trashIcon = newRow.querySelector('.trashImage');
        trashIcon.addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>


<script>
    var titleCounter = 1;
    document.getElementById("addTitle").addEventListener('click', function() {
        var tableBody = document.querySelector('#contents');
        var newRow = document.createElement("div");

        newRow.innerHTML = `
            <p class="fs-5 mb-4">    
              <i class="bi bi-trash trashTitle text-danger" style="cursor: pointer;"></i>
              <input type="tel" class="dynamicTextarea col-12" name="addTitle${titleCounter}" id=""   placeholder="Nhập tiêu đề..." style="border: none;font-weight: 700;font-size: 26px; ">  
            </p>`;
        tableBody.appendChild(newRow);

        var newTextarea = newRow.querySelector('.dynamicTextarea');
        newTextarea.addEventListener("input", function() {
            var lines = this.value.split('\n').length;
            if (lines > 1) {
                this.rows = lines;
            } else {
                this.rows = 1;
            }
        });
        titleCounter++;
        newTextarea.addEventListener("input", function() {
            var scrollHeight = this.scrollHeight;
            this.rows = Math.ceil(scrollHeight / 32);
        });


        var trashIcon = newRow.querySelector('.trashTitle');
        trashIcon.addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>


<script>
    var fileCounter = 1;
    document.getElementById("addFile").addEventListener('click', function() {
        var tableBody = document.querySelector('#contents');
        var newRow = document.createElement("div");

        newRow.innerHTML = `
            <p class="fs-5 mb-4">    
              <i class="bi bi-trash trashFile text-danger" style="cursor: pointer;"></i>
              <input type="file" class="form-control fileInput" id="fileInput" name="addFile${fileCounter}"  aria-describedby="fileHelp">
              
            </p>`;
        tableBody.appendChild(newRow);


        fileCounter++;



        var trashIcon = newRow.querySelector('.trashFile');
        trashIcon.addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>

<?php
require './app/Views/inc/FooterAdmin.php';
?>
<?php
// echo "<pre>";
// print_r($_POST);

//    $arr =  array_keys($_POST);
