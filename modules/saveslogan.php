<?php
  $tableName = 'site';
  $setValues = "slogan ='" . mysqli_real_escape_string($connection, $_POST["siteSlogan"]) . "'";
  $whereValue = "id = 1";
  $result = dbUpdate($connection, $tableName, $setValues, $whereValue);
  if ( $result == 'true ' ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Slogan strony głównej został zmieniony</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Slogan nie został zmieniony</div>";
  }
?>
