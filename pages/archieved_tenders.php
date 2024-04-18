
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





<h2 class="title">Archieved Tenders</h2>

<h2 class="title">Archieved Tenders</h2>

<?php $obj=new query();
echo $obj->getArchives();
?>

   


<!-- footer Start -->
<?php include ('../includes/inc_footer.php')?>
<?php include ('../includes/inc_page_bottom.php')?>

</body></html>