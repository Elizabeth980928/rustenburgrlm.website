<?php

include_once 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) 

{
    $name = htmlspecialchars(strip_tags($_POST['uname']));
    $password = htmlspecialchars(strip_tags($_POST['password']));
    $encrypted_password = md5($password);
          
        $db_object=new DatabaseMop();
        $db=$db_object->getConnectionMop();
		
		if($db)
		{
          $sql="INSERT INTO mopani_users (id,uname,password) VALUES ( :id, :uname,:password)";
          $stm = $db->prepare($sql);
        
           if($stm->execute(array(':id' => NULL, ':uname' => $name,':password' =>  $encrypted_password )))
            {
               echo'registered';
            }
			else
			{
				echo'no data inserted';
			}
		}
		else
		{
			echo'No connection';
		}

    
}
?>


