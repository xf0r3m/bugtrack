<?php

  if ( isset($_POST) && isset($_POST["editDictionary"]) ) {
    if ( empty($_POST["editDictionary"]) ) {
      $id = intval($_POST["dictId"]);
      $tableName = 'dictionary';
      $whereValue = "id = " . $id;
      $result = dbDel($connection, $tableName, $whereValue);
      if ( $result == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Słownik został usunięty</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Słownik nie został usunięty</div>";
      }
    } else {
      $tableName = "dictionary";
      $setValues = "dictionary='" . $_POST["editDictionary"] . "'";
      $whereValue = "id = " . $_POST["dictId"];
      $result = dbUpdate($connection, $tableName, $setValues, $whereValue);
      if ( $result == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Zapisano zmiany w słowniku.</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udała się zapisać zmian w słowniku.</div>";
      }
    }
  }
?>
