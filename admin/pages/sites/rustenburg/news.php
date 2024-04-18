<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"><link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">
    function enablebtn(){
        //if(documents.getElementById('upload'))
            document.getElementById('save').disabled = false;
    }
</script>
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
                            <h3>News</h3>
                            <p><font color="red">Please ensure that your file name does'nt contain semi-colons.</font></p>
                            <fieldset>
                                <div class="form-group">
                                    <label>Story</label>
                                    <textarea cols='10' rows='10' name='description' id="desc"></textarea>
                                    <p class="help-block">Avoid Semi-Colons, if forced to include it type it like (My description\'s\ field)</p>
                                </div>
                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Date Delivered</label>
                                    <input class="form-control legis" name="date_delivered" type="text" placeholder="<?php echo date('Y-m-d');?>" onkeypress="return isNumber(event)" <?php
                                                    if (isset($_POST["date_delivered"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['date_delivered']), '"';}?>/>
                                </div>
				<div class="col-sm-3">
                                    <label>Select File:</label>
                                    <input type="file" name="myfile" accept="image/*"><input type="submit" class="btn btn-primary btn-sm" id="upload" name="upload" value="Upload Pic"  />
                                </div> 
                                &nbsp;<input type="submit" class="btn btn-success btn-lg" id="save" name="save" value="Save/Upload" />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = gethostname();
                $date_time = mysql_escape_string(date('d/m/Y - H:i'));
                $uploaded_by = mysql_escape_string($_COOKIE['name']);
                $today = mysql_escape_string(date('Y-m-d'));

            if(isset($_POST['upload']) && $_FILES['myfile']['size']>0){

                if(!file_exists("documents/newspix/".$today)) mkdir("documents/newspix/".$today);
                $document_name = mysql_escape_string($_FILES['myfile']['name']);
                $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);
                $size = mysql_escape_string($_FILES['myfile']['size']);

                move_uploaded_file($tmp_document_name,"documents/newspix/".$today."/".$document_name);
                $path = mysql_escape_string("documents/newspix/".$today."/".$document_name);

                //save picuter path to a file to handle multiple photos. this is when you click upload button
                $file = "pix.txt";
                $handler = fopen($file,'a');
                fwrite($handler, $path."\n");
                fclose($handler);

                //then read the file and display only the file name 
                $file_handle = fopen($file, "r");
                echo "<br/><u>Pictures to upload</u><br/>";
                while (!feof($file_handle)) {
                    $line = fgets($file_handle);
                    if($line == ""){}
                    else
                        echo "<img src='$line' width='56px' height='47px'/>&nbsp;&nbsp;"; 
                }
                fclose($file_handle);
                }
                if(isset($_POST['save'])){
                    $description = mysql_escape_string($_POST['description']);
                    $group = mysql_escape_string("news");
                    $date_delivered = mysql_escape_string($_POST['date_delivered']);
                        
                        $saveDoc = "INSERT INTO newsroom(description,grouptype,date_delivered,date_uploaded,uploaded_by) VALUES('$description','$group','$date_delivered','$today','$uploaded_by')";
                        $exe = mysql_query($saveDoc);
                        if($exe){
                            echo "<div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>News Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                                </div>";
                            }                          
                            else{
                                echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                            }
              
            }
                //when you didnot select the file
               /* if(isset($_POST['upload']) && empty($_FILES['myfile']['name'])){
                    echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Please Select Images</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                }  */
            ?>
            </form>
        </div>
    </div>

    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
	$( document ).ready(function() {
 		$('#desc').bind('paste', function (e) {
    		e.preventDefault(); //disable cut,copy,paste
    		alert('no copy and paste bra');
		});
	});
    </script>
</body>