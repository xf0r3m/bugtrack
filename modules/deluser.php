<?php
  $tableName = 'user';
  $whereValue = "id = " . intval($_POST["delUid"]);
  $result = dbDel($connection, $tableName, $whereValue);
  if ( $result ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Użytkownik został usunięty.</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Użytkownik nie został usunięty.</div>";
  }
?>
