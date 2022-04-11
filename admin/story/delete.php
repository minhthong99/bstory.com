<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php
 require_once '../../templates/admin/inc/header.php';
    $story_id = $_GET['story_id'];
    $query = "DELETE FROM story WHERE story_id = ('{$story_id}')";
   
    $result = $mysqli->query($query);
    if($result){
        HEADER("LOCATION:index.php?msg=xóa thành công");

    }else{
        echo "không thể xóa";
    }
 ?>
