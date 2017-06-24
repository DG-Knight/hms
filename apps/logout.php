<?php
session_start();
unset($_SESSION['AUTHEN']);
header('location: ../index.php');
 ?>
