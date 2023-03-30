<div class="card card-spacer">
  <div class="card-body">
   <h5 class="card-title">Slogan strony głównej:</h5>
<?php
  $tableName = 'site';
  $columnScheme = 'slogan';
  $whereValue = "id = 1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    $row = mysqli_fetch_row($result);
    echo "<form action=\"?p=settings\" method=\"post\">";
    echo "<div class=\"mb-3\">";
    echo "<label for=\"sloganInput\" class=\"form-label\">Slogan:</label>";
    echo "<input type=\"text\" class=\"form-control\" id=\"sloganInput\" name=\"siteSlogan\" value=\"" . $row[0] ."\">";
    echo "</div>";
    echo "<button type=\"submit\" class=\"btn btn-warning\">Zapisz slogan</button>";
    echo "</form>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie znaleziono sloganu.</div>";
  }
?>
  </div>
</div>
