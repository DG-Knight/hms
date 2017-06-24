<?php
function CheckAuthenticationAndAuthorization(){
  if (!isset($_SESSION['AUTHEN']['UserId'])) {
  header('location: ../../index.php');
    die();
  }
}
?>
