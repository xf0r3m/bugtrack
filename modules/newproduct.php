<?php
  $tableName = 'product';
  $columnScheme = 'name,author,description';
  $setValues = "'" . $_POST["productName"] . "','" . $_POST["productAuthor"] . "','" . $_POST["productDesc"] . "'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
  if ( $result ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Dodano nowy produkt.</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się dodać produktu.</div>";
  } 
?>
