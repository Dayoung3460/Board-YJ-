<!-- *********************** write popup page *******************-->


<?php

if(isset($_SESSION['userId'])){
    echo '<button class="mainTop-btn" onclick="openWrite()">Write</button>';
} else{ 
    echo '<button class="mainTop-btn" onclick="openLogin()">Login to Write <i class="fas fa-pencil-alt"></i></button>';
    require_once 'login.php';
}

require_once 'dbconn.php';
$sql = "select * from subject";
$result = mysqli_query($conn, $sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$select_form = '<select name = "subject_id">';
while($row = mysqli_fetch_array($result)){
    $select_form .= '<option value = "'.$row['category'].'">'.$row['category'].'</option>';
}
$select_form .= '</select>';



?>
<div id="write" class="write">
                                <form action="process_write.php" method="post" class="write-content animate"
                                        enctype="multipart/form-data"
                                         onsubmit = "if(!confirm('Are you sure to create this?')){return false;}">
                                    <div class="writeContainer">
                                        <span><a class="close" onclick="closeWrite()">x</a></span>
                                        <img src="./image/writeBG.jpg" alt="writeImg" class="writeImg"></img>
                                        <p>Share your thoughts</p>
                                    </div>
                                    <div class="container">
                                        <label for="title"><b>Title</b></label>
                                        <?=$select_form?>
                                        <input type="text" name="title" required placeholder="Title here"></input>
                                        <br>
                                        <label for="content"><b>Content</b></label>
                                        <textarea type="textarea" name="content" class="content" required> </textarea>
                                        <br>
                                        <label for="image"><b>Attach Image</b></label>
                                        <br>
                                        <input type="file" name="contentFile" class="inputImg">
                                            <div class="write_imgcontainer">
                                                <img class="write_uploadImg" src="" alt="" width="100%" height="auto">
                                            </div>         
                                        </input>
                                        <button class="writeBtn" type="submit" name="submit">Post</button>
                                    </div>
                                </form>
                            </div> 
                            <script>
                                    const write_imgcontainer = document.querySelector('.write_imgcontainer');
                                    const inputImg = document.querySelector('.inputImg');
                                    const write_uploadImg = document.querySelector('.write_uploadImg');



                                    inputImg.addEventListener("change", function(){
                                        const file = this.files[0];

                                        if(file){
                                        const reader = new FileReader();

                                        reader.onload = function(){
                                            const result = reader.result;
                                            write_uploadImg.src = result;
                                            write_imgcontainer.classList.add("active");
                                        }

                                        reader.readAsDataURL(file);
                                        }
                                    });

                                    const write = document.getElementById('write');

                                    function openWrite(){
	write.style.display = 'block';
}

function closeWrite(){
    write.style.display = 'none';
}
                            </script>