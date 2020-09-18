<?php
//var_dump($_POST); 

$conn = mysqli_connect("localhost", "root", "1234", "boardTable");

settype($_POST['id'], 'integer');

$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id'])
  );

  $sql = "DELETE FROM board WHERE id = {$filtered['id']}";

//die($sql); 

$result = mysqli_query($conn, $sql);
if($result === false){
    echo "error in deleting data. Talk to admin.";
    error_log(mysqli_error($conn));
} else{
    // echo 'succeeded deleting. <br><a href="index.php">back</a>';
    header('Location: index.php');
}


?>