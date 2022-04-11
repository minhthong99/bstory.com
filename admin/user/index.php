<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='user'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<?php
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 1)) {
echo "<script type='text/javascript'>alert('bạn không được phép truy cập');

</script>";

die();
}
?>

<script type="text/javascript">
    document.title = 'Nguoi Dung';
</script>
<?php
//tổng số dòng
$queryTSD = "SELECT count(*) AS TSD FROM users";
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
$stmt = $mysqli->prepare("SELECT * FROM users ORDER BY username LIMIT ?,?");

if ($stmt) {
    //offset

    $stmt->bind_param('ii', $offset, $limit);
    $stmt->execute();
    $ketqua = $stmt->get_result();
?>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Quản lý người dùng</h2>
                
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
                                        <a href="admin/user/add.php" class="btn btn-success btn-md">Thêm</a>


                                    </div>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <form action="" method="GET">
                                            <input type="submit" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                            <input type="text" name="search" class="form-control input-sm" placeholder="Nhập tên truyện" value="<?php if (isset($_GET["search"])) {
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
                                            <th>Username</th>
                                            <th>FullName</th>
                                            <th>Quyền</th>
                                            <th width="160px">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                                            $key = $_GET['search'];
                                            $query = "SELECT * FROM users WHERE id LIKE '%{$key}%' OR  username LIKE '%{$key}%' OR  fullname LIKE '%{$key}%'   LIMIT {$offset},{$limit}";
                                        } else {
                                            $query = "SELECT * FROM users LIMIT {$offset},{$limit}";
                                        }

                                        $result = $mysqli->query($query);
                                        while ($arUser = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $arUser['id'] ?></td>
                                                <td><?php echo $arUser['username'] ?></td>
                                                <td><?php echo $arUser['fullname'] ?></td>
                                                <td><?php if ($arUser['role'] == 1) {echo "Admin";} else {echo "Member";} ?></td>
                                                <td class="center">
                                                    <a href="admin/user/edit.php?id=<?php echo $arUser['id'] ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                                    <a href="admin/user/delete.php?id=<?php echo $arUser['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa không ? ')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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
                                                        <li class="prev"><a href="admin/user/index.php?page=<?php echo $current_page - 1 ?>">Pre</a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page > 3) { ?>
                                                        <li class="start"><a href="admin/user/index.php?page=1">1</a></li>

                                                    <?php } ?>

                                                    <?php if ($current_page - 2 > 0) { ?>
                                                        <li class="page"><a href="admin/user/index.php?page=<?php echo $current_page - 2 ?>"><?php echo $current_page - 2 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page - 1 > 0) { ?>
                                                        <li class="page"><a href="admin/user/index.php?page=<?php echo $current_page - 1 ?>"><?php echo $current_page - 1 ?></a></li>
                                                    <?php } ?>

                                                    <li class="paginate_button active"><a href="admin/user/index.php?page=<?php echo $current_page ?>"><?php echo $current_page ?></a></li>
                                                    <?php if ($current_page + 1 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/user/index.php?page=<?php echo $current_page + 1 ?>"><?php echo $current_page + 1 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page + 2 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/user/index.php?page=<?php echo $current_page + 2 ?>"><?php echo $current_page + 2 ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page  < $tongsotrang - 2) { ?>
                                                        <li class="end"><a href="admin/user/index.php?page=<?php echo $tongsotrang ?>"><?php echo $tongsotrang ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page < $tongsotrang) { ?>
                                                        <li class="next"><a href="admin/user/index.php?page=<?php echo $current_page + 1 ?>">Next</a></li>
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