<?php
    session_start();
    require_once 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Awesome People</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">

        <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="./css/responsive.css?v=<?php echo time(); ?>">
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Russo+One&display=swap" rel="stylesheet">
    </head>
    <body>
        
        <div class="wrapper">
            <!--========================= header menu ============================= -->
            <div class="header">
                <div class="header-menu">
                    <div class="header-text"><a href="index.php">Awesome People</a></div>
                    <div class="openbtn" onclick="toggleSidebar()">
                        <i class="fas fa-th-list"></i>
                    </div>
                    <ul>

                        <?php 
                        
                            if(isset($_SESSION['userId'])){
                                echo '<li><a class="button" onclick="openLogin()" style="width:auto;">Log out</a></li>';
                                require_once 'logout.php';
                            } else{
                                echo '<li><a class="button" style="width:auto;" onclick="openLogin()">Log In</a></li>';
                                require_once 'login.php';
                                echo '<li><a class="button" style="width:auto;" onclick="openSignup()">Sign Up</a></li>';
                                require_once 'signup.php';
                            }
                        ?>
                        
                        <li><a href="#" class="dark-mode" id="dark-mode" onclick="darkMode()"><i class="fas fa-moon"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--=================================== side bar ================================== -->
            <div class="sidebar" id="mySidebar">
                <div class="sidebar-menu">
                    <a href="javascript:void(0)" class="closebtn" onclick="toggleSidebar()">×</a>
                    <div class="profile">
                        <!-- <img src="./image/default.png" alt=""> -->






                                            <?php
                                            if(isset($_SESSION['userId'])){
                                                $sql = "select * from users where uidUsers = '".$_SESSION['userUid']."'";
                                                $result = mysqli_query($conn, $sql);

                                                if(mysqli_num_rows($result)>0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $id = $row['idUsers'];
                                                         
                                                        $sqlImg = "select * from profileimg where userid='$id' limit 1";
                                                        
                                                        $resultImg = mysqli_query($conn, $sqlImg);
                                                        // var_dump($resultImg);
                                                        if(mysqli_num_rows($resultImg)>0){
                                                            while($rowImg = mysqli_fetch_assoc($resultImg)){
                                                                if($rowImg['status'] == 0){
                                                                //    echo "<img src='/upload_file/profile/profileUser".$id.".jpg'?".mt_rand().">";
                                                                   echo "<img src='upload_file/profile/profileUser".$id.".jpg'>";
                                                                }else{
                                                                    echo "<img src = 'image/default.png'>";
                                                                }
                                                                
                                                           }
                                                        }else{
                                                            echo "<img src = 'image/default.png'>";
                                                        } 
                                                        
                                                    }
                                                } 
                                            } else{
                                                echo "<img src = 'image/default.png'>";
                                            }
                                                
                                                
                                                
                                            ?>


                        <p><?php
                        if(!isset($_SESSION['userId'])){
                            echo "user";
                        } else {
                            echo $_SESSION['userUid'];
                        }
                        ?></p>
                    </div>
                    <ul>
                        <li class="item">
                            <a href="#" class="menu-btn">
                                <i class="fas fa-desktop"></i><span>Board</span>
                            </a>
                        </li>

                        
                        <li class="item">
                            <a href="#sub-menu1" class="menu-btn">
                                <i class="fas fa-user"></i><span>Profile</span><i class="fas fa-chevron-down drop-down" id="down"></i>
                            </a>
                            <div class="sub-menu" id="sub-menu1">
                                
                                    
                                            
                                            
                                            <?php
                                                if(isset($_SESSION['id'])){
                                                    if($_SESSION['id'] == 1){
                                                    }
                                                    echo "<a onclick='openUploadImg()'><i class='fas fa-camera'></i><span>Photo</span></a>
                                                            <div id='upload' class='upload'>
                                                            <div class='upload-content animate'>
                                                                <span><a class='close' onclick='closeUploadImg()'>x</a></span>
                                                                <div class='uploadContainer'>
                                                                    <div class='imgcontainer'>
                                                                        <img class='uploadImg' src='' alt=''>
                                                                    </div>
                                                                    <div class='content'>
                                                                        <div class='icon'><i class='fas fa-file-image'></i></div>
                                                                            <div class='text'>No file chosen yet.</div>
                                                                        </div>
                                                                    <div class='close uploadClose'>x</div>
                                                                    <div class='file-name'>File name here</div>
                                                                </div>
                                                                <form class='uploadBtn' action='process_upload_image.php' method='post' enctype='multipart/form-data'>
                                                                    <a onclick='chooseImg()' class='chooseImg' style='padding: 10px;
                                                                                                                    margin: 0 auto;
                                                                                                                    color: black;
                                                                                                                    text-align: center;
                                                                                                                    border: none;'>
                                                                        Choose a file
                                                                    </a>
                                                                      <input class='openFileBtn' type='file' name='file' hidden>
                                                                    <button class='uploadFinalBtn' type='submit' name='submitImg'>upload</button>
                                                                </form>
                                                            </div>
                                                        </div>";
                                                } 
                                            
                                            ?>
                                                
                                        
                                <a href="#"><i class="fas fa-signature"></i><span>Name</span></a>
                            </div>
                        </li>
                        <li class="item">
                            <a href="#sub-menu2" class="menu-btn">
                                <i class="fas fa-envelope"></i><span>Message</span><i class="fas fa-chevron-down drop-down" id="down"></i>
                            </a>
                            <div class="sub-menu" id="sub-menu2">
                                <a href="#"><i class="fas fa-envelope-open"></i><span>New</span></a>
                                <a href="#"><i class="far fa-envelope-open"></i><span>Sent</span></a>
                                <a href="#"><i class="fas fa-exclamation-triangle"></i><span>Spam</span></a>
                            </div>
                        </li>
                        <li class="item">
                            <a href="#sub-menu3" class="menu-btn">
                                <i class="fas fa-cog"></i><span>Setting</span><i class="fas fa-chevron-down drop-down" id="down"></i>
                            </a>
                            <div class="sub-menu" id="sub-menu3">
                                <a href="#"><i class="fas fa-lock"></i><span>Password</span></a>
                                <a href="#"><i class="fas fa-globe-asia"></i><span>Language</span></a>
                            </div>
                        </li>
                        
                            
                        
                        
                        <li class="item">
                            <a href="#" class="menu-btn">
                                <i class="fas fa-user"></i></i><span>Visits: </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

<script>
    
function darkMode() {
    var x, i;
   const body = document.querySelector('.wrapper .main-container');
   x = document.querySelectorAll(".mainTop-btn");

    for (i = 0; i < x.length; i++) {
        x[i].classList.toggle("darkModeBtn");
    }

   body.classList.toggle("dayAndDark");
}



    const upLoad = document.getElementById('upload');
    // const page = document.getElementById('pagination');
//     const main = document.getElementById("myMain");
// const side = document.getElementById("mySidebar");

function toggleSidebar(){
    main.classList.toggle("collapseMain");
    side.classList.toggle("collapseSide");
}

    function openUploadImg(){
    upLoad.style.display = 'block';
	// page.style.zIndex = '-1';
}

function closeUploadImg(){
    upLoad.style.display = 'none';
	// page.style.zIndex = '0';
}



const uploadContainer = document.querySelector('.uploadContainer');
            const fileName = document.querySelector('.file-name');
            const openFileBtn = document.querySelector('.openFileBtn');
            const uploadClose = document.querySelector('.uploadClose');
            const uploadImg = document.querySelector('.uploadImg');

	        

            let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

            function chooseImg(){
                openFileBtn.click();
            }

            openFileBtn.addEventListener("change", function(){
                const file = this.files[0];

                if(file){
                const reader = new FileReader();

                reader.onload = function(){
                    const result = reader.result;
                    uploadImg.src = result;
                    uploadContainer.classList.add("active");
                }

                uploadClose.addEventListener("click", function(){
                    uploadImg.src = "";
                    uploadContainer.classList.remove("active");
                })

                reader.readAsDataURL(file);
                }

                if(this.value){
                let valueStore = this.value.match(regExp);
                fileName.textContent = valueStore;
                }
            }); 



</script>