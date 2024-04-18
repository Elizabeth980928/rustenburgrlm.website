<link rel="shortcut icon" href="../../../lgb.ico">
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php require_once('menu.php'); ?>
<script type="text/javascript">
    function redirc(){	
        var goTo = document.getElementById("newsroom").value;
	/*if(goTo == 'news'){
        
        var page = goTo+".php";
        location.href = page;
	}*/
	
    }
</script>
<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <br/>
            <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Newsroom</h3>
                            <fieldset>
                                <div class="form-group">
                                    <label>Select File:</label>
                                    <input type="file" name="myfile">
                                </div>
								
								<div class="form-group">
                                    <label>image:</label>
                                    <input type="file" name="myimage">
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
                                        <select class="form-control" name="newsroom" id= "newsroom" onchange="return redirc();">
                                            <option value="none">-- Select --</option>

                                            <option value="notice" <?php if(@$_POST['newsroom'] == 'notice') { ?> selected <?php } ?>>Notices</option>
											<option value="news" <?php if(@$_POST['newsroom'] == 'news') { ?> selected <?php } ?>>News</option>
                                           
                                            <option value="events" <?php if(@$_POST['newsroom'] == 'events') { ?> selected <?php } ?>>Events</option>
                                            <option value="media release" <?php if(@$_POST['newsroom'] == 'media release') { ?> selected <?php } ?>>Media release</option>
                                            <option value="speeches" <?php if(@$_POST['newsroom'] == 'speeches') { ?> selected <?php } ?>>Speeches</option>
                                          
                                           
                                            <!--<option value="csi" <?php if(@$_POST['newsroom'] == 'csi') { ?> selected <?php } ?>>CSI</option>
                                            <option value="news" <?php if(@$_POST['newsroom'] == 'news') { ?> selected <?php } ?>>News</option>
                                            <option value="gallery" <?php if(@$_POST['newsroom'] == 'gallery') { ?> selected <?php } ?>>Pictures</option>-->
                                        
                                    </select>
									  </div>
							<!--	<div class="col-sm-3">
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
                                
                                <div class="col-sm-3">
                                    <label>Event Date</label>
                                    <input class="form-control legis" id="datepicker" type="text" placeholder="<?php echo date('Y-m-d');?>" name="closing_date" <?php
                                                    if (isset($_POST["closing_date"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['closing_date']), '"';}?>/>
                                </div>-->
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
					$fyfrom =htmlspecialchars(strip_tags($_POST['fyFrom']));
					$fyto =htmlspecialchars(strip_tags($_POST['fyTo']));
                    $group = htmlspecialchars(strip_tags($_POST['newsroom']));
                    $event_date = htmlspecialchars(strip_tags($_POST['closing_date']));
                    $today =  htmlspecialchars(strip_tags(date('Y-m-d')));
                    $uploadedby =  htmlspecialchars(strip_tags($_COOKIE['name']));
			
	                $dayDelivered =  htmlspecialchars(strip_tags(substr($event_date, 3,2)));
                    $MonthDelivered =  htmlspecialchars(strip_tags(substr($event_date, 0,2)));
                    $YearDelivered =  htmlspecialchars(strip_tags(substr($event_date, 6,4)));
                    
                    $full_closing_date=  htmlspecialchars(strip_tags($YearDelivered."-".$MonthDelivered."-".$dayDelivered));

                    $document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['name']));
					$image_path =  htmlspecialchars(strip_tags($_FILES['myimage']['name']));
                    $tmp_document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['tmp_name']));
                  
                    if(!file_exists("documents/".$group))
					{
						mkdir("documents/".$group);
					}
                    $document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['name']));
                    $tmp_document_name =  htmlspecialchars(strip_tags($_FILES['myfile']['tmp_name']));
                    $fileExt = htmlspecialchars(strip_tags($_FILES['myfile']['type']));

                    move_uploaded_file($tmp_document_name,"Documents/".$group."/".$document_name);
                    $content =  htmlspecialchars(strip_tags("Documents/".$document_name));
                    
					$image =  htmlspecialchars(strip_tags("images/news/".$image_path));
					
					
                    if($uploadedby == null)
                        header("Location:session_out.php");
                    else{
                    $saveDoc = "INSERT INTO documents_uploaded(id,description,dateuploaded,filepath,image_path,grouptype) VALUES(:id, :description,:dateuploaded,:filepath,:image_path,:grouptype)";
					
                    $db_object=new connection();
                    $db=$db_object->openConnection();
					

                    if($db)
                    {
					
					$stm = $db->prepare($saveDoc);
					if($stm->execute(array(':id' => NULL, ':description' =>  $description, ':dateuploaded' =>  $today,':filepath'=>$content,':image_path'=>$image,':grouptype'=>  $group)))
					{
						
                        echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <center><strong>Document Successfully Uploaded</strong> <a href='' class='alert-link'></a>.</center>
                            </div>";
                            
                    }
                    else{
						
                                echo "<div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <center><strong> could not upload".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
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
