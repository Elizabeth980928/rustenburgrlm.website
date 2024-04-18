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
            <form method="post" enctype="multipart/form-data" id="eventForm" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Events</h3>
                            <p><font color="red">Please ensure that your file name does'nt contain semi-colons.</font></p>
                            <fieldset>
                                <div class="form-group">
                                    <label>Select File:</label>
                                    <input type="file" name="myfile">
                                </div>
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <input class="form-control" type="text" required name="event_name"/>
                                    <p class="help-block">Avoid Semi-Colons, if forced to include it type it like (My description\'s\ field)</p>
                                </div>
                                <div class="row">
                                <div class="col-sm-3 date" id="datePicker">
                                    <label>Start Date</label>
                                    <input class="form-control" name="statdate" type="date" />
                                </div>
                                <div class="col-sm-3 date" id="datePicker">
                                    <label>End Date</label>
                                    <input class="form-control" name="enddate" type="date" />
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-3 date" id="datePicker">
                                    <label>Start Time</label>
                                    <input class="form-control" name="starttime" type="time" />
                                </div>
                                <div class="col-sm-3 date" id="datePicker">
                                    <label>End Time</label>
                                    <input class="form-control" name="endtime" type="time" />
                                </div>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input  type="text" class="form-control jscolor" value="#5367ce" name="color"/>
                                </div>
                                <br/>
                                <input type="submit" class="btn btn-primary btn-lg" id="save" name="save" value="Save/Upload"  />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $hostname = gethostname();
                $date_time = date('d/m/Y - H:i');
                if(isset($_POST['save']) OR $_FILES['myfile']['size']>0){
                    $event_name = mysql_escape_string($_POST['event_name']);
                    $statdate = mysql_escape_string($_POST['statdate']); 
                    $enddate = mysql_escape_string($_POST['enddate']);
                    $starttime = mysql_escape_string($_POST['starttime']); 
                    $endtime = mysql_escape_string($_POST['endtime']);
                    $color = mysql_escape_string('#'.$_POST['color']);

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmpName = mysql_escape_string($_FILES['myfile']['tmp_name']);   

                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);

                   if(!file_exists("documents/".$group)) mkdir("documents/".$group);
                    $document_name = mysql_escape_string($_FILES['myfile']['name']);
                    $tmp_document_name = mysql_escape_string($_FILES['myfile']['tmp_name']);
                    $fileExt = mysql_escape_string($_FILES['myfile']['type']);

                    move_uploaded_file($tmp_document_name,"documents/events/".$document_name);
                    $contentfile = mysql_escape_string("documents/events/".$document_name);

                    echo $saveDoc = "INSERT INTO events(event_name,statedate,enddate,starttime,endtime,color,filepath) VALUES('$event_name', '$statdate','$enddate','$starttime','$endtime','$color','$contentfile')";
                    $exe = mysql_query($saveDoc);
                        if($exe){
                                echo "<div class='alert alert-success alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Completed Successfully</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                
                                $filename = "../../../../Monthly-master/events.xml";
                                
                                $simp = simplexml_load_file($filename); 
                                $node = $simp->addChild('event');
                                $node->addChild('name',$event_name );
                                $node->addChild('startdate',$statdate );
                                $node->addChild('enddate',$enddate );
                                $node->addChild('starttime',$starttime );
                                $node->addChild('endtime',$endtime );
                                $node->addChild('color',$color );
                                $node->addChild('url',$contentfile );
                                $s = simplexml_import_dom($simp);
                                $s->saveXML($filename);
                                
                            }
                            else{
                                echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                            }
                        }
            ?>
            </form>
        </div>
    </div>
    <script src="jscolor.js"></script>
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../../dist/js/sb-admin-2.js"></script>
</body>