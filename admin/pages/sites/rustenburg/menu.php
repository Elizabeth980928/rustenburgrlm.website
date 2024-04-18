<link rel="shortcut icon" href="../../../lephalale.ico">
<?php 
require '../../../../config/connection.php'; 
if($_COOKIE['name'] == null )
    header("Location:session_out.php");
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <label class="navbar-brand">Upload Manager - Rustenburg</label>
		
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $_COOKIE['name']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="../profile/changepass.php"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>
                        
                        <li><a href="javascript:history.back()"><i class="fa fa-arrow-left fa-fw"></i> Back</a>
                        </li>
                        <li class="divider"></li>-->
                        <li><a href="../../../index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
			<!--<li class="divider"></li>-->
			<?php
                            if($_COOKIE['name']=="admin"){
                                echo "<li><a href='logs.php'><i class='fa fa-file-word-o fa-fw'></i>Logs</a></li>";
                            }
                        ?>
			
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li>
                            <a href="departments.php" ><i class="fa fa-folder-open fa-fw"></i> Departments</a>
                        </li>-->
                        <li>
                            <a href="newsroom.php"><i class="fa fa-wrench fa-fw"></i>Newsroom</a>
                        </li>
                        <li>
                            <a href="vacancies.php"><i class="fa fa-graduation-cap fa-fw"></i> Vacancies</a>
                        </li>
                        <li>
                            <a href="tenders.php"><i class="fa fa-wrench fa-fw"></i> Tenders</a>
                        </li>
						<!--<li>
                            <a href="documents.php"><i class="fa fa-wrench fa-fw"></i>Maps & GIS</a>
                        </li>-->
			            <li>
                            <a href="documents.php"><i class="fa fa-wrench fa-fw"></i>Documents</a>
                        </li>
			
                       <li>
                            <a href="admin.php"><i class="fa fa-wrench fa-fw"></i> Admin Docs</a>
                        </li>
                        
                    </ul>

                </div>

                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

        </nav>
<script src="jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });


</script> 