<div class="card card-spacer">
  <div class="card-body">
   <h5 class="card-title">Motyw serwisu:</h5>
<form action="?p=settings" method="post">
  <input type="hidden" value="1" name="siteId">
    <div class="mb-3">
      <select class="form-select" name="siteTheme">
        <?php
        $themeTbl = array("dark" => "Ciemny", "light" => "Jasny");
        $tableName = 'site';
        $columnScheme = "theme";
        $whereValue = "id = 1";
        $result4 = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($result4) > 0 ) {
          $row1 = mysqli_fetch_row($result4);
          $siteTheme =  $row1[0];
          foreach ($themeTbl as $key => $value) {
            if ( $key == $siteTheme ) {
              echo "<option value=\"" . $siteTheme . "\" selected>" . $value . "</option>";
              continue;
            } else {
              echo "<option value=\"" . $key . "\">" . $value . "</option>";
            }
          }
        }
        ?>
      </select>
    </div>
      <button type="submit" class="btn btn-primary">Zmień motyw</button>
</form>
</div>
</div>
