<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='cat'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Them Danh Muc Truyen';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm thể loại</h2>

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
                                        $query1 = "SELECT * FROM cat WHERE name = '{$name}'";
                                        #b3 thêm dữ liệu vào database
                                        $resultSelect = $mysqli->query($query1);
                                        if (mysqli_num_rows($resultSelect) == 0) {
                                            $query = "INSERT INTO cat(name) VALUE ('{$name}') ";
                                            $result = $mysqli->query($query);
                                            #b4 thông báo kết quả
                                            if ($result) {
                                                echo "thêm danh mục thành công";
                                            } else {
                                                echo "không thể thêm danh mục ";
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Tên thể loại</label>
                                        <input type="text" name="name" class="form-control" />

                                    </div>
                                    <p class="text-danger"><?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>

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