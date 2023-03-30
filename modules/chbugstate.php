<?php
  $tableName = 'bug';
  $columnScheme = "state";
  $whereValue = "id = " . intval($_POST["bugId"]);
  $bugResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  $bugRow = mysqli_fetch_row($bugResult);
  $oldStateId = $bugRow[0];
  $newStateId = intval($_POST["chBugState"]);

  $setValue = "state = " . $newStateId;
  $whereValue = 'id = ' . intval($_POST["bugId"]);
  $result = dbUpdate($connection, $tableName, $setValue, $whereValue);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Status zgłoszenia został zmieniony</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Status zgłoszenia nie został zmieniony</div>";
  }

  $stateTbl = array("Przyjęty", "Potwierdzony", "W trakcie", "Zakończony");

  $newState = $stateTbl[$newStateId];
  $oldState = $stateTbl[$oldStateId]; 

  $tableName = "comment";
  $columnScheme = "bugId,user,date,content";
  $setValue = intval($_POST["bugId"]) . ",'" . $_SESSION["username"] . "','" . date("Y-m-d H:i:s") . "','Status zgłoszenia został zmieniony z <strong>" . $oldState . "</strong> na <strong>" . $newState . "</strong>'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValue);
?>
