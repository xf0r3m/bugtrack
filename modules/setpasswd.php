<?php
  $tableName = 'user';
  $passwd_hash = password_hash($_POST["setUPasswd"], PASSWORD_DEFAULT);
  $setValue = "passwd_hash = '" . $passwd_hash . "'";
  $whereValue = "id = " . intval($_POST["setUid"]);
  $result = dbUpdate($connection, $tableName, $setValue, $whereValue);
  if ( $result ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Hasło zostało pomyślnie nadane.</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się ustawić hasła.</div>";
  }
?>
