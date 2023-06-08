<!-- <div class="card card-spacer">
  <div class="card-header">
    <h4>Lista produktów:</h4>
  </div>
  <div class="card-body"> -->
 <?php
    siteListProducts($connection, $_GET["site"]);
    /*
    $tableName = "product";
    $columnScheme = "*";
    $whereValue = "1=1";
    $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($result) > 0 ) {
      echo "<ul class=\"list-group\">";
      while ( $row = mysqli_fetch_row($result) ) {
        echo "<li class=\"list-group-item\"><a href=\"?p=submit&pid=" . $row[0] ."\">";
        echo $row[1] . "</a> (<em>". $row[2] ."</em>, <span class=\"text-muted\">" . $row[3] . "</span>)</li>";
      }
      echo "</ul>";
    } else {
      echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono żadnych produktów</div>";
    }
    */
  ?>
<!--
  </div>
</div>-->
