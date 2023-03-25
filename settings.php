<?php
  if ( session_status() != 2 ) {
    session_start();
  }
  if ( isset($_SESSION["username"]) ) {
    if ( isset($_POST) ) {
      #var_dump($_POST);
      if ( isset($_POST["oldPasswd"]) ) {
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
    }
    }
    $whereValue="username = '" . $_SESSION["username"] . "';";
    $result = dbQuery($connection, 'user', 'role', $whereValue);
    $row = mysqli_fetch_row($result);
    $userRole = $row[0];
    #var_dump($userRole);
      echo "<div class=\"card\">
  <div class=\"card-header\">
    <h4>Hasło:</h4>
  </div>
  <div class=\"card-body\">
<form action=\"?p=settings\" method=\"post\">
  <div class=\"row mb-3\">
    <label for=\"oldPassword\" class=\"col-sm-2 col-form-label\">Stare hasło:</label>
    <div class=\"col-sm-10\">
      <input type=\"password\" class=\"form-control\" id=\"oldPassword\" name=\"oldPasswd\">
    </div>
  </div>
  <div class=\"row mb-3\">
    <label for=\"newPassword\" class=\"col-sm-2 col-form-label\">Nowe hasło:</label>
    <div class=\"col-sm-10\">
      <input type=\"password\" class=\"form-control\" id=\"newPassword\" name=\"newPasswd\">
    </div>
  </div>
  <div class=\"row mb-3\">
    <label for=\"conNewPassword\" class=\"col-sm-2 col-form-label\">Potwierdź nowe hasło:</label>
    <div class=\"col-sm-10\">
      <input type=\"password\" class=\"form-control\" id=\"conNewPassword\" name=\"conNewPasswd\">
    </div>
  </div>
<button type=\"submit\" class=\"btn btn-primary\">Zmień hasło</button>
</form>
  </div>
</div>";
    if ( $userRole == "admin" ) {
      
    } 
  } else {
    include('403.php');
  }
?>
