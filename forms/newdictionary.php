<?php
  $tableName = "product";
  $columnScheme = "id,name";
  $whereValue = "id=" . $_POST["viewCLFPid"];
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    $rowP = mysqli_fetch_row($result);
    $pid = $rowP[0];
    $product = $rowP[1];
  }
?>

<div class="card card-spacer">
  <div class="card-body">
    <?php if ( isset($product) ): ?>
      <h5 class="card-title">Nowy słownik dla produktu: <?php echo $product; ?></h5>
        <form action="?p=settings" method="post">
          <input type="hidden" name="dictPid" value="<?php echo $pid; ?>" />
          <input type="hidden" name="dictCLFid" value="<?php echo $row[0]; ?>" />
          <div class="mb-3">
            <label for="dictionaryInput" class="form-label">Słownik:</label>
            <textarea class="form-control" id="dictionaryInput" name="dictionary" rows="2" placeholder="nazwa_pola1=>wyrażenie1,nazwa_pola2=>wyrażenie2"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Dodaj słownik</button>
        </form> 
      <?php else: ?>
        <h5 class="card-title">Nowy słownik dla produktu:</h5>
        <div class="alert alert-primary" role="alert">Nie znaleziono żadnych produktów.</div>
      <?php endif ?>
  </div>
</div>
