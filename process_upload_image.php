<?php
session_start();
require_once 'dbconn.php';
// $id = $_SESSION['id'];

if(isset($_POST['submitImg'])){

    $sql = "select * from users where uidUsers = '".$_SESSION['userUid']."'";
    // echo $_SESSION['userUid'];
    $result = mysqli_query($conn, $sql);
    // die($sql);
    
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
            $userid = $row['idUsers'];
            // status = 1 means user has no profile pic
            $sql = "insert into profileimg (userid, status) values ('$userid', 1)";
            mysqli_query($conn, $sql);
            
        }
    
    } else {
        echo "You have an error!";
    }

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    // $allowed = array('jpg', 'jpeg', 'png', 'jfif');
    $allowed = array('jpg');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 5000000){
                $fileNameNew = "profileUser".$userid.".".$fileActualExt;
                $fileDestination = 'upload_file/profile/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "update profileimg set status = 0 where userid = '$userid';";
                $result = mysqli_query($conn, $sql);
                header("Location: index.php?profileuploadsuccess");
            } else{
                $message = "Your file is too big!";
                echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php';</script>";
            }
        }else{
            $message = "There was an error uploading your file!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php';</script>";
        }
    } else{
        $message = "Choose your profile picture. You can only upload jpg file.";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='index.php';</script>";
    }

    

    



    
}
    
?>
