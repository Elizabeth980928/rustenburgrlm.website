
<!doctype html>

<html lang="en"><head>
    <!-- Required meta tags -->


    

    <?php include ('../includes/inc_page_metadata.php')?>
    <?php include_once ('../config/connection.php') ?>
    <?php include_once ('../functions/functions.php') ?>
</head><body>


<!-- navigation -->
<?php include ('../includes/inc_header.php')?>
<!-- nav part end -->

<!-- content-->


<!--<h2 class="title">Maps & GIS</h2>-->

 <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('../images/Screen Shot 2017-09-20 at 2.17.03 PM copy_0.png');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Maps & GIS</h2>
              <!--<p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>-->
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="http://localhost/Rusty/">Home</a></li>
            <li>Maps & GIS</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->






<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Street Maps</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Ward Maps</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Zoning & Infrastructure</a>
  </li>
</ul>

<div class="tab-content pt-5" id="tab-content">
  <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
  <?php $obj=new query();
                echo $obj->getDocuments('street_maps');
                ?>
  </div>
  <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
  <?php $obj=new query();
                echo $obj->getDocuments('ward_maps');
                ?>
  </div>
  <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">
  <?php $obj=new query();
                echo $obj->getDocuments('zoning_infrastructure');
                ?>
  </div>
</div>

</div>



   


<!-- footer Start -->
<?php include ('../includes/inc_footer.php')?>
<?php include ('../includes/inc_page_bottom.php')?>

</body></html>