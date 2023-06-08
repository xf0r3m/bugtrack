<?php
  if ( isset($_POST) && isset($_POST["editCLFormCode"]) ) {
    if ( empty($_POST["editCLFormCode"]) ) {
      $id = intval($_POST["delCLFid"]);
      $tableName = 'clform';
      $whereValue = "id = " . $id;
      $result = dbDel($connection, $tableName, $whereValue);
      if ( $result == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Kod formularza został usunięty</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Kod formularza nie został usunięty</div>";
      }
    } else {
      $tableName = "clform";
      $setValues = "code='" . $_POST["editCLFormCode"] . "'";
      $whereValue = "id = " . $_POST["CLFid"];
      $result = dbUpdate($connection, $tableName, $setValues, $whereValue);
      if ( $result == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Zapisano zmiany w kodzie formularza.</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udała się zapisać zmian w kodzie formularza.</div>";
      }
    }
  }
?>
