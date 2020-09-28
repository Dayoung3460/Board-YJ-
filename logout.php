<?php
require_once 'header.php';
?>

<div id="id01" class="login">
    <form action="process_logout.php" method="post" class="login-content animate">
        <div class="imgcontainer">
            <span><a class="close" onclick="closeLogin()">x</a></span>
            <img src="./upload_file/profile/profileUser<?= $_SESSION['userId'] ?>.jpg" alt="Avatar" class="avatar"></img>
        </div>
        <div class="container">
            <p>Are you sure to log out?</p>
            <button class="loginbtn" type="submit" name="logout-submit">Logout</button>
        </div>
    </form>
</div>

<script>
    const logIn = document.getElementById('id01');

    function openLogin() {
        logIn.style.display = 'block';
    }

    function closeLogin() {
        logIn.style.display = 'none';
    }
</script>