<?php
  $whereValue="username = '" . $_SESSION["username"] . "';";
  $result = dbQuery($connection, 'user', 'passwd_hash', $whereValue);
  $passwd_hash = getFieldValue($result);
  if ( password_verify($_POST["oldPasswd"],$passwd_hash) ) {
    if ( $_POST["newPasswd"] == $_POST["conNewPasswd"] ) {
      $setValue = "passwd_hash = '" . password_hash($_POST['newPasswd'], PASSWORD_DEFAULT) . "'";
      $whereValue = "username = '" . $_SESSION["username"] . "';";
      $result = dbUpdate($connection, 'user', $setValue, $whereValue);
      if ( $result == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Hasło zostało zmienione.</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Zmiana hasła nie powiodła się.</div>";
      }
    } 
  }
?>
