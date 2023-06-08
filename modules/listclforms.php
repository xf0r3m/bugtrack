<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Formularz list zmian:</h5>
    <div class="card card-spacer">
      <div class="card-body">
        <h6 class="card-title">Wybierz produkt:</h6>
          <?php
                $tableName = 'product';
                $columnScheme = 'id,name';
                $whereValue = "1=1";
                $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          ?>
          <?php if( mysqli_num_rows($result) > 0): ?>
            <form action="?p=settings" method="post">
              <div class="mb-3">
                <select class="form-select" aria-label="Choose product" name="viewCLFPid">
                  <?php
                    while ( $row = mysqli_fetch_row($result) ) {
                      if ( isset($_POST["viewCLFPid"]) ) {
                        if ( $_POST["viewCLFPid"] == $row[0] ) {
                          echo "<option selected value=\"" . $_POST["viewCLFPid"] . "\">" . $row[1] . "</option>";
                          continue;
                        }
                      }
                      echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
                    }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Pokaż formularz</button>
            </form>
          <?php else: ?>
            <div class="alert alert-primary" role="alert">Nie znaleziono żadnych produktów</div>
          <?php endif ?>
      </div>
    </div>
    <?php if ( isset($_POST) && isset($_POST["viewCLFPid"]) ): ?>
    <?php
      $tableName = "clform";
      $columnScheme = "id,code";
      $whereValue = "productId =" . intval($_POST["viewCLFPid"]);
      $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    ?>
      <?php if ( mysqli_num_rows($result) > 0 ): ?>
        <?php $row = mysqli_fetch_row($result); ?>
        <div class="card card-spacer">
          <h6 class="card-title">Podgląd formularza:</h6>
          <div class="card-body">
            <?php echo $row[1]; ?>
          </div>
        </div>
        <div class="card card-spacer">
          <h6 class="card-title">Kod formularza:</h6>
          <div class="card-body">
            <form action="?p=settings" method="post">
              <input type="hidden" name="CLFid" value="<?php echo $row[0]; ?>" />
              <div class="mb-3">
                <textarea class="form-control" id="CLFormCodeInput" name="editCLFormCode" rows="2" placeholder="Kod HTML formlarza. Znaczniki <script> są niedozwolone."><?php echo $row[1]; ?></textarea>
              </div>
              <button type="submit" class="btn btn-warning">Zapisz zmiany</button>
            </form>
          </div>
        </div>
        <?php
          $tableName = "dictionary";
          $columnScheme = "id,dictionary";
          $whereValue = "clformId = " . $row[0];
          $resultDict = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        ?>
        <?php if( mysqli_num_rows($resultDict) > 0 ): ?>
          <?php $rowD = mysqli_fetch_row($resultDict); ?>
        <div class="card card-spacer">
          <h6 class="card-title">Słownik:</h6>
          <div class="card-body">
           <form action="?p=settings" method="post">
              <input type="hidden" name="dictId" value="<?php echo $rowD[0]; ?>" />
              <div class="mb-3">
                <textarea class="form-control" name="editDict" rows="2" placeholder="nazwa_pola1=>wyrażenie1,nazwa_pola2=>wyrażenie2"><?php echo $rowD[1]; ?></textarea>
              </div>
              <button type="submit" class="btn btn-warning">Zapisz zmiany</button>
            </form>
          </div>
        </div>
        <?php else: ?>
          <?php include('forms/newdictionary.php'); ?>
        <?php endif ?>
      <?php else: ?>
        <div class="alert alert-primary" role="alert">Nie znaleziono formularza dla wybranego produktu</div>
        <?php include('forms/newclform.php'); ?>
      <?php endif ?>
    <?php else: ?>
      <div class="alert alert-primary" role="alert">Nie wybrano produktu</div>
    <?php endif ?>
  </div>
</div>
