<?php



require_once 'dbconn.php';

if(isset($_POST['submit'])){
    $file = $_FILES['contentFile'];
    //$file: array -> key: name, type, tmp_name, error, size
    $fileName = $_FILES['contentFile']['name'];
    $fileType = $_FILES['contentFile']['type'];
    $fileTmpName = $_FILES['contentFile']['tmp_name'];
    $fileError = $_FILES['contentFile']['error'];
    $fileSize = $_FILES['contentFile']['size'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                
                $fileDestination = 'upload_file/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header('Location: index.php?postuploadsuccess');
            } else{
                echo "Your file is too big!";
            }
        }else{
            echo "There was an error uploading your file!";
        }
    } else{
        echo "You cannot upload files of this type!";
    }
}

$filtered = array(
    'title' => mysqli_real_escape_string($conn, $_POST['title']),
    'content' => mysqli_real_escape_string($conn, $_POST['content']),
    'subject_id' => mysqli_real_escape_string($conn, $_POST['subject_id'])
);

$sql = "insert into board (title, content, date, category)
        values(
            '{$filtered['title']}',
            '{$filtered['content']}',
            NOW(),
            '{$filtered['subject_id']}'
            )
        ";

 // die($sql);

$result = mysqli_query($conn, $sql);

if($result === false){
    echo "Failed to upload a post. Talk to admin.";
    error_log(mysqli_error($conn));
} else{
    header('Location: index.php');
}

?>