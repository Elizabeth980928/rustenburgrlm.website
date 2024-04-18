<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"><link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript">

function changeOffice(){
    if(document.getElementById("office").value=="mayor")
        document.getElementById("profile_id").hidden=false;
    else
        document.getElementById("profile_id").hidden=true;

    if(document.getElementById("office").value=="ward")
        document.getElementById("ward_id").hidden=false;
    else
        document.getElementById("ward_id").hidden=true;

    if(document.getElementById("office").value=="magoshi")
        document.getElementById("location_id").hidden=false;
    else
        document.getElementById("location_id").hidden=true;

    if(document.getElementById("office").value=="topmanagment" || document.getElementById("office").value=="exco")
        document.getElementById("position_id").hidden=false;
    else
        document.getElementById("position_id").hidden=true;
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
                            <h3>Lepelle-Nkumpi Managements</h3>
                            <fieldset>
                                <div class="form-group">
                                    <img src="imgs/nopic.png" id="pic"/>
                                    <input type="file" name="myfile"  onchange="readURL(this);">
                                </div>
                                
                                <div class="form-group">
                                    <label>Office</label>
                                        <select class="form-control" name="office" id= "office" onchange="return changeOffice();">
                                                <option value="none">-- Select --</option>
                                                <option value="mayor" >Mayor</option>
                                                <option value="mm">Municipal Manager</option>
                                                <option value="topmanagment">Top Management</option>
                                                <option value="chiefwhip">Chief Whip</option>
                                                <option value="speaker">Speaker</option>
                                                <option value="ward">Ward Councillor</option>
                                                <option value="pr">PR Councillor</option>
                                                <option value="exco">Exco</option>
                                                <option value="magoshi">Magoshi</option>
						<option value="techserv">Technical Services</option>
						<option value="copserv">Coporate Services</option>
						<option value="commserv">Community Services</option>
						<option value="budTre">Budget and Treasury</option>
						<option value="ledplanning">LED and Planning</option>
                                        </select>
                                </div>
                                <div class="form-group" id="profile_id" hidden>
                                    <label>Proflie</label>
                                    <textarea cols="10" rows="10" name="profile"></textarea>
                                    <p class="help-block">Avoid Semi-Colons, if forced to include it type it like (My description\'s\ field)</p>
                                </div>

                                <div class="row">
                                <div class="col-sm-3">
                                    <label>Full Name</label>
                                    <input class="form-control" name="fullname" type="text" />
                                </div>
                                <div class="col-sm-3">
                                    <label>Cell Number</label>
                                    <input  class="form-control" name="cellnum" type="text" />
                                </div>
                                <div class="col-sm-3">
                                    <label>Office Number</label>
                                    <input  class="form-control" name="officenum" type="text" />
                                </div>
                                <div class="col-sm-3">
                                    <label>Email</label>
                                    <input  class="form-control" name="email" type="email" />
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-3" hidden id="ward_id">
                                    <label>Ward#</label>
                                    <input class="form-control" name="wardnum" type="text" placeholder="Ward 1"/>
                                </div>
                                <div class="col-sm-3" hidden id="location_id">
                                    <label>Location</label>
                                    <input  class="form-control" name="location" type="text" placeholder="Lebowakgomo"/>
                                </div>
                                <div class="col-sm-3" hidden id="position_id">
                                    <label>Position</label>
                                    <input  class="form-control" name="position" type="text" placeholder="Executive Manager Community Services"/>
                                </div>
                                </div>

                                <br/>
                                <input type="submit" class="btn btn-primary btn-lg" id="save" name="save" value="Save/Upload"  />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = mysql_escape_string(gethostname());
                $date_time = mysql_escape_string(date('d/m/Y - H:i'));
                $today = mysql_escape_string(date('Y-m-d'));
                $uploadedby = $_COOKIE['name'];
                if(isset($_POST['save']) && $_FILES['myfile']['size']>0){
                    $fullname = mysql_escape_string($_POST['fullname']);
                    $office = mysql_escape_string($_POST['office']);
                    $cellnum = mysql_escape_string($_POST['cellnum']); 
                    $officenum = mysql_escape_string($_POST['officenum']);
                    $email = mysql_escape_string(trim($_POST['email']));
                    $wardnum = mysql_escape_string($_POST['wardnum']);
                    $position = mysql_escape_string($_POST['position']);
                    $location = mysql_escape_string($_POST['location']);
                    $profile = mysql_escape_string($_POST['profile']);

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmpName = mysql_escape_string($_FILES['myfile']['tmp_name']);

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);

                   if(!file_exists("documents/employees/images/".$group)) mkdir("documents/employees/images/".$group);
                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);

                    move_uploaded_file($tmp_document_name,"documents/employees/images/".$document_name);
                    $content = mysql_escape_string("documents/employees/images/".$document_name);
                       
                    $saveMan = "INSERT INTO management(fullnames,position,cellnum,phonenum,email,ward,officeType,profile,location,pic_path,uploaded_by) VALUES('$fullname', '$position','$cellnum','$officenum','$email','$wardnum','$office','$profile','$location','$content','$uploadedby')";
                    $exe = mysql_query($saveMan);
                            if($exe){
                                echo "<div class='alert alert-success alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                /*$filename = "logs.txt";
                                $handler = fopen($filename, 'a');
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploadedby Successfully\r\n";
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
                                $content = "$hostname - [$date_time] - $description, under $group submitted by: $uploadedby failed to submit. reason: ".mysql_error()." \r\n";
                                fwrite($handler, $content);
                                fclose($handler);*/
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

    <script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pic')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>


</body>