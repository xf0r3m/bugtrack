<?php
  $id = intval($_POST["delCid"]);
  $tableName = 'component';
  $whereValue = "id = " . $id;
  $result = dbDel($connection, $tableName, $whereValue);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Komponent został usunięty</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Komponent nie został usunięty</div>";
  }
?>
 
