<?php


function checkCountSale(){
  global $db;

  $query = $db->prepare("SELECT count(sale.id) as counts FROM sale  WHERE sale.status =1 ");
  $query->execute();
  if($query->rowCount()>0){
    $count = $query->fetch(PDO::FETCH_OBJ);
    return $count->counts?$count->counts:0;
  }
    return 0;
}
