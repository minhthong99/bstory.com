<?php require_once '../../templates/admin/inc/header.php'; ?>
<?php $currentpage ='story'; ?>
<?php require_once '../../templates/admin/inc/leftbar.php'; ?>
<?php require_once '../../util/DBConnectionUtil.php'; ?>
<script type="text/javascript">
    document.title = 'Them Truyen';
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Truyện</h2>
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
                                    if ($_POST['name'] && $_POST['preview_text'] && $_POST['detail_text'] ) {
                                        $s_name = $_POST['name'];
                                        $s_preview = $_POST['preview_text'];
                                        $s_detail = $_POST['detail_text'];
                                        $s_cat = $_POST['cat_id'];
                                    } else {
                                        $error['name'] = 'Chưa nhập tên truyện';
                                        $error['preview_text'] = 'Chưa nhập mô tả';
                                        $error['detail_text'] = 'Chưa nhập tên chi tiết';
                                    }
                                    if (empty($error)) {
                                     
                                            $query = "INSERT INTO story(name, preview_text, detail_text, cat_id) VALUES ('$s_name','$s_preview','$s_detail','$s_cat')";
                                            if (isset($_FILES['picture']['name'])) {

                                                $file_name = $_FILES['picture']['name'];
                                                $arFile = explode('.', $file_name);
                                                $typeFile = end($arFile);
                                                $newFileName = 'Story-' . time() . '.' . $typeFile;
                                                $tmp_name = $_FILES['picture']['tmp_name'];
                                                $resultUpload =  move_uploaded_file($tmp_name, '../../files/uploads/' . $newFileName);
                                                if ($resultUpload) {
                                                    $query = "INSERT INTO story(name, preview_text, detail_text, cat_id,picture) VALUES ('$s_name','$s_preview','$s_detail','$s_cat','{$newFileName}')";
                                                }
                                            }

                                            $result = $mysqli->query($query);
                                            if ($result) {

                                              echo "thêm truyện thành công";
                                            } else {
                                                echo "không thể thêm truyện";
                                            }
                                       
                                    }
                                }
                                ?>
                                <form role="form" method="POST" enctype="multipart/form-data" class="frmAdd">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" id="name" class="form-control" />
                                        <p class="text-danger"><?php echo isset($error['name']) ? $error['name'] : '' ?></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat_id">
                                            <?php
                                            $query = 'SELECT * FROM cat';
                                            $result = $mysqli->query($query);
                                            while ($arOption = mysqli_fetch_assoc($result)) {
                                            ?>
                                               
                                                <option value="<?php echo $arOption['cat_id'] ?>"><?php echo $arOption['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />

                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"></textarea>
                                        <p class="text-danger"><?php echo isset($error['preview_text']) ? $error['preview_text'] : '' ?></p>
                                    </div>


                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="editor1" class="form-control " rows="5" name="detail_text"></textarea>
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