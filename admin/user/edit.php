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
    document.title = 'Sua Nguoi Dung';
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
                                $id = $_GET['id'];
                                $select = "SELECT * FROM users WHERE id = {$id}";
                                if ($mysqli->query($select)) {
                                    $infoUser = mysqli_fetch_assoc($mysqli->query($select));
                                }

                                #update

                                #thuật toán  đặt cờ hiệu
                                if (isset($_POST['submit'])) {
                                    $error = array();
                                    if ($_POST['username'] && $_POST['fullname'] && $_POST['password']) {
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        $fullname = $_POST['fullname'];
                                        $role = $_POST['role'];
                                    } else {
                                        $error['username'] = 'Chưa nhập tên người dùng';
                                        $error['password'] = 'Chưa nhập mật khẩu';
                                        $error['fullname'] = 'Chưa nhập full name';

                                        if ($_POST['password'] != $_POST['re_password']) {
                                            $error['re_password'] = 'Mật khẩu chưa chính xác';
                                        } else {
                                            $error['re_password'] = 'Chưa nhập mật khẩu';
                                        }
                                    }
                                    if (empty($error)) {
                                    
                                        $md5password = md5($password);
                                        #b2 viết câu lệnh truy vấn
                                        $query = "UPDATE users SET username ='{$username}', password = '{$md5password}', fullname = '{$fullname}',role ='{$role}' WHERE id = {$id}";
                                        #b3 thêm dữ liệu vào database
                                        $result = $mysqli->query($query);
                                        #b4 thông báo kết quả
                                        if ($result) {
                                           echo "cập nhật người dùng thành công" ;
                                        } else {
                                            echo "không thể cập nhật người dùng ";
                                        }
                               
                                    
                                }
                                }

                                ?>

                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>Sửa Username</label>
                                        <input type="text" value="<?php echo $infoUser['username']; ?>" name="username" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Sửa Password</label>
                                        <input type="password" value="<?php echo $infoUser['password']; ?>" name="password" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Nhập lại Password</label>
                                        <input type="password" value="" name="re_password" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['re_password']) ? $error['re_password'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Sửa FullName</label>
                                        <input type="text" value="<?php echo $infoUser['fullname']; ?>" name="fullname" class="form-control" />

                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['fullname']) ? $error['fullname'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Quyền</label>
                                        <select name="role" class="form-control">
                                            <option  value=1>Admin</option>
                                            <option  value=2 >Member</option>
                                        </select>

                                    </div>
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