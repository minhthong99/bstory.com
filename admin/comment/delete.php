<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php 
    require_once '../../templates/admin/inc/header.php';
    
    #b1 lấy id
        $comment_id =$_GET['comment_id'];
    #b2 xóa
        $query = "DELETE FROM comment WHERE comment_id = {$comment_id}";
    #b3 Về trang index thông báo
     if ($mysqli->query($query)){
        HEADER("LOCATION:index.php?msg=xóa bình luận thành công");

     }else{
        echo "không thành công";
     }

?>