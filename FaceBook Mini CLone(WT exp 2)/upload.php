<?php
session_start();
$vis = true;
if(isset($_SESSION['us_email']))
{
    $vis = false;
}

?>
<?php
if(isset($_POST["submit"]))
{
$con=new mysqli("localhost","root","","upload");
$f=$_FILES["img"]["name"];
$des=$_POST["desc"];
$n=$_SESSION["name"];
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');
$file_ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
if (!in_array($file_ext, $allowed_types)) {
  echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.')</script>;";
  echo '<script> window.location.replace("upload.php");</script>';
  exit();
}
$u=$con->query("INSERT INTO `images`( `filename`, `description`,`uname`) VALUES ('$f','$des','$n')");
$target_dir = "uploads/";
$file_tmp_name = $_FILES['img']['tmp_name'];
$target_file = $target_dir.basename($f);
move_uploaded_file($file_tmp_name, $target_file);

if(isset($u))
{
  // echo"<script>alert('sucessfully uploaded!!!...');</script>";
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Photos</title>
  <link rel="stylesheet" href="facebook.css">
  <link rel="stylesheet" href="css/cart.css"> 
  
  
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
        echo'<a href="profile.php">Profile</a>';
        echo'<a href="upload.php">Upload</a>';
        echo '<a href="logout.php">Logout</a>';
    }
    ?>
</nav>
</header>

<main>
<div class="card">
<h1>Photo Upload</h1>
<form action="" method="POST" enctype="multipart/form-data">
  <label for="img">Select the image</label>
  <input name ="img" class="input" type="file" id="img" onchange="previewImage(event)">
  <div class="photo">
    <label for="preview">Preview</label>
  <img id="preview" height="25%" width="25%">
  </div>
  <label for="text">description</label>
  <textArea name ="desc" class="input"  id="text" placeholder="Enter the description"></textArea><br>
  <button type="submit" name="submit">Upload</button>
</form>
</div>
</main>
  <script>
    function previewImage(event) {
  var reader = new FileReader(); 
  reader.onload = function() { 
    var preview = document.getElementById('preview'); 
    preview.src = reader.result; 
  }
  reader.readAsDataURL(event.target.files[0]); 
}

  </script>
</body>
</html>