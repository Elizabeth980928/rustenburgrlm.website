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
                            Documents
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Description</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $getAllDocs = "SELECT filepath, description, grouptype, id FROM newsroom WHERE date_deleted IS NULL ORDER BY id DESC";
                                    $exegetAllDockies = mysql_query($getAllDocs);
                                        $tb .="";
                                        while($row = mysql_fetch_array($exegetAllDockies)){
                                            $rowid = $row[5];
                                            $tb .="<tr class='odd gradeA'><td width='5%'><a href='$row[0]' target='_blank' ><img src='apdf.gif' /></a></td>";
                                            $tb .= "<td width='30%'>$row[1]</td>";
                                            $tb .= "<td width='30%'>$row[2]</td>";
                                            $tb .= "<td width='20%'><a href='updatenewsroom.php?id=$row[3]' >Update</a> - Archive <input type='checkbox' name='archive[]' value='$rowid' /></td>";
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
            
                                             echo $qry = "UPDATE docs  SET date_archived = '$today'  WHERE id =  ".$checked;
                                             echo "<Br/>";
                                            //$exe = mysql_query($qry);
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