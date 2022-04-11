<?php session_start(); ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 1)) {
echo "<script type='text/javascript'>alert('bạn không được phép truy cập');

</script>";

die();
}
?>
<?php    
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = {$id}";
    $result = $mysqli->query($query);
    if($result){
        HEADER("LOCATION:index.php?msg=xóa người dùng thành công");
    }else{
        echo "không xóa được";
    }

?>
