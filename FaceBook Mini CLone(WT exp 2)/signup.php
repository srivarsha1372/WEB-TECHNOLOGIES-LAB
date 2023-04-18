<?php
session_start();
if (isset($_SESSION['us_email']))
{
    header('Location: index.php');
    exit();
}

function validate($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    return $str;
}
if(isset($_POST['submit']))
{
    $uemail  = validate($_POST['uemail']);
    $passw = validate($_POST['passw']);
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $con = new mysqli("localhost","root","","upload");
    $query2 = "SELECT * FROM user_details WHERE email='$uemail'";
    $query1="INSERT INTO `user_details`( `username`, `email`, `passw`, `phone_no`) VALUES ('$name','$uemail','$passw','$phone')";
    $query = "INSERT INTO user_details VALUES ('$name','$uemail','$passw','$phone')";
    $res=$con->query($query2);
    if($res->num_rows > 0)
    {
        echo '<script> alert("Already Signed up!");</script>';
        echo '<script> window.location.replace("index.php");</script>';
    }

    $smt = $con->query($query1);

    try{

    $_SESSION['us_email'] = $uemail;
    $_SESSION['name']=$name;
    echo '<script> alert("Signed up successfully!");</script>';
    echo '<script> window.location.replace("index.php");</script>';
    }
    catch(mysqli_sql_exception $e){
        echo '<script> alert("Some error occured!");</script>';
    }
     
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Sign up page
    </title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
    
                        <div class="form">
                            <form action="" method="POST">
                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Sign up</h2>
                                <p class="text-white-50 mb-5">Please enter your detials...</p>

                                <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeEmailX">Name</label>
                                    <input  name = "name" type="text" id="typeEmailX" class="form-control form-control-lg" required/>
                                    
                                </div>

                                <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeEmailX">Email</label>
                                    <input  name = "uemail" type="email" id="typeEmailX" class="form-control form-control-lg" required/>
                                    
                                </div>

                                <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Password</label>
                                    <input name="passw" type="password" id="typePasswordX" class="form-control form-control-lg" required/>
                                 
                                </div>
                                
                                <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeEmailX">Phone no.</label>
                                    <input  name = "phone" type="text" id="typeEmailX" class="form-control form-control-lg" required/>
                                    
                                </div>
                                <button name="submit" class="btn-outline-light btn-lg px-5" type="submit">Sign up</button>

                            </div>
                            </form>
                        </div>
                    
</body>

</html>