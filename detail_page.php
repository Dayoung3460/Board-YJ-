<?php
session_start();
require_once 'header.php';
?>

                
                  <!--================================ detail(article) page ============================-->
                  <div class="main-container" id="myMain">
                    <?php
                        
                        

                        $article = array( 
                            'category' => '',
                            'title' => '',
                            'content' => '',
                            'filename' => '',
                            'writer' => ''
                        );

                        $update_link = '';
                        $delete_link = '';
                        $category = '';
                        
                        if(isset($_GET['id'])){

                            require_once 'dbconn.php';
                            $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
                            settype($filtered_id, 'integer');
                            $sql = "select * from board where id = {$filtered_id}";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);

                            $article['category'] = htmlspecialchars($row['category']);
                            $article['title'] = htmlspecialchars($row['title']);
                            $article['content'] = htmlspecialchars($row['content']);
                            $article['filename'] = htmlspecialchars($row['filename']);
                            $article['writer'] = htmlspecialchars($row['writer']);

                            $_SESSION['file'] = $article['filename'];

                            $update_link = '<a href="update.php?id=' . $_GET['id'] . '">Update</a>';
                            $delete_link = '
                                <form action="process_delete.php" method="post" onsubmit="if(!confirm(\'Are you sure to delete it?\')){return false;}">
                                    <input type="hidden" name="id" value="' . $_GET['id'] . '">
                                    <input type="submit" value="Delete" class="deleteBtn">
                                </form>
                            ';
                            $category = "{$article['category']}";
                        }
                    ?>

                    <div class="detailPage" style="display: block;">
                        <div class="detailContainer">
                            <p id="dPageTxt">see what others think</p>
                        </div>
                        <div class="container" name="detailPageForm">
                            <div class="btnCon">

                            <?php
                            
                            if(isset($_SESSION['userUid'])){
                                if($_SESSION['userUid'] == $article['writer']){
                                echo $update_link;
                                echo $delete_link;
                            }
                            }
                            
                            ?>
                               
                            </div>
                            
                            <label for="title"><b>Title</b>

                            <?php 
                                if($category != "category: "){
                                    echo "<br>[".$category."]";
                                } else {
                                    echo "<br>[&emsp;&emsp;&nbsp;]";}
                            ?>
                            
                            </label>
                            <textarea class="title readTitle" readonly name="dPageTitle" value=""><?=$article['title']?></textarea>
                            <br>
                            <label for="content"><b>Content</b></label>
                            <textarea class="content" readonly name="dPageContent"> <?=$article['content']?></textarea>
                            <br>
                            <label for="image"><b>Image</b></label>
                            <div class="img">
                                <img src="upload_file/<?=$article['filename']?>" alt="">
                            </div>
                            <br>
                            <button class="writeBtn">
                                <a href="index.php" style="text-decoration: none; color: var(--primary-color2); display: block;">Back</a>
                            </button>
                        </div>      
                    </div> 
                </div>
<script>
       const main = document.getElementById("myMain");
const side = document.getElementById("mySidebar");

function toggleSidebar(){
    main.classList.toggle("collapseMain");
    side.classList.toggle("collapseSide");
}
</script>
        <?php
        require_once 'footer.php';
        ?>