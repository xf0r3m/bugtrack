<?php
  $tableName = "dictionary";
  $columnScheme = "productId,clformId,dictionary";
  $setValues = $_POST["dictPid"] . "," . $_POST['dictCLFid'] . ",'" . $_POST["dictionary"] . "'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Dodano słownik dla produktu</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się dodać nowego słownika</div>";
  }
  unset($_POST);
?>
