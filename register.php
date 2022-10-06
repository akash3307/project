<?php

include'config.php';

if(isset($_POST['submit'])){

    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $pass=mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass=mysqli_real_escape_string($conn, md5($_POST['cpassword']));
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password='$pass'")or die('query failed');

if(mysqli_num_rows($select) >0){
    $message[]='user already exist!';
}else{
    if($pass !=$cpass){
        $message[]='confirm password not matched!';
    
    }
    else{
        $insert = mysqli_query($conn,"INSERT INTO `user_form`(name,email,password) VALUES('$name','$email','$pass')") or die('query failed');
        header('location:login.php');
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width,initial-scale=1.0">
                <title>Register</title>
</head>

<link rel="stylesheet" href="./style.css">
<body>
<div class="form-container">
    <form action="" method="post" entype="multipart/form-data">
    <h3>Register Now</h3>
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
        }
    }
    ?>
<input type="text" name="name" placeholder="Enter username" class="box" required>
<input type="email" name="email" placeholder="Enter email" class="box" required>
<input type="password" name="password" placeholder="Enter password" class="box" required>
<input type="password" name="cpassword" placeholder="confirm password" class="box" required>
<input type="submit" name="submit" value="Register Now" class="btn">
<p>already have an account?<a href="login.php">Login now</a></p>
</form>
</div>

</body>
</html>