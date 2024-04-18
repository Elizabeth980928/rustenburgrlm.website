<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Register New User</title>
<link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">
<?php //require '../../../connection.php';?>
<link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-default">
<div class="panel-heading">
                        <h3 class="panel-title">Register New User</h3>
</div>
<div class="panel-body">
<form method="post" role="form">
<fieldset>
<div class="form-group input-group margin-bottom-sm">
	<div class="form-group input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required  <?php
                if (isset($_POST["email"]) === TRUE) {
                    echo 'value="', strip_tags($_POST['email']), '"';}?> >
    </div>
    <div class="form-group input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
            <input class="form-control" placeholder="Fullnames" name="fullname" type="text" required  <?php
                if (isset($_POST["fullname"]) === TRUE) {
                    echo 'value="', strip_tags($_POST['fullname']), '"';}?> >
    </div>
    <div class='form-group'>
    	<select class='form-control' name='yourrole'>
    		<option value="Admin">Admin</option>
    		<option value="Normal User">Normal User</option>
    	</select>
    </div><br/>
    <br/><input type="submit" name="register" value="Register" class="btn btn-lg btn-success btn-block" />

</div>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
<?php 
	if(isset($_POST['register'])){
		require '../../connection.php';
		$fullname = $_POST['fullname'];
		$email = md5($_POST['email']);
		$password = md5('1234');
		$yourrole = $_POST['yourrole'];
		$register = "INSERT INTO users(fullnames, roles, email, password) VALUES('$fullname','$yourrole','$email','$password')";
		$exe = mysql_query($register);
		if($exe) {
			echo "<br/><div class='alert alert-info alert-success'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <center><strong>Registered</strong> <a href='#'' class='alert-link'></a>.</center>
                                                </div>";
           mysql_close();
         }
        else "<br/><div class='alert alert-danger alert-dismissable'>
                                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                <center><strong>".mysql_error()."</strong> <a href='' class='alert-link'></a>.</center>
                                            </div>";
	}
?>
<script src="../../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="../../../dist/js/sb-admin-2.js"></script>
</body>
</html>