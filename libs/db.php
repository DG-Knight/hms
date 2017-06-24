<?php
//database Connection variables
define('HOST', 'localhost');
define('DB_NAME', 'hms_db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('CHARSET', 'utf8');
$db = null;//ปิดฐานข้อมูล
try { // ให้พยายามทำงานคำสั่งต่อไปนี้
  $db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
  //$db -> exec("SET CHARACTER SET utf8"); // ให้รองรับภาษาไทย
  $db -> exec("SET CHARACTER SET".CHARSET); // ให้รองรับภาษาไทย
  //echo "ติดต่อฐานข้อมูลได้แล้ว เย้!";
}catch (PDOException $e) { //กรณีทำงานผิดพลาด
  echo "พบปัญหา : ".$e->getMessage(); //แสดง Error
}
?>
