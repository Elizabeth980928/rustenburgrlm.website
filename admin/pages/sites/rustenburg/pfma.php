<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"><link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        //document.getElementById("yearFrom").style.visibility="visible";
        alert("Only Numbers allowed");
        return false;
    }
    else{
        //document.getElementById("yearFrom").style.visibility="hidden";
        return true;
    }
}

function secGroup(){
    if(document.getElementById("pfma_id").value !="none")
      document.getElementById("save").disabled = false;
    else
        document.getElementById("save").disabled = true;
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
                            <h3>PFMA</h3>
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
                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Group</label>
                                        <select class="form-control legisChoose" name="pfma" id= "pfma_id" onchange="return secGroup();">
                                            <option value="none">-- Select --</option>
                                            <option value="circular" <?php if(@$_POST['pfma'] == 'circular') { ?> selected <?php } ?>>Circulars</option>
                                            <option value="manuals" <?php if(@$_POST['pfma'] == 'manuals') { ?> selected <?php } ?>>Manuals</option>
                                            <option value="notes" <?php if(@$_POST['pfma'] == 'notes') { ?> selected <?php } ?>>Notes</option>
                                            <option value="pfma_policies" <?php if(@$_POST['pfma'] == 'pfma_policies') { ?> selected <?php } ?>>Policies</option>
                                            <option value="provincial_reports" <?php if(@$_POST['pfma'] == 'provincial_reports') { ?> selected <?php } ?>>Provincial Reports</option>
                                            <option value="strategy" <?php if(@$_POST['pfma'] == 'strategy') { ?> selected <?php } ?>>Strategy</option>
                                            <option value="pfma_regulations" <?php if(@$_POST['pfma'] == 'pfma_regulations') { ?> selected <?php } ?>>Regulations</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="sec">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" > 
                                        <option value="first">1<sup>st</sup></option>
                                        <option value="second">2<sup>nd</sup></option>
                                        <option value="third">3<sup>rd</sup></option>
                                        <option value="forth">4<sup>th</sup></option>
                                    </select>
                                </div>
                                </div>


                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Financial Year(From)</label>
                                    <input class="form-control legis" name="fyFrom" type="text" placeholder="<?php echo date('Y');?>" onkeypress="return isNumber(event)" <?php
                                                    if (isset($_POST["fyFrom"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['fyFrom']), '"';}?>/>
                                    <p class="help-block" id="yearFrom"><font color="red" hidden>Type Only Number</font></p>
                                </div>
                                <div class="col-sm-3">
                                    <label>Financial Year(To)</label>
                                    <input class="form-control legis" name="fyTo" type="text" placeholder="<?php echo date('Y')+1;?>" onkeypress="return isNumber(event)" <?php
                                                    if (isset($_POST["fyTo"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['fyTo']), '"';}?>/>
                                    <p class="help-block" id="yearTo"><font color="red" hidden>Type Only Number</font></p>
                                </div>
                                </div><br/>
                                <input type="submit" class="btn btn-primary btn-lg" id="save" name="save" value="Save/Upload" disabled="true" />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = mysql_escape_string(gethostname());
                $date_time = mysql_escape_string(date('d/m/Y - H:i'));
                if(isset($_POST['save']) && $_FILES['myfile']['size']>0){
                    $description = mysql_escape_string(trim($_POST['description']));
                    $group = mysql_escape_string(trim($_POST['pfma']));
                    $fyFrom = mysql_escape_string(trim($_POST['fyFrom'])); 
                    $fyTo = mysql_escape_string(trim($_POST['fyTo']));
                    $today = mysql_escape_string(date('Y-m-d'));
                    $quarter = mysql_escape_string($_POST['quarter']);
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
                        //make sure that on financial year, the 'from' is lower that the 'to'
                        if($fyTo < $fyFrom){
                            echo "<div class='alert alert-info alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Financial Year To MUST be less than Financial Year From</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                        }
                        else{
                           $saveDoc = "INSERT INTO pfma(filepath,description,grouptype,fy_from,fy_to,date_uploaded,quarter,uploaded_by) VALUES('$content', '$description','$group','$fyFrom','$fyTo','$today','$quarter','$uploaded_by')";
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