<div class="card card-spacer">
  <div class="card-header">
    <h4>Zgłoszenia:</h4>
  </div>
  <div class="card-body">
<?php
  $tableName = 'bug';
  $columnScheme = "*";
  $whereValue = "state > 0";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    echo "<table class=\"table\">";
    echo "<thead><tr><th scope=\"col\">#Lp.</th><th scope=\"col\">#id</th><th scope=\"col\">Produkt</th><th scope=\"col\">Komponent</th>";
    echo "<th scope=\"col\">Rodzaj zgłosz.</th><th scope=\"col\">Temat zgłosz.</th><th scope=\"col\">Opis zgłosz.</th>";
    echo "<th>Status zgłosz.</th></tr></thead>";
    echo "<tbody>";
    $n = 1;
    while ( $row = mysqli_fetch_row($result) ) {
      echo "<tr><td>" . $n . "</td><td><a href=\"?p=comments&bid=" . $row[0] . "\">#" . $row[0] . "</a></td><th scope=\"row\">";
      $tableName = 'product';
      $columnScheme = 'name';
      $whereValue = 'id = ' . intval($row[1]);
      $result2 = dbQuery($connection, $tableName, $columnScheme, $whereValue);
      echo getFieldValue($result2);
      echo "</th><th>";
      $tableName = 'component';
      $columnScheme = 'name';
      $whereValue = 'id = ' . intval($row[2]);
      $result3 = dbQuery($connection, $tableName, $columnScheme, $whereValue);
      echo getFieldValue($result3);
      echo "</th><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td>";
      echo "<td>";
      $stateTbl = array("Przyjęty", "Potwierdzony", "W trakcie", "Zakończony");
      $index = $row[6];
      echo $stateTbl[$index]; 
      echo "</td>";
      ++$n;
    }
    echo "</tbody>";
    echo "</table>";
  } else {
    echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono żadnych zgłoszonych błędów</div>";
  }
?>
  </div>
</div>
