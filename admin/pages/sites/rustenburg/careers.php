<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<?php require_once('menu.php'); ?>
<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <br/>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Career @LPT</h3>
                            <p><font color="red">Please ensure that your file name does'nt contain semi-colons.</font></p>
                            <fieldset>
                                <div class="form-group">
                                    <label>Select File:</label>
                                    <input type="file" name="myfile">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control legis" type="text" required name="description" <?php
                                                    if (isset($_POST["description"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['description']), '"';}?>/>
                                    <p class="help-block">Avoid Semi-Colons, if forced to include it type it like (My description\'s\ field)</p>
                                </div>
                                <div class="form-group">
                                    <label>Group</label>
                                        <select class="form-control legisChoose" id="careers" name="groupCareer" onchange="return secGroup();">
                                            <option value="none">-- Select --</option>
                                            <option value="vacancies" <?php if(@$_POST['groupCareer'] == 'vacancies') { ?> selected <?php } ?> >Vacancies</option>
                                            <option value="bursaries" <?php if(@$_POST['groupCareer'] == 'bursaries') { ?> selected <?php } ?> >Bursaries</option>
                                            <option value="internships" <?php if(@$_POST['groupCareer'] == 'internships') { ?> selected <?php } ?> >Internships</option>
					    <option value="learnership" <?php if(@$_POST['groupCareer'] == 'learnership') { ?> selected <?php } ?> >Learnership</option>
                                    </select>
                                </div>
                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Closing Date</label>
                                    <input class="form-control legis" type="text" placeholder="<?php echo date('Y-m-d');?>" required name="closingdate" <?php
                                                    if (isset($_POST["closingdate"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['closingdate']), '"';}?>/>
                                    
                                </div>
                                </div><br/>
                                <input type="submit" class="btn btn-primary btn-lg" value="Save/Upload" name="save" id="save"  />
                            </fieldset>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = gethostname();
                $date_time = date('d/m/Y - H:i');
                if(isset($_POST['save']) && $_FILES['myfile']['size']>0){
                    $description = mysql_escape_string($_POST['description']);
                    $group = mysql_escape_string($_POST['groupCareer']);
                    $closingdate = mysql_escape_string($_POST['closingdate']);
                    $today = mysql_escape_string(date('Y-m-d'));
                    $uploaded_by = mysql_escape_string($_COOKIE['name']);

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);
                   
                    if(!file_exists("documents/".$group)) mkdir("documents/".$group);
                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);
                    $fileExt = mysql_escape_string($_FILES['myfile']['type']);

                    move_uploaded_file($tmp_document_name,"documents/".$group."/".$document_name);
                    $content = mysql_escape_string("documents/".$group."/".$document_name);

                    if($group == 'none'){
                        echo "<div class='alert alert-info alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Please Select File Group</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                    }
                    else{
                        
                           $saveDoc = "INSERT INTO careers(filepath,description,grouptype,closingdate,date_uploaded,uploaded_by) VALUES('$content', '$description','$group','$closingdate','$today','$uploaded_by')";
                            $exe = mysql_query($saveDoc);
                            if($exe){
                                echo "<div class='alert alert-success alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                $filename = "logs.txt";
                                $handler = fopen($filename, 'a');
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploaded_by Successfully\r\n";
                                fwrite($handler, $content);
                                fclose($handler);
                            }
                            else{
                                echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
				                $filename = "logs.txt";
                                $handler = fopen($filename, 'a');
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploaded_by failed to submit. reason: ".mysql_error()." \r\n";
                                fwrite($handler, $content);
                                fclose($handler);
                            }
                       
                    }

                }

                //when you didnot select the file
                if(isset($_POST['save']) && empty($_FILES['myfile']['name'])){
                    echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Please Select File</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
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
