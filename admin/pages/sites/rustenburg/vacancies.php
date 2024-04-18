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
                            <h3>Vacancies</h3>
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
                                </div>
				<div class="row">
                                <div class="col-sm-3">
                                    <label>Group</label>
                                        <select class="form-control legisChoose" id="tenders" onchange="return allowPost();" name="groupCareers">
                                            <option value="none">-- Select --</option>
                                            <option value="bursary" <?php if(@$_POST['groupCareers'] == 'bursary') { ?> selected <?php } ?> >Bursaries</option>
                                            <option value="vacancies" <?php if(@$_POST['groupCareers'] == 'vacancies') { ?> selected <?php } ?> >Careers</option>
											 <option value="forms" <?php if(@$_POST['groupCareers'] == 'forms') { ?> selected <?php } ?> >Forms</option>
                                        </select>
                                </div>
                                
                                <div class="col-sm-3">
                                    <label>Closing Date</label>
                                    <input class="form-control legis" id="datepicker" type="text" placeholder="<?php echo date('Y-m-d');?>" name="closing_date" <?php
                                                    if (isset($_POST["closing_date"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['closing_date']), '"';}?>/>
                                </div>
				</div>
                                <br/>
                                <input type="submit" class="btn btn-primary btn-lg" value="Save/Upload" name="save" id="save"  />
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
                    $group = htmlspecialchars(strip_tags($_POST['groupCareers']));
                    $closing_date = htmlspecialchars(strip_tags($_POST['closing_date']));
                    $today =  htmlspecialchars(strip_tags(date('Y-m-d')));
                    $uploadedby =  htmlspecialchars(strip_tags($_COOKIE['name']));
			
	                $dayDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 3,2)));
                    $MonthDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 0,2)));
                    $YearDelivered =  htmlspecialchars(strip_tags(substr($closing_date, 6,4)));
                    
                    $full_closing_date=  htmlspecialchars(strip_tags($YearDelivered."-".$MonthDelivered."-".$dayDelivered));

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
                    $saveDoc = "INSERT INTO documents_uploaded(id,description,dateuploaded,filepath,grouptype,ddate) VALUES(:id, :description,:dateuploaded,:filepath,:grouptype,:closing_date)";

                        $db_object = new connection();
                        $db = $db_object->openConnection();

                    if($db)
                    {
					
					$stm = $db->prepare($saveDoc);
					if($stm->execute(array(':id' => NULL, ':description' =>  $description, ':dateuploaded' =>  $today,':filepath'=>$content,':grouptype'=>  $group,':closing_date'=> $full_closing_date)))
					{
						
                        echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                            
                    }
                    else{
						
                               /* echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                </div>";*/

				
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
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        });
  </script>

</body>
