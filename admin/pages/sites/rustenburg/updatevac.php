<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<?php 
session_start();
require_once('menu.php'); 
$id = $_GET['id'];
?>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <br/>
            <form  enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Update Vacancies</h3>
                            <p><font color="red">Please ensure that your file name does'nt contain semi-colons.</font></p>
                            <fieldset>
                               <div class="panel-body"> 
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                    <th>Description</th>
                                                    <th>Closing Date</th>
                                                </tr>
                                            </thead>                                        
                                        <?php
                                            $getSelectedDoc = "SELECT filepath, description, closingdate,id FROM careers WHERE id = $id";
                                            $exe = mysql_query($getSelectedDoc);
                                            $tb .="";
                                            while($row = mysql_fetch_array($exe)){
                                                $tb .="<tr class='odd gradeA'><td width='5%'><input type='file' name='newfile' /></td>";
                                                $tb .= "<td width='25%'><textarea name='newdesc' cols='50' rows='3'>$row[1] </textarea></td>";
                                                $tb .= "<td width='10%'><input type='text' name='newClosingDate' value=$row[2] /></td>";
                                            }
                                            echo $tb .= "</tr></tbody></table>";
                                        ?>
                                    </div>
                               </div>
                               
                                
                                <input type="submit" class="btn btn-primary btn-lg" value="Update" name="update" id="save"  />
                            </fieldset>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = gethostname();
                $date_time = date('d/m/Y h:i');

                $getCurrnet = "SELECT description, closingdate,filepath FROM careers WHERE id = id";
                $exe = mysql_query($getCurrnet);
                $rowC = mysql_fetch_array($exe);
                $current_desc = mysql_escape_string($rowC[0];
                $current_closingdate = mysql_escape_string($rowC[1]);
                $current_file = mysql_escape_string($rowC[2]);

                if(isset($_POST['update']) && $_FILES['newfile']['size']>0){

                    $description = mysql_escape_string($_POST['newdesc']); //for new description
                    $closingdate = mysql_escape_string($_POST['newClosingDate']); //for new closing date
                    $today = mysql_escape_string(date('Y-m-d'));
                    $uploaded_by = mysql_escape_string($_COOKIE['name']);

                    $document_name = mysql_escape_string($_FILES['newfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['newfile']['tmp_name']);
                   
                    if(!file_exists("documents/".$group)) mkdir("documents/".$group);
                    $document_name = mysql_escape_string($_FILES['newfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['newfile']['tmp_name']);
                    $fileExt = mysql_escape_string($_FILES['newfile']['type']);

                    move_uploaded_file($tmp_document_name,"documents/".$group."/".$document_name);
                    $content = "documents/".$group."/".$document_name;
                    
                    $update = "UPDATE careers SET filepath='$content', description='$description' , closingdate = '$closingdate', uploaded_by ='$uploaded_by' WHERE id = '$id' ";
                    $exe = mysql_query($update);
                    if($exe){
                        echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>Vacancies Successfully updated with new document</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                        /*$filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        if($current_desc != $description) //means has changed
                            $content = "$hostname - [$date_time] - $current_desc changed to $description by $uploaded_by under Vacancies\r\n";
                        if($current_closingdate != $closingdate)
                            $content = "$hostname - [$date_time] - Closing date of $description has been changed from $current_closingdate to $closingdate by uploaded_by under Vacancies\r\n";

                        fwrite($handler, $content);
                        fclose($handler);*/
                    }
                    else{
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                       /* $filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        $content = "$hostname - [$date_time] - Vacancies $description submitted by: $uploaded_by failed to submit. reason: ".mysql_error()." \r\n";
                        fwrite($handler, $content);
                        fclose($handler);*/
                    }

                }

                //when you didnot select the file
                elseif(isset($_POST['update']) && empty($_FILES['myfile']['name'])){
                    $description = mysql_escape_string($_POST['newdesc']);
                    $closingdate = mysql_escape_string($_POST['newClosingDate']);
                    $today = mysql_escape_string(date('Y-m-d'));
                    $uploaded_by = mysql_escape_string($_COOKIE['name']);
                    echo $update = "UPDATE careers SET description='$description' , closingdate = '$closingdate', uploaded_by ='$uploaded_by' WHERE id = '$id' ";
                    $exe = mysql_query($update);
                    if($exe){
                        echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>Vacancies Successfully updated t</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                       /* $filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        //$content = "$hostname - [$date_time] - Vacancies $description, updated by: $uploaded_by Successfully\r\n";
                        if($current_desc != $description) //means has changed
                            $content = "$hostname - [$date_time] - $current_desc changed to $description by $uploaded_by under Vacancies\r\n";
                        if($current_closingdate != $closingdate)
                            $content = "$hostname - [$date_time] - Closing date of $description has been changed from $current_closingdate to $closingdate by $uploaded_by under Vacancies\r\n";

                        fwrite($handler, $content);
                        close($handler);*/
                    }
                    else{
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                       /* $filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        $content = "$hostname - [$date_time] - Vacancies description, submitted by: $uploaded_by failed to submit. reason: ".mysql_error()." \r\n";
                        fwrite($handler, $content);
                        fclose($handler);*/
                    }
                } 

                
                    
            ?>
            </form>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>

</body>
