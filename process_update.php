<?php
// var_dump($_POST); 

require_once 'dbconn.php';

settype($_POST['id'], 'integer');
$filtered = array(
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
    'category' => mysqli_real_escape_string($conn, $_POST['subject_id']),
    'title' => mysqli_real_escape_string($conn, $_POST['title']),
    'content' => mysqli_real_escape_string($conn, $_POST['content'])
);

$sql = "update board 
        set 
            category = '{$filtered['category']}',
            title = '{$filtered['title']}',
            content = '{$filtered['content']}'
        where
            id = {$filtered['id']}
        ";

// die($sql); 


$result = mysqli_query($conn, $sql);
if($result === false){
    // mysqli_error($conn);
    echo "error in saving data. Talk to admin.";
    error_log(mysqli_error($conn));// 아파치 로그에 에러가 저장됨.
} else{
    // echo 'succeeded. <br><a href="index.php">back</a>';
    header('Location: index.php');
}

// echo $sql;

?>