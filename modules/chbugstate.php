<?php
  $tableName = 'bug';
  $columnScheme = "state";
  $whereValue = "id = " . intval($_POST["bugId"]);
  $newStateId = intval($_POST["chBugState"]);
  if ( $newStateId == 6 ) {
    $tableName = 'comment';
    $whereValue = "bugId = " . intval($_POST["bugId"]);
    $result = dbDel($connection, $tableName, $whereValue);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Komentarz powiązane ze zgłoszeniem usunięte</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Komentarze powiązane ze zgłoszeniem nie zostały usunięte</div>";
    }
    $tableName = 'bug';
    $whereValue = "id = " . intval($_POST["bugId"]);
    $result = dbDel($connection, $tableName, $whereValue);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Zgłoszenie zostało usunięte</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Zgłoszenie nie zostało usunięte</div>";
    }
  } else {
    $bugResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    $bugRow = mysqli_fetch_row($bugResult);
    $oldStateId = $bugRow[0];
      

    $setValue = "state = " . $newStateId;
    $whereValue = 'id = ' . intval($_POST["bugId"]);
    $result = dbUpdate($connection, $tableName, $setValue, $whereValue);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Status zgłoszenia został zmieniony</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Status zgłoszenia nie został zmieniony</div>";
    }

    $stateTbl = array("Przyjęty", "Potwierdzony", "W trakcie", "Zakończony", "Odrzucony", "Zachowany");

    $newState = $stateTbl[$newStateId];
    $oldState = $stateTbl[$oldStateId]; 

    $tableName = "comment";
    $columnScheme = "bugId,user,date,content";
    $setValue = intval($_POST["bugId"]) . ",'" . $_SESSION["username"] . "','" . date("Y-m-d H:i:s") . "','Status zgłoszenia został zmieniony z <strong>" . $oldState . "</strong> na <strong>" . $newState . "</strong>'";
    $result = dbAdd($connection, $tableName, $columnScheme, $setValue);
  }
?>
