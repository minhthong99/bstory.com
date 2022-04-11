<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='contact'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Them Lien He';
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
                                    if ($_POST['name'] && $_POST['email'] && $_POST['website'] && $_POST['content']) {
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $website = $_POST['website'];
                                        $content = $_POST['content'];
                                    } else {
                                        $error['name'] = 'Chưa nhập tên danh mục';
                                        $error['email'] = 'Chưa nhập email';
                                        $error['website '] = 'Chưa nhập website';
                                        $error['content'] = 'Chưa nhập nội dung';
                                    }
                                    if (empty($error)) {
                                        
                                        #b2 viết câu lệnh truy vấn
                                        $query = "INSERT INTO contact(name,email,website,content) VALUES ('{$name}','{$email}','{$website}','{$content}') ";
                                        print_r($query);
                                        #b3 thêm dữ liệu vào database
                                        $result = $mysqli->query($query);
                                        #b4 thông báo kết quả
                                        if ($result) {
                                         echo "thêm liên hệ thành công";
                                        } else {
                                            echo "không thể thêm liên hệ ";
                                        }
                                    }
                                }

                                ?>
                                <form role="form" method="POST" enctype="multipart/form-data" class="frmAdd" >
                                    <div class="form-group">
                                        <label>Tên </label>
                                        <input type="text" name="name" class="form-control" />

                                    </div>
                                    <p class="text-danger"><?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" />

                                    </div>
                                    <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="website" class="form-control" />

                                    </div>
                                    <p class="text-danger"><?php echo isset($error['website']) ? $error['website'] : '' ?></p>
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        
                                        <textarea id="editor1" class="form-control " rows="5" name="content"></textarea>

                                        <script type="text/javascript"> 
                                        CKEDITOR.replace('editor1', {
                                            filebrowserBrowseUrl: 'library/ckfinder/ckfinder.html',
                                            filebrowserImageBrowseUrl: 'library/ckfinder/ckfinder.html?type=Images',
                                            filebrowserUploadUrl: 'library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                            filebrowserImageUploadUrl: 'library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                                        });
                                    </script>

                                    </div>
                                    <p class="text-danger"><?php echo isset($error['content']) ? $error['content'] : '' ?></p>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>

                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('.frmAdd').validate({
                                            rules: {
                                                name: {
                                                    require: true,
                                                },
                                                email: {
                                                    require: true,
                                                },
                                               website: {
                                                    require: true,
                                                },
                                               content: {
                                                    require: true,
                                                }
                                            }
                                        });
                                    });
                                </script>
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