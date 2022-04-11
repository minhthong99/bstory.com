<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php
 require_once '../../templates/admin/inc/header.php';
 
    #b1 lấy id
    $contact_id = $_GET['contact_id'];
    #b2 câu lệnh query xóa
    $query = "DELETE FROM contact WHERE contact_id = ('{$contact_id}')";
    #b3 quay về trang index
    $result = $mysqli->query($query);
    if($result){
        HEADER("LOCATION:index.php?msg=xóa liên hệ thành công");

    }else{
        echo "xóa không thành công";
    }
 
 
 ?>
