<!doctype html>

<html lang="en"><head>
    <!-- Required meta tags -->


    <!--<title>Awarded Tenders</title>-->

    <?php include ('../includes/inc_page_metadata.php')?>
    <?php include_once ('../config/connection.php') ?>
    <?php include_once ('../functions/functions.php') ?>
</head><body>


<!-- navigation -->
<?php include ('../includes/inc_header.php')?>
<!-- nav part end -->
<?php //include('../includes/inc_pagename.php') ?>
<!-- content-->


<!--<h2 class="title">Awarded Tenders</h2>

<!--<div class="accordion">

<!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('../images/Screen Shot 2017-09-20 at 2.17.03 PM copy_0.png');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Careers</h2>
              <!--<p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>-->
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="http://localhost/Rusty/">Home</a></li>
            <li>Careers</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

                <?php $obj=new query();
                echo $obj->getTenders('vacancies');
                ?>
            </p>
        </div>
    </div>

    

</div>


<!-- footer Start -->
<?php include ('../includes/inc_footer.php')?>
<?php include ('../includes/inc_page_bottom.php')?>

</body></html>