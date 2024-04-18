<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload Manager</title>
    <link rel="shortcut icon" href="../lephalale.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <?php require '../../config/connection.php'; ?>
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <h3 class="panel-title"><center>Login to Rustenburg upload tool</center></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group input-group margin-bottom-sm">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input class="form-control" placeholder="Username" name="uname" type="text" autofocus required  <?php
                                                    if (isset($_POST['uname']) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['uname']), '"';}?> >
                                </div>
                                <div class="form-group input-group margin-bottom-sm"> 
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required <?php
                                                    if (isset($_POST['password']) === TRUE) {
                                                    echo 'value="', strip_tags($_POST['password']), '"';}?> >
                                </div>
<?php
$hostname = gethostname();

if(isset($_POST['login'])) {

    $db_object = new connection();
    $db = $db_object->openConnection();

    $uname = $_POST['uname'];
    $password = $_POST['password'];
	$encrypted_password = md5($password);

    $sql = "SELECT name, pass FROM rustenburg_users WHERE name = :uname";

    if ($db) {

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':uname' => $uname));
        $users = $stmt->fetch();
		//echo $users[''];
        if ($users) {
            if ($encrypted_password== $users['pass']) {

                setcookie('name', $users['name'],time() + 3600);

                header("Location:sites/rustenburg/index.php");
                ob_end_flush();
               
            } else {
                echo "<div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>Your Credintials are incorrect</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
            }
        }
    } else {
        echo 'User not found';
    }
}
?>
				<div class="row">
            				<div class="col-md-12"><input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block" /></div>
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
