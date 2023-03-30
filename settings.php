<?php
  if ( session_status() != 2 ) {
    session_start();
  }
  if ( isset($_SESSION["username"]) ) {
    if ( isset($_POST) ) {
      #var_dump($_POST);
      if ( isset($_POST["oldPasswd"]) ) { include('modules/chpasswd.php'); }
      if ( isset($_POST["nuName"]) ) { include('modules/newuser.php'); }
      if ( isset($_POST["setUPasswd"]) ) { include('modules/setpasswd.php'); }
      if ( isset($_POST["delUid"]) ) { include('modules/deluser.php'); }
      if ( isset($_POST["componentName"]) ) { include('modules/newcomponent.php'); }
      if ( isset($_POST["productId"]) ) { include('modules/editproduct.php'); }
      if ( isset($_POST["productName"]) ) { include('modules/newproduct.php'); }
      if ( isset($_POST["delPid"]) ) { include('modules/delproduct.php'); }
      if ( isset($_POST["editCompId"]) ) { include('modules/editcomponent.php'); }
      if ( isset($_POST["delCid"]) ) { include('modules/delcomponent.php'); }
      if ( isset($_POST["siteSlogan"]) ) { include('modules/saveslogan.php'); }

    }
    $whereValue="username = '" . $_SESSION["username"] . "';";
    $result = dbQuery($connection, 'user', 'role', $whereValue);
    $row = mysqli_fetch_row($result);
    $userRole = $row[0];
    #var_dump($userRole);
    include('forms/chpasswd.php');
    if ( $userRole == "admin" ) {
      echo "<div class=\"card card-spacer\"><div class=\"card-header\"><h4>Użytkownicy:</h4></div><div class=\"card-body\">";
      include('forms/newuser.php');
      include('modules/listusers.php');
      echo "</div></div>";
      echo "<div class=\"card card-spacer\"><div class=\"card-header\"><h4>Produkty:</h4></div><div class=\"card-body\">";
      if ( isset($_POST) && isset($_POST["editPid"]) ) { include('modules/editproduct.php'); }
      else { include('forms/newproduct.php'); }
      include('modules/listproducts.php');
      echo "</div></div>";
      echo "<div class=\"card card-spacer\"><div class=\"card-header\"><h4>Komponenty:</h4></div><div class=\"card-body\">";
      if ( isset($_POST) && isset($_POST["editCid"]) ) { include('modules/editcomponent.php'); }
      else { include('forms/newcomponent.php'); }
      include('modules/listcomponents.php');
      echo "</div></div>";
      echo "<div class=\"card card-spacer\"><div class=\"card-header\"><h4>Strona główna:</h4></div><div class=\"card-body\">";
      include('forms/slogan.php');
      echo "</div></div>";

    } 
  } else {
    include('403.php');
  }
?>
