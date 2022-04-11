<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php 
   
    #b1 lấy id
        $cat_id =$_GET['cat_id'];
    #b2 xóa
        $query = "DELETE FROM cat WHERE cat_id = {$cat_id}";
    #b3 Về trang index thông báo
     if ($mysqli->query($query)){
        HEADER("LOCATION:index.php?msg=xóa danh mục thành công");

     }else{
        echo "không thành công";
     }

?>