<?php
$emailid=$_POST["uemail"];
$pwd=$_POST["password"];
$mysqli= new mysqli("localhost","root","","upload");
$b=$mysqli->query("SELECT * FROM user_details WHERE email='$emailid' ");
if(isset($b))
{
   $c =$mysqli->query("UPDATE `user_details` SET `passw`='$pwd' WHERE email ='$emailid'");
   if(isset($c))
   {
        echo '<script> alert("Changed Successful! Login with new password!");</script>';
        echo '<script> window.location.replace("index.php ");</script>';
   }
   else{
    echo '<script> alert("Invalid!");</script>';
}
}

?>
