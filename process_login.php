<?php


if(isset($_POST['login-submit'])){
    require 'dbconn.php';
    global $mailuid;
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password)){
        header("Location: index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "select * from users where uidUsers=? or emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if($pwdCheck == false){
                    header("Location: index.php?error=wrongpassword");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId']=$row['idUsers'];
                    $_SESSION['userUid']=$row['uidUsers'];
                    $_SESSION['id'] = 1;

                    
                    header("Location: index.php?login=success&user={$row['uidUsers']}");
                    exit();
                }
            }
            else{
                header("Location: index.php?error=wrongpwd");
                exit();
            }
        }
    }
    
}
else{
    header("Location: index.php");
    exit();
}


?>







