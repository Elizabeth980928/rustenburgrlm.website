<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../../bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<?php require_once('menu.php'); ?>
<form method="post">
<div id="page-wrapper">
            
            <?php// require_once ('admin.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All documents
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Description</th>
                                            <th>Group</th>
                                            <th>Financial Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									
								     error_reporting(E_ALL);
                                     ini_set('display_errors', 1);
									 
									 date_default_timezone_set('Africa/Johannesburg');

									 $db_object=new DatabaseLGB();
                                     $db=$db_object->getConnectionLGB();
									
									
                                        $getAllDocs = "SELECT filepath, description, grouptype, fyfrom, fyto, id FROM wp_docs WHERE datedeleted IS NULL ORDER BY id DESC";
                                      									
										$stmt = $db->prepare( $getAllDocs);
                                        $stmt->execute();
										
                                        $tb ="";
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                            $rowid = $row['id'];
                                            $tb .="<tr class='odd gradeA'><td width='5%'><a href='$row[filepath]' target='_blank' ><img src='apdf.gif' /></a></td>";
                                            $tb .= "<td width='30%'>$row[description]</td>";
                                            $tb .= "<td width='30%'>$row[grouptype]</td>";
                                            $tb .= "<td width='10%'>$row[fyfrom]/$row[fyto]</td>";
                                            $tb .= "<td width='20%'><a href='updatedocuments.php?id=$rowid' >Update</a> - Archive <input type='checkbox' name='archive[]' value='$rowid' /></td>";
                                        }
                                        echo $tb .= "</tr></tbody></table>";
                                        if(isset($_POST['btnArchive']) && empty($_POST['archive']) && !isset($_POST['archive'])){
                                        echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>You didnot choose document(s) to archive. Choose by ticking next to it under Action Coloumn </strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                        }

                                        if(isset($_POST['btnArchive']) && !empty($_POST['archive']) && isset($_POST['archive'])){
                                            $today = date('Y-m-d');
                                            foreach($_POST['archive'] as $checked){
            
                                             echo $qry = "UPDATE documents_uploaded  SET datedeleted = '$today'  WHERE id =  ".$checked;
                                             echo "<Br/>";
                                            //$exe = mysql_query($qry);
											
										    $stmt = $db->prepare( $qry);
                                            $stmt->execute();
                                        }
                                        echo "<div class='alert alert-success alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Successfully Archived</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                        }
                                     ?>   
                                    <input type="submit" class="btn btn-primary btn-lg" value="Archive" name="btnArchive"/>
                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- /#page-wrapper -->
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

     <script src="../../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>