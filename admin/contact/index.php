<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='contact'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Lien He';
</script>
<?php
//tổng số dòng
$queryTSD = "SELECT count(*) AS TSD FROM contact";
$resultTSD = $mysqli->query($queryTSD);
$arTmp = mysqli_fetch_assoc($resultTSD);
$tongSoDong = $arTmp['TSD'];
// số truyện trên 1 trang
$limit = 5;
//tổng số trang
$tongsotrang = ceil($tongSoDong / $limit);

//trang hiện tại
$current_page = 1;
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
}
//offset
$offset = ($current_page - 1) * $limit;
//liên kết phân trang
$stmt = $mysqli->prepare("SELECT * FROM contact ORDER BY name LIMIT ?,?");

if ($stmt) {
    //offset
    
    $stmt->bind_param('ii', $offset,$limit);
    $stmt->execute();
    $ketqua = $stmt->get_result();
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý Liên Hệ</h2>
               
              
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="admin/contact/add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                <form  action="" method="GET">
                                           
                                           <input type="submit" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                           <input type="text" name="search" class="form-control input-sm"  placeholder="Nhập tên truyện" value="<?php if (isset($_GET["search"])) {
                                                                                                                                                   echo $_GET["search"];
                                                                                                                                               } ?>" style="float:right; width: 300px;" />

                                           <div style="clear:both"></div>
                                       </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $key = $_GET['search'];
                                         $query = "SELECT * FROM contact 
                                         WHERE contact_id LIKE '%{$key}%' OR name LIKE '%{$key}%'  OR email LIKE '%{$key}%'  OR website LIKE '%{$key}%'  OR content LIKE '%{$key}%' LIMIT {$offset},{$limit}  ";
                                         
                                    } else {
                                        $query = "SELECT * FROM contact  LIMIT {$offset},{$limit}    ";
                                    }
                                   
                                    $result = $mysqli->query($query);
                                    while ($arContact = mysqli_fetch_assoc($result))  {
                                    ?>
                                        <tr class="<?php echo $cl ?> gradeX">
                                            <td><?php echo $arContact['contact_id'] ?></td>
                                            <td><?php echo $arContact['name'] ?></td>
                                            <td><?php echo $arContact['email'] ?></td>
                                            <td><?php echo $arContact['website'] ?></td>
                                            <td><?php echo $arContact['content'] ?></td>

                                            <td class="center">
                                                <a href="admin/contact/edit.php?contact_id=<?php echo $arContact['contact_id'] ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                                <a href="admin/contact/delete.php?contact_id=<?php echo $arContact['contact_id'] ?>" onclick="return confirm('Bạn có muốn xóa không ?')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ <?php echo $current_page ?> đến <?php echo $tongsotrang ?> của <?php echo $result->num_rows; ?> kết quả </div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                    <?php if ($tongsotrang > 0) { ?>
                                                <ul class="pagination">
                                                    <?php if ($current_page > 1) { ?>
                                                        <li class="prev"><a href="admin/contact/index.php?page=<?php echo $current_page - 1 ?>">Pre</a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page > 3) { ?>
                                                        <li class="start"><a href="admin/contact/index.php?page=1">1</a></li>
                                                       
                                                    <?php } ?>

                                                    <?php if ($current_page - 2 > 0) { ?>
                                                        <li class="page"><a href="admin/contact/index.php?page=<?php echo $current_page - 2 ?>"><?php echo $current_page - 2 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page - 1 > 0) { ?>
                                                        <li class="page"><a href="admin/contact/index.php?page=<?php echo $current_page - 1 ?>"><?php echo $current_page - 1 ?></a></li>
                                                    <?php } ?>

                                                    <li class="paginate_button active"><a href="admin/contact/index.php?page=<?php echo $current_page ?>"><?php echo $current_page ?></a></li>
                                                    <?php if ($current_page + 1 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/contact/index.php?page=<?php echo $current_page + 1 ?>"><?php echo $current_page + 1 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page + 2 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/contact/index.php?page=<?php echo $current_page + 2 ?>"><?php echo $current_page + 2 ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page  < $tongsotrang - 2) { ?>
                                                        <li class="end"><a href="admin/contact/index.php?page=<?php echo $tongsotrang ?>"><?php echo $tongsotrang ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page < $tongsotrang) { ?>
                                                        <li class="next"><a href="admin/contact/index.php?page=<?php echo $current_page + 1 ?>">Next</a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once '../../templates/admin/inc/footer.php'; ?>
<?php $stmt->close();
} ?>