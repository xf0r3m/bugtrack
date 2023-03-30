<?php
  $tableName = 'site';
  $columnScheme = 'slogan';
  $whereValue = 'id = 1';
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    $slogan = getFieldValue($result);
    echo "<h3>" . $slogan . "</h3>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie znaleziono sloganu strony</div>";
  }
?>
