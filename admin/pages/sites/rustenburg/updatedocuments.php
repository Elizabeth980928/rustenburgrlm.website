<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<?php require_once('menu.php'); 
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
                            <h3>Update Documents</h3>
                            <p><font color="red">Please ensure that your file name does'nt contain semi-colons.</font></p>
                            <fieldset>
                               <div class="panel-body"> 
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                    <th>Description</th>
                                                    <th>Financial Year</th>
                                                </tr>
                                            </thead>                                        
                                        <?php
										
										 error_reporting(E_ALL);
                                         ini_set('display_errors', 1);
										 
									
										 
										$db_object=new DatabaseMop();
                                        $db=$db_object->getConnectionMop();
										
                                            $getSelectedDoc = "SELECT filepath, description, fyfrom, fyto,id FROM  documents_uploaded WHERE id = $id";
                                            //$exe = mysql_query($getSelectedDoc);
											
											
											$stmt = $db->prepare($getSelectedDoc);
                                            $stmt->execute();
											
											
                                            $tb ="";
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
												
												extract($row);
                                                $tb .="<tr class='odd gradeA'><td width='5%'><input type='file' name='newfile' /></td>";
                                                $tb .= "<td width='25%'><textarea name='newdesc' cols='50' rows='3'>$row[description] </textarea></td>";
                                                $tb .= "<td width='10%'><input type='text' name='newFYFrom' value=$row[fyfrom] size='4'/>/<input type='text' name='newFYTO' value=$row[fyto] size='4'/></td>";
                                                
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
			
			    date_default_timezone_set('Africa/Johannesburg');
			    
                $hostname = gethostname();
                $date_time = date('d/m/Y h:i');
                if(isset($_POST['update']) && $_FILES['newfile']['size']>0){
                    $description =$_POST['newdesc'];
                    $fy_from = $_POST['newFYFrom'];
                    $fy_to = $_POST['newFYTO'];
                    $today = date('Y-m-d');
                    $uploaded_by = $_COOKIE['name'];

                    $document_name = $_FILES['newfile']['name'];
                    $tmp_document_name =$_FILES['newfile']['tmp_name'];
                   
                    if(!file_exists("documents/".$group)) mkdir("documents/".$group);
                    $document_name =$_FILES['newfile']['name'];
                    $tmp_document_name =$_FILES['newfile']['tmp_name'];
                    $fileExt = $_FILES['newfile']['type'];

                    move_uploaded_file($tmp_document_name,"documents/".$group."/".$document_name);
                    $content ="documents/".$group."/".$document_name;
                    
                    $update = "UPDATE documents_uploaded SET filepath='$content', description='$description' , fyfrom = '$fy_from', fyto = '$fy_to'  WHERE id = '$id' ";
                    //$exe = mysql_query($update);
					
					$stmt = $db->prepare($update);
                    $stmt->execute();
					
                    if($stmt){
                        echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>Document Successfully updated with new document</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                        /*$filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        $content = "$hostname - [$date_time] - Document $description, updated with new document by: $uploaded_by Successfully\r\n";
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
                        $content = "$hostname - [$date_time] - Document $description submitted by: $uploaded_by failed to submit. reason: ".mysql_error()." \r\n";
                        fwrite($handler, $content);
                        fclose($handler);*/
                    }

                }

                //when you didnot select the file
                elseif(isset($_POST['update']) && empty($_FILES['myfile']['name'])){
                    $description = $_POST['newdesc'];
                   // $closingdate = $_POST['newClosingDate'];
                    $fy_from = $_POST['newFYFrom'];
                    $fy_to = $_POST['newFYTO'];
                    $today = date('Y-m-d');
                    $uploaded_by = $_COOKIE['name'];
                    echo $update = "UPDATE documents_uploaded SET description='$description' , fyfrom = '$fy_from', fyto = '$fy_to' WHERE id = '$id'";
                   
				   //$exe = mysql_query($update);
				   	$stmt = $db->prepare($update);
                    $stmt->execute();
					
					
                    if($stmt){
                        echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>Document Successfully updated </strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                        /*$filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        $content = "$hostname - [$date_time] - Document $description, updated by: $uploaded_by Successfully\r\n";
                        fwrite($handler, $content);
                        close($handler);*/
                    }
                    else{
                        echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                        /*$filename = "logs.txt";
                        $handler = fopen($filename, 'a');
                        $content = "$hostname - [$date_time] - Document description, submitted by: $uploaded_by failed to submit. reason: ".mysql_error()." \r\n";
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