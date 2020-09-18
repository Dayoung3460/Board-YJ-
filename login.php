<div id="id01" class="login">
    <form action="process_login.php" method="post" class="login-content animate">
        <div class="imgcontainer">
            <span><a class="close" onclick="closeLogin()">x</a></span>
            <img src="./image/person.jpg" alt="Avatar" class="avatar"></img>
        </div>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username/E-mail" name="mailuid" required></input>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pwd" required></input>
            <button class="loginbtn" type="submit" name="login-submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me</input>
            </label>
            <span class="psw">Forgot <a href="#" class="forgotPsw">password? <i class="fas fa-key"></i></a></span>
        </div>
    </form>
</div>
<script>
    const logIn = document.getElementById('id01');

    function openLogin(){
    logIn.style.display = 'block';
}

function closeLogin(){
    logIn.style.display = 'none';
}
</script>