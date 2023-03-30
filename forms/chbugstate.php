<form action="index.php" method="post">
  <input type="hidden" value="<?php echo $row[0]; ?>" name="bugId">
  <div class="row">
    <div class="col">
      <select class="form-select" name="chBugState">
        <?php
        $stateTbl = array('Przyjęty', 'Potwierdzony', 'W trakcie', 'Zakończony');
        $tableName = 'bug';
        $columnScheme = "state";
        $whereValue = "id = " . intval($row[0]);
        $result4 = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($result4) > 0 ) {
          $row1 = mysqli_fetch_row($result4);
          $bugState =  $row1[0];
          for ($i = 0; $i < count($stateTbl); $i++) {
            if ( $i == $bugState ) {
              echo "<option value=\"" . $bugState . "\" selected>" . $stateTbl[$bugState] . "</option>";
              continue;
            } else {
              echo "<option value=\"" . $i . "\">" . $stateTbl[$i] . "</option>";
            }
          }
        }
        ?>
      </select>
    </div>
    <div class="col">
      <button type="submit" class="btn btn-primary">Zmień status</button>
    </div>
  </div>
</form>
