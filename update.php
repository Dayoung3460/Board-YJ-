<?php
require_once 'header.php';
?>

<!--================================ update page ============================-->
<div class="main-container" id="myMain">
                    <?php
                        
                        $article = array( 
                            'title' => '',
                            'content' => ''
                        );

                        if(isset($_GET['id'])){
                            
                            require_once 'dbconn.php';
                            $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
                            settype($filtered_id, 'integer');
                            $sql = "select * from board where id = {$filtered_id}";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);

                            $article['title'] = htmlspecialchars($row['title']);
                            $article['content'] = htmlspecialchars($row['content']);

                            $sql = "select * from subject";
                            $result = mysqli_query($conn, $sql);
                            $select_form = '<select name = "subject_id">';
                            while($row = mysqli_fetch_array($result)){
                                $select_form .= '<option value = "'.$row['category'].'">'.$row['category'].'</option>';
                            }
                            $select_form .= '</select>';
                            
                        }
                    ?>

                    <div class="detailPage" style="display: block;">
                        <div class="detailContainer">
                            <p id="dPageTxt">see what others think</p>
                        </div>
                        <form action="process_update.php" method="post" class="container" 
                                onsubmit="if(!confirm('Are you sure to update it?')){return false;}">
                            <input type="hidden" name = "id" value = "<?=$_GET['id']?>">
                            <?=$select_form?>
                            <label for="title"><b>Title</b></label>
                            <textarea class="title" name="title">
                                <?=$article['title']?>
                            </textarea>
                            <br>
                            <label for="content"><b>Content</b></label>
                            <textarea class="content" name="content">
                                <?=$article['content']?>
                            </textarea>
                            <br>
                            <label for="image"><b>Image</b></label>
                            <div class="img"></div>
                            <br>
                            <button class="writeBtn" type="submit">
                                <a style="text-decoration: none; color: var(--primary-color2); display: block;">Update</a>
                            </button>
                        </form>
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