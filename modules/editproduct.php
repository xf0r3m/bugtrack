<?php
  if ( isset($_POST) && isset($_POST["productId"]) ) {
    $id = intval($_POST["productId"]);
    $tableName = 'product';
    $setValue = "name = '" . $_POST["productName"] . "', author='" . $_POST["productAuthor"] . "', description='" . $_POST["productDesc"] . "'";
    $whereValue = "id = " . $id;
    $result = dbUpdate($connection, $tableName, $setValue, $whereValue);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Zapisano zmiany w produkcie.</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Nie udało się zapisać zmian w produkcie.</div>";
    }
    } else {
    $id = intval($_POST["editPid"]);
    $tableName = 'product';
    $columnScheme = "*";
    $whereValue = "id = " . $id . ";";
    $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( $result == true ) {
      $row = mysqli_fetch_row($result);
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Nie można odnaleźć wybranego produktu</div>";
    }
  }
?>
<?php if ( ! isset($_POST["productId"]) ): ?>
<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Nowy produkt:</h5>
    <form action="?p=settings" method="post">
      <div class="mb-3">
        <label for="productNameInput" class="form-label">Nazwa produktu</label>
        <input type="hidden" name="productId" value="<?php echo $row[0]; ?>">
        <input type="text" class="form-control" id="productNameInput" name="productName" value="<?php echo $row[1]; ?>">
      </div>
      <div class="mb-3">
        <label for="productAuthorInput" class="form-label">Autor produktu</label>
        <input type="text" class="form-control" id="productAuthorInput" name="productAuthor" value="<?php echo $row[2]; ?>">
      </div>
      <div class="mb-3">
        <label for="productDescriptionTextArea" class="form-label">Opis produktu</label>
        <textarea class="form-control" id="productDescriptionTextArea" name="productDesc" rows="2"><?php echo $row[3]; ?></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Zapisz zmiany</button>
    </form>
  </div>
</div>
<?php endif ?>
<?php unset($_POST); ?>  
