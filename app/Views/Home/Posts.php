<?php


require './app/Views/inc/Header.php';

?>
<style>

</style>
<section class="py-6">

    <div class="container mt-5">

        <div class="row">
            <div class="col-lg-8">


                <!-- Post title-->
                <?php foreach ($post as $item) { ?>
                    <h1 class="fw-bolder mb-1"><?php echo $item['title'];  ?></h1>

             
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-5">LIVEDOC, <?php echo   date("d/m/Y", strtotime($item['created_at'])); ?></div>
                <?php break;     } ?>
                <div class="mb-5" style="text-align: justify;">

                    <?php foreach ($post as $item) {
                        echo htmlspecialchars_decode($item['content']);
                        
                    } ?>
                </div>





            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">

                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header text-center">Bài viết khác</div>
                    <div class="row p-2" style="overflow-y: scroll; height: 700px;">
                        <div class="col-12 mb-4" style="min-height: 180px;">
                            <div class="card h-100 shadow card-span rounded-3"><img class="card-img-top rounded-top-3" src="<?php echo _WEB_ROOT; ?>/public/img/gallery/covid-19.png" style="height: 100px;" alt="news" />
                                <div class="card-body">
                                    <span class="fs--1 text-900">Nov 21, 2021</span></span>
                                    <h5 class="font-base ">COVID-19: The Most Up-to-Date Information </h5>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
</body>

</html>

<?php
require './app/Views/inc/Footer.php';

?>