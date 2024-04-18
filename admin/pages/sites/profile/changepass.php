<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Password</title>
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../../bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>Change Password</center></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group input-group margin-bottom-sm"> 
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="Current Password" name="password" type="password" value="" required <?php
                                                    if (isset($_POST["password"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['password']), '"';}?> >
                                </div>
                                <div class="form-group input-group margin-bottom-sm"> 
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="New Password" name="newpassword" type="password" value="" required <?php
                                                    if (isset($_POST["newpassword"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['newpassword']), '"';}?> >
                                </div>
                                <div class="form-group input-group margin-bottom-sm"> 
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="Confirm Password" name="confirmpassword" type="password" value="" required <?php
                                                    if (isset($_POST["confirmpassword"]) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['confirmpassword']), '"';}?> >
                                </div>
                                <?php 
                                    require '../../connection.php';
                                    $hostname = gethostname();
                                    $date_time = date('d/m/Y - h:i');
                                    $filename = "../treasury_intranet/logs.txt";

                                    if(isset($_POST['confirmpassword'])){
                                        $username = $_COOKIE['name'];
                                        $password = $_POST['password'];
                                        $newpassword = $_POST['newpassword'];
                                        $confirmpassword = $_POST['confirmpassword'];

                                        $verifyCurrentPassword = "SELECT uname, password FROM limtre_users WHERE uname = '$username' AND password = '$password'";

                                        $exe = mysql_query($verifyCurrentPassword);
                                        if(mysql_num_rows($exe) == 1){

                                            if($newpassword == $confirmpassword){
                                                $changep = "UPDATE limtre_users SET password = '$confirmpassword' WHERE uname = '$username'";
                                                $exeChange = mysql_query($changep);
                                                if($exeChange){
                                                    $handler = fopen($filename, 'a') or die('Unable');
                                                    $content = "$hostname - [$date_time] - Password of $username successfully changed\r\n";
                                                    fwrite($handler, $content);
                                                    fclose($handler);
                                                    echo "<div class='alert alert-success alert-dismissable'>
                                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                        <center><strong>Password Changed. Click <a href='../treasury_intranet/index.php'>here</a> to login</strong> <a href='' class='alert-link'></a>.</center>
                                                    </div>";
                                                }
                                                else{
                                                    $handler = fopen($filename, 'a') or die('Unable') ;
                                                    $content = "$hostname - [$date_time] - Password failed to change. because ".mysql_error()." \r\n";
                                                    fwrite($handler, $content);
                                                    fclose($handler);

                                                    echo "<div class='alert alert-danger alert-dismissable'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <center><strong>Password failed to change.".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                                    </div>";
                                                }
                                            }
                                            else{
                                                    $handler = fopen($filename, 'a') or die('Unable') ;
                                                    $content = "$hostname - [$date_time] - Password for $username failed to change they didnot match \r\n";
                                                    fwrite($handler, $content);
                                                    fclose($handler);
                                                    echo "<div class='alert alert-danger alert-dismissable'>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <center><strong>Password didnot match for $username</strong> <a href='' class='alert-link'></a>.</center>
                                                    </div>";
                                            }
                                        }
                                        else{
                                            $handler = fopen($filename, 'a') or die('Unable') ;
                                            $content = "$hostname - [$date_time] - attempt to change password failed. Incorrect password provided\r\n";
                                            fwrite($handler, $content);
                                            fclose($handler);

                                            echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Your Current Password is incorrect</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
                                        }
                                    }

                                ?>
				            <div class="form-group">
            				    <div class="form-group"><input type="submit" name="changepassword" value="Change Password" class="btn btn-lg btn-success btn-block" /></div>
				            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
