<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"><link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    function isNumberFrom(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        var errorMsg = "Only Numbers allowed";
        var errorColor = errorMsg.fontcolor("red"); 
        document.getElementById("yearFrom").innerHTML=errorColor;
        //alert("Only Numbers allowed");
        return false;
    }
    else{
        document.getElementById("yearFrom").innerHTML="";
        return true;
    }
}
function isNumberTo(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        var errorMsg = "Only Numbers allowed";
        var errorColor = errorMsg.fontcolor("red");
        document.getElementById("yearTo").innerHTML=errorColor;
        //alert("Only Numbers allowed");
        return false;
    }
    else{
        document.getElementById("yearTo").innerHTML="";
        return true;
    }
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
                            <h3>Documents</h3>
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
                                                    echo 'value="', strip_tags($_POST['description']), '"';}?> />
                                    <p class="help-block">Avoid Semi-Colons, if forced to include it type it like (My description\'s\ field)</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Group</label>
                                        <select class="form-control legisChoose" name="docs" id= "docs_id" onchange="return secGroup();">
                                            <option value="none">-- Select --</option>
                                                <optgroup label="Documents">
                                                <option value="media_releases" <?php if(@$_POST['docs'] == 'media_releases') { ?> selected <?php } ?>>Media Releases</option>
                                                <option value="budget_speech" <?php if(@$_POST['docs'] == 'budget_speech') { ?> selected <?php } ?>>Budget Speech</option>
                                                <option value="service_standards" <?php if(@$_POST['docs'] == 'service_standards') { ?> selected <?php } ?>>Service Standards</option>
                                                <option value="paia" <?php if(@$_POST['docs'] == 'paia') { ?> selected <?php } ?>>PAIA</option>
                                                <option value="paja" <?php if(@$_POST['docs'] == 'paja') { ?> selected <?php } ?>>PAJA</option>
                                                <option value="reports" <?php if(@$_POST['docs'] == 'reports') { ?> selected <?php } ?>>Reports</option>
                                            </optgroup>
                                            <optgroup label="Corporate Identity">
                                                <option value="coprate_manual">Corporate Manual</option>
                                                <option value="letter_heads">Letter Heads</option>
                                                <option value="communications_protocols">Communications Protocols</option>
                                            </optgroup>
					    <optgroup label="HR Toolkit">
                                                <option value="hr_policies">HR Policies</option>                                                
                                            </optgroup>
				            <optgroup label="Forms">
                                                <option value="salbanking">Salary Banking Details Form</option>
						<option value="policies">Policies</option> 
						<option value="z83">Z83</option>
						<option value="z81">Z81</option>
						<option value="forms">Forms</option>
						<option value="travelclaim">Travel Claim</option>                                               
                                            </optgroup>
					    <optgroup label="Meeting">
                                                <option value="exe_meetings">Executive Meetings</option>
						<option value="othermeetings">Other Meetings</option>                                                
                                            </optgroup>
                                      
                                    </select>
                                </div>
                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Financial Year(From)</label>
                                    <input maxlength='4' class="form-control legis" name="fyFrom" type="text" placeholder="<?php echo date('Y');?>" onkeypress="return isNumberFrom(event)" <?php
                                                    if (isset($_POST["fyFrom"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['fyFrom']), '"';}?>/>
                                    <p class="help-block" id="yearFrom"><font color="red" hidden>Type Only Number</font></p>
                                </div>
                                <div class="col-sm-3">
                                    <label>Financial Year(To)</label>
                                    <input maxlength='4' class="form-control legis" name="fyTo" type="text" placeholder="<?php echo date('Y')+1;?>" onkeypress="return isNumberTo(event)" <?php
                                                    if (isset($_POST["fyTo"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['fyTo']), '"';}?>/>
                                    <p class="help-block" id="yearTo"><font color="red" hidden>Type Only Number</font></p>
                                </div>
                                </div><br/>
                                <input type="submit" class="btn btn-primary btn-lg" id="save" name="save" value="Save/Upload"  />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = gethostname();
                $date_time = date('d/m/Y - H:i');
                if(isset($_POST['save']) && $_FILES['myfile']['size']>0){
                    $description = mysql_escape_string(trim($_POST['description']));
                    $group = mysql_escape_string($_POST['docs']);
                    $fyFrom = mysql_escape_string(trim($_POST['fyFrom'])); 
                    $fyTo = mysql_escape_string(trim($_POST['fyTo']));
                    $today = mysql_escape_string(date('Y-m-d'));
                    $uploadedby = mysql_escape_string($_COOKIE['name']);

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmpName = mysql_escape_string($_FILES['myfile']['tmp_name']);

                    /*$fp      = fopen($tmpName, 'r');
                    $content = fread($fp, filesize($tmpName));
                    $content = addslashes($content);
                    fclose($fp);

                    if(!get_magic_quotes_gpc())
                    {
                        $document_name = addslashes($document_name);
                    }*/

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
                        //make sure that on financial year, the 'from' is lower that the 'to'
                        if($fyTo < $fyFrom){
                            echo "<div class='alert alert-info alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Financial Year To MUST be less than Financial Year From</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                        }
                        else{
                           $saveDoc = "INSERT INTO documents(filepath,description,grouptype,fy_from,fy_to,date_uploaded,uploadedby) VALUES('$content', '$description','$group','$fyFrom','$fyTo','$today','$uploadedby')";
                            $exe = mysql_query($saveDoc);
                            if($exe){
                                echo "<div class='alert alert-success alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                $filename = "logs.txt";
                                $handler = fopen($filename, 'a');
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploadedby Successfully\r\n";
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
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploadedby failed to submit. reason: ".mysql_error()." \r\n";
                                fwrite($handler, $content);
                                fclose($handler);
                            }
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
    </div>

    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../../dist/js/sb-admin-2.js"></script>
</body>