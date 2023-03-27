<?php

  echo "<div class=\"card card-spacer\"><div class=\"card-body\">
  <h5 class=\"card-title\">Lista użytkowników</h5>";

  $tableName = 'user';
  $columnScheme = '*';
  $whereValue = "1=1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    echo "<table class=\"table\"><thead><tr><th scope=\"col\">#id</th>
<th scope=\"col\">Nazwa użytkownika</th><th scope=\"col\">Rola</th>
<th scope=\"col\">Przypisz hasło</th>
<th scope=\"col\">Usuń użytkownika</th></tr></thead><tbody>";
    while ( $row = mysqli_fetch_row($result) ) {
      echo "<tr><th scope=\"row\">" . $row[0] . "</th><td>" . $row[1] . "</td><td>" . $row[3] . "</td><td>";
      include("forms/setpasswd.php");
      echo "</td><td>";
      include("forms/deluser.php");
      echo "</td></tr>"; 
    }
    echo "</tbody></table>";
  } else {
    echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono użytkowników!</div>";
  }
  echo "</div></div>";
?>
