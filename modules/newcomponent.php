<?php
  $tableName = "component";
  $columnScheme = "productId,name,author,description";
  $setValues = $_POST["productId"] . ",'" . $_POST["componentName"] . "','" . $_POST["componentAuthor"] . "','" . $_POST["componentDesc"] . "'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Dodano nowy komponent dla produktu</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się dodać nowego komponentu dla produktu</div>";
  }
  unset($_POST);
?>
