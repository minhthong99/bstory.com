<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='cat'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Sua Danh Muc Truyen';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa thể loại truyện</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                #Select
                                $cat_id = $_GET['cat_id'];
                                $select = "SELECT * FROM cat WHERE cat_id = {$cat_id} ";
                                if ($mysqli->query($select)) {
                                    $infoCat = mysqli_fetch_assoc($mysqli->query($select));
                                }
                                #update
                                #thuật toán  đặt cờ hiệu
                                if (isset($_POST['submit'])) {
                                    $error = array();
                                    if ($_POST['name']) {
                                        $name = $_POST['name'];
                                    } else {
                                        $error['name'] = 'Chưa nhập tên danh mục';
                                    }
                                    if (empty($error)) {
                                      
                                            #b2 viết câu lệnh truy vấn
                                            $query = "UPDATE cat SET name =  '{$name}' WHERE cat_id = {$cat_id}";
                                            #b3 thêm dữ liệu vào database
                                            $result = $mysqli->query($query);
                                            #b4 thông báo kết quả
                                            if ($result) {
                                                echo "cập nhật danh mục thành công";
                                            } else {
                                                echo "không thể cập nhật danh mục ";
                                            }
                                       
                                        }
                                    }
                                
                                ?>

                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Sửa thể loại</label>
                                        <input type="text" value="<?php echo $infoCat['name']; ?>" name="name" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Cập nhật</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<?php require_once '../../templates/admin/inc/footer.php'; ?>