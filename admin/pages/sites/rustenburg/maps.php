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
                            <h3>Maps & GIS</h3>
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
                                        <select class="form-control legisChoose" name="docs" id= "docs_id" onchange="return secGroup();">
                                            <option value="none">-- Select --</option>

                                            <option value="street_maps" <?php if(@$_POST['map'] == 'street_maps') { ?> selected <?php } ?>>Street Maps</option>
                                            <option value="ward_maps" <?php if(@$_POST['map'] == 'ward_maps') { ?> selected <?php } ?>>Ward Maps</option>
                                            <option value="zoning_infrastructure" <?php if(@$_POST['map'] == 'zoning_infrastructure') { ?> selected <?php } ?>>Zoning and Infrastructure</option>
                                            


						<!--<option value="quarterlyreport" <?php if(@$_POST['docs'] == 'quarterlyreport') { ?> selected <?php } ?>>Quarterly report</option>

						<option value="nrgp" <?php if(@$_POST['docs'] == 'nrgp') { ?> selected <?php } ?>>NRGP</option>
						<option value="paia" <?php if(@$_POST['docs'] == 'paia') { ?> selected <?php } ?>>PAIA</option>
						<option value="policies" <?php if(@$_POST['docs'] == 'policies') { ?> selected <?php } ?>>Policies</option>                  
						<option value="popia" <?php if(@$_POST['docs'] == 'popia') { ?> selected <?php } ?>>POPIA</option>-->


                       

                                             
						
                                    </select>
                                </div>
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
			
				 error_reporting(E_ALL);
                 ini_set('display_errors', 1);

				date_default_timezone_set('Africa/Johannesburg');

                $hostname = htmlspecialchars(strip_tags(gethostname()));
				
                if(isset($_POST['save']) && $_FILES['myfile']['size']>0){
                    $description = htmlspecialchars(strip_tags($_POST['description']));
					$fyfrom =htmlspecialchars(strip_tags($_POST['fyFrom']));
					$fyto =htmlspecialchars(strip_tags($_POST['fyTo']));
                    $group = htmlspecialchars(strip_tags($_POST['map']));
                    //$closing_date = htmlspecialchars(strip_tags($_POST['closing_date']));
                    $today =  htmlspecialchars(strip_tags(date('Y-m-d')));
                    $uploadedby =  htmlspecialchars(strip_tags($_COOKIE['name']));
			
	                //$dayDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 3,2)));
                    //$MonthDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 0,2)));
                    //$YearDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 6,4)));
                    
                   //$full_closing_date=  htmlspecialchars(strip_tags($YearDelivered."-".$MonthDelivered."-".$dayDelivered));

                    $document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['name']));
                    $tmp_document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['tmp_name']));
                  
                    if(!file_exists("../../../../documents/"))
					{
						mkdir("../../../../documents/");
					}
                    $document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['name']));
                    $tmp_document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['tmp_name']));
                    $fileExt = htmlspecialchars(strip_tags($_FILES['myfile']['type']));

                    move_uploaded_file($tmp_document_name,"../../../../documents/".$document_name);
                    $content =  htmlspecialchars(strip_tags("Documents/".$document_name));
                    
                    if($uploadedby == null)
                        header("Location:session_out.php");
                    else{
                    $saveDoc = "INSERT INTO documents_uploaded(id,description,fyfrom,fyto,dateuploaded,filepath,grouptype) VALUES(:id, :description,:fyfrom,:fyto,:dateuploaded,:filepath,:grouptype)";

                        $db_object = new connection();
                        $db = $db_object->openConnection();
					

                    if($db)
                    {
					
					$stm = $db->prepare($saveDoc);
					if($stm->execute(array(':id' => NULL, ':description' =>  $description, ':fyfrom' => $fyfrom, ':fyto' => $fyto, ':dateuploaded' =>  $today,':filepath'=>$content,':grouptype'=>  $group)))
					{
						
                        echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                            
                    }
                    else{
						
                                echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                </div>";

				
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
	
 <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        });
  </script>
	
</body>