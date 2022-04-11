<?php require_once '../../util/DBConnectionUtil.php'; ?>


<?php
//tổng số dòng
$queryTSD = "SELECT count(*) AS TSD FROM comment";
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
$offset = ($current_page - 1) * $limit;
//liên kết phân trang
$stmt = $mysqli->prepare("SELECT * FROM comment ORDER BY comment_id LIMIT ?,?");

if ($stmt) {
    //offset

    $stmt->bind_param('ii', $offset, $limit);
    $stmt->execute();
    $ketqua = $stmt->get_result();

?>
    <?php require_once '../../templates/admin/inc/header.php'; ?>
    <?php $currentpage ='comment'; ?>
    <?php require_once '../../templates/admin/inc/leftbar.php'; ?>

    <script type="text/javascript">
        document.title = 'Quản lý comment';
    </script>

    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Quản lý bình luận</h2>
               
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
                            
                                    <div class="col-sm-12" style="text-align: right;">
                                        <form  action="" method="GET">
                                           
                                            <input type="submit" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                            <input type="text" name="search" class="form-control input-sm"  placeholder="Nhập comment" value="<?php if (isset($_GET["search"])) {
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
                                            <th>Story Name</th>
                                            <th>Username</th>
                                             <th>Nội dung bình luận</th>       
                                             <th>Created at</th>                                                                                                
                                            <th width="160px">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                                            $key = $_GET['search'];
                                             $query = "SELECT comment.*,story.name as story_name FROM comment INNER JOIN story ON comment.story_id = story.story_id  WHERE comment_id LIKE '%{$key}%' OR username LIKE '%{$key}%' OR comment_detail LIKE '%{$key}%' LIMIT {$offset},{$limit}";
                                             
                                        } else {
                                            $query = "SELECT comment.*,story.name as story_name FROM comment INNER JOIN story ON comment.story_id = story.story_id  LIMIT {$offset},{$limit} ";
                                        }


                                        $result = $mysqli->query($query);
                                    
                                        while ($arComment = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr class="<?php echo $cl ?> gradeX">
                                                <td><?php echo $arComment['comment_id'] ?></td>
                                                <td><?php echo $arComment['story_name'] ?></td>
                                                <td><?php echo $arComment['username'] ?></td>
                                                <td><?php echo $arComment['comment_detail'] ?></td>
                                                <td><?php echo $arComment['comment_date']?></td>
                                                <td class="center">
                                                    
                                                    <a href="admin/comment/delete.php?comment_id=<?php echo $arComment['comment_id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa k? ')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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
                                                        <li class="prev"><a href="admin/comment/index.php?page=<?php echo $current_page - 1 ?>">Pre</a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page > 3) { ?>
                                                        <li class="start"><a href="admin/comment/index.php?page=1">1</a></li>

                                                    <?php } ?>

                                                    <?php if ($current_page - 2 > 0) { ?>
                                                        <li class="page"><a href="admin/comment/index.php?page=<?php echo $current_page - 2 ?>"><?php echo $current_page - 2 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page - 1 > 0) { ?>
                                                        <li class="page"><a href="admin/comment/index.php?page=<?php echo $current_page - 1 ?>"><?php echo $current_page - 1 ?></a></li>
                                                    <?php } ?>

                                                    <li class="paginate_button active"><a href="admin/comment/index.php?page=<?php echo $current_page ?>"><?php echo $current_page ?></a></li>
                                                    <?php if ($current_page + 1 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/comment/index.php?page=<?php echo $current_page + 1 ?>"><?php echo $current_page + 1 ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($current_page + 2 < $tongsotrang + 1) { ?>
                                                        <li class="page"><a href="admin/comment/index.php?page=<?php echo $current_page + 2 ?>"><?php echo $current_page + 2 ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page  < $tongsotrang - 2) { ?>
                                                        <li class="end"><a href="admin/comment/index.php?page=<?php echo $tongsotrang ?>"><?php echo $tongsotrang ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($current_page < $tongsotrang) { ?>
                                                        <li class="next"><a href="admin/comment/index.php?page=<?php echo $current_page + 1 ?>">Next</a></li>
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