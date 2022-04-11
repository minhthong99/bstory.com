<?php
    if(!isset($_SESSION['user'])){
        HEADER("LOCATION:../../admin/auth/login.php");
    }
?>