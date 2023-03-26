<?php
  if ( session_status() != 2 ) {
    session_start();
  }
  if ( isset($_SESSION["username"]) ) {
    if ( isset($_POST) ) {
      #var_dump($_POST);
      if ( isset($_POST["oldPasswd"]) ) {
        include('modules/chpasswd.php');
      } #kolejna czynność
    }
    $whereValue="username = '" . $_SESSION["username"] . "';";
    $result = dbQuery($connection, 'user', 'role', $whereValue);
    $row = mysqli_fetch_row($result);
    $userRole = $row[0];
    #var_dump($userRole);
    include('forms/chpasswd.php');
    if ( $userRole == "admin" ) {
     include('forms/newuser.php'); 
    } 
  } else {
    include('403.php');
  }
?>
