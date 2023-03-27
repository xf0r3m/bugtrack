<?php

  echo "<div class=\"card card-spacer\"><div class=\"card-body\">
  <h5 class=\"card-title\">Lista produktów:</h5>";

  $tableName = 'product';
  $columnScheme = '*';
  $whereValue = "1=1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    echo "<table class=\"table\"><thead><tr><th scope=\"col\">#id</th>
<th scope=\"col\">Nazwa produktu</th><th scope=\"col\">Autor</th>
<th scope=\"col\">Opis produktu</th>
<th scope=\"col\"></th><th scope=\"col\"></th></tr></thead><tbody>";
    while ( $row = mysqli_fetch_row($result) ) {
      echo "<tr><th scope=\"row\">" . $row[0] . "</th><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>";
      include("forms/editproduct.php");
      echo "</td><td>";
      include("forms/delproduct.php");
      echo "</td></tr>"; 
    }
    echo "</tbody></table>";
  } else {
    echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono żadnych produktów!</div>";
  }
  echo "</div></div>";
?>
