<?php
    
    if(isset($_POST['signup-submit'])){
        
        require 'dbconn.php';
        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordRepeat = $_POST['pwd-repeat'];


        // when all four blanks are empty
        if(empty($username)||empty($email)||empty($password)||empty($passwordRepeat)){ 
            header("Location: index.php?error=emptyfields&uid=".$username."&mail=".$email);
            exit();
        } 

        // when email and username are invalid
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: index.php?error=invalidmailuid");
            exit(); 
        }

        // when email is invalid and username is valid
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: index.php?error=invalidmail&uid=".$username);
            exit(); 
        }

        // when username is invalid and email is valid
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){ 
            header("Location: index.php?error=invaliduid&mail=".$email);
            exit(); 
        }
        
        // when pwds are not matched. username and email are valid.
        else if($password !== $passwordRepeat){
            header("Location: index.php?error=passwordcheck&uid=".$username."&mail=".$email);
            exit(); 
        }

        //username shouldn't be the same as the one already in db
        else{
            $sql = "select uidUsers from users where uidUsers=?";
            $stmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: index.php?error=sqlerror");
                exit();
            }

            else{
                mysqli_stmt_bind_param($stmt, "s", $username); 
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt); 
                if($resultCheck > 0){
                    header("Location: index.php?error=usertaken&mail=".$email);
                    exit();
                }

                //if username is new, insert into db
                else{
                    $sql= "insert into users (uidUsers, emailUsers, pwdUsers) values (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: index.php?error=sqlerror");
                        exit();
                    }
                    else{
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                         
                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: index.php?signup=success");
                        exit();
                    }
                }

            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
    else{
        header("Location: index.php");
        exit();
    }
