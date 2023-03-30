<?php
  $tableName = 'bug';
  $columnScheme = "*";
  $whereValue = "1=1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    echo "<table class=\"table\">";
    echo "<thead><tr><th scope=\"col\">#Lp.</th><th scope=\"col\">Produkt</th><th scope=\"col\">Komponent</th>";
    echo "<th scope=\"col\">Rodzaj zgłosz.</th><th scope=\"col\">Temat zgłosz.</th><th scope=\"col\">Opis zgłosz.</th>";
    echo "<th></th></tr></thead>";
    echo "<tbody>";
    $n = 1;
    while ( $row = mysqli_fetch_row($result) ) {
      $form = "<form action=\"index.php\" method=\"post\"><input type=\"hidden\" value=\"" . $row[0] . "\" name=\"bugId\"><div classs=\"row\"><div class=\"col\"><select class=\"form-select\" name=\"bugChState\"><option value=\"0\">Przyjęty</option><option value=\"1\" selected>Potwierdzony</option><option value=\"2\">W trakcie</option><option value=\"3\">Zakończony</option></div><div class=\"col\"><button type=\"submit\" class=\"btn btn-primary\">Zmień status</button></div></div></form>";
      echo "<tr><td>" . $n . "</td><th scope=\"row\">";
      $tableName = 'product';
      $columnScheme = 'name';
      $whereValue = 'id = ' . intval($row[1]);
      $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
      echo getFieldValue($result);
      echo "</th><th>";
      $tableName = 'component';
      $columnScheme = 'name';
      $whereValue = 'id = ' . intval($row[2]);
      $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
      echo getFieldValue($result);
      echo "</th>"; 
    }
  } else {
    echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono żadnych zgłoszonych błędów</div>";
  }
?>
