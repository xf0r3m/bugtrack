<?php
  $id = intval($_POST["delPid"]);
  $tableName = 'component';
  $whereValue = "productId = " . $id;
  $result = dbDel($connection, $tableName, $whereValue);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Usunięto wszystkie komponenty produktu</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Komponenty produktu nie zostały usunięte</div>";
  }

  $tableName = 'product';
  $whereValue = "id = " . $id;
  $result = dbDel($connection, $tableName, $whereValue);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Produkt został usunięty</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Produkt nie został usunięty</div>";
  }
?>
 
