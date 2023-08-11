<?php
  $tableName = 'site';
  $setValues = "theme ='" . mysqli_real_escape_string($connection, $_POST["siteTheme"]) . "'";
  $whereValue = "id = 1";
  $result = dbUpdate($connection, $tableName, $setValues, $whereValue);
  if ( $result == 'true ' ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Domyślny motyw serwisu został zmieniony</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Domyślny motyw nie został zmieniony</div>";
  }
?>
