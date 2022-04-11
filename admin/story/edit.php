<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='story'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Sua Truyen';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa truyện</h2>
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
                                $story_id = $_GET['story_id'];
                                $select = "SELECT * FROM story WHERE story_id = {$story_id}";
                                if ($mysqli->query($select)) {
                                    $infostory = mysqli_fetch_assoc($mysqli->query($select));
                                }
                                #update
                                #thuật toán  đặt cờ hiệu
                                if (isset($_POST['submit'])) {
                                    $error = array();
                                    if ($_POST['name'] && $_POST['preview_text'] && $_POST['detail_text']) {
                                        $name = $_POST['name'];
                                        $preview_text = $_POST['preview_text'];
                                        $detail_text = $_POST['detail_text'];
                                        $old_picture = $_POST['picture_old'];
                                        $picture = $_FILES['picture']['name'];
                                    } else {
                                        $error['name'] = 'Chưa nhập tên truyện';
                                        $error['preview_text'] = 'Chưa nhập mô tả';
                                        $error['detail_text'] = 'Chưa nhập tên chi tiết';
                                    }
                                    if (empty($error)) {
                                       

                                            #b2 viết câu lệnh truy vấn
                                            $query = "UPDATE story SET name ='{$name}', preview_text = '{$preview_text}', detail_text = '{$detail_text}' WHERE story_id = {$story_id}";
                                            #b3 kiem tra anh
                                            if (isset($_FILES['picture']['name'])) {
                                                $file_name = $_FILES['picture']['name'];
                                                $arFile = explode('.', $file_name);
                                                $typeFile = end($arFile);
                                                $newFileName = 'Story-' . time() . '.' . $typeFile;
                                                $tmp_name = $_FILES['picture']['tmp_name'];
                                                $resultUpload =  move_uploaded_file($tmp_name, '../../files/uploads/' . $newFileName);

                                                if ($resultUpload) {
                                                    $query = "UPDATE story SET name ='{$name}', preview_text = '{$preview_text}', detail_text = '{$detail_text}',picture='{$newFileName}'  WHERE story_id = {$story_id}";
                                                }
                                            }
                                            #b4 thông báo kết quả
                                            $result = $mysqli->query($query);
                                            if ($result) {

                                               echo "cập nhật truyện thành công";
                                            } else {
                                                echo "không thể cập nhật liên hệ ";
                                            }
                                        }
                                    }
                                
                                ?>
                                <form role="form" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Sửa name</label>
                                        <input type="text" value="<?php echo $infostory['name']; ?>" name="name" class="form-control" />
                                        <p class="text-danger"> <?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Sửa đánh giá</label>
                                        <input type="text" value="<?php echo $infostory['preview_text']; ?>" name="preview_text" class="form-control" />
                                        <p class="text-danger"><?php echo isset($error['preview_text']) ? $error['preview_text'] : '' ?></p>
                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['preview_text']) ? $error['preview_text'] : '' ?></p>

                                    <div class="form-group">
                                        <label>Sửa hình ảnh</label>
                                        <input type="file" name="picture" class="form-control" value="" />
                                        <input type="hidden" name="picture_old" value="<?php echo $infostory['picture'] ?>">
                                    </div>
                                    <img src="<?php echo "files/uploads/{$infostory['picture']}"; ?>" width="100px">

                                    <div class="form-group">
                                        <label>Sửa chi tiết</label>
                                        <textarea name="detail_text" id="editor1" cols="50" rows="30"><?php echo $infostory['detail_text']; ?></textarea>
                                        <p class="text-danger"><?php echo isset($error['detail_text']) ? $error['detail_text'] : '' ?></p>
                                        <script type="text/javascript">
                                            CKEDITOR.replace('editor1', {
                                                filebrowserBrowseUrl: 'library/ckfinder/ckfinder.html',
                                                filebrowserImageBrowseUrl: 'library/ckfinder/ckfinder.html?type=Images',
                                                filebrowserUploadUrl: 'library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                filebrowserImageUploadUrl: 'library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                                            });
                                        </script>
                                    </div>
                                    <p class="text-danger"> <?php echo isset($error['detail_text']) ? $error['detail_text'] : '' ?></p>
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