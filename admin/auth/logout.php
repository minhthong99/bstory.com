
<?php
  session_start();
  if(isset($_SESSION['username']) && $_SESSION['username'] !=NULL){
    unset($_SESSION['user']);
    unset($_SESSION['username']);
    HEADER("location:../auth/login.php");
  }

?>