<?php

require_once 'dbconn.php';

settype($_POST['id'], 'integer');

$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id'])
  );

$sql = "DELETE FROM board WHERE id = {$filtered['id']}";

$result = mysqli_query($conn, $sql);
if($result === false){
    echo "error in deleting data. Talk to admin.";
    error_log(mysqli_error($conn));
} else{
    // echo 'succeeded deleting. <br><a href="index.php">back</a>';
    header('Location: index.php');
}
