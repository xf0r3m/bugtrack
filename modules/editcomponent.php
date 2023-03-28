<?php
  if ( isset($_POST) && isset($_POST["editCompName"]) ) {
    $tableName = "component";
    $setValues = "productId=" . intval($_POST["editCompProductId"]) . ",name='" . $_POST["editCompName"] . "',author='" . $_POST["editCompAuthor"] . "',description='" . $_POST["editCompDesc"] . "'";
    $whereValue = "id = " . intval($_POST["editCompId"]);
    $result = dbUpdate($connection, $tableName, $setValues, $whereValue);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Zapisano zmiany w komponencie.</div>";
    } else {
      echo "<div class=\"alert alert-success\" role=\"alert\">Nie udała się zapisać zmian w komponencie.</div>";
    }
  } else {
    $id = intval($_POST["editCid"]);
    $tableName = "component";
    $columnScheme = "productId,name,author,description";
    $whereValue = "id = " . $id;
    $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($result) > 0 ) {
      $row1 = mysqli_fetch_row($result);
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się odnleźć wybranego komponentu.</div>"; 
    }
  }
?>
<?php if ( ! isset($_POST["editCompName"]) ): ?>
<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Nowy komponent:</h5>
      <?php
        $tableName = "product";
        $columnScheme = "id,name";
        $whereValue = "1=1";
        $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($result) > 0 ) {
          $thereAreProducts = true;
        } else {
          $thereAreProducts = false;
        }
      ?>
        <form action="?p=settings" method="post">
          <div class="mb-3">
            <label for="productSelect" class="form-label">Produkt</label>
            <select class="form-select" aria-label="Product select" id="productSelect" name="editCompProductId">
              <option selected>Wybierz produkt</option>
              <?php
                if ( mysqli_num_rows($result) > 0 ) {
                  while ( $row = mysqli_fetch_row($result) ) {
                    if ( $row1[0] == $row[0] ) {
                      echo "<option selected value=" . $row[0] . ">" . $row[1] . "</option>"; 
                      continue;
                    }
                   echo "<option value=" . $row[0] . ">" . $row[1] . "</option>"; 
                  }
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="hidden" name="editCompId" value="<?php echo $_POST["editCid"]; ?>">
            <label for="componentNameInput" class="form-label">Nazwa komponentu</label>
            <input type="text" class="form-control" id="componentNameInput" name="editCompName" value="<?php echo $row1[1]; ?>">
          </div>
          <div class="mb-3">
            <label for="componentAuthorInput" class="form-label">Autor komponentu</label>
            <input type="text" class="form-control" id="componentAuthorInput" name="editCompAuthor" value="<?php echo $row1[2]; ?>">
          </div>
          <div class="mb-3">
            <label for="componentDescInput" class="form-label">Opis komponentu</label>
            <textarea class="form-control" id="componentDescInput" name="editCompDesc" rows="2"><?php echo $row1[3]; ?></textarea>
          </div>
          <button type="submit" class="btn btn-warning">Zapisz zamiany</button>
        </form> 
  </div>
</div>
<?php endif ?>
