<?php

require_once 'header.php';
?>

<?php
                if(isset($_GET['error'])){ 
                    if($_GET['error'] == "emptyfields"){ 
                        $message = "Fill in all fields!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if($_GET['error'] == "invalidmailuid"){
                        $message = "Invalid username and e-mail!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if($_GET['error'] == "invaliduid"){
                        $message = "Invalid username!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if($_GET['error'] == "invalidmail"){
                        $message = "Invalid e-mail!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if($_GET['error'] == "passwordcheck"){
                        $message = "Your passwords do not match!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if($_GET['error'] == "usertaken"){
                        $message = "Username is already taken!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }

                else if(isset($_SESSION['userId'])){
                    if($_GET['signup'] == "success"){
                        $message = "Signup successful!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }
                
               

                
            ?>

<div id="signup" class="signup">
                                <div class="signup-content animate">
                                    <div class="welcomecontainer">
                                        <span><a class="close" onclick="closeSignup()">x</a></span>
                                        <div>Be one of our <p class="">Awesome People!</p></div>
                                    </div>
                                    <form class="container" id="signUpForm" action="process_signup.php" method="post">
                                        <div class="form-control">
                                            <label for="username"><b>Username</b></label>
                                            <input type="text" placeholder="Enter Username" name="uid" id="username" required></input>
                                            <!-- <i class="fas fa-check-circle"></i>
                                            <i class="fas fa-exclamation-circle"></i>
                                            <small>Error message</small> -->
                                        </div>

                                        <div class="form-control">
                                            <label for="email"><b>Email</b></label>
                                            <input type="text" placeholder="Enter Email" name="mail" id="email" required></input>
                                            <!-- <i class="fas fa-check-circle"></i>
                                            <i class="fas fa-exclamation-circle"></i>
                                            <small>Error message</small> -->
                                        </div>

                                        <div class="form-control">
                                            <label for="psw"><b>Password</b></label>
                                            <input type="password" placeholder="Enter Password" name="pwd" id="pw" required></input>
                                            <!-- <i class="fas fa-check-circle"></i>
                                            <i class="fas fa-exclamation-circle"></i>
                                            <small>Error message</small> -->
                                        </div>

                                        <div class="form-control">
                                            <label for="repeatPsw"><b>Repeat Password</b></label>
                                            <input type="password" placeholder="Repeat Password" name="pwd-repeat" id="pw2" required></input>
                                            <!-- <i class="fas fa-check-circle"></i>
                                            <i class="fas fa-exclamation-circle"></i>
                                            <small>Error message</small> -->
                                        </div>

                                        <button class="signUpBtn" type="submit" name="signup-submit">Sign Up</button>
                                        <p>or</p>
                                        <button class="signUpBtn signUpWith" type="submit"><i class="fab fa-google"></i> Sign Up with Google</button>
                                        <button class="signUpBtn signUpWith" type="submit"><i class="fab fa-facebook-f"></i> Sign Up with Facebook</button>
                                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
                                    </form>
                                </div>
                            </div>

                            <script>
                                const signUp = document.getElementById('signup');

                                function openSignup(){
    signUp.style.display = 'block';
}

function closeSignup(){
    signUp.style.display = 'none';
}
                            </script>