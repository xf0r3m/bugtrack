<?php
  $tableName = "product";
  $columnScheme = "id,name";
  $whereValue = "id=" . $_POST["viewCLFPid"];
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    $row = mysqli_fetch_row($result);
    $pid = $row[0];
    $product = $row[1];
  }
?>

<div class="card card-spacer">
  <div class="card-body">
    <?php if ( isset($product) ): ?>
      <h5 class="card-title">Nowy formularz dla produktu: <?php echo $product; ?></h5>
        <form action="?p=settings" method="post">
          <input type="hidden" name="CLFPid" value="<?php echo $pid; ?>" />
          <div class="mb-3">
            <label for="componentDescInput" class="form-label">Kod formlarza</label>
            <textarea class="form-control" id="CLFormCodeInput" name="CLFormCode" rows="2" placeholder="Kod HTML formlarza. Znaczniki <script> są niedozwolone."></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Dodaj formularz</button>
        </form> 
      <?php else: ?>
        <h5 class="card-title">Nowy formularz dla produktu:</h5>
        <div class="alert alert-primary" role="alert">Nie znaleziono żadnych produktów.</div>
      <?php endif ?>
  </div>
</div>
