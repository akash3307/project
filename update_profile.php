<?php
include 'config.php';
session_start();
$user_id=$_SESSION['user_id'];
if(isset($_POST['update_profile'])){
    $update_name=mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email=mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_adds=mysqli_real_escape_string($conn, $_POST['update_adds']);
    $update_city=mysqli_real_escape_string($conn, $_POST['update_city']);
    $update_phone=mysqli_real_escape_string($conn, $_POST['update_phone']);
    $update_dob=mysqli_real_escape_string($conn, $_POST['update_dob']);

    mysqli_query($conn, "UPDATE `user_form` SET name='$update_name', email ='$update_email', address='$update_adds', city='$update_city', phone='$update_phone', dob='$update_dob' WHERE id ='$user_id'") or die('query failed');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
<div class="update-profile">
<?php
    $select=mysqli_query($conn,"SELECT * FROM `user_form` WHERE id='$user_id'")or die('query failed');
    if(mysqli_num_rows($select) > 0 ){
        $fetch=mysqli_fetch_assoc($select);
    }
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
        }
    }
    ?>
    <form action="" method="post" entype="multipart/form-data">
        <div class="flex">
            <div class="inputbox">
                <span>username :</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']?>" class="box">
                <span>Your email :</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']?>" class="box">
                <span>City : </span>
    <input type="text" name="update_city" placeholder="Enter the City" class="box">
</div>
 <div class="inputbox">
    <span>Address :</span>
 <input type="text" name="update_adds" placeholder="Enter Address" class="box">
 <span>Date Of Birth:</span>
<input type="dob" name="update_dob" placeholder="yyyy/mm/dd" class="box">
    <span>Phone Number: </span>
    <input type="number" name="update_phone" placeholder="Enter phone number" class="box">
 </div>
</div>
<input type="submit" value="update Profile" name="update_profile" class="btn">
<a href="home.php" class="delete-btn">Go Back</a>
</form>
</div>
</body>
</html>