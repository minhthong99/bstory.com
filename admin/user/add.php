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
    document.title = 'Them Nguoi Dung';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Người dùng</h2>
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

                                        if ($_POST['password'] != $_POST['repassword']) {
                                            $error['repassword'] = 'Mật khẩu chưa chính xác';
                                        } else {
                                            $error['repassword'] = 'Chưa nhập mật khẩu';
                                        }
                                    }

                                    if (empty($error)) {
                                    
                                            $md5Password = md5($password);
                                            $query2 = "INSERT INTO users(username,password,fullname,role) VALUES ('{$username}','{$md5Password}','{$fullname}','{$role}') ";
                                            $result = $mysqli->query($query2);
                                            if ($result) {
                                                echo "thêm người dùng thành công";
                                            } else {
                                                echo "không thể thêm người dùng ";
                                            }
                                        }
                                    }
                                
                                ?>
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <label>User name</label>
                                        <input type="text" name="username" class="form-control" />

                                    </div>
                                    <p class="text-danger">
                                        <?php echo isset($error['username']) ? $error['username'] : '' ?>
                                    </p>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control">

                                    </div>
                                    <p class="text-danger">
                                        <?php echo isset($error['password']) ? $error['password'] : '' ?>
                                    </p>
                                    <div class="form-group">
                                        <label>Re-Password</label>
                                        <input type="password" name="repassword" class="form-control">

                                    </div>
                                    <p class="text-danger">
                                        <?php echo isset($error['repassword']) ? $error['repassword'] : '' ?>
                                    </p>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="fullname" class="form-control">

                                    </div>
                                    <p class="text-danger">
                                        <?php echo isset($error['fullname']) ? $error['fullname'] : '' ?>
                                    </p>
                                    <div class="form-group">
                                        <label>Quyền</label>
                                        <select name="role" class="form-control">
                                            <option value=1>Admin</option>
                                            <option value=2>Member</option>
                                        </select>

                                    </div>
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
<!-- /. PAGE WRAPPER  -->
<?php require_once '../../templates/admin/inc/footer.php'; ?>