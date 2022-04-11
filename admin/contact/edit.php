<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='contact'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Sua Lien He';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa người dùng</h2>
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
                                    $contact_id = $_GET['contact_id'];
                                    $select = "SELECT * FROM contact WHERE contact_id = {$contact_id}";
                                    if($mysqli->query($select)){
                                        $infoContact =mysqli_fetch_assoc($mysqli->query($select));                                                                               
                                    }
                          
                                #update

                                #thuật toán  đặt cờ hiệu
                                if (isset($_POST['submit'])) {
                                    $error = array();
                                    if ($_POST['name'] && $_POST['email'] && $_POST['website'] && $_POST['content']) {
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $website = $_POST['website'];
                                        $content = $_POST['content'];
                                    } else {
                                        $error['name'] = 'Chưa sửa tên người dùng';
                                        $error['email'] = 'Chưa sửa email ';
                                        $error['website'] = 'Mời bạn nhập đầy đủ thông tin';
                                        $error['content'] = 'Mời bạn nhập đầy đủ thông tin';
                                    }
                                    if (empty($error)) {

                                        #b2 viết câu lệnh truy vấn
                                        $query = "UPDATE contact SET name ='{$name}', email = '{$email}', website = '{$website}', content = '{$content}' WHERE contact_id = {$contact_id}";
                                        #b3 thêm dữ liệu vào database
                                        $result = $mysqli->query($query);
                                        #b4 thông báo kết quả
                                        if ($result) {
                                            echo "cập nhật liên hệ thành công";
                                        } else {
                                            echo "không thể cập nhật liên hệ ";
                                        }
                                    }
                                }

                                ?>

                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Sửa name</label>
                                        <input type="text" value="<?php echo $infoContact['name']; ?>" name="name" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Sửa email</label>
                                        <input type="text" value="<?php echo $infoContact['email']; ?>" name="email" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Sửa website</label>
                                        <input type="text" value="<?php echo $infoContact['website']; ?>" name="website" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['website']) ? $error['website'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Sửa content</label>
                                        <input type="text" value="<?php echo $infoContact['content']; ?>" name="content" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['content']) ? $error['content'] : '' ?></p>
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