<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../../bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
    function redirc(){
	
	
        var goTo = document.getElementById("docs_id").value;
        var page = goTo+".php";
        location.href = page;
	
	
    }
</script>
<?php require_once('menu.php'); ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-sm-3"><br/>
                                        <select class="form-control legisChoose" name="docs" id= "docs_id" onchange="return redirc();">
                                            <option value="#">-- Select --</option>
                                                <option value="admin_documents">All documents</option>
						                        
                                            </optgroup>
                                    </select>
                                </div><!--<br/><input type="submit" class="btn btn-primary btn-sm" value="GO" onclick="return redirc();" />-->
               
            </div>
           
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