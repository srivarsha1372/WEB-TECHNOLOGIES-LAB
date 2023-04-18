<?php
session_start();
$vis = true;
if(isset($_SESSION['us_email']))
{
    $vis = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Facebook</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="facebook.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cart.css">
    <style>
       .photo {
            width: 100%;
            height: 300px; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .photo img {
        max-width: 100%; 
        max-height: 100%;
        }
        p{
            font-size:10px;
            font-size: 14px;
            line-height: 1.5;
            color: #262626;
            margin: 8px 0;
        }
    </style>

</head>

<body>
    <header>

        <a href="index.php" class="logo">
        
        <i class="uil uil-facebook"></i>
        Facebook 
                        
                    </a>

        <nav class="navbar">
                      
            <?php 
            if($vis == false)
            {   
                echo'<a class="a"href="profile.php">Profile</a>';
                echo'<a class="a"href="upload.php">Upload</a>';
                echo '<a class="a"href="logout.php">Logout</a>';
            }
            ?>
        </nav>
    </header>
    <main class="profile">
        <?php
        if($vis==TRUE){
            echo'
                <div>
                <h2><i class="uil uil-trophy"></i>top 3 liked users</h2>';
            $con=new mysqli("localhost","root","","upload");
            if(isset($con)){
            $sql="SELECT * FROM `images` ORDER BY likes DESC LIMIT 3;";
            $top=$con->query($sql);
            $j=1;
            
            while($i=mysqli_fetch_assoc($top))
            {
                echo'<p>'.$j.".".$i["uname"].'</p><hr>';
                $j+=1;
            }
            echo'</div>';
        }       
       echo'    
                <form class="form" action="login.php" method="POST">
                    <h2 style="margin-left:20px;">Login</h2>
                    <p>Email</p>
                    <input placeholder="Email address or phone number"name = "uemail" class="input" type="text">
                    <p>Password</p>
                    <input placeholder="Password" name="passw" class="input" type="password" id="password"> 
                    <button id="loginBtn"name="submit" type="submit">Log in</button>
                    <a id="forgotPassword" href="reset.html">Forgotten password?</a><br>
                    <a href="signup.php">No account? Register Now!</a>
                </form>
                
                ';
        }
        if($vis == False){
                    
            $con=new mysqli("localhost","root","","upload");
            $query="SELECT  `id`,`filename`, `description`, `uname`, `likes` FROM `images`";
            $r=$con->query($query);
            while($row= mysqli_fetch_assoc($r))
            {
                $u=$row["uname"];
                $t=$row["filename"];
                $s="uploads/" . $t; 
                $d=$row["description"];
                $imgid=$row["id"];   
                $likes=$row["likes"];
            echo'
                <div class="container">
                <div class="feed">
                <h5>'.$u.'</h5>
                <div class="photo">
                <img src="'.$s.'"alt=""></div>
                <p>'.$d.'</p>
                <form action="like.php" method="POST">
                <input type="hidden" name="image_id" value="' . $imgid . '" />
                <button  name="submit" type="submit"><i class="uil uil-thumbs-up"></i>'.$likes.'</button>
                </form>
                <form action="index.php" method="POST">
                <input name="comm" type="text"placeholder="comment..." >
                <input type="hidden" name="image_id" value="' . $imgid . '" />
                <button name="submit" type="submit">Send</button>';
                $q="SELECT `id`, `img_id`, `username`, `comment` FROM `comments` WHERE `img_id`='$imgid'";
                $c=$con->query($q);
                if(isset($c))
                {
                    while($com=mysqli_fetch_assoc($c))
                    {
                        $commenter=$com['username'];
                        $des=$com['comment'];
                        echo'<p><b>'.$commenter.'</b></p>';
                        echo'<p>'.$des.'</p>';
                    }
                }
                echo'</form>
                    </div>
                </div>';
            }  
            if(isset($_POST["submit"]))
            {
                $i=$_POST['image_id'];
                $c=$_POST['comm'];
                $u=$_SESSION["name"];
                $con= new mysqli("localhost","root","","upload");
                $query="INSERT INTO `comments`(`img_id`, `username`, `comment`) VALUES ('$i','$u','$c')";
                $r=$con->query($query);
                if(isset($r))
                {
                    echo"<script>alert('commented');</script>";
                }
            }
        }
        ?>
    </main>
    <script src="js/script.js"></script>

</body>

</html>