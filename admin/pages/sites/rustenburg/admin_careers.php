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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Vacancies
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Description</th>
                                            <th>Group</th>
                                            <th>Closing Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $getAllDocs = "SELECT filepath, description, grouptype, closingdate,id FROM careers ORDER BY (datediff(curdate(),closingdate) <= 0)";
                                    $exegetAllDockies = mysql_query($getAllDocs);
                                        $tb .="";
                                        while($row = mysql_fetch_array($exegetAllDockies)){
                                            $tb .="<tr class='odd gradeA'><td width='5%'><a href='$row[0]' target='_blank' ><img src='apdf.gif' /></a></td>";
                                            $tb .= "<td width='30%'>$row[1]</td>";
                                            $tb .= "<td width='30%'>$row[2]</td>";
                                            $tb .= "<td width='10%'>$row[3]</td>";
                                            $tb .= "<td width='10%'><a href='updatevac.php?id=$row[4]' >Update</a> - Delete</td>";
                                        }
                                        echo $tb .= "</tr></tbody></table>";

                                     ?>   
                                    
                                
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