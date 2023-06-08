<?php
  $tableName = "clform";
  $columnScheme = "productId,code";
  $setValues = $_POST["CLFPid"] . ",'" . $_POST["CLFormCode"] . "'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Dodano nowy kod formularza listy zmian dla produktu</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się dodać nowego kodu formularza</div>";
  }
  unset($_POST);
?>
