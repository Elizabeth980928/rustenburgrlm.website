<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


<?php require_once('menu.php'); ?>
<body>
<form method="post" enctype="multipart/form-data" id="text-options"> 
    <div id="wrapper">
        <div id="page-wrapper"><Br/>
            <fieldset>
                <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3"><center>PFMA/MFMA</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Description</th><th>Date Uploaded</th><th>Uploaded By</th>
                                </tr>
                                <?php
                                    $getPFMA = "SELECT description,filepath,date_uploaded,uploaded_by FROM pfma ORDER BY id DESC LIMIT 10";
                                    $exe = mysql_query($getPFMA);
                                    while($row = mysql_fetch_array($exe)){
                                    ?>
                                    <tr><td><?php echo "<a href='$row[1]' target='_blank'> $row[0]</a>"; ?> </td><td><?php echo $row[2]; ?> </td><td><?php echo $row[3]; ?> </td></tr>

                                    <?php } ?>
                                    
                                
                            </tbody>
                    </table>
                </div>
                
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3"><center>Tenders</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Description</td><td>Date Uploaded</td><td>Uploaded By</td>
                                </tr>
                                <?php
                                    $getPFMA = "SELECT description,filepath,date_uploaded,uploaded_by FROM tenders ORDER BY id DESC LIMIT 10";
                                    $exe = mysql_query($getPFMA);
                                    while($row = mysql_fetch_array($exe)){
                                    ?>
                                    <tr><td><?php echo "<a href='$row[1]' target='_blank'> $row[0]</a>"; ?> </td><td><?php echo $row[2]; ?> </td><td><?php echo $row[3]; ?> </td></tr>

                                    <?php } ?>
                            </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3"><center>Careers</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Description</td><td>Date Uploaded</td><td>Uploaded By</td>
                                </tr>
                                <?php
                                    $getPFMA = "SELECT description,filepath,date_uploaded,uploaded_by FROM careers ORDER BY id DESC LIMIT 10";
                                    $exe = mysql_query($getPFMA);
                                    while($row = mysql_fetch_array($exe)){
                                    ?>
                                    <tr><td><?php echo "<a href='$row[1]' target='_blank'> $row[0]</a>"; ?> </td><td><?php echo $row[2]; ?> </td><td><?php echo $row[3]; ?> </td></tr>

                                    <?php } ?>
                            </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3"><center>Documents</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Description</td><td>Date Uploaded</td><td>Uploaded By</td>
                                </tr>
                                <?php
                                    $getPFMA = "SELECT description,filepath,date_uploaded,uploadedby FROM dockies ORDER BY id DESC LIMIT 10";
                                    $exe = mysql_query($getPFMA);
                                    while($row = mysql_fetch_array($exe)){
                                    ?>
                                    <tr><td><?php echo "<a href='$row[1]' target='_blank'> $row[0]</a>"; ?> </td><td><?php echo $row[2]; ?> </td><td><?php echo $row[3]; ?> </td></tr>

                                    <?php } ?>
                            </tbody>
                    </table>
                </div>
            </div>
            </fieldset>
            
            <input  type="submit" value="Save" name="save"/>
            <?php
                if($_POST['save']){

                    $my_file = 'log.txt';
                    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
                    
                    $pfma = "SELECT description,date_uploaded,uploaded_by FROM pfma ORDER BY id DESC";
                    $exepfma = mysql_query($pfma);
                    while($row = mysql_fetch_array($exepfma)){
                        $contentPFMA = $row[0]." was uploaded on the ".$row[1]." by ".$row[2]."\r\n";
                        fwrite($handle, $contentPFMA);
                    }
                    fwrite($handle, "--end of pfma--\r\n");
                    $tenderLog = "SELECT description,date_uploaded,uploaded_by FROM tenders ORDER BY id DESC";
                    $exetenderLog = mysql_query($tenderLog);
                    while($row = mysql_fetch_array($exetenderLog)){
                        $contenttender = $row[0]." was uploaded on the ".$row[1]." by ".$row[2]."\r\n";
                        fwrite($handle, $contenttender);
                    }
                    fwrite($handle, "--end of tenders--\r\n");
                    $careersLog = "SELECT description,date_uploaded,uploaded_by FROM careers ORDER BY id DESC";
                    $execareersLog = mysql_query($careersLog);
                    while($row = mysql_fetch_array($execareersLog)){
                        $contentCareers = $row[0]." was uploaded on the ".$row[1]." by ".$row[2]."\r\n";
                        fwrite($handle, $contentCareers);
                    }

                    fwrite($handle, "--end of careers--\r\n");
                    
                    echo "saved";
                    fclose($my_file);
                }
            ?>
    </div>
    </div>
    
    </form>
    
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../../dist/js/sb-admin-2.js"></script>
   
</body>